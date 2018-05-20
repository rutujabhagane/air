<?php
require_once('classes/moisture_sensor.class.php');
$moistureSensor = new MoistureSensor();

$timestamp = date("d-m-Y - H:i:s");
$params = $_POST["params"];

$params = explode(",",$params);
$farm_id = $params[0];
$moisture_sensor_readings = $params[1];

$moistureSensor->postMoistureSensorData($farm_id,$moisture_sensor_readings);

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $timestamp . " - ".$farm_id." - ". $moisture_sensor_readings ."\n";
fwrite($myfile, $txt);
fclose($myfile);
echo $txt;
?>