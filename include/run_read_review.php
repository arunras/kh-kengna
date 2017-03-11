<?php
/*
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}

	include("../connection/connection.php");
	include("../module/module.php");
*/
?>
<meta http-equiv="Content-Type" content="text/html charset=utf-8" />

<!--==Import CSS============================================================================================================-->
<link type="text/css" rel="stylesheet" href="css/read_review_style.css" />

<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery.expander.js"></script>

	<link type="text/css" rel="stylesheet" href="app_plugin/image_tooltip/img_tooltip.css" />
	<script src="app_plugin/image_tooltip/img_tooltip.js" type="text/javascript"></script>


			<style type="text/css">#videogallery a#videolb{display:none}</style>
			<link rel="stylesheet" href="app_plugin/video_engine/css/videolightbox.css" type="text/css" />
			<link rel="stylesheet" type="text/css" href="app_plugin/video_engine/css/overlay-minimal.css"/>

			<script src="app_plugin/video_engine/js/swfobject.js" type="text/javascript"></script>
			<!-- make all links with the 'rel' attribute open overlays -->
            <!--
            <script src="../app_plugin/video_engine/js/jquery.tools.min.js" type="text/javascript"></script>
			<script src="../app_plugin/video_engine/js/videolightbox.js" type="text/javascript"></script>
            -->
		<!-- End VideoLightBox.com HEAD section -->

<script type="text/javascript">
function init_review(){

  // simple example, using all default options
  //$('#user_comment p').expander();

  // *** OR ***

  // override some default options
  $('.user_comment p').expander({
    slicePoint:       200,  // default is 100
    expandText:         '[more]', // default is 'read more...'
	expandEffect: 		'toggle',
   // collapseTimer:    5000, // re-collapses after 5 seconds; default is 0, so no re-collapsing
    userCollapseText: '[less]'  // default is '[collapse expanded text]'
  });

}
</script>
<!--==END Expand Script============================================================================================================-->



	<!-- Start VideoLightBox.com BODY section -->

<script type="text/javascript">

function onYouTubePlayerReady(playerId) {
ytplayer = document.getElementById("video_overlay");
ytplayer.setVolume(100);
}

</script>
	<!-- End VideoLightBox.com BODY section -->



<div id="wrapper">

<?php
	require_once("php_sub/run_view.php");
?>

</div>