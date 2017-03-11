<?php
	if(isset($_GET['city']))
	{
		echo '<ul id="slider1Content">';
		//////////////////////////////

		$city_id = $_GET['city'];
		/*
		$q_city_title=getValue("SELECT DISTINCT city_name FROM tbl_cities WHERE city_id=".$_GET['city']);
		echo '<div id="location_title">';
		//echo '<div class="child">'.$q_city_title.'</div>';
			echo $q_city_title;
		echo '</div>';
		*/

		$sql_city = "SELECT city_photo, city_photo_description FROM tbl_city_photo WHERE city_id=".$city_id." ORDER BY RAND()";;
		$city_photos = getResultSet($sql_city);
		while($rc= mysql_fetch_array($city_photos))
		{
			$desc = $rc['city_photo_description'];
			$photo = $rc['city_photo'];

			echo '<li class="slider1Image">';
				echo '<img src="'.$photo.'" alt="1" id="' . $city_id . '"/>';
				echo '<span class="right">'.$desc.'</span></li>';
			echo '</li>';
		}
		/////////////////////////////
		echo '<div class="clear slider1Image"></div>';
		echo '</ul>';
	}

?>
            
            