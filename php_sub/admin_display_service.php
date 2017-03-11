<?php
    include("../connection/connection.php");
    include("../module/module.php");
    $id = $_GET['id'];
    $service = $_GET['service'];
    if(isset($_GET['available'])){
        $sql = "UPDATE tbl_service SET service_available = " . $_GET['available'] . " WHERE service_id = " . $id . " AND service_type = '" . $service . "'";
        runSQL($sql);
    }
    else if(!isset($_POST['submit_service'])){
?>
    <form action="php_sub/admin_display_service.php?id=<?php echo $id ?>&service=<?php echo $service ?>" method="post" enctype="multipart/form-data" target="upload_target">
        <table>
            <tr>
                <td>Choose icon</td>
                <td><input type="file" id="service_icon" name="service_icon" />
                <input type="hidden" value="2000000" name="MAX_FILE_SIZE" /></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="submit_service" value="Save" />
                    <input type="button" value="Cancel" onclick="close_form_over()" />
                </td>
            </tr>
        </table>
    </form>
    <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
<?php
    }
    else{
        $destination_path = "../data_images/service/" . $service . "/" . $id;
        $result=upload('service_icon',$destination_path, "");
        $file_name = $_FILES['service_icon']['name'];

        $tem=explode(";",$result);
        $result=$tem[0];
        $target_path=$tem[1];
        if($result=="0"){
          $target_path=substr($target_path,3,strlen($target_path));
          $sql = "UPDATE tbl_service SET service_icon = '" . $target_path . "' WHERE service_id = " . $id . " AND service_type = '" . $service . "'";
          runSQL($sql);
          echo $sql;
          echo "Uploaded successful.";

        ?>
        <script language="javascript">
            window.top.window.save_service("<?php echo $service; ?>");
        </script>
        <?php
          //$photo_id = getValue("SELECT photo_id FROM tbl_photos WHERE hotel_id = " . $hotel_id . " AND photo_path = '" . $target_path . "'");
        }
        else{
            echo "Uploaded fail.";
        }
    }
?>