<?php
    ob_start();
    if(!isset($_SESSION))session_start();

    //get user id
    $can_review = false;

    $user_id = 0;
    if(isset( $_SESSION['_user_13_5_2011_id']))
      $user_id = $_SESSION['_user_13_5_2011_id'];


    $user_type = getValue("SELECT level_id FROM tbl_users WHERE user_id = " . $user_id);

    if($user_type == ADMINISTRATOR || $user_type == REVIEWER){
       $can_review = true;
    }
    else{
       $can_review = false;
    }


    //get hotel id
    $hotel_id = $_SESSION['viewing_hotel_id'];
?>
<div id="stretch_background"><center><table width="1000"><tr><td>
    <?php
        display_hotel($hotel_id);
    ?>
</td></tr></table></center></div>

<?php
function display_hotel($hotel_id)
{

	$sql = "SELECT hotel_id, hotel_name, hotel_address, hotel_star, hotel_images, hotel_description FROM tbl_hotels WHERE hotel_id = " . $hotel_id;
	$q_ho = getResultSet($sql);
    $total_record=mysql_num_rows(getResultSet($sql));

	if($total_record==0){echo "No hotels!";}
	while($row=mysql_fetch_array($q_ho))
	{
			$id = $row['hotel_id'];
			$name = str_replace(";","<br/>",$row['hotel_name']);
			$picture = $row['hotel_images'];
			$star = $row['hotel_star'];
			$add = $row['hotel_address'];

			$desc = $row['hotel_description'];
			$desc = ltrim($desc);
			$desc = rtrim($desc);
			if(strlen($desc)>240) {$dot=".....";} else{$dot="";}
			$desc = substr($desc,0,240).$dot;

			/*******************************/
					//if($picture == null){$picture = "images/image_not_found.jpg";}
					if (!file_exists($picture)) {$picture = "app_images/image_not_found.jpg";}
			/*******************************/
			$img = $picture;
			$url=getUrl($id);
			$ur = '"'.$url.'"';
			echo "<div id='list_wrapper' style='border:none;display:block;width:800px;'>";

			//echo "<div id='list_wrapper'>";
			$low_price= getValue("SELECT hotel_lowest_price FROM tbl_hotels WHERE hotel_id=". $id);
				echo '<div id="block1">';
					echo '<a href="#">'.'<img src="'.$img.'"/>'.'</a>';
					echo '<p class="show_price">From: $'.$low_price.'</p>';
				echo '</div>'; //end <div id="block1">

				echo '<div id="block2" style="width:600px;">';
					echo '<a href="#">'.'<p class="title">'.$name.'</p></a>';
					echo '<div id="rate_star">';
						//rate_star......
						echo '<img id="rate_start" src="images/rate.jpg"/>';
                	echo '</div>';
					echo '<p class="clear">';
						echo '<img src="app_images/add.jpg" width="16px" height="16px" style="float:left;"/>';
						echo '<div id="hotel_location">'.$add.'</div><br/>';
					echo '</p>';

					echo '<div id="hotel_description">'.$desc.'</div><br />';

					echo '<div id="service">';
						//Service images...
						$q_service = getResultSet("SELECT service_name,service_icon FROM tbl_services WHERE hotel_id =". $id);
						while($rs=mysql_fetch_array($q_service)){
							$s_name= $rs['service_name'];
							$icon= $rs['service_icon'];
							echo '<img src="'.$icon.'" title="'.$s_name.'" />';
						}
					echo '</div>';
				echo '</div>'; //end <div class="block2">

				echo '<div id="block3">';
				$q_ho_photo = getResultSet("SELECT photo_path FROM tbl_photos WHERE hotel_id=".$id." LIMIT 0,2" );
				while($rp = mysql_fetch_array($q_ho_photo)){
					$photo = $rp[0];
					//if($photo == null){$photo = "images/image_not_found.jpg";}
					if(!file_exists($photo)) {$photo = "images/image_not_found.jpg";}

					echo '<img src="'.$photo.'"/>';
				}
				echo '</div>';
			echo "</div>"; //end "<div id='list_wrapper'>"
	}
}
?>