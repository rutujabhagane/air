#include <VirtualWire.h>    //Including virtualWire library , used for transmission
int farm_unit_id = 2;
int farm_id = 2;
const byte moisture_sensor_pin = A0; //Analog pin o 
const byte Tx_pin = 12; //Transmitter Pin
const byte Tx_led_pin = 9; //LED for transmitter
int sensor_value = 0; //variable to store the value coming from the sensor
int sensor_value_percentage = 0;
  

void setup(){
    //Pin configuarions
    pinMode(Tx_led_pin,OUTPUT);
    
    Serial.begin(9600); // Starting serial communication
    //transmitter configurations
    vw_set_ptt_inverted(true); // Required for RF Link module
    vw_set_tx_pin(Tx_pin); // setting transmitter pin 
    vw_setup(2000);// speed of data transfer Kbps
    Serial.println(" System started successfully (Farm 2 Farm Unit)"); // Printing message to serial monitor
}

void loop(){
    sensor_value = analogRead(moisture_sensor_pin); // Reading values from sensor
    /*
        Maping sensor readings to 0-100
        In a drys soil readings = 550 while wet soil readings = 10
    */
    sensor_value_percentage = map(sensor_value,550,10,0,100);
    Serial.print("Sensor readings: ");
    Serial.println(sensor_value_percentage);
    transmitMoistureReadings(sensor_value_percentage,farm_unit_id,farm_id); //calling sendMoistureReadings to send moisture via a transmitter
    delay(5000);          
    
}


/*
    Function for sending moisture readings to Pumping Unit Controller(mCII) using a transmitter
    argument: sensor_readings(int),farm_unit_id(int)
*/
void transmitMoistureReadings(int sensor_readings,int farm_unit_id,int farm_id){
    digitalWrite(Tx_led_pin,1);
    
    char output[6]; // buffer to send 
    sprintf(output,"%d,%d,%d,",sensor_readings,farm_unit_id,farm_id);
    vw_send((uint8_t *)output, strlen(output));
    vw_wait_tx(); // Wait until the whole message is gone
    digitalWrite(Tx_led_pin,0);
}
