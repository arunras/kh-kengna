<?php
	ob_start();
	if(!isset($_SESSION))session_start();

    $_SESSION['_cur_Page']="detail";

	/*---------------hotel_id : store id of hotel ----------*/
	$hotel_id = 0;
	if(isset($_GET['id']) && $_GET['id'] != ""){
		$hotel_id = $_GET['id'];

		/* ------- declare variable for hotel details ----- */
		$hotel_name         = "";
		$hotel_description  = "";
		$hotel_stars        = "";
		$hotel_address      = "";
		$hotel_country_id   = "";
		$hotel_city_id      = "";
		$hotel_khan_id      = "";
		$hotel_sangkat_id   = "";
		$hotel_image        = "";
		$hotel_lowest_price = "";
		$hotel_lattitude    = "";
		$hotel_longitude    = "";

		$hotel_country      = "";
		$hotel_city         = "";
		$hotel_khan         = "";
		$hotel_sangkat      = "";

		$hotel_rs = getResultSet("SELECT * FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
		if(mysql_num_rows($hotel_rs) == 0)
		{
			header("location:index.php");
		}
		while($hotel_detail = mysql_fetch_array($hotel_rs)){
			$hotel_name         = $hotel_detail["hotel_name"];
			$hotel_description  = $hotel_detail["hotel_description"];
			$hotel_stars        = $hotel_detail["hotel_star"];
			$hotel_address      = $hotel_detail["hotel_address"];
			$hotel_country_id   = $hotel_detail["hotel_country"];
			$hotel_city_id      = $hotel_detail["hotel_city"];
			$hotel_khan_id      = $hotel_detail["hotel_khan"];
			$hotel_sangkat_id   = $hotel_detail["hotel_sangkat"];
			$hotel_image        = $hotel_detail["hotel_images"];
			$hotel_lowest_price = $hotel_detail["hotel_lowest_price"];
			$hotel_review       = $hotel_detail["hotel_facebook"];
			$hotel_lattitude    = $hotel_detail["hotel_lattitude"];
			$hotel_longitude    = $hotel_detail["hotel_longitude"];
		}

        if($hotel_lattitude == "" || $hotel_lattitude == 0){
            $hotel_lattitude = 11.5760974842769;
        }
        if($hotel_longitude == "" || $hotel_longitude == 0){
            $hotel_longitude = 104.92308139801;
        }

        if($hotel_image == ""){
            $hotel_image = "app_images/not_found.png";
        }

		//$hotel_country      = getValue("SELECT country_name FROM tbl_countries WHERE country_id = " . $hotel_country);
		if($hotel_city_id != 0  || $hotel_city_id != '')
			$hotel_city         = getValue("SELECT city_name FROM tbl_cities WHERE city_id = " . $hotel_city_id);
		if($hotel_khan_id != 0  || $hotel_khan_id != '')
			$hotel_khan         = getValue("SELECT khan_name FROM tbl_khan WHERE khan_id = " . $hotel_khan_id);
		if($hotel_sangkat_id != 0  || $hotel_sangkat_id != '')
			$hotel_sangkat      = getValue("SELECT sangkat_name FROM tbl_sangkat WHERE sangkat_id = " . $hotel_sangkat_id);

		$hotel_address = $hotel_city . ", " . $hotel_khan . ", " . $hotel_address;
        $_SESSION['viewing_hotel_id'] = $hotel_id;



        /*
         * User Logged in Information and authentication
         */

        /*
         * if user type is beside registerer or administrator can_edit = false
         */

         $can_edit = false;

         /*
          * for reviewers who can review any hotel
          */
         $can_review = false;

         $user_id = 0;
         if(isset( $_SESSION['_user_13_5_2011_id']))
            $user_id = $_SESSION['_user_13_5_2011_id'];


         $user_type = getValue("SELECT level_id FROM tbl_users WHERE user_id = " . $user_id);


         if($user_type == REGISTERER){
            if(getValue("SELECT hotel_id FROM tbl_user_hotels WHERE user_id = " . $user_id . " AND hotel_id = " . $hotel_id) != ""){
                $can_edit = true;
            }
            else{
                $can_edit = false;
            }
         }
         else{
             $can_edit = false;
         }

         if($user_type == REVIEWER){
             $can_review = true;
         }
         else{
             $can_review = false;
         }

         if($user_type  == ADMINISTRATOR){
            $can_review = true;
            $can_edit   = true;
         }

	}//end of if get id block
	else{
		header("location:index.php");
	}//end of else get id block

?>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=<?php echo API_KEY_GOOGLE_MAP; ?>" type="text/javascript"></script>
<body onLoad="detail();initialize(<?php echo $hotel_lattitude; ?>,<?php echo $hotel_longitude; ?>);"><!-- initialize(11.572313,104.916515); -->
<!--<body onload="detail();">-->
<span id="nothing"></span>
<div class="sample_popup" id="popup" style="display: none;width:auto;">
    <div id="popup_drag" class="menu_form_header" style="width:auto;">
    <div id="title" style="display:inline;"></div>
    <img class="menu_form_exit" id="popup_exit" src="app_images/exit.gif" alt="" />
    </div>
    <div class="menu_form_body" id="form_content" style="width:auto;">

    </div>
</div><!-- end of sample_popup -->

<div class="sample_popup" id="popup_over" style="display: none;width:auto;">
    <div id="popup_drag_over" class="menu_form_header" style="width:auto;">
    <div id="title_over" style="display:inline;"></div>
    <img class="menu_form_exit" id="popup_exit_over" src="app_images/exit.gif" alt="" />
    </div>
    <div class="menu_form_body" id="form_content_over" style="width:auto;">

    </div>
</div><!-- end of sample_popup -->


	<div id="stretch_background">
           <div class="full_row" style="height:20px;text-align:left;padding-left:130px;width:auto;">
               <div style="display:inline;">
                    <a href="?mangoparam=index" class="navigation_location">Home</a> &nbsp;&nbsp; &raquo; &nbsp;&nbsp;
                    <a <?php echo "href='http://".DOMAIN.ROOT."/?mangoparam=$run_display_page&city=$hotel_city_id&where=$hotel_city&curP=1'"; ?> class="navigation_location"><?php echo $hotel_city; ?></a>&nbsp;&nbsp; &raquo; &nbsp;&nbsp;
                    <?php echo $hotel_name; ?>
               </div>

           </div>

           <?php
               if($can_edit){
           ?>
           <a id="edit" class="edit_settings">
              <img src="app_images/edit.gif" width="24" height="24" align="left"/>
              <span>Edit</span>
           </a>

           <?php } ?>
            <table border="0"><tr>
        	<td class="left_panel" align="right" valign="top"> <!-- left panel (1) -->
                <div class="profile <?php if($can_edit)echo ' editable_profile' ?>">
                <img id="profile_picture" src="<?php echo $hotel_image; ?>" />
                <!--<a href="#" class="edit hide" name="profile_pic" >Change Profile </a>-->

                <?php
                    $payment_style= 'style="margin:15px 0 5px 0;"';
                    if($can_edit) {
                ?>
                <center>
                  <div class="upload" style="height:25px;display:block;">
                    <div style="margin-left:20px;float:right;">
                    <form id="form_profile_picture" action="php_ajax/db_upload_profile_pic.php?hotel_id=<?php echo $hotel_id; ?>" method="post" enctype="multipart/form-data" onSubmit="return check_image_upload('form_profile_picture')" target="upload_target" >
                      <input type="file" name="file_profile_picture" id="file_profile_picture" class="upload_file_style" />
                      <span id="upload_status"></span>
                      <input type="hidden" value="2000000" name="MAX_FILE_SIZE" />
                      <input type="submit" name="submit" value="Save" id="save_profile" class="hide" />
                      <input type="button" name="cancel" value="Cancel" class="hide" onClick="hide_siblings(this)" />
                      <span class="hide">&bull;</span>
                      <label id="label_profile_picture" style="margin-top:5px;margin-left:5px;" for="file_profile_picture" class="upload_fake_style hide edit">Select</label>

                      <!--<div id="loading_ajax"><p align="center"><img src="app_images/loader.gif" /><br />Uploading.....</p></div>-->
                      <span class="error_text" id="sms"></span>
                      <iframe id='upload_target' name='upload_target' src='#' style='width:0;height:0;border:0px solid #fff;'></iframe>
                   </form>
                   </div>
                  </div>
                  </center>
                  <?php
                    $payment_style= 'style="margin:30px 0 5px 0;"';
                    }
                  ?>

                </div>
                <!-- row 1 is profile picture -->

        <table <?php echo $payment_style; ?> ><tr>
            <td>We Accept:</td>
        	<td><div id="hotel_payment_display">
            </div></td>
            <td width=31><a href="#" id="edit_payment" onClick="return false;" class="edit hide">[Edit]</a></td>
            </tr>
        </table>

		<div id="map_canvas"></div>     <!-- row 2 is map -->
        <?php
            $map_url = "php_ajax/viewmap.php?can_edit=" . $can_edit . "&hotel_id=" . $hotel_id;
        ?>

        <a href="#"
            onClick="return PopupCenter('<?php echo $map_url; ?>','Hotel location',1000,700);">View full map</a>
        &nbsp;&nbsp;&nbsp;
        <a href="#" class="map edit hide" onClick="return savemap(<?php echo $hotel_id; ?>)">Save</a>
        <span id="save_map_status" class="error_text"></span>&nbsp;

        <br /><br />

       <div class="contact" id="contact">
       </div>
        <?php
            if($can_edit){
              echo '<a href="#" id="add_contact" onclick="return false;" class="edit hide">[Add]</a>';
            }
        ?>

        	<div id="run_block_wrapper"> <!-- style="display:none;">-->
            <?php
    			//RUN Promotion**********************************************//
    			echo '<div id="promotion_wrapper">';
    				require_once("php_sub/run_promotion.php");
    			echo '</div>';


    			//RUN Room Information**********************************************//
    			require_once("php_sub/run_room_information.php");
    		?>
            </div>

        </td> <!-- end of left panel (1)-->
            <td align="left" valign="top"> <!-- middle panel (2)-->
             <div id="info">
            	<div class="hotel_name">
                        <?php echo $hotel_name; ?>
                </div>


                <span style="display:inline;"><a href="" id="edit_name"  class="edit hide"><span>[Change]</span></a></span><br />
                <table style="display:block;margin-left:50px;">
                    <tr><td><div id="hotel_star"><?php display_star($hotel_id, false); ?></div></td></tr>
                </table>
                <?php
                    view_price($hotel_id);
                ?>
                <div class="hotel_address">
                    <em>
                        Address: <?php echo $hotel_address; ?>
                    </em>
                    <span style="display:inline;"><a href="" id="edit_address"  class="edit hide"><span>[Change Address]</span></a></span>
                </div>

                <br />
                <div class="hotel_description"><?php echo $hotel_description; ?>
                <span style="display:inline;"><a href="" id="edit_description"  class="edit hide"><span>[Change Description]</span></a></span>
                </div>

                <div id="summary_review" style="margin-left:50px;margin-top:15px;">
                </div>
             </div> <!-- end of info div -->

             <br />



            <!-- view photos -->
            <?php
                $num_photos = getValue("SELECT count(*) FROM tbl_photos WHERE hotel_id = " . $hotel_id);

            ?>
            <div id="photos">

              <div class="block_title <?php if($can_edit && !$num_photos)echo ' edit '; if(!$num_photos) echo 'hide'; ?>" style="width:600px;margin-left:50px;">
                <img class="logo" src="app_images/photos.png" />
                <label>Photos</label>
                <span class="edit add hide" id="add_photos_<?php echo $hotel_id; ?>">
                    <a>[Add]</a>
                </span>
                <span style="padding-right:15px;" class="edit add hide" id="edit_photos_<?php echo $hotel_id; ?>">
                    <a>[Edit]</a>
                </span>
                <span class="edit add hide" id="delete_photos_<?php echo $hotel_id; ?>">
                    <a>[Delete]</a>
                </span>
              </div>




             <div id="include_gallerfic">
             </div>
             </div> <!-- end of photos div -->

             <div id="hotel_information" style="width:550px;">
             	<div class="block_title">Hotel Information</div>

               	<div id="page-wrap"><!-- start tab block -->
                     <ul class="navigationTabs">
                    	<li><a href="#Basic" rel="#Basic" class="tabtext" onClick="return false;">Basic Information</a></li>
                        <li><a href="#Facilities" rel="#Facilities" class="tabtext" onClick="return false;">Facilities</a></li>
                        <li><a href="#Sports" rel="#Sports" class="tabtext" onClick="return false;">Sports and Recreations</a></li>
                        <li><a href="#Accessibilities" rel="#Accessibilities" class="tabtext" onClick="return false;">Accessibilities</a></li>
                     </ul>

                    <div class="tabsContent">
                    	<div class="tab">
                            <div id="Basic">
                            </div>
                            <?php
                                  if($can_edit){
                                    echo '<a href="#" id="save_basic" class="edit hide"><span>[Save]</span></a>';
                                    echo '&nbsp;&nbsp;&nbsp;<span id="save_basic_status"></span>';
                                  }
                              ?>
                        </div><!-- end basic info -->

                        <div class="tab">
                                <div id="Facilities">
                                </div>
                                <?php
                                    //include("php_sub/viewing_hotel_facilities.php);
                                    if($can_edit){
                                      echo '<input type="text" value="" id="input_facilities" class="hide" />';
                                      echo '<a href="#" id="add_facility" class="edit hide"><span>[Add]</span></a>';
                                      echo '<a href="#" id="save_facilities" class="edit hide"><span>[Save]</span></a>';
                                      //echo '&nbsp;&nbsp;&nbsp;<span id="save_facilities_status"></span>';
                                    }
                                ?>

                        </div><!-- end Facilities -->

                        <div class="tab">
                            <div id="Sports">
                            </div>
                            <?php
                                    if($can_edit){
                                      echo '<input type="text" value="" id="input_sports" class="hide" />';
                                      echo '<a href="#" id="add_sports" class="edit hide"><span>[Add]</span></a>';
                                      echo '<a href="#" id="save_sports" class="edit hide"><span>[Save]</span></a>';
                                      //echo '&nbsp;&nbsp;&nbsp;<span id="save_facilities_status"></span>';
                                    }
                            ?>
                        </div><!-- end Sports -->

                        <div class="tab">
                            <div id="Accessibilities">
                            </div>
                            <?php
                            if($can_edit){
                              echo '<input type="text" value="" id="input_accessibilities" class="hide" />';
                              echo '<a href="#" id="add_accessiblities" class="edit hide"><span>[Add]</span></a>';
                              echo '<a href="#" id="save_accessiblities" class="edit hide"><span>[Save]</span></a>';
                              //echo '&nbsp;&nbsp;&nbsp;<span id="save_facilities_status"></span>';
                            }
                            ?>
                        </div><!-- end Accessibility -->
                    </div>
                </div><!-- end of tab block -->

             </div><!-- Information Layout -->


             <br/><br/>

             <div style="width:550px;">
             	<div class="block_title">Hotel Review<span class="tip" id="review_count">(<?php echo getValue("SELECT COUNT(*) FROM tbl_write_review WHERE hotel_id = " . $hotel_id); ?>)</span>
                 <?php
                    if($can_review){
                        echo '<a href="?mangoparam=run_write_review"><span class="add">[Write Review]</span></a>';
                    }
                 ?>
                 </div>

                 <div id="hotel_reviews">
                    <?php
                        include("include/run_read_review.php");
                    ?>
                 </div>

                 <?php
                    if($can_review){
                      //echo '<a href="#" style="margin-left:50px" class="edit">[Write Review]</a>';
                    }
                 ?>
             </div><!-- hotel review -->

            </td> <!-- end middle panel (2) -->
        </tr></table>
    </div> <!-- end of div id= stretch_background -->
 </body>

 <?php


 ?>