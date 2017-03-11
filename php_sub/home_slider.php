<?php	
	echo '<ul>';	
		//$city_id = $_GET['city'];
		
		$sql_city = "SELECT city_photo, city_photo_description FROM tbl_city_photo";// ORDER BY RAND()";;
		$city_photo = getResultSet($sql_city);
		while($rc= mysql_fetch_array($city_photo))
		{
			$desc = $rc['city_photo_description'];
			$photo = $rc['city_photo'];

			echo '<li>';
				echo '<img src="'.$photo.'" alt="'.$desc.'" />';
			echo '</li>';
		}
	echo '</ul>';
?>
    