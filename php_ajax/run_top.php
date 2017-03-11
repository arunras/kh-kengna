<?php
	if(isset($_GET['city']))
	{
		include('../connection/connection.php');
		include('../module/module.php');
		$city = $_GET['city'];
		$enabled_top_hotel = " AND hotel_enabled =1 AND hotel_top_slide = 1" ;

		$q_top = "SELECT hotel_id, hotel_name, hotel_description, hotel_images, hotel_city FROM tbl_hotels WHERE hotel_city=".$city.$enabled_top_hotel. " LIMIT 0,3";// ORDER BY RAND()";;
		//$q_top =  "SELECT hotel_id,hotel_name,hotel_images FROM tbl_hotels
		//				WHERE hotel_city=".$city. " LIMIT 0,3";
		$q_top = getResultSet($q_top);

		while($rt = mysql_fetch_array($q_top))
		{
			$hotel_id = $rt['hotel_id'];
			$name = $rt['hotel_name'];
			$desc = $rt['hotel_description'];
			$picture = $rt['hotel_images'];

			if (!file_exists("../" . $picture)) {$picture = "app_images/image_not_found.jpg";}
			
			$title = '<div id="top_hotel_title">'.$name.'</div>';
			echo '<a href="http://'.DOMAIN.ROOT.'/?mangoparam=detail&id='.$hotel_id.'">'.$title.'<img title="'.$name.'" src="'.$picture.'"/> </a>';
		}
	}
?>