<meta name="keywords" content="Camitss, Cambodia IT, IT Solution, IT Support, Outsourcing, Offshore Development, Office IT, IT maintenance, カンボジアＩＴ" />
<meta name="description" content="CAMITSS - Cambodia IT Solutions & Supports" />

<link href="css/mangosteen_style.css" rel="stylesheet" type="text/css" />
<!--
<link href="css/camitss_style.css" rel="stylesheet" type="text/css" />
-->
<link href="css/svwp_style.css" rel="stylesheet" type="text/css" />

<link href="css/slider.css" rel="stylesheet" type="text/css" /><!--Fad Slider-->



<script type="text/javascript" src="js/jquery.slideViewerPro.1.0.js"></script>

<!-- Optional plugins  -->
<script type="text/javascript" src="js/jquery.timers.js"></script>

<script type="text/javascript" src="js/s3Slider.js"></script>
<script type="text/javascript" src="../js/toggle_category.js"></script>

<link rel="stylesheet" href="css/css_star/ui.tabs.css" type="text/css" />
<link type="text/css" rel="stylesheet" href="css/css_star/star_rating.css" />
<link rel="stylesheet" href="css/css_star/jquery.rating.css" type="text/css" />

<!--<script type="text/javascript" src="js/js_star/ui.core.min.js"></script>-->
<!--<script type="text/javascript" src="js/js_star/ui.tabs.min.js"></script>-->
<script type="text/javascript" src="js/js_star/jquery.rating.js"></script>
<script type="text/javascript" src="js/js_star/jquery.rating.pack.js"></script>


<script type="text/javascript">
    function init_display() {
        $('#slider1').s3Slider({
            timeOut: 4000
        });

        $(".hotel-rate").rating();
    }
</script>
<!--=====End Import=======================================================================================================================-->

<title>Display Hotels</title>
</head>

<body onLoad="init_display();">
<!--
<div id="menu1">
    <BLINK>Menu Welcome to Cambodia!</BLINK>
    <a href="http://run/mangosteen/"> HOME </a>

</div>
-->

<div id="display_body_wrapper">
<!--
	<div id="display_filter_wrapper">
<?php
	//require_once("include/list_category.php");
?>
-->
    <div id="mangosteen_body_middle">
<!--===Display Slider: City tour=================================================================================================================-->
    	<div id="slider1">

<?php
		$q_city_title=getValue("SELECT DISTINCT city_name FROM tbl_cities WHERE city_id=".$_GET['city']);
		echo '<div id="location_title">';
		//echo '<div class="child">'.$q_city_title.'</div>';
			echo $q_city_title;
		echo '</div>';
	require_once("php_sub/run_display_slider.php");
?>
		</div>
<!--===end Display Slider: City tour=================================================================================================================-->
<?php
	//require_once("php_sub/display_hotel.php");
	//display_list_hotel();
?>
<?php
	require_once("php_sub/run_filter_hotel.php");
?>
    </div><!--end <div id="mangosteen_body_middle">--->
<!--==Right================================================================================================================================================-->
    <div id="mangosteen_body_right">
    	<div id="top_title_wrapper">
        	<p >
            <?php
				$location = getValue("SELECT city_name FROM tbl_cities WHERE city_id=".$city);
				echo "<p class='top_title'>TOP HOTELs in "."<b>".$location."</b></p>";
			?>
            </p>
    	</div>

        <div id="adv_wrapper">
<?php
	require_once("php_sub/run_top_hotel.php");
?>
		</div>
    	<!--
        <div id="body_right_item">
        	<p><a href="">Naga World</a></p>
        	<img src="images/i21.jpg"/>
            <div class="desc">
            	Comprehensive HAI course for beginners. Security, lighting, temperature, audio, and more. Vietnam and Philippines during July.
            </div>
    	</div>
        <div id="body_right_item">
        	<p><a href="">Bopha Hotel</a></p>
        	<img src="images/i14.jpg"/>
            <div class="desc">
            	Comprehensive HAI course for beginners. Security, lighting, temperature, audio, and more. Vietnam and Philippines during July.
            </div>
    	</div>
        <div id="body_right_item">
        	<p><a href="">Kiri Hotel</a></p>
        	<img src="images/i11.jpg"/>
            <div class="desc">
            	Comprehensive HAI course for beginners. Security, lighting, temperature, audio, and more. Vietnam and Philippines during July.
            </div>
    	</div>
        -->
        <div id="list_category_wrapper">
<?php
	$total_page=0;
	$cur_page=1;
	$page_size=5;
	$page_link="";

	require_once("php_sub/run_list_category.php");
?>
    </div>
    </div>
<!--==end Right================================================================================================================================================-->
<hr/>
<?php //start build_page_link_number
function create_page_nav($num_page) //function create_page_nav($cat)
{
	//xecho "num_page=". $num_page;
	$total_page=0;
	$total_row=0;
	//$numpage=0;
	$page_size = 5;
	$cur_page;
	$page_link="";
	if (isset($_GET['curP'])== null | isset($_GET['curP'])== " " | isset($_GET['curP'])== 0){ $cur_page = 1;}
	if (isset($_GET["curP"]) != null) { $cur_page = $_GET["curP"]; }

	if (isset($_GET['where'])) // if add
		{
			$where = $_GET['where'];
			$city_id = $_GET['city'];
			$page_link = "?mangoparam=run_display&city=$city_id&where=$where&curP=";
			$total_page=$num_page;
		}

	if (isset($_GET['khan'])) // if add
		{
			$khan = $_GET['khan'];
			$city_id = $_GET['city'];
			$page_link = "?mangoparam=run_display&city=$city_id&khan=$khan&curP=";
			$total_page=$num_page;
		}

	if (isset($_GET['pop'])) // if add
		{
			$pop = $_GET['pop'];
			$city_id = $_GET['city'];

			$page_link = "?mangoparam=run_display&city=$city_id&pop=$pop&curP=";
			$total_page=$num_page;
		}

	if (isset($_GET['pmin']) && isset($_GET['pmax'])) // if add
		{
			$pmin = $_GET['pmin'];
			$pmax = $_GET['pmax'];
			$city_id = $_GET['city'];

			$page_link = "?mangoparam=run_display&city=$city_id&pmin=$pmin&pmax=$pmax&curP=";
			$total_page=$num_page;
		}

	if (isset($_GET['facility'])) // if add
		{
			$facility= $_GET['facility'];
			$city_id = $_GET['city'];

			$page_link = "?mangoparam=run_display&city=$city_id&facility=$facility&curP=";
			$total_page=$num_page;
		}

	echo "<div class='nav'>";
		require_once("php_sub/run_build_page_number.php");
		build_page_number($total_page, $page_size, $cur_page, $page_link);
	echo "</div>";
//end build_page_link_number
}//function create_page_nav($cat)
?>

</div><!--<div id="display_body_wrapper">-->
</body>
</html>