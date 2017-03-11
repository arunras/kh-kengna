<?php
    include("../module/module.php");
	include("../connection/connection.php");

    $hotel_id   = $_GET['hotel_id'];

    $table_name = $_GET['table_name'];
    $field_name = $_GET['field_name'];


    $url = "php_ajax/db_save_hotel_info.php?hotel_id=" . $hotel_id . "&table_name=" . $table_name . "&field_name=" . $field_name;
    if(!isset($_POST['submit_value'])){
      //$_name = getValue("SELECT " . $fie . " FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
?>


<center>
<form action="<?php echo $url; ?>" method="post" target="upload_target">
    <div id="sms_value" class="error_text"></div>

    <table>
        <tr height=40>
            <td width="100">Value:</td>
            <td>
                <input type="text" name="txt_value" value="" id="txt_value" style="margin-left:10px;"/>
            </td>
        </tr>

        <tr>
            <td colspan="2" align="right">
                <input type="submit" name="submit_value" value="Save"/>
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

        $value      = $_POST['txt_value'];
        $sql ="";
        if($value != ""){
          $sql="INSERT INTO " . $table_name . "(" . $field_name . ",hotel_id) VALUES('" . $value . "'," . $hotel_id . ")";
          runSQL($sql);
        }

        if($table_name == "tbl_hotel_facilities") $table_name = "Facilities";
        else if($table_name == "tbl_hotel_sports") $table_name = "Sports";
        else if($table_name == "tbl_hotel_accessibilities" ) $table_name = "Accessibilities";

?>
<script language="javascript" type="text/javascript">window.top.window.finish_add_info("<?php echo $table_name; ?>");
</script>
<?php
  }
?>