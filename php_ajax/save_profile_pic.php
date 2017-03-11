<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}
   	$destination_path = "../data_images/profile/";
	include("../module/module.php");
	include("../connection/connection.php");
   	$result = 0;
	if(isset($_SESSION['added_hotel_id'])){

	$hotel_id = $_SESSION['added_hotel_id'];


   $result=upload('txtfile',$destination_path);

   $tem=explode(";",$result);
   $result=$tem[0];
   $target_path=$tem[1];
   $view_result = "";
   echo $result." ".$target_path;
   if($result=="0"){
	   $view_result = "<div class='profilepic'><img src='" . $target_path . "' class='profilepic' /></div>";
	   $target_path=substr($target_path,3,strlen($target_path));
	   $sql="update tbl_hotels SET hotel_images = '" . $target_path . "' WHERE hotel_id=" . $hotel_id;
		runSQL($sql);
   }
}
?>

<script language="javascript" type="text/javascript">window.top.window.finish_submit_profile(<?php echo $result; ?>,"profile","<?php echo $view_result; ?>");
</script>