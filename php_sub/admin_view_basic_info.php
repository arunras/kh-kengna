<?php
    include("../connection/connection.php");
    include("../module/module.php");
    if(!isset($_GET['action'])){
        admin_view_basic_info();
        exit();
    }
    $action = $_GET['action'];
    if(isset($_GET['id'])){//to edit/delete basic info
        $id = $_GET['id'];
        if($action == "edit"){
            if(!isset($_POST['admin_submit_basic'])){ //to show edit basic info form
            $basic_label = getValue("SELECT info_label FROM tbl_basic_info WHERE info_id = " . $id);
            $basic_value_type =getValue("SELECT info_value_type FROM tbl_basic_info WHERE info_id = " . $id);
            ?>
            <form action = "php_sub/admin_view_basic_info.php?id=<?php echo $id; ?>&action=edit" method="post" target="upload_target">
                <table style="width:250px;">
                    <tr align="left">
                        <td><label for="txt_basic_label">Label:</label></td>
                        <td><input type="text" name="txt_basic_label" id="txt_basic_label" value="<?php echo $basic_label; ?>" /></td>
                    </tr>
                    <tr align="left">
                        <td><label for="txt_basic_label">Value Type*:</label></td>
                        <td>
                            <input type="text" name="basic_value" id="basic_value" value="<?php echo $basic_value_type; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">
                            <input type="submit" name="admin_submit_basic" value="Save" />
                            <input type="button" name="cancel" value="Cancel" onclick="close_popup()" />
                        </td>
                    </tr>
                </table>
            </form>
            <label style="font-size:10px;margin-bottom:10px;">* Leave blank for normal text type<br /> or put some pre-define values seperate by ";"<br /> or put "YES;NO" for check value</label>
            <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
            <?php

            }// form edit
            else{
                $basic_label = $_POST['txt_basic_label'];
                $basic_type  = $_POST['basic_value'];
                runSQL("UPDATE tbl_basic_info SET info_label = '" . $basic_label . "', info_value_type = '" . $basic_type . "' WHERE info_id = " . $id);
            ?>
            <script language="javascript">window.top.window.finish_save_basic()</script>
            <?php
            }// to edit db

        }// edit action
        else{
           runSQL("DELETE FROM tbl_basic_info WHERE info_id = " . $id);
           runSQL("DELETE FROM tbl_service WHERE service_id = " . $id . " AND service_type = 'basic_info'");
           ?>
            <script language="javascript">window.top.window.finish_save_basic()</script>
            <?php
        } //delete action
    }//to edit/delete facility
    else{
        if(!isset($_POST['admin_add_basic'])){
        ?>
        <form action = "php_sub/admin_view_basic_info.php?action=add" method="post" target="upload_target">
            <table style="width:250px;">
                    <tr align="left">
                        <td><label for="txt_basic_label">Label:</label></td>
                        <td><input type="text" name="txt_basic_label" id="txt_basic_label" value="" /></td>
                    </tr>
                    <tr align="left">
                        <td><label for="txt_basic_label">Value Type*:</label></td>
                        <td>
                            <input type="text" name="basic_value" id="basic_value" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">
                            <input type="submit" name="admin_add_basic" value="Save" />
                            <input type="button" name="cancel" value="Cancel" onclick="close_popup()" />
                        </td>
                    </tr>
                </table>
        </form>
        <label style="font-size:10px;margin-bottom:10px;">* Leave blank for normal text type<br /> or put some pre-define values seperate by ";"<br /> or put "YES;NO" for check value</label>
        <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
        <?php
        }//show form add
        else{
            runSQL("INSERT INTO tbl_basic_info(info_label,info_value_type) VALUES('" . $_POST['txt_basic_label'] . "','" . $_POST['basic_value'] . "')");
            runSQL("INSERT INTO tbl_service(service_id,service_type) VALUES(" . mysql_insert_id() . ",'basic_info')");
           ?>
            <script language="javascript">window.top.window.finish_save_basic()</script>
            <?php
        }// to add to db
    } //to show form add/ add to db facility
    //admin_view_facilities();
?>