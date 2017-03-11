<?php
	//echo "It's me!!!";
	//exit();
	include("../connection/connection.php");
	include("../module/module.php");

	$hotel_id = $_POST['hotel_id'];
	$room_id = $_GET['room_id1'];

	$room_name = $_POST['room_name1'];
	$room_name = str_replace("'"," ",$room_name);

	$room_description = $_POST['room_desc1'];
	$room_description = str_replace("'"," ",$room_description);
	
	//$room_photo = "../app_images/room.jpg";
	$room_photo = getValue("SELECT room_photo FROM tbl_room_hotel WHERE room_id=".$room_id);
	$feature = $_POST ['feature1'];
	
/**FILE upload********************************************************************************/

if((!empty($_FILES["rphoto1"])) && ($_FILES['rphoto1']['error'] == 0))
{


	$path = '../data_images/room_photo/';	
	$file = $_FILES["rphoto1"]["tmp_name"];
	$file_name = $_FILES["rphoto1"]["name"];

	$ext = end(explode(".",strtolower($file_name)));
	//if((!empty($_FILES["uploaded_file"]))
	
	if (($_FILES["rphoto1"]["type"] == "image/gif")
  		|| ($_FILES["rphoto1"]["type"] == "image/jpeg")
  		|| ($_FILES["rphoto1"]["type"] == "image/png" )
  		&& ($_FILES["rphoto1"]["size"] < 100000))
 		{
  			move_uploaded_file($file,
    			$path . $hotel_id."_".$room_id.".".$ext);
			$room_photo = $path . $hotel_id."_".$room_id.".".$ext;
			//echo 'Room= '.$room_photo;
			//exit();
  		}
	else
  	{
  		echo "Files must be either JPEG, GIF, or PNG and less than 10,000 kb";
  	}
}
/**END FILE upload********************************************************************************/

	//echo 'Feature:';
	$replace_feature = getResultSet("DELETE FROM tbl_room_hotel_feature WHERE room_id=".$room_id);
	
	foreach($feature as $feature_id) {
		$q_feature =getResultSet("INSERT INTO tbl_room_hotel_feature VALUES('$room_id', '$feature_id')");
	}
	
	$sql_edit_room = "UPDATE tbl_room_hotel 
						SET room_name=".Field($room_name).", room_description=".Field($room_description).", room_photo=".Field($room_photo).
						" WHERE room_id=". $room_id;
						
	$q_add_room = getResultSet($sql_edit_room);
	
	header('Location: http://'.DOMAIN.ROOT.'/?mangoparam=detail&id='.$hotel_id);
?>


