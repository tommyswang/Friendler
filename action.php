<?php
	require 'location.php';
	$edu = new Location;
	$edu->setId($_REQUEST['id']);
	$edu->setLat($_REQUEST['Latitude']);
	$edu->setLng($_REQUEST['Longitude']);
	$status = $edu->updateLocsWithLatLng();
	if($status == true) {
		echo "Updated...";
	} else {
		echo "Failed...";
	}
 ?>
