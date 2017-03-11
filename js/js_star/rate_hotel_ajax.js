/**
 * jQuery-PHP-Mysql Star Rating
 * This jQuery-PHP-Mysql plugin was inspired and based on jQuery Star Rating Plugin (http://www.fyneworks.com/jquery/star-rating/)
 * and adapted to me for use like a plugin from jQuery.
 * @name jQuery-PHP-Mysql Star Rating
 * @author Igor Jovičić - http://www.cashmopolit.hr
 * @version 1.0
 * @date August 14, 2010
 * @category jQuery plugin
 * @copyright (c) 2010 Igor Jovičić (www.cashmopolit.hr)
 * @license CC Attribution-No Derivative Works 2.5 Brazil - http://creativecommons.org/licenses/by-nd/2.5/br/deed.en_US
 * @example Visit http://www.cashmopolit.hr/howto/jquery/how_to_jquery_star_rating.php for more informations about this jQuery/PHP/Mysql plugin
 */
$(document).ready(function() {
var some_product_id=1;  //let's say it's product with id=1, if you have application you will change this variable programatically

getRating(some_product_id);

function getRating(id){
	$.ajax({
		type: "GET",
		url: "../php_sub/php_star/rate_hotel.php",
		dataType : 'json',
		data: "do=getRate&hotel_id=" + id,
		cache: false,
		async: false,
		success: function(result) {
			avg=result.avg;
			sum=result.count;
			$("#votes").html("Average:" + avg);
			$(".vote_count").html(sum + " vote(s)");
			$('.rate').rating('select',avg);
		},
		error: function() {
			alert("Error, please try again *!");
		}
	});
}

//$('.hover-star').submit(function(){
$('.hover-star').click(function(){
//$('form').submit(function(){
	$.ajax({
		type: "GET",
		url: "../php_sub/php_star/rate_hotel.php",
		dataType : 'json',
		data: "do=hotel_rate_value&hotel_id=" + some_product_id + "&hotel_rate_value="+$(this).text(),
		cache: false,
		async: false,
		success: function(result) {
			avg=result.avg;
			sum=result.count;
			$("#votes").html("Average:" + avg);
			$(".vote_count").html(sum + " vote(s)");
			$('.rate').rating('select',avg);
		},
		error: function() {
			alert("Error, please try again! **");
		}
	});
});
});