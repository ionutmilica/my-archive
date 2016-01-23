#ifndef WEBCLIENT_HPP
#define	WEBCLIENT_HPP

#include <curl/curl.h>
#include <string.h>
#include <cstdarg>
#include <iostream>
#include <map>

class WebClient {
public:
    WebClient();
    WebClient(const std::string&);
    bool makeRequest();
    bool makePost();
    bool makeGet();
    bool makeDelete();
    void postField(std::string, std::string);
    std::string getResult() { return m_data; }
    void reset();
    void setURL(const std::string&);
    virtual ~WebClient();
protected:
    CURL* m_curl;
    std::string m_data;
    std::map<std::string, std::string> m_postfields;
    std::string urlEncode(const std::string&);
    char * encodedPostFields;
protected:
    std::string encodePostFields();
    static size_t writeDataCallback(char*, size_t, size_t, void*);
    size_t writeData(char* buffer, size_t size, size_t nmemb); 
private:
    WebClient(const WebClient& orig);
};

#endif	/* WEBCLIENT_HPP */

