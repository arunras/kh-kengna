<?php
    include("../connection/connection.php");
    include("../module/module.php");
    if(isset($_GET['action'])){// mean this is called for edit or delete users
        $action  = $_GET['action'];
        $user_id = $_GET['id'];
        $user_activated = getValue("SELECT user_activate FROM tbl_users WHERE user_id = " . $user_id);
        if($action == "delete"){
            runSQL("DELETE FROM tbl_users WHERE user_id = " . $user_id);
            admin_view_users();
        }// end of delete action
        else{
            if($user_activated == 0){
                $user_activated = "";
            }
            else{
                $user_activated = " checked";
            }
            if(isset($_POST['submit_user'])){// works as editing user info in db
                $sql = "UPDATE tbl_users SET level_id = " . $_POST['user_level'];
                if(isset($_POST['reset_password'])){
                    $sql .= ", user_password = '" . md5('password') . "'";
                }
                if(isset($_POST['activate'])){
                    $sql .= ", user_activate=1";
                }
                else{
                    $sql .= ", user_activate=0";
                }
                $sql .= " WHERE user_id = " . $user_id;
                runSQL($sql);
            ?>
            <script language="javascript">
                window.top.window.save_user();
            </script>
            <?php
            }//end of edit user
            else{
              $u_rs           = getResultSet("SELECT user_name, level_id, user_profile_name, user_email, user_profile_picture, user_registered_date FROM tbl_users WHERE user_id = " . $user_id);
              $u_name         = "";
              $u_level        = 3;
              $u_profile_name = "";
              $u_email        = "";
              $u_profile_pic  = "";
              $u_registered   = "";
              while($u_info = mysql_fetch_array($u_rs)){
                $u_name         = $u_info[0];
                $u_level        = $u_info[1];
                $u_profile_name = $u_info[2];
                $u_email        = $u_info[3];
                $u_profile_pic  = $u_info[4];
                $u_registered   = $u_info[5];
              }
              if($u_profile_pic == "" || !file_exists($u_profile_pic)){
                $u_profile_pic = "app_images/image_not_found.jpg";
              }
            ?>
            <form action="php_sub/admin_mgt_users.php?action=edit&id=<?php echo $user_id; ?>" method="post" target= "upload_target">
            <table style="width:200px;margin:20px;" border=0 cellpadding="5" cellspacing="5">
                <tr valign="middle" align="left">
                    <td height="70" style="width:220px;">
                        <img width="70" height="70" src="<?php echo $u_profile_pic ?>" style="margin:0;padding:0;" />
                    </td>
                    <td>
                        <span style="margin-left:20px;"><b><?php echo $u_profile_name; ?></b></span><br />
                        <span style="margin-left:20px;">Registered on:</span>
                        <span style="margin-left:20px;"><?php echo $u_registered; ?></span>
                    </td>
                </tr>
                <tr align="left" height="30">
                    <td style="width:220px;">Username:</td><td><a style="margin-left:20px;" href="?mangoparam=profile&id=<?php echo $user_id;  ?>"><?php echo $u_name; ?></a></td>
                </tr>
                <tr align="left" height="30">
                    <td style="width:220px;">Password:</td><td><input type="checkbox" style="margin-left:20px;" name="reset_password" />Reset</td>
                </tr>
                <tr align="left" height="30">
                    <td style="width:220px;">Activate:</td><td><input type="checkbox" style="margin-left:20px;" name="activate" <?php echo $user_activated; ?> /></td>
                </tr>
                <tr align="left" height="30">
                    <td style="width:220px;">Authority:</td>
                    <td>
                        <select name="user_level" style="float:left;margin-left:20px;">
                            <?php
                                $level_rs = getResultSet("SELECT level_id, level_name FROM tbl_user_level");
                                while($level_info = mysql_fetch_array($level_rs)){
                                    echo '<option value="' . $level_info[0] . '" ';
                                    if($level_info[0] == $u_level) echo " selected ";
                                    echo '>' . $level_info[1] . '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr align="left" height="30">
                    <td style="width:220px;"></td>
                    <td align="center">
                        <input type = "Submit" name="submit_user" value="Save" />
                        <input type = "Button" name="cancel" value="cancel" onclick="close_popup();" />
                    </td>
                </tr>
            </table>
            </form>
            <iframe style="display:none;" name="upload_target" id="upload_target"></iframe>
            <?php
            }//end of view edit form
        }// end of edit action
    }// end of isset get action
    else{// mean this is called for view users
        admin_view_users();
    }// end of called for view users
?>