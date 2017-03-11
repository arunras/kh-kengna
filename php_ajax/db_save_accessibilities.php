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

			if(isset($_GET['delete_accessibilities'])) {
                //runSQL("DELETE FROM tbl_hotel_accessibilities WHERE hotel_id = " . $hotel_id);
                $val_access = explode(";",$_GET['delete_accessibilities']);
                $o_sql      = "";

				foreach($val_access as $access) {
				    if($access == "") continue;
                    if(getValue("SELECT COUNT(*) FROM tbl_hotel_accessibilities WHERE hotel_id = " . $hotel_id . " AND hotel_accessibility_name = '" . $access . "'") != 0){
                        $o_sql  = "DELETE FROM tbl_hotel_accessibilities";
						$o_sql .= " WHERE hotel_id =";
						$o_sql .= $hotel_id . " AND ";
						$o_sql .= " hotel_accessibility_name = '" . htmlspecialchars($access) . "'";
						$o_sql .= "";
                    }
                    //echo $o_sql . "\n";
					runSQL($o_sql);
                    accessibility_view($hotel_id);
				}

			}

		} else {
		}
	//}
	//header("location:../?mangoparam=add_hotel&menu=3");
?>