/* 
 * File:   WebClient.cpp
 * Author: Ionut
 * 
 * Created on September 12, 2014, 11:18 AM
 */

#include "WebClient.hpp"
#include <cstdio>

WebClient::WebClient() {
    curl_global_init(CURL_GLOBAL_ALL);
    encodedPostFields = NULL;
    m_curl = curl_easy_init();
    curl_easy_setopt(m_curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_easy_setopt(m_curl, CURLOPT_WRITEFUNCTION, writeDataCallback);
    curl_easy_setopt(m_curl, CURLOPT_WRITEDATA, this);
    
#ifdef DEBUG
    curl_easy_setopt(m_curl, CURLOPT_VERBOSE, 1);
#endif
}

WebClient::WebClient(const std::string& url) : WebClient() {
    setURL(url);
}

WebClient::WebClient(const WebClient& orig) {}

/**
 * Generic make request. As default it's a GET request.
 * 
 * @return 
 */
bool WebClient::makeRequest() {
    m_data.clear();
    return 0 == curl_easy_perform(m_curl);
}

/**
 * Make the post request
 * 
 * @return bool 
 */
bool WebClient::makePost() {
   
    if (encodedPostFields != NULL) {
        delete encodedPostFields;
    }
    
    encodedPostFields = strdup(encodePostFields().c_str());
    
    curl_easy_setopt(m_curl, CURLOPT_POST, 1);
    curl_easy_setopt(m_curl, CURLOPT_POSTFIELDS, encodedPostFields);
    
    return makeRequest();
}

/**
 * Make the get request
 * 
 * @return bool 
 */
bool WebClient::makeGet() {
    curl_easy_setopt(m_curl, CURLOPT_POST, 0);
    
    return makeRequest();
}

/**
 * Make delete request
 * 
 * @return bool
 */
bool WebClient::makeDelete() {
    
    curl_easy_setopt(m_curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    
    return makePost();
}

/**
 * 
 * Add new post fields to the request
 * 
 * @param key std::string
 * @param value std::string
 * @return void
 */
void WebClient::postField(std::string key, std::string value) {
    m_postfields[key] = value;
}

/**
 * Reset the post fields
 */
void WebClient::reset() {
    m_postfields.clear();
}

/**
 * Set url to the curl client
 * 
 * @param url
 */
void WebClient::setURL(const std::string& url) {
    curl_easy_setopt(m_curl, CURLOPT_URL, url.c_str());
}

/**
 *  Encode query to work with curl client
 * 
 * @param str
 * @return std::string 
 */
std::string WebClient::urlEncode(const std::string& str) {
    char * escaped =  curl_easy_escape(m_curl, str.c_str(), str.size());
    std::string ret = std::string(escaped);
    curl_free(escaped);
    return std::string(ret);
}

/**
 * 
 * Encodes the postfields
 * @example username=test&password=test
 * 
 * @return std::string 
 */
std::string WebClient::encodePostFields() {
    
    std::string urlencoded = "";

    for (std::map<std::string, std::string>::iterator it = m_postfields.begin(); it != m_postfields.end(); ++it)
    {
        if (it != m_postfields.begin())
            urlencoded.append("&");
        urlencoded.append(it->first + "=" + it->second);
    }
    
    return urlencoded;
}

/**
 * Static function used as a callback for receiving html/json content
 * 
 * @param buffer
 * @param size
 * @param nmemb
 * @param thisPtr
 * @return 
 */

size_t WebClient::writeDataCallback(char *buffer, size_t size, size_t nmemb, void* thisPtr) { 
    if (thisPtr) 
        return ((WebClient*) thisPtr)->writeData(buffer, size, nmemb); 
    else 
        return 0; 
} 

/**
 * Function used to write the received html/json content to a c++ string.
 * 
 * @param buffer
 * @param size
 * @param nmemb
 * @return 
 */
size_t WebClient::writeData(char *buffer, size_t size, size_t nmemb) { 
  int result = 0; 
    if(buffer != 0){ 
      m_data.append(buffer, size*nmemb); 
      result = size*nmemb; 
  } 
  return result; 
} 

WebClient::~WebClient() {
    
    if (encodedPostFields) {
        delete encodedPostFields;
    }
    
    curl_easy_cleanup(m_curl);
    curl_global_cleanup();
}

