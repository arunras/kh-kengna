<?php
	if(isset($_GET['city']))
	{
		$hotel_adv = " AND hotel_enabled = 1 AND hotel_top_slide= 1";
		$city = $_GET['city'];
		require_once("run_display_hotel.php");
		$sql_city = "SELECT hotel_id,hotel_name,hotel_images,hotel_description FROM tbl_hotels
						WHERE hotel_city=".$city. $hotel_adv;

		if(isset($_GET['khan']))
		{
				$khan = $_GET['khan'];
				$sql_city.= " AND hotel_khan=".$khan;
		}
		$sql_city.=" ORDER BY RAND() LIMIT 0,3 ";

		$q_top_ho = getResultSet($sql_city);


		while($rt = mysql_fetch_array($q_top_ho))
		{
			$id = $rt['hotel_id'];
			$name = $rt['hotel_name'];
			$picture = $rt['hotel_images'];
			$desc = $rt['hotel_description'];
			if(strlen($desc)>50){$dot="...";} else {$dot="";}
			$desc = substr($desc,0,50).$dot;
			if (!file_exists($picture)) {$picture = "app_images/image_not_found.jpg";}
			/*******************************/
			$img = $picture;
			
			$url=getUrl($id);
			$ur = '"'.$url.'"';
			echo "<div id='adv' onclick='location.href=$ur' >";
			
				//echo '<p class="title"><a href="">'.$name.'</a></p>';
				echo '<p class="adv_title">'.$name.'</p>';
					echo '<img src="'.$img.'"/>';
					echo '<div class="desc">';
						echo $desc;
					echo '</div>';
			echo '</div>';
		}
	}
?>