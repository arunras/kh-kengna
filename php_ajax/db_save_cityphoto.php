<?php

    $action = $_GET['action'];
    if(isset($_GET['id']))$id=$_GET['id'];
    else $id = 0;
    $form   = "";
    $city   = $_GET['city'];
    if(isset($_POST['submit_city_photo'])){
        include("../connection/connection.php");
        include("../module/module.php");
        $sql = "";
        switch($action){
            case "add":
                $destination_path = "../data_images/city/" . $city . "/";
                $result=upload('txt_photo',$destination_path);
                $description = $_POST['txt_description'];
                $file_name = $_FILES['txt_photo']['name'];

                $tem=explode(";",$result);
                $result=$tem[0];
                $target_path=$tem[1];
                if($result=="0"){
            	   $target_path=substr($target_path,3,strlen($target_path));
            	   $sql="INSERT INTO tbl_city_photo(city_id, city_photo, city_photo_description) VALUES(" . $city . ",'" . $target_path . "', '" . $description . "')";
            	   runSQL($sql);
                   $photo_id = mysql_insert_id();
                ?>
<script language="javascript" type="text/javascript">window.top.window.upload_city_photos(<?php echo $result; ?>,"<?php echo $target_path; ?>","<?php echo $file_name; ?>","<?php echo $photo_id; ?>", "<?php echo $description; ?>");
</script>
                <?php
                }
                else{
                    echo "Uploaded fail.";
                }
                 break;
            case "edit":
                $description = $_POST['txt_description'];
                $sql = "UPDATE tbl_city_photo SET city_photo_description='" . $description . "' WHERE city_photo_id = " . $id ;
                runSQL($sql);
?>
<script language="javascript" type="text/javascript">window.top.window.finish_city_photo_description("<?php echo $id  ?>","<?php echo $description ?>");
</script>
<?php
                break;

        }
    }
    else{
    switch($action){
        case "add":
            $form = '
                <table style="margin:10px 15px 10px 15px;width:300px;">
                    <tr>
                        <td align="left">Photo:</td><td align="left"><input type="file" name="txt_photo" id="txt_photo" /></td>
                    </tr>
                    <tr>
                        <td align="left">Description:</td><td align="left"><input type="text" name="txt_description" /></td>
                    </tr>
                    <tr>
                        <td colspan=2 align="right">
                            <input type="submit" name="submit_city_photo" value="Save" />
                            <input type="button" value="Cancel" onclick="close_form_over()" />
                        </td>
                    </tr>
                </table>
                <input type="hidden" value="2000000" name="MAX_FILE_SIZE" />
            ';
            break;
        case "edit":
            include("../connection/connection.php");
            include("../module/module.php");
            $old_desc = getValue("SELECT city_photo_description FROM tbl_city_photo WHERE city_photo_id = " . $id);
             $form = '
                <table style="margin:10px 15px 10px 15px;width:150px;">
                    <tr>
                        <td align="left">Description:</td><td align="left"><input type="text" value="' . $old_desc . '" name="txt_description" /></td>
                    </tr>
                    <tr>
                        <td colspan=2 align="right">
                            <input type="submit" name="submit_city_photo" value="Save" />
                            <input type="button" value="Cancel" onclick="close_form_over()" />
                        </td>
                    </tr>
                </table>
                <input type="hidden" value="2000000" name="MAX_FILE_SIZE" />
            ';
            break;
        case "delete":
            include("../connection/connection.php");
            include("../module/module.php");
            $form = "";
            $sql = "DELETE FROM tbl_city_photo WHERE city_photo_id = " . $id;
            runSQL($sql);
            exit();
            break;
    }

    //echo 'php_ajax/db_save_cityphoto.php?action=' . $action . '&id=' . $id . '&city=' . $city;
    echo '<form action="php_ajax/db_save_cityphoto.php?action=' . $action . '&id=' . $id . '&city=' . $city . '" method="post" enctype="multipart/form-data" target="upload_target">';
    echo '<div id="sms_photos" class="error_text"></div>';
    echo $form;
    echo '
        </form>
        <iframe id="upload_target" name="upload_target" style="display:none"></iframe>
    ';

    }
?>