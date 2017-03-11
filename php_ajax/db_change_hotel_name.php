<?php
    include("../module/module.php");
	include("../connection/connection.php");

    $hotel_id = $_GET['hotel_id'];

    if(!isset($_POST['submit_name'])){
      $_name = getValue("SELECT hotel_name FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
?>


<center>
<form id="hotel_name_form" action="php_ajax/db_change_hotel_name.php?hotel_id=<?php echo $hotel_id; ?>" method="post" target="upload_target">
    <div id="sms_name" class="error_text"></div>

    <table>
        <tr height=40>
            <td width="100">New Name</td>
            <td>
                <input type="text" name="txt_name" value="<?php echo $_name; ?>" id="txt_name" style="margin-left:10px;"/>
            </td>
        </tr>

        <tr>
            <td colspan="2" align="right">
                <input type="submit" name="submit_name" value="Save"/>
                <input type="button" value="Cancel" onclick="close_form();"  />
            </td>
        </tr>
    </table>
</form>
<iframe id='upload_target' name='upload_target' src='#' style='width:0;height:0;border:0px solid #fff;'></iframe>
</center>
<?php
    }
    else{

        $_new_name = $_POST['txt_name'];
        if($_new_name != ""){                     
          runSQL("UPDATE tbl_hotels SET hotel_name = '" . $_new_name . "' WHERE hotel_id = " . $hotel_id);
        }

?>
<script language="javascript" type="text/javascript">window.top.window.changed_name("<?php echo $_new_name; ?>");
</script>
<?php
  }
?>