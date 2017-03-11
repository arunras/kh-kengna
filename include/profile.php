<?php
    ob_start();
    if(!isset($_SESSION))session_start();

    $profile_id = 0;
     if(isset($_GET['id']))
        $profile_id = $_GET['id'];

     $user_id = 0;
     if(isset( $_SESSION['_user_13_5_2011_id']))
        $user_id = $_SESSION['_user_13_5_2011_id'];

     $can_edit = false;
     if($profile_id == $user_id)$can_edit = true;

     if($profile_id != 0){
        $user_type = getValue("SELECT level_id FROM tbl_users WHERE user_id =" . $profile_id);

        $show_review   = false;
        $show_myhotels = false;
        if($user_type == ADMINISTRATOR){
            $show_review   = true;
            $show_myhotels = true;
        }
        else if($user_type == REGISTERER){
            $show_myhotels   = true;
        }
        else if($user_type == REVIEWER){
            $show_review = true;
        }
        else{
            $show_review   = false;
            $show_myhotels = false;
        }

        $profile_name    = "";
        $user_name       = "";
        $profile_email   = "";
        $profile_type    = "";
        $registered_date = "";
        $profile_picture = "";

        $profile_rs = getResultSet("SELECT user_name, level_id, user_profile_name, user_email, user_registered_date, user_profile_picture FROM tbl_users WHERE user_id = " . $profile_id);
        while($profile_info = mysql_fetch_array($profile_rs)){
            $user_name       = $profile_info[0];
            $profile_type    = getValue("SELECT level_name FROM tbl_user_level WHERE level_id = " . $profile_info[1]);
            $profile_name    = $profile_info[2];
            $profile_email   = $profile_info[3];
            $registered_date = $profile_info[4];
            $profile_picture = $profile_info[5];
        }

?>
<body onload="init_profile();">
<div id="stretch_background">
<div class="sample_popup" id="popup_over" style="display: none;width:auto;">
    <div id="popup_drag_over" class="menu_form_header" style="width:auto;">
    <div id="title_over" style="display:inline;"></div>
    <img class="menu_form_exit" id="popup_exit_over" src="app_images/exit.gif" alt="" />
    </div>
    <div class="menu_form_body" id="form_content_over" style="width:auto;">

    </div>
</div><!-- end of sample_popup -->
    <span id="profile_id" style="display:none"><?php echo $profile_id; ?></span>
    <center>
            <div style="text-align:left;" id="my_account">
            </div> <!--end of my_account tab -->
            <?php
                if($can_edit){
            ?>
            <a href="#" id="edit_profile">[Edit]</a><a href="#" id="cancel" class="profile_hide">[Cancel]</a>
            <?php
                }
            ?>
            <div id="page-wrap"><!-- start tab block -->

                    <ul class="navigationTabs" style="width:800px;">
                        <?php if($show_myhotels){ ?><li><a href="#my_hotels" rel="#my_hotels" class="tabtext" onClick="return false;">Added Hotels</a></li><?php } ?>
                        <?php if($show_review){ ?><li><a href="#reviewd_hotels" rel="#Mgt_Facilities" class="tabtext" onClick="return false;">Reviewed Hotels</a></li><?php } ?>
                     </ul>

                    <div class="tabsContent" style="width:80%;margin-right:50px;margin-left:50px;">

                        <?php if($show_myhotels){ ?>
                        <div class="tab" style="text-align:left;">
                            <span class="admin_add" id="add_hotels"><a href="?mangoparam=<?php echo $add_hotel_page; ?>&menu=1">[Add]</a></span><br /><br />
                            <div id="my_hotels">
                            </div>
                        </div> <!-- end of my_hotels tab -->
                        <?php } ?>

                        <?php if($show_review){ ?>
                        <div class="tab" style="text-align:left;">
                            <div id="reviewd_hotels">
                            </div>
                        </div> <!-- end of reviewd_hotels tab -->
                        <?php } ?>
                    </div>
            </div>
    </center>
</div>
</body>
<?php
    }
    else{
      echo '<div id="stretch_background">';
      echo 'Please log in.';
      echo '</div>';
    }
?>