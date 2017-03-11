<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}

	/* ----------- session for current page: _cur_Page (name of the page without extension)----------------- */

	$_SESSION['_cur_Page']=$home_page;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<!--=====Imports=======================================================================================================================-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Camitss, Cambodia IT, IT Solution, IT Support, Outsourcing, Offshore Development, Office IT, IT maintenance, カンボジアＩＴ" />
<meta name="description" content="CAMITSS - Cambodia IT Solutions & Supports" />

<link href="app_images/logo.png" rel="shortcut icon" />

<link href="css/mangosteen_style.css" rel="stylesheet" type="text/css" />
<link href="css/svwp_style.css" rel="stylesheet" type="text/css" />



<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.slideViewerPro.1.0.js" type="text/javascript"></script>

<!-- Optional plugins  -->
<script src="js/jquery.timers.js" type="text/javascript"></script>
<!--=====End Import=======================================================================================================================-->


<!---- Link style-sheet block ---->


<!---- End of link style-sheet block ---->
<!---- Script block ---->

<!---- Script block ---->
<script type="text/javascript">
	var auto=true;
	var s = true;
	function switchPlay(){
		if(s==true){
			document.getElementById("navPlay").src="app_images/pause.gif";
			document.getElementById("navPlay").title="Stop";
			auto=true;
			s=false;
			//alert(auto);
		}
		else if(s==false){
			document.getElementById("navPlay").src="app_images/play.gif";
			document.getElementById("navPlay").title="Play";
			auto=false;
			s=true;
			//alert(auto);
		}
		$("div#featuredslideshow").slideViewerPro({
               autoslide: auto
         });

	}
</script>




<title>Welcome to Mangosteen</title>
</head>

<body>
<!--
<div id="mangosteen_header_wrapper"><!--Header--
	<div id="mangosteen_header">
    	<div id="site_title">
        site_title
        	<a href="http://www.camitss.com">
            	<!--<img src="#" alt="logo" width="171" height="81" align="absmiddle" />--
            	<span>MangoSteen</span>
          	</a>
    	</div> <!-- end of site_title --
    </div>
</div><!--end Header--
-->
<!--
<div id="menu1">
	Menu
</div>
-->
<div id="mangosteen_body_wrapper">
        <!--<div id="body_middle_top">-->
        <div id="mangosteen_slider_wrapper">
        	<div id="mangosteen_title">
            
            	<div id="logo">
                	<a href="#" title="home"> <img src="app_images/logo.png" width="150px" height="60px" /> </a>
                </div>
            
            	<h1>MangoSteen</h1>
            </div>

        	<div id="mangosteen_list_location">
<?php
	require_once("php_sub/run_list_location.php");
?>
            </div>

			<div id="mangosteen_top_hotel_wrapper">
            <div id="mangosteen_top_hotel">
            	<div id="top_three">
                	<!--
            		<a href="http://googl.com"> <img alt="　B" src="images/i12.jpg" id="test1" onmouseover="style: bordercolor: red;" /> </a>
                	<a href="#"> <img alt="　B" src="images/i13.jpg" id="test2" /> </a>
                	<a href="#"> <img alt="　B" src="images/i9.jpg" id="test3" /> </a>
                    -->
                </div>
            </div>
            	<div id="navigator">
                    <a href="#" id="previous" title="Previous"><img src="app_images/left.gif" /></a>
                    <a href="#" id="play"><img src="app_images/play.gif" id="navPlay" onclick="switchPlay();" title="Play"/></a>
                    <a href="#" id="next" title="Next"><img src="app_images/right.gif" /></a>
           		</div>
            </div>
            
            
            
            
    	    <div id="mangosteen_slider">
                <div id="featuredslideshow">
                	<?php
						require_once("php_sub/run_home_slider.php");
					?>
                </div>
                <script type="text/javascript">				
				$(document).ready(function(){
					$.get(
					"php_ajax/run_top.php?city=1",
						function(data){
							$("#top_three").html(data);
						}
					);	
                    $("div#featuredslideshow").slideViewerPro({ 
                    thumbs: 20,  
                    thumbsPercentReduction: 3,//15 ,
                    galBorderWidth: 0, 
                    galBorderColor: "#666", 
                    thumbsTopMargin: 10, 
                    thumbsRightMargin: 10, 
                    thumbsBorderWidth: 1, 
                    thumbsActiveBorderColor: "#0000ff", 
                    thumbsActiveBorderOpacity: 0.8, 
                    thumbsBorderOpacity: 0, 
                    buttonsTextColor: "#707070", 
                    autoslide: auto,  
                    typo: true
                    });
				});
					//showGallery();
					
                </script>
            </div>
            <!--
            <div class="cleaner"></div>
            -->
    </div>
</div>

	<?php

		/* ---------------- View menu ------------------*/
		//include("include/menu.php");

		/* --------------- Use the page parameter to choose which page to display -----------------------------------*/

		//include("include/" . $page_param . ".php");

	?>
</body>
</html>