<?php

if(isset($_GET['city']))
{
 $city = $_GET['city'];
 require_once("include/display_hotel.php");
 $hotel_info="SELECT Ho.hotel_id, Ho.hotel_name, Ho.hotel_images, Ho.hotel_star,hotel_address, Ho.hotel_description";
 $request_hotels="";
 
 /*===City===================================================================================================================================*/
 	if(isset($_GET['where']))
	{
		$where = $_GET['where'];
		$request_hotels = $hotel_info." FROM tbl_hotels AS Ho WHERE Ho.hotel_city=".$city;
	}	
 /*===end City===================================================================================================================================*/
 /*===Khan===================================================================================================================================*/	
 
	if(isset($_GET['khan']))
	{
		$khan = $_GET['khan'];
		$request_hotels = $hotel_info." FROM tbl_hotels AS Ho WHERE Ho.hotel_city=".$city." AND hotel_khan=".$khan. " ORDER BY RAND()";
	}
 /*===end Khan===================================================================================================================================*/
 /*===Pop===================================================================================================================================*/		
 	if(isset($_GET['pop']))
	{ 
		$pop = $_GET['pop'];
		require_once("include/display_hotel.php");
		if($pop=='MostViewed')
		{
		$q_pop = ", Co.count_value
					FROM tbl_hotels AS Ho
					INNER JOIN tbl_count AS Co ON Ho.hotel_id= Co.hotel_id
					WHERE Ho.hotel_city=".$city."
					GROUP BY hotel_id
					ORDER BY SUM(Co.count_value) DESC";
		$request_hotels= $hotel_info.$q_pop;
		}
		elseif($pop=='MostRecommended')
		{
		$q_pop = ", Ra.hotel_rate_value
					FROM tbl_hotels AS Ho
					INNER JOIN tbl_hotels_rate AS Ra ON Ho.hotel_id= Ra.hotel_id
					WHERE Ho.hotel_city=".$city."
					GROUP BY hotel_id
					ORDER BY Ra.hotel_rate_value DESC";
		$request_hotels= $hotel_info.$q_pop;
		}
	}
 /*===endPop===================================================================================================================================*/		
 /*===Price===================================================================================================================================*/		
 	if(isset($_GET['pmin'])&&isset($_GET['pmax']))
	{
		$pmin=$_GET['pmin'];
		$pmax=$_GET['pmax'];
		
		$q_price_range=" FROM tbl_hotels AS Ho WHERE Ho.hotel_city=".$city." AND Ho.hotel_lowest_price BETWEEN ".$pmin." AND ".$pmax;	
		$request_hotels= $hotel_info.$q_price_range;
	}
 /*===end Price===================================================================================================================================*/		
 /*===Price===================================================================================================================================*/		
 	if(isset($_GET['facility']))
	{
		$facility=$_GET['facility'];
		
		$q_facility = ", Fa.facility_id
					FROM tbl_hotels AS Ho
					INNER JOIN tbl_hotel_facilities AS Fa ON Ho.hotel_id= Fa.hotel_id
					WHERE Ho.hotel_city=".$city." AND Fa.facility_id=".$facility."
					GROUP BY hotel_id
					ORDER BY RAND()";
		
		
		$request_hotels= $hotel_info.$q_facility;
	}
 /*===end Price===================================================================================================================================*/		

 
 
 
 /*===call DISPLAY HOTELs===================================================================================================================================*/		
 display_list_hotel($request_hotels);
 /*===end call DISPLAY HOTELs===================================================================================================================================*/		
}
?>
