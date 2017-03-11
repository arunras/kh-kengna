<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}

	
	if(isset($_SESSION['_user_13_5_2011_id'])){
		unset($_SESSION['_user_13_5_2011_id']);
	}
	
	$cur_page = "alfDFc0_Ky";
	$cur_page = $_SESSION['_cur_Page'];
	header("location:?mangoparam=" . $cur_page);
?>