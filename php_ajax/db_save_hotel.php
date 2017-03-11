<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}
	$hotel_id=0;
	/*if(isset($_SESSION['added_hotel_id'])){
		$hotel_id = $_SESSION['added_hotel_id'];
	}*/

	include("../module/module.php");
	include("../connection/connection.php");


	$country = $_POST['country'];
	$country = 1; 						//Country in this version is only cambodia
	$hotel = $_POST['hotel'];

	$city = $_POST['city'];
	$khan = $_POST['khan'];
	$sangkat = $_POST['sangkat'];

	$des = $_POST['description'];
	$address = $_POST['address'];
	$star = $_POST['star'];
	$hotel_id = randomID("tbl_hotels","hotel_id");


	$o_sql = "INSERT INTO tbl_hotels(hotel_id,hotel_name,hotel_description,hotel_star,hotel_city,hotel_khan,hotel_sangkat,hotel_address,hotel_images)";
	$o_sql .= " VALUES (";
	$o_sql .= $hotel_id.",";
	$o_sql .= "'".$hotel."',";
	$o_sql .= "'". $des . "',";
	$o_sql .= "" . $star . ",";
	$o_sql .= "" . $city . ",";
	$o_sql .= "" . $khan . ",";
	$o_sql .= "" . $sangkat . ",";
	$o_sql .= "'".$address."',";
	$o_sql .= "' '";
	$o_sql .= ")";

	$_SESSION['added_hotel_id']= $hotel_id;
	//echo $address;
	//echo $o_sql . "<br/>";


	runSQL($o_sql);
	$user_id = $_SESSION['_user_13_5_2011_id'];
	$o_sql = "INSERT INTO tbl_user_hotels(user_id,hotel_id) VALUES(" . $user_id . "," . $hotel_id . ")";
	runSQL($o_sql);
	/*----------------------------- save hotel --------------------------------*/

	//echo "<center><h3>".$hotel."</h3><span>has registered successfully!</span></center>";
	header("location:../?mangoparam=detail&id=" . $hotel_id);

?>
