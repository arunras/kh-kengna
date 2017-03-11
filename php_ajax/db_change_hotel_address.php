<?php
    include("../module/module.php");
	include("../connection/connection.php");

    $hotel_id = $_GET['hotel_id'];

    if(!isset($_POST['submit_address'])){

    $addr_rs = getResultSet("SELECT hotel_city,hotel_khan,hotel_sangkat,hotel_address FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
    $hotel_city    = 0;
    $hotel_khan    = 0;
    $hotel_sangkat = 0;
    $hotel_address = "";

    $url_city = "php_ajax/db_save_type_address.php?type=city&view=true";
    $url_khan = "php_ajax/db_save_type_address.php?type=khan&view=true";
    $url_sangkat = "php_ajax/db_save_type_address.php?type=sangkat&view=true";

    while($add_info = mysql_fetch_array($addr_rs)){
        $hotel_city    = $add_info[0];
        $hotel_khan    = $add_info[1];
        $hotel_sangkat = $add_info[2];
        $hotel_address = $add_info[3];
    }
?>


<center>
<form id="hotel_address_form" action="php_ajax/db_change_hotel_address.php?hotel_id=<?php echo $hotel_id; ?>" method="post" target="upload_target">
    <div id="sms_description" class="error_text"></div>

    <table>
        <tr height=40>
            <td>City/Province:</td>
            <td>
                <select name="city" id="city" style="margin-left:5px; width:150px; display:inline;" onchange="ChangeKhan()">
                    <option value="0">-- City --</option>
                    <?php
                       $city_rs = getResultSet("SELECT city_id, city_name FROM tbl_cities WHERE country_id = 1"); //country_id = 1 for cambodia
                       while($city_info = mysql_fetch_array($city_rs)){
                         echo '<option value=' . $city_info[0];
                         if($city_info[0] == $hotel_city) echo ' selected ';
                         echo '>' . $city_info[1] . '</option>';
                       }
                    ?>
                </select>
            </td>
            <td>
                <a href="#" style="margin-left:10px; margin-right:10px;width:100px; width:150px;" onclick="popup_show('popup_over', 'form_content_over', 'title_over', 'popup_drag_over', 'popup_exit_over', 'screen-center',         0,   0, 'pos_bottom', 'Add New City', '<?php echo $url_city . "&up=1"; ?>')">Add</a>
            </td>
        </tr>

        <tr height=40>
            <td>District:</td>
            <td>
                <select name="khan" id="khan" style="margin-left:5px; display:inline;  width:150px;" onchange="ChangeSangkat()">
                    <option value="0">-- District --</option>
                    <?php
                       $khan_rs = getResultSet("SELECT khan_id, khan_name FROM tbl_khan");
                       while($khan_info = mysql_fetch_array($khan_rs)){
                         echo '<option value=' . $khan_info[0];
                         if($khan_info[0] == $hotel_khan) echo ' selected ';
                         echo '>' . $khan_info[1] . '</option>';
                       }
                    ?>
                </select>
            </td>
            <td>
                <a href="#" style="margin-left:10px; margin-right:10px;width:100px; width:150px;" onclick="popup_show('popup_over', 'form_content_over', 'title_over', 'popup_drag_over', 'popup_exit_over', 'screen-center',         0,   0, 'pos_bottom', 'Add New Khan', '<?php echo $url_khan . "&up="; ?>' + document.getElementById('city').value)">Add</a>
            </td>
        </tr>
        <tr height=40>
            <td>Commune:</td>
            <td>
                <select name="sangkat" id="sangkat" style="margin-left:5px; display:inline;  width:150px;">
                    <option value="0">-- Commune --</option>
                    <?php
                       $sangkat_rs = getResultSet("SELECT sangkat_id, sangkat_name FROM tbl_sangkat");
                       while($sangkat_info = mysql_fetch_array($sangkat_rs)){
                         echo '<option value=' . $sangkat_info[0];
                         if($sangkat_info[0] == $hotel_sangkat) echo ' selected ';
                         echo '>' . $sangkat_info[1] . '</option>';
                       }
                    ?>
                </select>
            </td>
            <td>
                <a href="#" style="margin-left:10px; margin-right:10px;width:100px; width:150px;" onclick="popup_show('popup_over', 'form_content_over', 'title_over', 'popup_drag_over', 'popup_exit_over', 'screen-center',         0,   0, 'pos_bottom', 'Add New Sangkat', '<?php echo $url_sangkat . "&up="; ?>' + document.getElementById('khan').value)">Add</a>
            </td>
        </tr>
        <tr height=40>
            <td>Address#:</td>
            <td>
                <input type="text" name="txt_address_no" value="<?php echo $hotel_address; ?>" />
            </td>
            <td></td>
        </tr>

        <tr>
            <td colspan="3" align="right">
                <input type="submit" name="submit_address" value="Save"/>
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

        $_new_city = $_POST['city'];
        $_new_khan = $_POST['khan'];
        $_new_sangkat = $_POST['sangkat'];
        $_new_addr = $_POST['txt_address_no'];

        $sql  = "UPDATE tbl_hotels SET hotel_city = " . $_new_city;
        $sql .= ", hotel_khan = " . $_new_khan;
        $sql .= ", hotel_sangkat = " . $_new_sangkat;
        $sql .= ", hotel_address = '" . $_new_addr . "'";
        $sql .= " WHERE hotel_id = " . $hotel_id;

        runSQL($sql);

        $hotel_city         = "";
		$hotel_khan         = "";
		$hotel_sangkat      = "";

        if($_new_city != 0  || $_new_city != '')
			$hotel_city         = getValue("SELECT city_name FROM tbl_cities WHERE city_id = " . $_new_city);
		if($_new_khan != 0  || $_new_khan != '')
			$hotel_khan         = getValue("SELECT khan_name FROM tbl_khan WHERE khan_id = " . $_new_khan);
		if($_new_sangkat != 0  || $_new_sangkat != '')
			$hotel_sangkat      = getValue("SELECT sangkat_name FROM tbl_sangkat WHERE sangkat_id = " . $_new_sangkat);

		$hotel_address = "Address:" . $hotel_city . ", " . $hotel_khan . ", " . $_new_addr;
?>
<script language="javascript" type="text/javascript">window.top.window.changed_address("<?php echo $hotel_address; ?>");
</script>
<?php
  }
?>