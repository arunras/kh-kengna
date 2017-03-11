<!--==Location==================================================================================================================================-->
<div class="categoryBox">
	<ul>
	<?php //Location//
	 //echo 'http://'.DOMAIN.ROOT ;
	 $hotel_enabled = " AND hotel_enabled= 1";


	$city_id = $_GET['city'];
	$q_city_name=getValue("SELECT DISTINCT city_name FROM tbl_cities WHERE city_id=".$city_id);
	$q_khan=getResultSet("SELECT DISTINCT khan_id,khan_name FROM tbl_khan WHERE city_id=".$city_id);
	
	$root = "<a href='http://".DOMAIN.ROOT."/?mangoparam=$run_display_page&city=$city_id&where=$q_city_name	&curP=1'>";

	echo "<li id='cat_title' class='top_place'><img src='app_images/cat_place.png' align='center' width='20px' height='20'/><p> Top places in <i style='color: blue;'>".
			$root.$q_city_name
		  ."</i></p></li>";

	while($rk = mysql_fetch_array($q_khan))
	{
		$khan_id= $rk['khan_id'];
		$khan = $rk['khan_name'];

		$count_hotel= getValue("SELECT COUNT(hotel_id) FROM tbl_hotels WHERE hotel_khan=".$khan_id. $hotel_enabled);
		
		echo '<li id="cat_link" class="top_place1">';
			echo "» ";
			echo "<a href='http://".DOMAIN.ROOT."/?mangoparam=$run_display_page&city=$city_id&khan=$khan_id&curP=1'>";
				echo $khan.'<font class="num_hotels"> ('.$count_hotel.')</font> ';
			echo '</a>';
		echo '</li>';
	}
	?>
	</ul>
</div>
<!--==end Location==================================================================================================================================-->
<!--==Popular==================================================================================================================================-->
<div class="categoryBox">
	<ul>
    	<li id='cat_title' class='pop'><img src='app_images/cat_pop.png' align='center' width='20px' height='20'/><p> Popular</p></li>
    	<li id="cat_link" class='pop1'>
        	»
            <a href='http://<?php echo DOMAIN.ROOT."/?mangoparam=$run_display_page&";?>city=<?php echo $city_id;?>&pop=MostViewed&curP=1'>
            	Most Viewed
            </a>
        </li>
        <li id="cat_link" class='pop1'>
        	»
            <a href='http://<?php echo DOMAIN.ROOT."/?mangoparam=$run_display_page&";?>city=<?php echo $city_id;?>&pop=MostRecommended&curP=1'>
            	Most Recommanded
            </a>
        </li>
    </ul>
</div>
<!--==Popular==================================================================================================================================-->
<!--==Price==================================================================================================================================-->
<div class="categoryBox">
 <ul>
 	<li id='cat_title' class='price'><img src='app_images/cat_price.png' align='center' width='20px' height='20'/><p> Price</p></li>
    <li id='cat_link' class='price1'>»
    	<a href='http://<?php echo DOMAIN.ROOT."/?mangoparam=$run_display_page&";?>city=<?php echo $city_id;?>&pmin=0&pmax=100&curP=1'>Cheap Price</a>
    </li>
    <li id='cat_link' class='price1'>»
    	<a href='http://<?php echo DOMAIN.ROOT."/?mangoparam=$run_display_page&";?>city=<?php echo $city_id;?>&pmin=100&pmax=200&curP=1'>Mide-range price</a>
    </li>
    <li id='cat_link' class='price1'>»
    	<a href='http://<?php echo DOMAIN.ROOT."/?mangoparam=$run_display_page&";?>city=<?php echo $city_id;?>&pmin=200&pmax=300&curP=1'>Lusury</a>
    </li>
 </ul>
</div>
<!--==end Price==================================================================================================================================-->
<!--==Facility==================================================================================================================================-->
<div class="categoryBox">
    <ul>
    	<?php //Explore Cambodia//
		$q_facility=getResultSet("SELECT DISTINCT facility_id, facility_name FROM tbl_facilities");

		echo "<li id='cat_title' class='facility'><img src='app_images/cat_facility.png' align='center' width='20px' height='20'/><p> Facilities </p><i style='color: blue;'>"."</a></i></li>";

		while($rf = mysql_fetch_array($q_facility))
		{
			$facility_id = $rf['facility_id'];
			$facility = $rf['facility_name'];
			$count_hotel= getValue("SELECT DISTINCT COUNT(Fa.hotel_id), Ho.hotel_id FROM tbl_hotel_facilities AS Fa
									INNER JOIN tbl_hotels AS Ho
									ON Ho.hotel_id = Fa.hotel_id
									WHERE Fa.facility_id=".$facility_id. $hotel_enabled. " AND Ho.hotel_city=$city_id");
			echo '<li id="cat_link" class="facility1">';
				echo "» ";
				echo "<a href='http://".DOMAIN.ROOT."/?mangoparam=$run_display_page&city=$city_id&facility=$facility_id&curP=1'>";
					echo $facility.'<font class="num_hotels"> ('.$count_hotel.')</font> ';
				echo '</a>';
			echo '</li>';
		}
		?>
   	</ul>
</div>
<!--==end Facility==================================================================================================================================-->
<!--==Explor Cambodia==================================================================================================================================-->
<div class="categoryBox">
	<ul>
		<?php //Explore Cambodia//
		$q_city=getResultSet("SELECT DISTINCT city_id,city_name FROM tbl_cities LIMIT 0,10");

		echo "<li id='cat_title' class='exp_cam'><img src='app_images/cat_cam.png' align='center' width='20px' height='20'/><p> Explore CAMBODIA </p> <i style='color: blue;'>"."</a></i></li>";

		while($rc = mysql_fetch_array($q_city))
		{
			$id = $rc['city_id'];
			$city = $rc['city_name'];
			$count_hotel= getValue("SELECT COUNT(hotel_id) FROM tbl_hotels WHERE hotel_city=".$id . $hotel_enabled);
			echo '<li id="cat_link" class="exp_cam1">';
				echo "» ";
				echo "<a href='http://".DOMAIN.ROOT."/?mangoparam=$run_display_page&city=$id&where=$city&curP=1'>";
					echo $city.'<font class="num_hotels"> ('.$count_hotel.')</font> ';
				echo '</a>';
			echo '</li>';
		}
		?>
	</ul>
</div>
<!--==Explor Cambodia==================================================================================================================================-->


<!--==END File==================================================================================================================================-->
