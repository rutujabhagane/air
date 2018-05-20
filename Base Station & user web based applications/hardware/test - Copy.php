<?php	
	require_once('classes/water_need.class.php');
	$water_need = new WaterNeed();
	foreach($water_need->getFarmWaterNeed($_GET['farm_id']) as $fetched){
		echo $fetched['volume'];
	}

?>