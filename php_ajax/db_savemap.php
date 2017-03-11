<?php
	include("../connection/connection.php");
	include("../module/module.php");
	connectDB();

	if(isset($_GET['hotel_id']) && isset($_GET['lat']) && isset($_GET['lon'])){
		$hotel_id = $_GET['hotel_id'];
		$hlat = $_GET['lat'];
		$hlon = $_GET['lon'];

		runSQL("UPDATE tbl_hotels SET hotel_lattitude=" . $hlat . ", hotel_longitude = " . $hlon . " WHERE hotel_id = " . $hotel_id);
		echo "Save successfully";
	}

?>