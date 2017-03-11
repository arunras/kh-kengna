<?php
    include("../module/module.php");
	include("../connection/connection.php");

    $hotel_id = $_GET['hotel_id'];

    if(!isset($_POST['submit'])){
?>


<form id="hotel_photos_form" action="php_ajax/db_hotel_photos.php?hotel_id=<?php echo $hotel_id; ?>" method="post" enctype="multipart/form-data" target="upload_target">
    <div id="sms_photos" class="error_text"></div>
    <table cellspacing="2" cellpadding="5" style="width:350px;">
        <tr height=40>
            <td align="left">Select Photo *</td>
            <td align="left">
                <input type="file" name="file_photos" id="file_photos" style="height:25px;margin-left:10px;" />
            </td>
        </tr>

        <tr height=40>
            <td align="left">Photo Description</td>
            <td align="left">
                <input type="text" name="photos_description" style="width:220px;height:20px;margin-left:10px;" />
            </td>
        </tr>

        <tr>
            <td colspan="2" align="right">
                <input type="hidden" value="2000000" name="MAX_FILE_SIZE" />
                <input type="submit" name="submit" value="Save"/>
            </td>
        </tr>
    </table>
</form>
<iframe id='upload_target' name='upload_target' src='#' style='width:0;height:0;border:0px solid #fff;'></iframe>

<?php
    }
    else{
   $destination_path = "../data_images/photos/" . $hotel_id;
   $result=upload('file_photos',$destination_path);
   $description = $_POST['photos_description'];
   $file_name = $_FILES['file_photos']['name'];

   $tem=explode(";",$result);
   $result=$tem[0];
   $target_path=$tem[1];
   if($result=="0"){
	   $target_path=substr($target_path,3,strlen($target_path));
	   $sql="insert into tbl_photos(hotel_id,photo_path,photo_description) values(" . $hotel_id . ",'" . $target_path . "','" . $description . "') ";
	   runSQL($sql);
       echo $sql;
       echo "Uploaded successful.";
       $photo_id = getValue("SELECT photo_id FROM tbl_photos WHERE hotel_id = " . $hotel_id . " AND photo_path = '" . $target_path . "'");
   }
   else{
        echo "Uploaded fail.";
   }
?>

<script language="javascript" type="text/javascript">window.top.window.upload_photos(<?php echo $result; ?>,"<?php echo $target_path; ?>","<?php echo $file_name; ?>","<?php echo $photo_id; ?>", "<?php echo $description; ?>");
</script>
<?php
  }
?>
