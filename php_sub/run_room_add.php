<?php
	//echo "It's me!!!";
	//exit();
	include("../connection/connection.php");
	include("../module/module.php");

	$hotel_id = $_POST['hotel_id'];
	$room_id = autoID("tbl_room_hotel","room_id");
	$room_name = $_POST['room_name'];
	$room_name = str_replace("'"," ",$room_name);
	//$room_description = $_POST['room_description'];
	$room_description = $_POST['room_desc'];
	$room_description = str_replace("'"," ",$room_description);
	
	$room_photo = "../app_images/room.jpg";
	$feature = $_POST ['feature'];
	
/**FILE upload********************************************************************************/
if((!empty($_FILES["rphoto"])) && ($_FILES['rphoto']['error'] == 0))
{

	$path = '../data_images/room_photo/';	
	$file = $_FILES["rphoto"]["tmp_name"];
	$file_name = $_FILES["rphoto"]["name"];

	$ext = end(explode(".",strtolower($file_name)));
	//if((!empty($_FILES["uploaded_file"]))
	
	if (($_FILES["rphoto"]["type"] == "image/gif")
  		|| ($_FILES["rphoto"]["type"] == "image/jpeg")
  		|| ($_FILES["rphoto"]["type"] == "image/png" )
  		&& ($_FILES["rphoto"]["size"] < 100000))
 		{
  			move_uploaded_file($file,
    			$path . $hotel_id."_".$room_id.".".$ext);
			$room_photo = $path . $hotel_id."_".$room_id.".".$ext;
  		}
	else
  	{
  		echo "Files must be either JPEG, GIF, or PNG and less than 10,000 kb";
  	}
}
/**END FILE upload********************************************************************************/

	foreach($feature as $feature_id) {
		$q_feature =getResultSet("INSERT INTO tbl_room_hotel_feature VALUES('$room_id', '$feature_id')");
	}
	
	$sql_add_room = "INSERT INTO tbl_room_hotel VALUES('$hotel_id', '$room_id', '$room_name','$room_description', '$room_photo')";
	$q_add_room = getResultSet($sql_add_room);
	
	header('Location: http://'.DOMAIN.ROOT.'/?mangoparam=detail&id='.$hotel_id);
?>


