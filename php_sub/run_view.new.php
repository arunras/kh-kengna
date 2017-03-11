<?php



	$hotel_id = $_GET['id'];
	//$user_id = 1; //$user_id = $_SESSION['_user_13_5_2011_id'];

	$sql_read_review = "SELECT wr_id, user_id, hotel_id, wr_title, wr_comment, wr_date, wr_stayed_date, wr_visit_kind, hotel_rate_value FROM tbl_write_review WHERE hotel_id=".$hotel_id;
	$sql_rate = "SELECT hotel_rate_value FROM tbl_hotel_rate WHERE wr_id=";
	$sql_photo = "SELECT pv_path, pv_description FROM tbl_write_review_photovideo WHERE pv_type='photos' AND wr_id=";
	$sql_user = "SELECT user_name, user_profile_picture FROM tbl_users WHERE user_id=";

	$q_read_review = getResultSet($sql_read_review);
	$total_review = mysql_num_rows($q_read_review);
	if ($total_review==0)
	{
		echo "<b><h1>NO Review...</h1></b>";
	}
    $i = 0;
	while($rr = mysql_fetch_array($q_read_review))
	{
        $i++;
        $wr_id = $rr['wr_id'];
		$user_id = $rr['user_id'];
		$hotel_id = $rr['hotel_id'];
		$wr_title = $rr['wr_title'];
		$wr_comment = $rr['wr_comment'];
		$wr_date = $rr['wr_date'];
		$wr_stayed_date = $rr['wr_stayed_date'];
		$wr_visit_kind = $rr['wr_visit_kind'];

		//$hotel_rate_value = $rr['hotel_rate_value'];
		$hotel_rate_value = $rr['hotel_rate_value'];



		echo '<div id="list_wrapper">';
			echo '<div id="block1">';
				echo '<a href="http://'.DOMAIN.ROOT.'/?mangoparam=profile&id='.$user_id.'">';
					$q_user = getResultSet($sql_user.$user_id);
					$user_name ="";
					$user_photo = "";
					while($ru = mysql_fetch_array($q_user))
					{
						$user_name = $ru['user_name'];
						$user_photo = $ru['user_profile_picture'];
					}

					echo '<img src="'.$user_photo.'" title="'.$user_name.'"/>';


				echo '</a>';
			echo '</div>';

			echo '<div id="block2">';
				echo '<div id="rate_star">';
					display_rate($hotel_rate_value, $i);
					//echo '<img src="images/rate.jpg" /> '.$hotel_rate_value.'<br />';//Rate Hotel Read Only
				echo '</div>';

				echo '<p><a href="http://'.DOMAIN.ROOT.'/?mangoparam=profile&id='.$user_id.'">'.$user_name.'</a></p>';
				echo '<p>Stayed:'.$wr_stayed_date.'</p>';
				echo '<p>Traveled as:'.$wr_visit_kind.'</p>';
			echo '</div>';
			echo '<div id="block3">';
			echo '<div id="photo_gallery"><ul>';//Loop photos...
				$q_photo = getResultSet($sql_photo.$wr_id);
				while($rp = mysql_fetch_array($q_photo))
				{
					$pv_path = $rp['pv_path'];
					$pv_desc = $rp['pv_description'];
					echo '<li><a href="'.$pv_path.'" class="preview" title="'.$pv_desc.'"><img src="'.$pv_path.'" alt="photo" /></a></li>';
					//echo '<li><img src="'.$pv_path.'"/></li>';
				}
			echo '</ul></div>';
			echo '</div>';

			echo '<div class="user_comment">';
				echo '<b>'.$wr_title.'</b>';
				echo '<p>'.$wr_comment.'</p>';
			echo '</div>';



			echo '<p style="color:#999; text-align:right; margin: 10px 0px 0px 0px; padding: 0px 0px 0px 0px;">';
				echo 'Reviewed: '.$wr_date;
            echo '</p>';

		echo '</div>';
	}
?>