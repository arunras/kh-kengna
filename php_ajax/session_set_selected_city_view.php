<?php
	ob_start();
	if(!isset($SESSION)){
		session_start();
	}
	
	$_SESSION['city_selected'] = $_POST['city_id'];
	echo $_SESSION['city_selected'];
?>