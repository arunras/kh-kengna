// JavaScript Document
var center;

	function initialize(xx,yy) {
		if (GBrowserIsCompatible() && document.getElementById('map_canvas')) {
			var map = new GMap2(document.getElementById("map_canvas"));
			x = xx;
			y = yy;
			//var gicons = [];
			//gicons["restaurant"] = new GIcon(G_DEFAULT_ICON,"images/point.png");
			var baseIcon = new GIcon(G_DEFAULT_ICON);
			baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
			baseIcon.iconSize = new GSize(20, 34);
			baseIcon.shadowSize = new GSize(37, 34);
			baseIcon.iconAnchor = new GPoint(9, 34);
			baseIcon.infoWindowAnchor = new GPoint(9, 2);

			var letter = "M";
			var letteredIcon = new GIcon(baseIcon);
			letteredIcon.image = "http://www.google.com/mapfiles/marker" + letter + ".png";

			center = new GLatLng(x, y);
			map.setCenter(center, 17);
			map.setUIToDefault();

			if(document.getElementById("edit")){
                var marker = new GMarker(center, {icon:letteredIcon,draggable: true});
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
			}
			else{
				var marker = new GMarker(center,{draggable:false});
			}
			map.addOverlay(marker);
			GEvent.addListener(marker, "click", function() {
  				/*marker.openInfoWindowHtml("<?php echo $rtitle1."<hr>".$rtitle2; ?>");*/
			});
		}
}