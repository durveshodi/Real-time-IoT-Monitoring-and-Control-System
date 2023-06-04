#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "xxxxxxxxxxx";
const char* password = "xxxxxxxxxxx";
const char* jsonURL = "http://xxxxxxxxxxx/data.php"; // Replace with your PHP bridge URL
const char* updates = "http://xxxxxxxxxxx/update_data.php";


// MySQL database configuration
const char* mysqlServer = "localhost";
const char* mysqlUser = "xxxxxxxxxxx";
const char* mysqlPassword = "xxxxxxxxxxx";
const char* mysqlDatabase = "xxxxxxxxxxx";

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;

    // Send GET request to the JSON file
    if (http.begin(client, jsonURL)) {
      int httpResponseCode = http.GET();

      if (httpResponseCode > 0) {
        String payload = http.getString();
        Serial.println("Received data: " + payload);

        // Parse JSON array
        DynamicJsonDocument doc(2048);
        DeserializationError error = deserializeJson(doc, payload);

        if (error) {
          Serial.println("Invalid JSON");
          return;
        }

        // Process each JSON object in the array
        for (JsonVariant value : doc.as<JsonArray>()) {
          // Extract action, pin, value, and frequency from JSON
          String action = value["action"];
          String pinName = value["pin"];
          int pin = getPin(pinName);
          int frequency = value["frequency"];
          int pinValue = value["value"];

          // Perform pin control action
          if (action == "read") {
            if (pin >= 0 && pin <= 20) {
              if (pin == A0) {
                pinValue = analogRead(A0);
                Serial.print("Analog value (A0): ");
              } else {
                pinValue = digitalRead(pin);
                Serial.print("Digital value (");
                Serial.print(pinName);
                Serial.print("): ");
              }
              Serial.println(pinValue);
              updateDatabase(pinName, pinValue);
            } else {
              Serial.println("Invalid pin");
            }
          } else if (action == "write") {
            if (pin >= 0 && pin <= 20) {
              if (pin == A0) {
                if (pinValue >= 0 && pinValue <= 1023) {
                  analogWrite(A0, pinValue);
                  Serial.print("Analog write (A0): ");
                  Serial.println(pinValue);
                  readAndUpdateDatabase(pin);
                } else {
                  Serial.println("Invalid value");
                }
              } else {
                if (pinValue == 0 || pinValue == 1) {
                  pinMode(pin, OUTPUT);
                  digitalWrite(pin, pinValue);
                  Serial.print("Digital write (");
                  Serial.print(pinName);
                  Serial.print("): ");
                  Serial.println(pinValue);
                  readAndUpdateDatabase(pin);
                } else {
                  Serial.println("Invalid value");
                }
              }
            } else {
              Serial.println("Invalid pin");
            }
          } else {
            Serial.println("Unknown action");
          }
        }
      } else {
        Serial.print("Error in HTTP request: ");
        Serial.println(httpResponseCode);
      }

      http.end();
    } else {
      Serial.println("Failed to connect to JSON file");
    }
  } else {
    Serial.println("WiFi connection lost");
  }

  delay(5000); // Wait for 5 seconds before the next request
}

int getPin(const String& pinName) {
  if (pinName == "D0") {
    return D0;
  } else if (pinName == "D1") {
    return D1;
  } else if (pinName == "D2") {
    return D2;
  } else if (pinName == "D3") {
    return D3;
  } else if (pinName == "D4") {
    return D4;
  } else if (pinName == "D5") {
    return D5;
  } else if (pinName == "D6") {
    return D6;
  } else if (pinName == "D7") {
    return D7;
  } else if (pinName == "D8") {
    return D8;
  } else if (pinName == "A0") {
    return A0;
  } else {
    return -1;
  }
}

void updateDatabase(String name, int value) {
    WiFiClient client2;
    HTTPClient http2;
  
   String url = String(updates) + "?pin=" + name + "&value=" + String(value); // Added "?"
  if (http2.begin(client2, url)) {
      int httpResponseCode = http2.GET();
      if (httpResponseCode > 0) {
    Serial.println("Updating database: " + name + " : " + String(value));
  } else {
    Serial.println("Failed to connect to MySQL server");
   }
 }
}

void readAndUpdateDatabase(int pin) {
  int value = digitalRead(pin);
  //updateDatabase(String(pin), value);
}
