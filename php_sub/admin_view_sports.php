<?php
    include("../connection/connection.php");
    include("../module/module.php");
    if(!isset($_GET['action'])){
        admin_view_sports();
        exit();
    }
    $action = $_GET['action'];
    if(isset($_GET['sport_id'])){//to edit/delete sport
        $sport_id = $_GET['sport_id'];
        if($action == "edit"){
            if(!isset($_POST['admin_submit_sport'])){ //to show edit sport form
            $sport_name = getValue("SELECT sport_name FROM tbl_sports_recreation WHERE sport_id = " . $sport_id);
            ?>
            <form action = "php_sub/admin_view_sports.php?sport_id=<?php echo $sport_id; ?>&action=edit" method="post" target="upload_target">

                    <label for="txt_sport_name">Sport:</label>
                    <input type="text" name="txt_sport_name" id="txt_sport_name" value="<?php echo $sport_name ?>" />

                <!--
                <tr>
                    <td align="left"><label>View in display:</label></td>
                    <td align="left">
                        <input type="checkbox" value="view_sport" />
                    </td>
                </tr>
                <tr>
                    <td align="left"><label>Icon</label></td>
                    <td align="left">
                        <input type="file" name="sport_icon" id="sport_icon" />
                    </td>
                </tr>
                <tr>
                -->
                        <input type="submit" name="admin_submit_sport" value="Save" />
                        <!--<input type="button" value="Cancel" onclick="close_form_over()" />-->

            </form>
            <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
            <?php

            }// form edit
            else{
                $sport_name = $_POST['txt_sport_name'];
                runSQL("UPDATE tbl_sports_recreation SET sport_name = '" . $sport_name . "' WHERE sport_id = " . $sport_id);
            ?>
            <script language="javascript">window.top.window.finish_save_sport()</script>
            <?php
            }// to edit db

        }// edit action
        else{
           runSQL("DELETE FROM tbl_sports_recreation WHERE sport_id = " . $sport_id);
           runSQL("DELETE FROM tbl_service WHERE service_id = " . $sport_id . " AND service_type = 'sport'");
           ?>
            <script language="javascript">window.top.window.finish_save_sport()</script>
            <?php
        } //delete action
    }//to edit/delete sport
    else{
        if(!isset($_POST['admin_add_sport'])){
        ?>
        <form action = "php_sub/admin_view_sports.php?action=add" method="post" target="upload_target">
            <label for="txt_sport_name">Sport:</label>
            <input type="text" name="txt_sport_name" id="txt_sport_name" value="" />
            <input type="submit" name="admin_add_sport" value="Save" />
        </form>
        <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
        <?php
        }//show form add
        else{
            runSQL("INSERT INTO tbl_sports_recreation(sport_name) VALUES('" . $_POST['txt_sport_name'] . "')");
            runSQL("INSERT INTO tbl_service(service_id,service_type) VALUES(" . mysql_insert_id() . ",'sport')");
           ?>
            <script language="javascript">window.top.window.finish_save_sport()</script>
            <?php
        }// to add to db
    } //to show form add/ add to db sport
    //admin_view_sports();
?>