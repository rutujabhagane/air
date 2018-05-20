<?php
require_once('../classes/moisture_sensor.class.php');
require_once('../classes/temperature_sensor.class.php');
$moistureSensor = new MoistureSensor();
$temperatureSensor = new TemperatureSensor();

$timestamp = date("Y-m-d H:i:s");
$params = $_POST["params"];

$params = explode(",",$params);
$moisture_sensor_readings = $params[0];
$farm_unit_id = $params[1];
$temperature_sensor_readings = $params[2];
$farm_id = $params[3];


$moistureSensor->postMoistureSensorData($farm_unit_id,$moisture_sensor_readings,$timestamp);
$temperatureSensor ->postTemperatureSensorData($farm_unit_id,$temperature_sensor_readings,$timestamp);

$myfile = fopen("post_details.txt", "w") or die("Unable to open file!");
$txt = $timestamp . " = ".$farm_unit_id." - ". $moisture_sensor_readings . " - ".$temperature_sensor_readings." - ".$farm_id."\n";
fwrite($myfile, $txt);
fclose($myfile);
echo $txt;
?>