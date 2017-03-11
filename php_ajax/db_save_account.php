<?php
	ob_start();
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_POST)){
		include("../module/module.php");
		include("../connection/connection.php");

		$u_id = randomID("tbl_users","user_id");
		$u_name = $_POST['txtusername'];
		$u_password = $_POST['txtpassword'];
		$u_email = $_POST['txtemail'];
		$u_profile_name = $_POST['txtprofilename'];
		$u_type = $_POST['user_type'];
		$has_email = getResultSet("SELECT * FROM tbl_users WHERE user_email = '" . $u_email . "'");

		$u_password = md5($u_password);
		if(mysql_num_rows($has_email)>0){
			echo "This email has registered already.";
		}
		else{
			$sql_st = "INSERT INTO tbl_users(user_id,user_name,user_password,level_id,user_profile_name,user_email) VALUES(" . $u_id . ",'" . $u_name . "','" . $u_password . "'," . $u_type . ",'" . $u_profile_name . "','" . $u_email . "')";
			runSQL($sql_st);
			$_SESSION['_user_13_5_2011_id'] = $u_id;
		}
		if(getValue("SELECT level_name FROM tbl_user_level WHERE level_id = " . $u_type) == REGISTERER){
			header("location:../?mangoparam=add_hotel&menu=1");
		}
		else{
			header("location:../?mangoparam=home");
		}
	}
?>