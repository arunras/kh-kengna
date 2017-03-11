<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}

	include("connection/connection.php");
	include("module/module.php");

	connectDB();
    //unset($_SESSION['_user_13_5_2011_id']);

	/*

		This is the main page that use to call for the other sub pages requested by user via parameters.

		e.g. http://www.mangosteen.com/index.php?mangoparam=home -> refer to home page in include folder.
		     http://www.mangosteen.com/index.php?mangoparam=detail -> refer to detail page of each hotel.
			 http://www.mangosteen.com/index.php?mangoparam=user -> refer to profile page of our user.

	*/


	/* -------------- parameter use to call page :: initialize as home_page----------------------*/
	$page_param = $home_page; // more declaration of page_param is in module


	/* ------------------- Getting the parameter -----------------------*/
	if(isset($_GET['mangoparam'])){
		$page_param = $_GET['mangoparam'];
	}


	/* -------------------- verify that the page request is available for loading -----------------*/
	$page_param=get_loadable_page($page_param);


	/* ----------- session for user id: _user_13_5_2011_id------------------*/

	if(isset($_SESSION['_user_13_5_2011_id'])){
		/*-------------  user_id : parameter store user id after log in --------------*/
		$user_id = $_SESSION['_user_13_5_2011_id'];
		//unset($_SESSION['_user_13_5_2011_id']);

	}


	/* ----------- session for current page: _cur_Page (name of the page without extension)----------------- */

	//$_SESSION['_cur_Page']=$home_page;

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="images/logo.png" rel="shortcut icon" />



<!-- Link style-sheet block -->


 <!-- phearun style sheet -->
<!--<link href="css/mangosteen_style.css" rel="stylesheet" type="text/css" />
   <link href="css/svwp_style.css" rel="stylesheet" type="text/css" />
    <link href="css/slider.css" rel="stylesheet" type="text/css" />--><!--Fad Slider-->
 <!-- end of phearun style sheet -->

<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="css/login.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.asmselect.css" />
<link rel="stylesheet" type="text/css" href="css/popup.css" />
<link rel="stylesheet" type="text/css" href="css/dropdown.css" />
<link rel="stylesheet" type="text/css" href="css/add_styles.css"/>
<link rel="stylesheet" type="text/css" href="css/hotel_detail.css"/>
<link rel="stylesheet" type="text/css" href="css/gmap.css"/>
<link rel="stylesheet" type="text/css" href="css/admin.css"/>
<link rel="stylesheet" type="text/css" href="css/lst_table.css"/>
<link rel="stylesheet" type="text/css" href="css/profile.css"/>
<link rel="stylesheet" type="text/css" href="css/write_review.css"/>


<link rel="stylesheet" href="css/gallerific/galleriffic.css" type="text/css" />
<link rel="stylesheet" href="css/checkbox.css" type="text/css" media="screen" charset="utf-8" />

 <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.6/dijit/themes/claro/claro.css" />
<!-- End of link style-sheet block -->

<!--- script block --->
<script src="js/ajax.js"></script>
<script type="text/javascript" src="js/jquery-1.6.1.js"></script>

<script src="js/checkbox.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.opacityrollover.js"></script>
<script type="text/javascript" src="js/jquery.galleriffic.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/dojo/1.6/dojo/dojo.xd.js" djConfig="parseOnLoad: true"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery.ui.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/utility.js"></script>
<script type="text/javascript" src="js/jquery.inputfocus-0.9.min.js"></script>
<script type="text/javascript" src="js/jquery.asmselect.js"></script>
<script type="text/javascript" src="js/add_hotel.js"></script>
<script type="text/javascript" src="js/js_admin.js"></script>
<script type="text/javascript" src="js/hotel_detail.js"></script>
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=<?php echo API_KEY_GOOGLE_MAP; ?>" type="text/javascript"></script>

<!--<script type="text/javascript" src="js/gallerific/jquery-1.3.2.js"></script>-->


<script type="text/javascript" src="js/gmap.js"></script>
<script type="text/javascript" src="js/popup-window.js"></script>
<script type="text/javascript" src="js/slider.js"></script>


    <!-- phearun script -->
        <script src="js/jquery.slideViewerPro.1.0.js" type="text/javascript"></script>
        <script src="js/jquery.timers.js" type="text/javascript"></script>

        <script type="text/javascript" src="js/s3Slider.js"></script>
        <script type="text/javascript" src="js/toggle_category.js"></script>
    <!-- end of phreaun script -->

<script type="text/javascript" src="js/organic-tabs/organictabs.jquery.js"></script>


 <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.6/dijit/themes/claro/claro.css"/>

<!--==Import CSS============================================================================================================-->
<link type="text/css" rel="stylesheet" href="css/write_review_style.css" />

<!--==end Import CSS============================================================================================================-->

<!--==Star Rating=========================================================================-->
<link rel="stylesheet" href="css/css_star/ui.tabs.css" type="text/css" />
<link type="text/css" rel="stylesheet" href="css/css_star/star_rating.css" />
<link rel="stylesheet" href="css/css_star/jquery.rating.css" type="text/css" />

<!--<script type="text/javascript" src="js/js_star/ui.core.min.js"></script>-->
<!--<script type="text/javascript" src="js/js_star/ui.tabs.min.js"></script>-->
<script type="text/javascript" src="js/js_star/jquery.rating.js"></script>
<script type="text/javascript" src="js/js_star/jquery.rating.pack.js"></script>
<!--<script type="text/javascript" src="js/js_star/jquery.MetaData.js"></script>-->

<script type="text/javascript" src="js/file_upload/fileupload.js"></script>




<!-- MultiUpload-Application -->
    <!-- loading script -->
    <!--<script language="JavaScript" src="Application/MultiUpload/JavaScript/jquery-1.6.2.js"></script>-->
    <script type="text/javascript" src="application/multiupload/javascript/jquery.multiupload.js"></script>
    <!-- end of loading script -->

    <!-- loading style sheet -->
    <link rel="stylesheet" href="application/multiupload/css/multiuploadstyle.css" type="text/css" />
    <!-- end of loading css  -->
<!-- End of MultiUpload -->



<script language="javascript" type="text/javascript">

	var htmlid="";
	var xmlobj;

	function ajax_return()
	{
		if (xmlobj.readyState==4 || xmlobj.readyState=="complete")
		{
			document.getElementById(htmlid).innerHTML=xmlobj.responseText;
            $("#" + htmlid + " input[type=checkbox]").prettyCheckboxes();
		}
	}

</script>

<!-- end of script block -->


<title>Welcome to Mangosteen</title>
</head>

	<?php
        include("noscript.php");

		/* ---------------- View menu ------------------*/

		include("include/util_menu.php");


		/* --------------- Use the page parameter to choose which page to display -----------------------------------*/

		/*
			echo '<span id="view"></span>';
			getting the value from city selected in menu;
			it will return the city_id value to the tag with it's id is view;
			you can modify it in slider.js
			and session_set_selected_city_view.php which set the session ['city_selected'] to city_id as well
		*/

		include("include/" . $page_param . ".php");



		/* ---------------- view footer ----------------*/

		include("include/util_footer.php");
	?>

</html>