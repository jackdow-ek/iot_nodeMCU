#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
int Led_OnBoard = 2;        
const char* ssid = "your wifi ssid";  
const char* password = "your wifi password";
const char *host = "your host ip";
float resolution=3.3/1023;
void setup() {
  delay(1000);
  pinMode(Led_OnBoard, OUTPUT);
  Serial.begin(115200);
  WiFi.mode(WIFI_OFF);
  delay(1000);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(Led_OnBoard, LOW);
    delay(250);
    digitalWrite(Led_OnBoard, HIGH);
    delay(250);
  }
  digitalWrite(Led_OnBoard, HIGH);
  Serial.println(WiFi.localIP());
}
void loop() {
  HTTPClient http;
  String TmpGonder, postData;
  float ldrvalue=(analogRead(A0) * resolution) * 100;
  TmpGonder = String(ldrvalue);
  postData = "ldrvalue=" + TmpGonder;
  http.begin("http://192.168.1.105/Nodemcu_db_record_view/InsertDB.php");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  int httpCode = http.POST(postData);
  String payload = http.getString();
  http.end();
  delay(4000);
  digitalWrite(Led_OnBoard, LOW);
  delay(1000);
  digitalWrite(Led_OnBoard, HIGH);
}
