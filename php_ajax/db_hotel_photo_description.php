<?php
    $photo_id = $_GET['photo_id'];

    include("../connection/connection.php");
    include("../module/module.php");

    if(!isset($_POST['submit_photo_description'])){
      $old_desc = "";
      $old_desc = getValue("SELECT photo_description FROM tbl_photos WHERE photo_id = " . $photo_id);
?>
    <form action="php_ajax/db_hotel_photo_description.php?photo_id=<?php echo $photo_id ?>" method="post" target="upload_target">
    <table>
        <tr>
            <td align="left">
                Description<br />
                <input type="text" value="<?php echo $old_desc; ?>" name="text_description" />
            </td>
        </tr>
        <tr>
            <td align="right">
                <input type="submit" value="Save" name="submit_photo_description" />
            </td>
        </tr>
    </table>
    </form>
    <iframe id="upload_target" style="display:none"></iframe>
<?php
    }
    else{
        $desc = $_POST['text_description'];
        $photo_id  =  $_GET['photo_id'];
        $sql = "UPDATE tbl_photos SET photo_description = '" . $desc . "' WHERE photo_id = " . $photo_id;
        runSQL($sql);
?>
<script language="javascript">
    window.top.window.finish_photo_description("<?php echo $photo_id; ?>","<?php echo $desc; ?>");
</script>
<?php
    }
?>