<?php
	echo '<ul id="home_slider">';
		//$city_id = $_GET['city'];

		$sql_city = "SELECT DISTINCT CP.city_id, CP.city_photo, CP.city_photo_description, CT.city_name FROM tbl_city_photo AS CP 
						INNER JOIN tbl_cities AS CT ON CP.city_id = CT.city_id GROUP BY city_id ";
						//WHERE LIMIT 1";// ORDER BY RAND()";;
		$city_photo = getResultSet($sql_city);
		
		$count_city = mysql_num_rows($city_photo);
		
		while($rc= mysql_fetch_array($city_photo))
		{
			$desc = $rc['city_photo_description'];
			$photo = $rc['city_photo'];
            $city_id = $rc['city_id'];
			$city_name = $rc['city_name'];

			echo '<li>';
				echo '<img id="' . $city_id . '" src="'.$photo.'" alt="'.$city_name.'"/>';
			echo '</li>';
		}                                
	echo '</ul>';
?>
    