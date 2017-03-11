<?php

    include("../connection/connection.php");
    include("../module/module.php");

    $hotel_id = $_GET['id'];

    if(isset($_GET['view_edit'])){
        view_contact_edit($hotel_id);
    }
    else if(isset($_GET['edit_form'])){
        $contact_id    = $_GET['contact_id'];
        $hotel_id      = $_GET['id'];
        if(isset($_POST['submit_contact'])){//to save contact
            $contact_value = $_POST['contact_value'];
            $contact_label = $_POST['contact_label'];
            $contact_type  = $_POST['contact_type'];
            if($contact_id == "0")
                $sql = "INSERT INTO tbl_hotel_contacts(hotel_id, contact_label, contact_value, contact_type)
                VALUES(" . $hotel_id . ", '" . $contact_label . "', '" . $contact_value . "', '" . $contact_type . "')";
            else
                $sql = "UPDATE tbl_hotel_contacts SET contact_label = '" . $contact_label . "', contact_value = '" . $contact_value . "',
                contact_type = '" . $contact_type . "' WHERE contact_id = " . $contact_id;
            runSQL($sql);
            ?>
            <script language="javascript">
                window.top.window.finish_save_contact();
            </script>
            <?php
        }
        else{//to print the add/edit form
          view_form($hotel_id, $contact_id);
        }
    }
    else if(isset($_GET['delete'])){
        runSQL("DELETE FROM tbl_hotel_contacts WHERE contact_id = " . $_GET['contact_id']);
        view_contact_edit($_GET['id']);
    }
    else{
        view_contact($hotel_id);
    }

    function view_form($hotel_id, $contact_id){
        if($contact_id == "0"){
            $contact_label  = "";
            $contact_value  = "";
            $contact_type   = "";
            // 0 to tell the server to add new contact
        }
        else{
            $contact_rs         = getResultSet("SELECT contact_label, contact_value, contact_type FROM tbl_hotel_contacts WHERE contact_id = " . $contact_id);
            while($contact_info = mysql_fetch_array($contact_rs)){
                $contact_label  = $contact_info[0];
                $contact_value  = $contact_info[1];
                $contact_type   = $contact_info[2];
            }
        }
        //print the edit form
        echo '
              <form action="php_sub/hotel_contact.php?id=' . $hotel_id . '&contact_id=' . $contact_id . '&edit_form=1" method="post" target="upload_target">
                <table style="width:200px;margin-left:20px;margin-right:23px;">
                    <tr>
                        <td><span>Label</span></td>
                        <td><input type="text" name="contact_label" value="' . $contact_label . '"/></td>
                    </tr>
                    <tr>
                        <td><span>Value</span></td>
                        <td><input type="text" name="contact_value" value="' . $contact_value . '"/></td>
                    </tr>
                    <tr>
                        <td><span>Type</span></td>
                        <td>
                            <select name="contact_type" style="float:none;width:150px;border:1px solid #e3e3e3;">
                                <option value="text" '; if($contact_type != "link")echo " selected "; echo '>Text</option>
                                <option value="link" '; if($contact_type == "link")echo " selected "; echo '>Link</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <input type="submit" value="Save" name="submit_contact" />
                            <input type="button" value="Cancel" onclick="close_form()" />
                        </td>
                    </tr>
                </table>
              </form>
              <iframe style="display:none" id="upload_target" name="upload_target"></iframe>
        ';
    }

?>