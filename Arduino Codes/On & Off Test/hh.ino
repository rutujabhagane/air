const byte flowRate_pin = 2;    //This is the input pin on the Arduino
double flowRate;    //This is the value we intend to calculate. 
volatile int pulsecount; //This integer needs to be set as volatile to ensure it updates correctly during the interrupt process.
const byte Farm1_Mosfet_pin = 13; //Mosfet pin to control the Solenoid valve for farm 1
const byte Relay_pin = 11; //Relay Pin

void setup() {
  Serial.begin(9600);
  pinMode(flowRate_pin, INPUT);  //Sets flow rate sensor pin as input
  pinMode(Farm1_Mosfet_pin,OUTPUT);
  pinMode(Relay_pin,OUTPUT);
  attachInterrupt(0, Flow, RISING);  //Configures interrupt 0 (pin 2 on the Arduino Uno) to run the function "Flow" 
}

void loop() { // run over and over
  delay(1000);
  digitalWrite(Relay_pin,HIGH); // Turns ON Relay connected to the pump
  digitalWrite(Farm1_Mosfet_pin, HIGH); 
  //delay(1000);
  //digitalWrite(Farm1_Mosfet_pin, LOW); 
}

//Interrupt Service Routine                                   
void Flow(){
   pulsecount++; //Every time this function is called, increment "count" by 1
}






