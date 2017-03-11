<?php
  $hotel_id = $_GET['hotel_id'];
  $type     = $_GET['type'];
  include("../connection/connection.php");
  include("../module/module.php");
  if($type == 'Facilities')
      facilities_view($hotel_id);
  else if($type == 'Sports')
      sports_recreation_view($hotel_id);
  else if($type == 'Accessibilities')
      accessibility_view($hotel_id);
  else if($type == 'Basics')
      basic_info_view($hotel_id);
?>