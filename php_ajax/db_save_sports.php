<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION['viewing_hotel_id'])){
		$hotel_id = $_SESSION['viewing_hotel_id'];
		include("../module/module.php");
		include("../connection/connection.php");

		//if(isset($_POST['submit'])) {

			if(isset($_GET['input_sports'])) {
                runSQL("DELETE FROM tbl_hotel_sports WHERE hotel_id = " . $hotel_id);
                $val_sports = explode(";",$_GET['input_sports']);

				foreach($val_sports as $sports) {
				    if($sports == "") continue;
					if(preg_match('/[0-9]+/', $sports)){
						$o_sql = "INSERT INTO tbl_hotel_sports(hotel_id,sport_id)";
						$o_sql .= " VALUES (";
						$o_sql .= "". $hotel_id ."";
						$o_sql .= ",".htmlspecialchars($sports);
						$o_sql .= ")";
					}
					else{
						$o_sql = "INSERT INTO tbl_hotel_sports(hotel_id,sport_id,sport_description)";
						$o_sql .= " VALUES(";
						$o_sql .= $hotel_id . ",";
						$o_sql .= "0,";
						$o_sql .= "'" . htmlspecialchars($sports) . "'";
						$o_sql .= ")";
					}
					runSQL($o_sql);
				}

			}

		} else {
		}
	//}
	//header("location:../?mangoparam=add_hotel&menu=3");
?>