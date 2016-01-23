#include <iostream>
#include "WebClient.hpp"

using namespace std;

int main(int argc, char** argv) {

    WebClient client("http://google.ro");

    client.postField("data", "dev");
    
    if (client.makeGet()) {
        cout << client.getResult() << endl;
    }
    
    return 0;
}

