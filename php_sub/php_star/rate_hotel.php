<?php
/**
 * jQuery-PHP-Mysql Star Rating
 * This jQuery-PHP-Mysql plugin was inspired and based on jQuery Star Rating Plugin (http://www.fyneworks.com/jquery/star-rating/)
 * and adapted to me for use like a plugin from jQuery.
 * @name jQuery-PHP-Mysql Star Rating
 * @author Igor Jovičić - http://www.cashmopolit.hr
 * @version v3.13
 * @date August 14, 2010
 * @category jQuery plugin
 * @copyright (c) 2010 Igor Jovičić (www.cashmopolit.hr)
 * @license CC Attribution-No Derivative Works 2.5 Brazil - http://creativecommons.org/licenses/by-nd/2.5/br/deed.en_US
 * @example Visit http://www.cashmopolit.hr/howto/jquery/how_to_jquery_star_rating.php for more informations about this jQuery/PHP/Mysql plugin
 */
 
// function to retrieve
function getRate() {
	$sql= "select ifnull(round(sum(hotel_rate_value)/count(*),0),0) avg, count(*) count from tbl_hotel_rate where hotel_id=" . $_GET['hotel_id'];
	if($result=mysql_query($sql)) {
		if($row=mysql_fetch_array($result)) {
			$rate['avg'] = $row['avg'];
			$rate['count'] = $row['count'];
			echo json_encode($rate);
		}
	}
}

// function to insert rating
function rate() {
	$sql = "insert into tbl_hotel_rate (hotel_id, hotel_rate_value) values (" . $_GET['hotel_id'] . ", ".$_GET['hotel_rate_value'].")";
	if($result=mysql_query($sql)) {
		getRate(); //call retrieve from getRate function
	}
}

if(!empty($_GET['do'])) {
	include 'config.php';
	include 'opendb.php';  //open database connection
	
	if($_GET['do']=='hotel_rate_value'){
		// do rate
		rate();
	}
	else if($_GET['do']=='getRate'){
		// get rating
		getRate();
	}
}
?>