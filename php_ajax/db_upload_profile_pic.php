<?php
    include("../module/module.php");
	include("../connection/connection.php");

       if(isset($_GET['hotel_id'])){
            $id = $_GET['hotel_id'];
            $destination_path = "../data_images/profile/" . $id;

            $old_image = "../" . getValue("SELECT hotel_images FROM tbl_hotels WHERE hotel_id = " . $id);
            if(unlink($old_image));

            $result=upload('file_profile_picture',$destination_path);
            $tem=explode(";",$result);
             $result=$tem[0];
             $target_path=$tem[1];
             if($result=="0"){
          	   $target_path=substr($target_path,3,strlen($target_path));
          	   $sql="update tbl_hotels SET hotel_images = '" . $target_path . "' WHERE hotel_id=" . $id;
          	   runSQL($sql);
                 echo "Uploaded successful.";
             }
             else{
                  echo "Uploaded fail.";
             }
             ?>
             <script language="javascript" type="text/javascript">window.top.window.change_profile(<?php echo $result; ?>,"<?php echo $target_path; ?>");
            </script>
             <?php
       }
       else if(isset($_GET['user_id'])){
            $id = $_GET['user_id'];
            $destination_path = "../data_images/users/" . $id;

            $old_image = "../" . getValue("SELECT user_profile_picture FROM tbl_users WHERE user_id = " . $id);
            if(unlink($old_image));

            $result=upload('fl_profile_picture',$destination_path);
            $tem=explode(";",$result);
             $result=$tem[0];
             $target_path=$tem[1];
             if($result=="0"){
          	   $target_path=substr($target_path,3,strlen($target_path));
          	   $sql="update tbl_users SET user_profile_picture = '" . $target_path . "' WHERE user_id=" . $id;
          	   runSQL($sql);
                 //echo "Uploaded successful.";
                 echo $sql;
             }
             else{
                  echo "Uploaded fail.";
             }
             ?>
             <script language="javascript" type="text/javascript">window.top.window.change_profile_user(<?php echo $result; ?>,"<?php echo $target_path; ?>");
            </script>
<?php
       }
?>
