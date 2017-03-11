<?php
    include("../module/module.php");
	include("../connection/connection.php");

    $hotel_id = $_GET['hotel_id'];

    if(!isset($_POST['submit_description'])){
      $_description = getValue("SELECT hotel_description FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
?>


<center>
<form id="hotel_description_form" action="php_ajax/db_change_hotel_description.php?hotel_id=<?php echo $hotel_id; ?>" method="post" target="upload_target">
    <div id="sms_description" class="error_text"></div>

    <table style="width:500px;">
        <tr height=40 valign="top">
            <td>
                &nbsp;&nbsp;&nbsp;New Description<br />
                <textarea name="txt_description" id="txt_description" style="margin-left:10px;width:500px;height:150px;"><?php echo $_description ?></textarea>
            </td>
        </tr>

        <tr>
            <td align="right">
                <input type="submit" name="submit_description" value="Save" />
                <input type="button" value="Cancel" onclick="close_form();" />
            </td>
        </tr>
    </table>
</form>
<iframe id='upload_target' name='upload_target' src='#' style='width:0;height:0;border:0px solid #fff;'></iframe>
</center>
<?php
    }
    else{

        $_new_description = $_POST['txt_description'];
        $_new_description = htmlspecialchars($_new_description,1);
        if($_new_description != ""){
          runSQL("UPDATE tbl_hotels SET hotel_description = '" . $_new_description . "' WHERE hotel_id = " . $hotel_id);
        }

?>
<script language="javascript" type="text/javascript">window.top.window.changed_description("<?php echo $_new_description; ?>");
</script>
<?php
  }
?>