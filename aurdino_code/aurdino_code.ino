// I2C device class (I2Cdev) demonstration Arduino sketch for ADXL345 class
// 10/7/2011 by Jeff Rowberg <jeff@rowberg.net>
// Updates should (hopefully) always be available at https://github.com/jrowberg/i2cdevlib
//
// Changelog:
//     2011-10-07 - initial release

/* ============================================
I2Cdev device library code is placed under the MIT license
Copyright (c) 2011 Jeff Rowberg

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
===============================================
*/

// Arduino Wire library is required if I2Cdev I2CDEV_ARDUINO_WIRE implementation
// is used in I2Cdev.h
#include "Wire.h"
#include <SPI.h>
#include <Ethernet.h>

// I2Cdev and ADXL345 must be installed as libraries, or else the .cpp/.h files
// for both classes must be in the include path of your project
#include "I2Cdev.h"
#include "ADXL345.h"

// class default I2C address is 0x53
// specific I2C addresses may be passed as a parameter here
// ALT low = 0x53 (default for SparkFun 6DOF board)
// ALT high = 0x1D
ADXL345 accel;

int16_t ax1, ay1, ax2,ay2,az,difx,dify;

#define LED_PIN 13 // (Arduino is 13, Teensy is 6)
bool blinkState = false;

//----------------Ethernet Settings--------------------//

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
 
// Enter the IP address for Arduino, as mentioned we will use 192.168.0.16
// Be careful to use , insetead of . when you enter the address here
IPAddress ip(10,10,25,18);

int tempPin = 0;  // Analog input pin on Arduino we connected the SIG pin from sensor
int tempReading;  // Here we will place our reading

char server[] = "10.10.25.10"; // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie. "www.yourwebpage.com")

// Initialize the Ethernet server library
EthernetClient client;

//-----------------Ethernet end --------------------------------//

void setup() {
    // join I2C bus (I2Cdev library doesn't do this automatically)

    
    Wire.begin();

    // initialize serial communication
    // (38400 chosen because it works as well at 8MHz as it does at 16MHz, but
    // it's really up to you depending on your project)
    Serial.begin(9600);
      // start the Ethernet connection
    Ethernet.begin(mac, ip);
    Serial.println("-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");     
    Serial.print("IP Address        : ");     
    Serial.println(Ethernet.localIP());     
    Serial.print("Subnet Mask       : ");     
    Serial.println(Ethernet.subnetMask());     
    Serial.print("Default Gateway IP: ");     
    Serial.println(Ethernet.gatewayIP());     
    Serial.print("DNS Server IP     : ");     
    Serial.println(Ethernet.dnsServerIP());  

    // initialize device
    Serial.println("Initializing I2C devices...");
    accel.initialize();

    // verify connection
    Serial.println("Testing device connections...");
    Serial.println(accel.testConnection() ? "ADXL345 connection successful" : "ADXL345 connection failed");

    
    // configure LED for output
    pinMode(LED_PIN, OUTPUT);

    ax1=ay1=ax2=ay2=az=0;
    
    Serial.println("======Setup end==========");
}

void loop() {
    // read raw accel measurements from device
    
    Serial.println("=====loop start==========");
    accel.getAcceleration(&ax2, &ay2, &az);

    difx=abs(ax2-ax1); dify=abs(ay2-ay1);
    // display tab-separated accel x/y/z values
    Serial.print("accel:\n");
    Serial.print(ax2); Serial.print("\t");
    Serial.print(ay2); Serial.print("\t");
    Serial.println(az);

    
    tempReading = (analogRead(tempPin))*500/1023; // Fill the sensorReading with the information from sensor
 
  // Connect to the server (your computer or web page)  
    if (client.connect(server, 80)) {
    
    Serial.println("connected");
    client.print("GET /JohnDeere/AddEngineTemp.php?tid=1&"); // This
    client.print("temp="); // This
    client.print(tempReading); // And this is what we did in the testing section above. We are making a GET request just like we would from our browser but now with live data from the sensor

    if(ax2>=200 || ay2 >=0 || (difx>=50&&dify>=30))
      client.print("&danger=yes");
    else
      client.print("&danger=no");
      
    client.println(" HTTP/1.1"); // Part of the GET request
    client.println("Host: 10.10.25.10"); // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie.Host: "www.yourwebpage.com")
    client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
    client.println(); // Empty line
    client.println(); // Empty line
    client.stop();    // Closing connection to server
    Serial.println("inserted"); 
  }

  else {
    // If Arduino can't connect to the server (your computer or web page)
    Serial.println("--> connection failed\n");
  }
 
    // Give the server some time to recieve the data and store it. I used 10 seconds here. Be advised when delaying. If u use a short delay, the server might not capture data because of Arduino transmitting new data too soon.
  
    // blink LED to indicate activity
    blinkState = !blinkState;
    digitalWrite(LED_PIN, blinkState);
    ax1=ax2; ay1=ay2;
    delay(1000);
}
