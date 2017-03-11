<?php
    ob_start();
    if(!isset($_SESSION))session_start();
    $user_id = 0;
     if(isset( $_SESSION['_user_13_5_2011_id']))
        $user_id = $_SESSION['_user_13_5_2011_id'];


     $user_type = getValue("SELECT level_id FROM tbl_users WHERE user_id = " . $user_id);

     if($user_type == ADMINISTRATOR){
?>
<body onload="init_admin();">
<div id="stretch_background">
<div class="sample_popup" id="popup_over" style="display: none;width:auto;">
    <div id="popup_drag_over" class="menu_form_header" style="width:auto;">
    <div id="title_over" style="display:inline;"></div>
    <img class="menu_form_exit" id="popup_exit_over" src="app_images/exit.gif" alt="" />
    </div>
    <div class="menu_form_body" id="form_content_over" style="width:auto;">

    </div>
</div><!-- end of sample_popup -->

    <center>
            <div id="page-wrap"><!-- start tab block -->
                     <ul class="navigationTabs" style="width:80%;">
                    	<li><a href="#Mgt_User" rel="#Mgt_User" class="tabtext" onClick="return false;">User Management</a></li>
                        <li><a href="#Mgt_Addresses" rel="#Mgt_Addresses" class="tabtext" onClick="return false;">Addresses</a></li>
                        <li><a href="#Mgt_Facilities" rel="#Mgt_Facilities" class="tabtext" onClick="return false;">Facilities</a></li>
                        <li><a href="#Mgt_Sports" rel="#Mgt_Sports" class="tabtext" onClick="return false;">Sports and Recreation</a></li>
                        <li><a href="#Mgt_Basic_Info" rel="#Mgt_Basic_Info" class="tabtext" onClick="return false;">Hotel Basic Information</a></li>
                        <li><a href="#Mgt_Service" rel="#Mgt_Service" class="tabtext" onClick="return false;">Payment</a></li>
                        <li><a href="#Mgt_Top_Hotel" rel="#Mgt_Top_Hotel" class="tabtext" onClick="return false;">Hotel Management</a></li>
                     </ul>

                    <div class="tabsContent" style="width:80%;margin-right:50px;margin-left:50px;">
                    	<div class="tab" style="text-align:left;" id="Mgt_User">

                        </div> <!--end of Mgt_user tab -->


                        <div class="tab" style="text-align:left;" id="Mgt_Addresses">
                            <span>Photo action:</span>
                              <span class="admin_add" id="admin_add_photo">[Add]</span>&nbsp;&nbsp;
                              <span class="admin_add" id="admin_edit_photo">[Edit]</span>
                              <span class="admin_add" id="admin_delete_photo">[Delete]</span>

                            <div id="city_photos">
                                <center><p><br /><br /><br /><br /><br />To Display The City's Photos</p></center>
                            </div>
                            <br /><br />
                            <table>
                                <tr>
                                    <th width="300">Cities&nbsp;&nbsp;<span class="admin_add" id="admin_add_city">[Add]</span></th>
                                    <th width="300">District/Khan&nbsp;&nbsp;<span class="admin_add" id="admin_add_khan">[Add]</span></th>
                                    <th width="300">Commune/Sangkat&nbsp;&nbsp;<span class="admin_add" id="admin_add_sangkat">[Add]</span></th>
                                </tr>
                                <tr>
                                    <td align="left" valign="top"><div id="Cities"></div></td>
                                    <td align="left" valign="top"><div id="Khan"></div></td>
                                    <td align="left" valign="top"><div id="Sangkat"></div></td>
                                </tr>
                            </table>
                        </div> <!-- end of Mgt_Addresses tab -->


                        <div class="tab" style="text-align:left;">
                            <span class="admin_add" id="admin_add_facility">[Add]</span><br /><br />
                            <div id="Mgt_Facilities">
                            </div>
                        </div> <!-- end of Mgt_Facilitites tab -->


                        <div class="tab" style="text-align:left;">
                            <span class="admin_add" id="admin_add_sport">[Add]</span><br /><br />
                            <div id="Mgt_Sports">
                            </div>
                        </div> <!-- end of Mgt_Sports tab -->


                        <div class="tab" style="text-align:left;">
                            <span class="admin_add" id="admin_add_basic_info">[Add]</span><br /><br />
                            <div id="Mgt_Basic_Info">
                            </div>
                        </div> <!-- end of Mgt_Basic_Info tab -->


                        <div class="tab" style="text-align:left;">
                            <span class="admin_add" id="admin_add_payment_method">[Add]</span><br /><br />
                            <div id="Mgt_Payment">
                            </div>
                        </div><!-- end of Mgt_Payment tab -->

                        <div class="tab" style="text-align:left;" id="Mgt_Top_Hotel">
                        </div> <!-- end of Mgt_Top_Hotel tab -->
                    </div>
            </div>
    </center>
</div>
</body>
<?php
    }
    else{
      echo '<div id="stretch_background">';
      echo 'Page restrict.';
      echo '</div>';
    }
?>