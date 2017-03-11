<?php
    ob_start();
    if(!isset($_SESSION))session_start();

    $id = $_GET['id'];

    include("../connection/connection.php");
    include("../module/module.php");

    $profile_id = 0;
     if(isset($_GET['id']))
        $profile_id = $_GET['id'];

     $user_id = 0;
     if(isset( $_SESSION['_user_13_5_2011_id']))
        $user_id = $_SESSION['_user_13_5_2011_id'];

     $can_edit = false;
     if($profile_id == $user_id)$can_edit = true;

     if(isset($_GET['edit']) && $can_edit){
        view_edit_profile_info($id);
     }
     else if(isset($_POST['profile_data'])){

        $profile_name  = $_POST['txt_profilename'];
        $user_name     = $_POST['txt_username'];
        $user_email    = $_POST['txt_email'];
        $user_password = $_POST['txt_password'];
        $real_password = getValue("SELECT user_password FROM tbl_users WHERE user_id = " . $id);
        $new_password  = $_POST['txt_con_password'];

        $error = 0;
        $sms = "";
        if($user_password != ""){
            if(md5($user_password) != $real_password){
                $sms = "Error! Invalid password.";
                $error++;
            }
        }else{
           $new_password = $real_password;
        }

        if($error == 0){
            //if($new_password == "") $new_password = $real_password;
            if($new_password != $real_password) $new_password = md5($new_password);
            $sql = "UPDATE tbl_users SET user_name = '" . $user_name . "', user_email = '" . $user_email . "', user_profile_name = '" . $profile_name . "', user_password = '" . $new_password . "' WHERE user_id = " . $id;
            runSQL($sql);
            $sms = "";
        }

        ?>
        <script language="javascript">
            window.top.window.finish_save_profile("<?php echo $sms; ?>");
        </script>
        <?php
     }
     else{
        view_profile_info($id);
     }
?>