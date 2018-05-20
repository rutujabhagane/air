#include <VirtualWire.h>    //Including virtualWire library , used for receiving
#include <SoftwareSerial.h> //Software Serial , for GSM shield
#include <Wire.h>

//GSM setup
SoftwareSerial gsmSerial(7, 8);  // RX, TX Pins

//Enumerations for different states, used in the parseATText for getting the data from the server
enum _parseState {
  PS_DETECT_MSG_TYPE,

  PS_IGNORING_COMMAND_ECHO,

  PS_HTTPACTION_TYPE,
  PS_HTTPACTION_RESULT,
  PS_HTTPACTION_LENGTH,

  PS_HTTPREAD_LENGTH,
  PS_HTTPREAD_CONTENT
};

enum _actionState {
  WAITING_FOR_RESPONSE,
  STATE_IDLE
};

//used for the parseATText
byte parseState = PS_DETECT_MSG_TYPE;
byte actionState = STATE_IDLE;
char buffer[80];
byte pos = 0;
int contentLength = 0;

void resetBuffer() {
  memset(buffer, 0, sizeof(buffer));
  pos = 0;
}


const byte Rx_led_pin = 10; //LED for receiver
const byte Relay_pin = 11; //Relay Pin

/* Considering two valves for two farms connected to the this unit (actuating unit) 
   pin 3, for first farm
   pin 4 , for second farm 
*/
const byte Farm1_Mosfet_pin = 13; //Mosfet pin to control the Solenoid valve for farm 1
const byte Farm2_Mosfet_pin = 4; //Mosfet pin to control the Solenoid valve for farm 2

const byte flowRate_pin = 2;    //This is the input pin on the Arduino
double flowRate;    //This is the value we intend to calculate. 
volatile int pulsecount; //This integer needs to be set as volatile to ensure it updates correctly during the interrupt process.
char *received_data; //variable for getting data
float AmtOfWater;
int farm_id;
int farm_unit_id;
int moisture_sensor_readings;
int temperature_readings;
char gsmData[100];

void setup(){
    Serial.begin(9600); // Starting serial communication
    gsmSerial.begin(9600); //set the data rate for the SoftwareSerial port
  
    //Pin configurations
    pinMode(Rx_led_pin, OUTPUT);
    pinMode(Relay_pin,OUTPUT);
    pinMode(Farm1_Mosfet_pin,OUTPUT);
    pinMode(Farm2_Mosfet_pin,OUTPUT);
    pinMode(flowRate_pin, INPUT);  //Sets flow rate sensor pin as input
    attachInterrupt(0, Flow, RISING);  //Configures interrupt 0 (pin 2 on the Arduino Uno) to run the function "Flow" 

    //Reciever configuarations
    vw_set_ptt_inverted(true); // Required for RF Link module
    vw_set_rx_pin(12); // setting receiver pin 
    vw_setup(2000);// speed of data transfer Kbps
    vw_rx_start();  // Start the receiver
    Serial.println("System started successfully (Actuating Unit)"); // Printing message to serial monitor
    delay(5000);
}

void loop(){
    delay(3000);
   received_data = receiveSensorReadings();
   delay(3000);
   //If data is received
   if(received_data != "0"){
     sscanf(received_data,"%d,%d,%d,%d",&moisture_sensor_readings,&temperature_readings,&farm_unit_id,&farm_id);
     delay(1000);
     Serial.print("Moisture Readings received: ");
     Serial.println(moisture_sensor_readings);
     
     Serial.print("Temperature Readings received: ");
     Serial.println(temperature_readings);
     
     Serial.print("Farm unit id: ");
     Serial.println(farm_unit_id);
     Serial.print("Farm id: ");
     Serial.println(farm_id);
     sprintf(gsmData, "params=%d,%d,%d,%d", moisture_sensor_readings, farm_unit_id, temperature_readings,farm_id); //putting data in gsmData variable
     //gsm_postToServer();
      /*
          if(SOIL IS DRY){
              //TURN RELAY ON TO TURN ON PUMP
              if(flow rate sensor has a reading){
                  //OPEN SOLENOID TO THAT FARM 
              }else{
                  //CONTINUE TO CLOSE SOLENOID TO THE FARM 
                  //NOTIFICATION, TO INDICATE NO WATER IS FLOWING
              }
          }
      */

      /**/
      pulsecount = 0; // Reset counter
      
      if(moisture_sensor_readings < -60){ //Soil is dry
        gsm_postToServer();
        digitalWrite(Relay_pin,HIGH); // Turns ON Relay connected to the pump
        digitalWrite(Farm1_Mosfet_pin, HIGH); 
        
        interrupts();   //Enables interrupts on the Arduino, for the flow rate sensor
        delay(9000);
        flowRate = (pulsecount * 2.25);    //Take counted pulses in the last second and multiply by 2.25mL 
        flowRate = flowRate * 60;         //Convert seconds to minutes, giving you mL / Minute
        flowRate = flowRate / 1000;       //Convert mL to Liters, giving you Liters / Minute
        float thef = 4.5;
        Serial.print("Flow rate: ");
        Serial.println(thef);
        if(thef != 0){ //there is water flowing
          float time_to_run = 0;
          switch(farm_id){
            case 1:
              //Farm1_openSolenoid();

              //get the amount of water from server and calculate the time , delay 
              //gsm_getFromServer(farm_id);
              AmtOfWater = 2.5;
              delay(3000);
              Serial.print("The amount of water: ");
              Serial.println(AmtOfWater);
              Serial.print("Flow rate: ");
              Serial.println(thef);
              time_to_run = ((1/thef)*AmtOfWater)*60000;
              Serial.println(time_to_run);
              delay(time_to_run);
              Serial.println("Stop");
              digitalWrite(Farm1_Mosfet_pin, LOW); 
            break;
            case 2:
              Farm2_openSolenoid();
       
              //get the amount of water from server and calculate the time , delay 
              gsm_getFromServer(farm_id);
              delay(3000);
              Serial.print("The amount of water: ");
              Serial.println(AmtOfWater);
              time_to_run = ((1/flowRate)*AmtOfWater)*60000;
              delay(time_to_run);
              Farm2_closeSolenoid(); //Turn off solenoid
            break;
            default:
              Serial.println("No farm with id is found");
          }
          noInterrupts(); //Disable the interrupts on the Arduino
          digitalWrite(Relay_pin,LOW); // Turns OFF Relay connected to the pump
          
        }else{
          Serial.println("No water is flowing in the main water channel");
          delay(20000);
          digitalWrite(Relay_pin,LOW); // Turns OFF Relay connected to the pump
        }
        
      }

      /*
        SED DATA VIA GSM
        Data: farm_id,sensor readings,flowRate,Sensor ID,Farm Block,Time 
      */
      
    }
    delay(6000);
    
}

char *receiveSensorReadings(){
  static char StringReceived[8];
  digitalWrite(Rx_led_pin,1);
  uint8_t buf[VW_MAX_MESSAGE_LEN];
  uint8_t buflen = VW_MAX_MESSAGE_LEN;
  if(vw_wait_rx_max(200)){
      if (vw_get_message(buf, &buflen)) {  //Checking if there was a message, getting data
        Serial.println("Message received");
        int i;
        for (i = 0; i < buflen; i++)  {          // CHECKSUM OK ? GET MESSAGE           
          StringReceived[i] = char(buf[i]);      // FILL THE ARRAY 
        } 
        digitalWrite(Rx_led_pin,0);
        return StringReceived;
      }else{
        Serial.println("No message recieved");
      }    
  }
  digitalWrite(Rx_led_pin,0);
  return "0"; //A zero string indicating no data was recieved
}

//function to open solenoid to first farm
void Farm1_openSolenoid(){
  digitalWrite(Farm1_Mosfet_pin, HIGH); 
}

//function to close solenoid to first farm
void Farm1_closeSolenoid(){
  digitalWrite(Farm1_Mosfet_pin, LOW);
}


//function to open solenoid to second farm
void Farm2_openSolenoid(){
  digitalWrite(Farm2_Mosfet_pin, HIGH); 
}

//function to close solenoid to second farm
void Farm2_closeSolenoid(){
  digitalWrite(Farm2_Mosfet_pin, LOW);
}

//Interrupt Service Routine
void Flow(){
   pulsecount++; //Every time this function is called, increment "count" by 1
}


/***** GSM FUNCTIONS *****/

//function for printing GSM status
void printGSMStatus() {
  while (gsmSerial.available()) {
    Serial.write(gsmSerial.read());
  }
}

//funtion for posting to a server
void gsm_postToServer() {
  Serial.println("sending data to server");
  gsmSerial.println("AT"); 
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+SAPBR=3,1,Contype,GPRS");
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+SAPBR=3,1,APN,internet");
  printGSMStatus();
  delay(2000);
  gsmSerial.println("AT+SAPBR =1,1");
  printGSMStatus();
  delay(2000);
  gsmSerial.println("AT+SAPBR=2,1");
  printGSMStatus();
  delay(2000);
  gsmSerial.println("AT+HTTPINIT");
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+HTTPPARA=CID,1");
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+HTTPPARA=URL,http://www.airgh.com/hardware/test.php");
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+HTTPPARA=CONTENT,application/x-www-form-urlencoded");
  printGSMStatus();
  delay(500);
  gsmSerial.println("AT+HTTPDATA=192,10000");
  printGSMStatus();
  delay(100);
  gsmSerial.println(gsmData);
  printGSMStatus();
  delay(10000);
  gsmSerial.println("AT+HTTPACTION=1");
  printGSMStatus();
  delay(5000);
  gsmSerial.println("AT+HTTPREAD");
  printGSMStatus();
  delay(100);
  gsmSerial.println("AT+HTTPTERM");
  printGSMStatus(); 
}

//function for getting data from server into variable, will print to serial mornitor too
void getData() {
  actionState = WAITING_FOR_RESPONSE;
  while(actionState == WAITING_FOR_RESPONSE){
    delay(500);
    while (gsmSerial.available()) {
      parseATText(gsmSerial.read());
    }
  }
}

void gsm_getFromServer(int farm_id) {
  String id = String(farm_id);
  Serial.println("Receiving data from server");
  gsmSerial.println("AT"); 
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+SAPBR=3,1,Contype,GPRS");
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+SAPBR=3,1,APN,internet");
  printGSMStatus();
  delay(2000);
  gsmSerial.println("AT+SAPBR =1,1");
  printGSMStatus();
  delay(2000);
  gsmSerial.println("AT+SAPBR=2,1");
  printGSMStatus();
  delay(2000);
  gsmSerial.println("AT+HTTPINIT");
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+HTTPPARA=CID,1");
  printGSMStatus();
  delay(1000);
  gsmSerial.println("AT+HTTPPARA=URL,http://airgh.com/hardware/test2.php?farm_id="+id);
  printGSMStatus();
  delay(2000);
  gsmSerial.println("AT+HTTPACTION=0");
  printGSMStatus();
  delay(9000);
  gsmSerial.println("AT+HTTPREAD");
  getData(); //printing to serial mornitor and get data from server to the variable, amountOfWaterNeeded
  delay(10000);
  gsmSerial.println("AT+HTTPTERM");
  printGSMStatus(); 
}


void parseATText(byte b) {

  buffer[pos++] = b;

  if ( pos >= sizeof(buffer) )
    resetBuffer(); // just to be safe

  /*
   // Detailed debugging
   Serial.println();
   Serial.print("state = ");
   Serial.println(state);
   Serial.print("b = ");
   Serial.println(b);
   Serial.print("pos = ");
   Serial.println(pos);
   Serial.print("buffer = ");
   Serial.println(buffer);*/

  switch (parseState) {
  case PS_DETECT_MSG_TYPE: 
    {
      if ( b == '\n' )
        resetBuffer();
      else {        
        if ( pos == 3 && strcmp(buffer, "AT+") == 0 ) {
          parseState = PS_IGNORING_COMMAND_ECHO;
        }
        else if ( b == ':' ) {
          //Serial.print("Checking message type: ");
          //Serial.println(buffer);

          if ( strcmp(buffer, "+HTTPACTION:") == 0 ) {
            Serial.println("Received HTTPACTION");
            parseState = PS_HTTPACTION_TYPE;
          }
          else if ( strcmp(buffer, "+HTTPREAD:") == 0 ) {
            Serial.println("Received HTTPREAD");            
            parseState = PS_HTTPREAD_LENGTH;
          }
          resetBuffer();
        }
      }
    }
    break;

  case PS_IGNORING_COMMAND_ECHO:
    {
      if ( b == '\n' ) {
        Serial.print("Ignoring echo: ");
        Serial.println(buffer);
        parseState = PS_DETECT_MSG_TYPE;
        resetBuffer();
      }
    }
    break;

  case PS_HTTPACTION_TYPE:
    {
      if ( b == ',' ) {
        Serial.print("HTTPACTION type is ");
        Serial.println(buffer);
        parseState = PS_HTTPACTION_RESULT;
        resetBuffer();
      }
    }
    break;

  case PS_HTTPACTION_RESULT:
    {
      if ( b == ',' ) {
        Serial.print("HTTPACTION result is ");
        Serial.println(buffer);
        parseState = PS_HTTPACTION_LENGTH;
        resetBuffer();
      }
    }
    break;

  case PS_HTTPACTION_LENGTH:
    {
      if ( b == '\n' ) {
        Serial.print("HTTPACTION length is ");
        Serial.println(buffer);
        
        // now request content
        gsmSerial.print("AT+HTTPREAD=0,");
        gsmSerial.println(buffer);
        
        parseState = PS_DETECT_MSG_TYPE;
        resetBuffer();
      }
    }
    break;

  case PS_HTTPREAD_LENGTH:
    {
      if ( b == '\n' ) {
        contentLength = atoi(buffer);
        Serial.print("HTTPREAD length is ");
        Serial.println(contentLength);
        
        Serial.print("HTTPREAD content: ");
        
        parseState = PS_HTTPREAD_CONTENT;
        resetBuffer();
      }
    }
    break;

  case PS_HTTPREAD_CONTENT:
    {
      // for this demo I'm just showing the content bytes in the serial monitor
      //Serial.write(b);
      
      contentLength--;
      
      if ( contentLength <= 0 ) {

        // all content bytes have now been read
        AmtOfWater=atof(buffer);
        Serial.println(AmtOfWater);
        actionState = STATE_IDLE;
        parseState = PS_DETECT_MSG_TYPE;
        
        resetBuffer();
      }
    }
    break;
  }
}

/***** END GSM FUNCTIONS *****/
