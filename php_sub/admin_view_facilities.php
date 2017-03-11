<?php
    include("../connection/connection.php");
    include("../module/module.php");
    if(!isset($_GET['action'])){
        admin_view_facilities();
        exit();
    }
    $action = $_GET['action'];
    if(isset($_GET['facility_id'])){//to edit/delete facility
        $facility_id = $_GET['facility_id'];
        if($action == "edit"){
            if(!isset($_POST['admin_submit_facility'])){ //to show edit facility form
            $facility_name = getValue("SELECT facility_name FROM tbl_facilities WHERE facility_id = " . $facility_id);
            ?>
            <form action = "php_sub/admin_view_facilities.php?facility_id=<?php echo $facility_id; ?>&action=edit" method="post" target="upload_target">
                <label for="txt_facility_name">Facility:</label>
                <input type="text" name="txt_facility_name" id="txt_facility_name" value="<?php echo $facility_name ?>" />
                <input type="submit" name="admin_submit_facility" value="Save" />
            </form>
            <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
            <?php

            }// form edit
            else{
                $facility_name = $_POST['txt_facility_name'];
                runSQL("UPDATE tbl_facilities SET facility_name = '" . $facility_name . "' WHERE facility_id = " . $facility_id);
            ?>
            <script language="javascript">window.top.window.finish_save_facility()</script>
            <?php
            }// to edit db

        }// edit action
        else{
           runSQL("DELETE FROM tbl_facilities WHERE facility_id = " . $facility_id);
           runSQL("DELETE FROM tbl_service WHERE service_id = " . $facility_id . " AND service_type = 'facility'");
           ?>
            <script language="javascript">window.top.window.finish_save_facility()</script>
            <?php
        } //delete action
    }//to edit/delete facility
    else{
        if(!isset($_POST['admin_add_facility'])){
        ?>
        <form action = "php_sub/admin_view_facilities.php?action=add" method="post" target="upload_target">
            <label for="txt_facility_name">Facility:</label>
            <input type="text" name="txt_facility_name" id="txt_facility_name" value="" />
            <input type="submit" name="admin_add_facility" value="Save" />
        </form>
        <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
        <?php
        }//show form add
        else{
            runSQL("INSERT INTO tbl_facilities(facility_name) VALUES('" . $_POST['txt_facility_name'] . "')");
            runSQL("INSERT INTO tbl_service(service_id,service_type) VALUES(" . mysql_insert_id() . ",'facility')");
           ?>
            <script language="javascript">window.top.window.finish_save_facility()</script>
            <?php
        }// to add to db
    } //to show form add/ add to db facility
    //admin_view_facilities();
?>