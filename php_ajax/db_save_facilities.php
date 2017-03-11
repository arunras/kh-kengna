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

			if(isset($_GET['input_facilities'])) {
                runSQL("DELETE FROM tbl_hotel_facilities WHERE hotel_id = " . $hotel_id);
                $val_facilities = explode(";",$_GET['input_facilities']);
				foreach($val_facilities as $facilities) {
				  if($facilities == "") continue;
					if(preg_match('/[0-9]+/', $facilities)){
						$o_sql = "INSERT INTO tbl_hotel_facilities (hotel_id,facility_id)";
						$o_sql .= " VALUES (";
                        $o_sql .= "". $hotel_id ."";
						$o_sql .= ",".htmlspecialchars($facilities);
						$o_sql .= ")";
					}
					else{
                        $o_sql = "INSERT INTO tbl_hotel_facilities(hotel_id,facility_id,facility_description)";
						$o_sql .= " VALUES(";
						$o_sql .= $hotel_id . ",";
						$o_sql .= "0,";
						$o_sql .= "'" . htmlspecialchars($facilities) . "'";
						$o_sql .= ")";
					}
					runSQL($o_sql);
                    //facilities_view($hotel_id);
				}
                echo 'Facilities saved successfully';

			}

		} else {
		}
	//}
	//header("location:../?mangoparam=add_hotel&menu=2");
?>