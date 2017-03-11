<?php
	ob_start();
	if(!isset($SESSION))session_start();

	include("../connection/connection.php");
	include("../module/module.php");

	$type = $_GET['type'];

    if(isset($_GET['action'])){//for delete
        $del_sql = "";
        $id = $_GET['id'];
        switch($type){
          case "city":$del_sql = "DELETE FROM tbl_cities WHERE city_id = " . $id;break;
          case "khan":$del_sql = "DELETE FROM tbl_khan WHERE khan_id = " . $id;break;
          case "sangkat":$del_sql = "DELETE FROM tbl_sangkat WHERE sangkat_id = " . $id;break;
        }
        runSQL($del_sql);
        admin_view_addresses($type, $_GET['up']);
        exit();
    }


	$view = $_GET['view'];
    // for insert /update
	if($view == "true"){
		$up_id = $_GET['up'];
		$select_option = "";
		$up_label = "";
		$value_label = "";
        $sql_edit =""; //in case it is the edit form
		switch($type){
			case "city":
				$select_option = '<input type="hidden" value="1" name="up_val"/>'; //1 is the id of cambodia(for country)
				$value_label = "City";
                $sql_edit = "SELECT city_name FROM tbl_cities WHERE city_id=";
				break;
			case "khan":
				$up_label = "City";
				$value_label = "Khan";
                $sql_edit = "SELECT khan_name FROM tbl_khan WHERE khan_id=";
				$rs = getResultSet("SELECT * FROM tbl_cities");
				$select_option .= '<select name="up_val" style="width:150px;">';
				while($r = mysql_fetch_array($rs)){
					$select_option .= '<option value=' . $r['city_id'];
					if($r['city_id'] == $up_id) $select_option .= ' selected';
					$select_option .= '>' . $r['city_name'] . '</option>';
				}
				$select_option .= '</select>';
				break;
			case "sangkat":
				$up_label = "Khan";
				$value_label = "Sangkat";
                $sql_edit = "SELECT sangkat_name FROM tbl_sangkat WHERE sangkat_id=";
				$rs = getResultSet("SELECT * FROM tbl_khan");
				$select_option .= '<select name="up_val" style="width:150px;">';
				while($r = mysql_fetch_array($rs)){
					$select_option .= '<option value=' . $r['khan_id'];
					if($r['khan_id'] == $up_id) $select_option .= ' selected';
					$select_option .= '>' . $r['khan_name'] . '</option>';
				}
				$select_option .= '</select>';
				break;
			default:break;
		}
        $url = 'php_ajax/db_save_type_address.php?type=' . $type . '&view=false';
        if(isset($_GET['edit'])){
	      $edit = "true";
          $value_id = $_GET['id'];
          $url .= '&id=' . $value_id;
          $sql_edit .= $value_id;
          $value = getValue($sql_edit);
	    }
        else{
          $edit = "false";
          $value = "";
        }
        $url .= '&edit=' . $edit;
		echo '<form action="' . $url . '" method="post" target="upload_target" enctype="multipart/form-data" />';
		echo '<table>';
		echo '<tr align="left"><td>' . $up_label . '</td><td>' . $select_option . '</td></tr>';
		echo '<tr align="left" height=45><td>' . $value_label . '</td><td><input type="text" value="' . $value . '" id="addr_value" name="addr_value" /></td></tr>';
		echo '<tr align="right" height=35><td colspan="2"><input type="submit" id="btn_save" value="save" /><input type="button" id="btn_cancel" value="Cancel" onclick="close_form_over();" /> </td></tr>';
		echo '</table>';
		echo '</form>';
        echo "<iframe id='upload_target' name='upload_target' src='#' style='width:0;height:0;border:0px solid #fff;'></iframe>";
	}
	else{
		$value = $_POST['addr_value'];
		$up_id = $_POST['up_val'];
		$table_name = "";
		$field_id ="";
		$field_name = "";
		$up_field_name = "";
		$url = $_SESSION['_cur_Page'] . "&menu=1"; //current page must be addnew_hotel
		if($value == ""){
			echo $url;
            //header("location:../?mangoparam=" . $url);
            ?>

            <script language="javascript">
                window.top.window.close_form_over();
            </script>

            <?php
			return;
		}
		switch($type){
			case "city":
				$table_name = "tbl_cities";
				$field_id = "city_id";
				$field_name = "city_name";
				$up_field_name = "country_id";
				break;
			case "khan":
				$table_name = "tbl_khan";
				$field_id = "khan_id";
				$field_name = "khan_name";
				$up_field_name = "city_id";
				break;
			case "sangkat":
				$table_name = "tbl_sangkat";
				$field_id = "sangkat_id";
				$field_name = "sangkat_name";
				$up_field_name = "khan_id";
				break;
			default:break;
		}

		//if(!isDuplicate($table_name,$field_name,$value, "string")){
        if($_GET['edit'] == "false")
		{
			$sql_ ="INSERT INTO " . $table_name . "(" . $field_name . "," . $up_field_name . ")";
			$sql_ .= " VALUES('" . $value . "'," . $up_id . ")";
			runSQL($sql_);
            $id = getValue("SELECT " . $field_id . " FROM " . $table_name . " WHERE " . $field_name . "='" . $value . "'");

            ?>
            <script language="javascript">
                window.top.window.close_form_over();
                var curUrl = window.top.location + "";
                if((curUrl.indexOf("detail")+0) > 0){// it is called in detail page
                    window.top.window.add_address_type("<?php echo $type; ?>","<?php echo $value; ?>","<?php echo $id; ?>");
                }
                else{
                    if((curUrl.indexOf("add_hotel")+0) > 0){// it is called in add hotel page
                        window.top.window.hotel_address_type("<?php echo $type; ?>");
                    }
                    else{// it is called in admin page
                        window.top.window.admin_address_type("<?php echo $type; ?>");
                    }
                }
            </script>
            <?php
		}
        else{
            $value_id = $_GET['id'];
            $sql_ = "UPDATE " . $table_name . " SET " . $field_name . " = '" . $value . "' WHERE " . $field_id . " = " . $value_id;
            runSQL($sql_);
            ?>
                <script language="javascript">
                window.top.window.close_form_over();
                window.top.window.admin_address_type("<?php echo $type; ?>");
                </script>
            <?php
        }
	}
?>