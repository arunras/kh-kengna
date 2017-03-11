<?php
   	include("../connection/connection.php");
	include("../module/module.php");

	$hotel_id        = $_GET['hotel_id'];
    $can_edit        = $_GET['can_edit'];
   	$hotel_lattitude = getValue("SELECT hotel_lattitude FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
    $hotel_longitude = getValue("SELECT hotel_longitude FROM tbl_hotels WHERE hotel_id = " . $hotel_id);

?>

<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=<?php echo API_KEY_GOOGLE_MAP; ?>" type="text/javascript"></script>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta name="description" content="We service" />

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>

<link rel="stylesheet" href="../css/style.css" />


<style type="text/css">
  #map_canvas { height: 100%;width:inherit; border:2px #666 solid;}
  a.map{ font-size:12px;}
</style>
</head>

<!---------------------------->
<script type="text/javascript">
	//var myLatlng = new google.maps.LatLng(-34.397, 150.644);

	var center;

	function initialize(xx,yy) {
		if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map_canvas"));
			x = xx;
			y = yy;
			center = new GLatLng(xx, yy);
			map.setCenter(center, 15);
			map.setUIToDefault();
			if(document.getElementById("edit_")){
				var marker = new GMarker(center, {draggable: true});
				GEvent.addListener(marker, "dragstart", function() {
					map.closeInfoWindow();
				});

				GEvent.addListener(marker, "dragend", function() {
					var str = marker.getLatLng().toString();
					str = str.split(',')
					str[0]=str[0].substring(1,str[0].length);
					str[1]=str[1].substring(0,str[1].length-1);

					x = str[0]+0;
					y = str[1]+0;
				});
				map.addOverlay(marker);
			}
			else{
				var marker = new GMarker(center,{draggable:false});
				map.addOverlay(marker);
			}
			GEvent.addListener(marker, "click", function() {
			});
		}
	}

  function savemap(hotel_id){
		hobj =getHTTPObject();
		cid="savemap";
		if(hobj==null){
			return;
		}
		url ="db_savemap.php?hotel_id="+hotel_id+"&lat="+x+"&lon="+y;
		hobj.onreadystatechange=stateChangedInfo
		hobj.open("GET",url,true)
		hobj.send(null)

        $("#"+cid).fadeOut(900);
		return false;
  }

  //window.onload = loadScript;

  function stateChangedInfo()
	{
		if (hobj.readyState==4 || hobj.readyState=="complete")
		{
			document.getElementById(cid).innerHTML=hobj.responseText;
		}
	}

  //window.onload = loadScript;

</script>

<body onload="initialize(<?php echo $hotel_lattitude ?>,<?php echo $hotel_longitude ?>)" onunload="GUnload()">
	<?php
       if($can_edit){
    ?>


&nbsp;&nbsp;&nbsp;&nbsp;<a id="edit_" href="#" class="map" onClick="return savemap(<?php echo $hotel_id; ?>)">Save</a>
        <!--&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="map" onClick=""></a>-->
        <br><span id="savemap" class="error_text"></span>
        </em></center>
 	<?php } ?>

<div id="map_canvas" style="padding-top:10px;">
</div>


<?php echo "</body>"; ?>

