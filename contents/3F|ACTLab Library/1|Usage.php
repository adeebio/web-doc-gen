\h1_pb{Usage}

\n|

The following code is the bare minimum needed of an Arduino sketch to use the ACTLab Library:
    
\code{
// Library includes.
#include <SD.h>
#include <SPI.h>
#include <Ethernet.h>
#include <ACTLab.h>

void setup() <
  // Begin the serial connection with a 9600 baud.
  Serial.begin(9600);
  
  // Configure ACTLab.
  ACTLab.rig("tr");
  ACTLab.MAC(0x90,0xA2,0xDA,0x00,0x7F,0xAB);
  ACTLab.SDBuffer(0);
  ACTLab.serialMessages(1);
  
  // Start the ACTLab Library.
  ACTLab.start();
>

void loop() <
>
}

...Opps, I cheated a bit here, the angle brackets are meant to be curly, but there's bug at the moment :o(...