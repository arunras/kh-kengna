<?php
	//require_once("check_url.php");
?>
<?php
//1page(9,3)
/*
$total_page=0;
$cur_page=0;
$page_link="";//"http://".DOMAIN.ROOT."/display.php?curP=";
*/

function display_list_hotel($sql)//$sql
{
	$row = 1; $col = 1; $num_per_page=1;  $current_page=1;
	if(isset($_GET['curP'])){
		$current_page=$_GET['curP'];
	}
	$start=($current_page-1)*$num_per_page;
	$end=$num_per_page;

	$total_record=mysql_num_rows(getResultSet($sql));

	$sql.=" Limit ".$start. ",".$end;
	$q_ho = getResultSet($sql);

	$total_page=ceil($total_record/$num_per_page);

	//echo "TOTAL records= ".$total_record;
	//echo "<br/>TOTAL Pages= ".$total_page;

	///////////////////////////***////////////////////////////////
	if($total_record==0){echo "<div id='no_hotel'><h1 style='color: #CCC; margin-top: 50px;'>No hotels!</h1></div>";}
	//for($c=0;$c<$total_record;$c++) //for($c=0;$c<$record;$c++)
	//{
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
			if(strlen($desc)>140) {$dot=".....";} else{$dot="";}
			$desc = substr($desc,0,140).$dot;

			/*******************************/
					//if($picture == null){$picture = "images/image_not_found.jpg";}
					if (!file_exists($picture)) {$picture = "app_images/image_not_found.jpg";}
			/*******************************/
			$img = $picture;
			//$img = "images/i19.jpg";
					//$url = "restaurant.php?resID=$res_id"; //$url=getUrl($res_id);
			$url=getUrl($id);
			$ur = '"'.$url.'"';
			echo "<div id='list_wrapper' onclick='location.href=$ur' >";

			//echo "<div id='list_wrapper'>";
			$low_price= getValue("SELECT hotel_lowest_price FROM tbl_hotels WHERE hotel_id=". $id);
				echo '<div id="block1">';
					echo '<a href="#">'.'<img src="'.$img.'"/>'.'</a>';
					echo '<p class="show_price">From: $'.$low_price.'</p>';
				echo '</div>'; //end <div id="block1">

				echo '<div id="block2">';
					echo '<a href="#">'.'<p class="title">'.$name.'</p></a>';
					echo '<div id="rate_star">';
						//rate_star......
						display_rate($star, $name);
						
                	echo '</div>';
					echo '<p class="clear">';
						//echo '<img src="app_images/add.png" width="12px" height="12px" style="float:left; margin-right: 3px;"/>';
						echo '<div id="hotel_location"><img src="app_images/add.png">'.$add.'</img></div><br/>';
					echo '</p>';

					echo '<p id="hotel_description">'.$desc.'</p>';

					echo '<div id="service">';
						//Service images...///////////////////////////////////////////////
						/*
						$q_service = getResultSet("SELECT SV.service_name, SV.service_icon FROM tbl_service AS SV
													INNER JOIN tbl_hotel_service AS HS ON SV.service_id =  HS.service_id
													WHERE hotel_id =". $id);
						*/
									
						
						
						//$q_basic_info =getResultSet("SELECT info_label FROM tbl_basic_info WHERE hotel_id=".$id);
						//$q_sport = getResultSet("SELECT sport_name FROM tbl_sports_recreation WHERE hotel_id=".$id) ;			
						
						
						$q_hotel_facility =getResultSet("SELECT facility_id FROM tbl_hotel_facilities WHERE hotel_id=".$id);
						while($rf = mysql_fetch_array($q_hotel_facility))
						{
							$facility_id = $rf['facility_id'];		
							
							$q_facility_name =getValue("SELECT facility_name FROM tbl_facilities WHERE facility_id=".$facility_id);
							//echo $q_facility_name."; ";
							$q_icon =getValue("SELECT service_icon FROM tbl_service WHERE service_type='facility' AND service_available=1 AND service_id=".$facility_id);
							if ($q_icon==true){
								echo '<img src="'.$q_icon.'" title="'.$q_facility_name.'" />';
							}
						}
						
						
						$q_hotel_sport = getResultSet("SELECT sport_id FROM tbl_hotel_sports WHERE hotel_id=".$id) ;			
						while($rs = mysql_fetch_array($q_hotel_sport))
						{
							$sport_id = $rs['sport_id'];		
							$q_sport_name =getValue("SELECT sport_name FROM tbl_sports_recreation WHERE sport_id=".$sport_id);

							$q_icon =getValue("SELECT service_icon FROM tbl_service WHERE service_type='sport' AND service_available=1 AND service_id=".$sport_id);
							if ($q_icon==true){
								echo '<img src="'.$q_icon.'" title="'.$q_sport_name.'" />';
							}
						}
						
						$q_hotel_info = getResultSet("SELECT info_id FROM tbl_hotel_information WHERE hotel_id=".$id) ;			
						while($ri = mysql_fetch_array($q_hotel_info))
						{
							$info_id = $ri['info_id'];		
							$q_info_name =getValue("SELECT info_label FROM tbl_basic_info WHERE info_id=".$info_id);
							//echo $q_info_name."; ";
							
							$q_icon =getValue("SELECT service_icon FROM tbl_service WHERE service_type='basic_info' AND service_available=1 AND service_id=".$info_id);
							if ($q_icon==true){
								echo '<img src="'.$q_icon.'" title="'.$q_info_name.'" />';
							}
						}					
						
						
						
						
						
						
						
						
						
						/*
						$sql_hotel_facility = "SELECT F.facility_name FROM tbl_facilities AS F
											INNER JOIN tbl_hotel_facilities AS HF ON HF.facility_id = F.facility_id";
											
																			
						$q_service = getResultSet($sql_facility);			
						
						while($rs=mysql_fetch_array($q_service)){
							$s_name= $rs['facility_name'];

							echo $s_name. "; ";	
						}
						*/							
						/*
						while($rs=mysql_fetch_array($q_service)){
							$s_name= $rs['service_name'];
							$icon= $rs['service_icon'];
							echo '<img src="'.$icon.'" title="'.$s_name.'" />';
						}
						*/
						//Service images...///////////////////////////////////////////////
					echo '</div>';
				echo '</div>'; //end <div class="block2">

				echo '<div id="block3">';
				$q_ho_photo = getResultSet("SELECT photo_path FROM tbl_photos WHERE hotel_id=".$id." LIMIT 0,2" );
				while($rp = mysql_fetch_array($q_ho_photo)){
					$photo = $rp[0];
					//if($photo == null){$photo = "images/image_not_found.jpg";}
					if(!file_exists($photo)) {$photo = "app_images/no_image.jpg";}

					echo '<img src="'.$photo.'"/>';
				}
				echo '</div>';
			echo "</div>"; //end "<div id='list_wrapper'>"
		}
	//}
	create_page_nav($total_page);
}
?>
<!--end function build_9row_per_page()-->
