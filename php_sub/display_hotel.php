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
	$row = 1; $col = 1; $num_per_page=3;  $current_page=1;
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
	if($total_record==0){echo "No hotels!";}
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
					if (!file_exists($picture)) {$picture = "images/image_not_found.jpg";} 					
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
						echo '<img id="rate_start" src="images/rate.jpg"/>';
                	echo '</div>';
					echo '<p class="clear">';
						echo '<img src="images/add.jpg" width="16px" height="16px" style="float:left;"/>';
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
				$q_ho_photo = getResultSet("SELECT name FROM tbl_photos WHERE hotel_id=".$id." LIMIT 0,2" );
				while($rp = mysql_fetch_array($q_ho_photo)){
					$photo = $rp['name'];
					//if($photo == null){$photo = "images/image_not_found.jpg";}
					if(!file_exists($photo)) {$photo = "images/image_not_found.jpg";}
					
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
