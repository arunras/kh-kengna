<?php
    ob_start();
    if(!isset($_SESSION))session_start();

    $user_id = 0;
    if(isset( $_SESSION['_user_13_5_2011_id']))
      $user_id = $_SESSION['_user_13_5_2011_id'];


    $user_type = getValue("SELECT level_id FROM tbl_users WHERE user_id = " . $user_id);


    if($user_type == REVIEWER || $user_type == ADMINISTRATOR){
       $can_review = true;
    }
    else{
       $can_review = false;
    }


    $hotel_id = 0;
	if(isset($_SESSION['viewing_hotel_id'])){
		$hotel_id = $_SESSION['viewing_hotel_id'];

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
			$hotel_review       = $hotel_detail["hotel_review"];
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
     }
?>
	   <script>
			function init_review(){
				$("#submit_review").click(function(){

					//for photos path
					var path = "";
					$("#photo_list div span").each(function(){
						path = path + "|" + $(this).attr("title").substring(15);
					});

					$("#txt_paths").val(path);
				});


                //for rating
                $('.hover-star').rating({
                    cancel: 'Clear',
                    focus: function(value, link){
                    // 'this' is the hidden form element holding the current value
                    // 'value' is the value selected
                    // 'element' points to the link element that received the click.
    				    var tip = $('#hover-status');
    				    //tip[0].data = tip[0].data || tip.html();
    				    tip.html(link.title || 'value: '+value);
  				    },
  				    blur: function(value, link){
                        var $rated_value = $('.hover-star:checked').attr("title");
                        if($rated_value && $rated_value != 0) $("#hover-status").html($rated_value);
                        else $("#hover-status").html("Rate here!");
  			    	},
                    callback: function(value, link){
                        var $rated_value = $('.hover-star:checked').attr("title");
                        if($rated_value && $rated_value != 0) $("#hover-status").html($rated_value);
                        else $("#hover-status").html("Rate here!");
  			    	}
				});

                $('.hotel-star').rating();


                $("#Photos").Uploader({
                    header_text  : "",
                    footer_text  : "",
                    browse_text  : "Add",
                    clear_text   : "Clear",
                    accept_types : "jpg|png|gif|jpeg"
                });

                $("#Videos").Uploader({
                    header_text  : "",
                    footer_text  : "",
                    browse_text  : "Add",
                    clear_text   : "Clear",
                    accept_types : "avi|swf|flv|mp4|wmv"
                });

                $("#kind_of_visit input[type=radio]").prettyCheckboxes({'display':'inline'});

                $("#certify").prettyCheckboxes();

                $("#submit").click(function(){
                    if($("#title").val() == ""){
                        alert("Please input title of your review.");
                        return false;
                    }
                    if($("#certify").attr("checked")){
                        //$("#txt_review").val($("#review_editor").html());
                        return true;
                    }
                    else{
                        return false;
                    }

                });


			}

            function finish_review(str){
                $("#submit_status").fadeIn(100).html(str).fadeOut(8000);
            }
		</script>

        <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.6/dojo/dojo.xd.js"
        djConfig="parseOnLoad: true">
        </script>
        <script type="text/javascript">
            dojo.require("dijit.Editor");
        </script>


<body onload="init_review()">
<!--<div id="tabs-3">-->
<div id="fileupload">
<!--
<form action="run_submit.php"  method="post" enctype="multipart/form-data">
-->

<form id="review_form" action="php_sub/run_submit_write_review.php"  method="post" enctype="multipart/form-data" target="upload_target">
<input type="hidden" value="2000000" name="MAX_FILE_SIZE" />

<input type="hidden" id="txt_paths" name="txt_paths" />

<div id="wrapper">
	<div id="write_wrapper">
    	<div id="part">
             <div class="hotel_header">
				 <div class="profile">
					 <img src="<?php echo $hotel_image ?>"/>
				 </div>

                 <div class="detail">
                 <span class="hotel_name" style="margin-left:0;"><?php echo $hotel_name; ?></span>
                                <span style="margin-left:50px;display:block;">
                                <?php
                                    display_star($hotel_id, false);
                                ?>
                                </span><br />
                    <span class="hotel_address" style="margin-left:0;"><?php echo $hotel_address; ?></span><br />

                    <a href="?mangoparam=detail&id=<?php echo $hotel_id; ?>" style="margin-left:50px;" id="redirect_back">Detail</a>
                 </div>
			 </div>
    	</div>
        <div id="part">
        	<div class="col1">
            	Date of stay
            </div>
            <div class="col2">
            	<select name="date_stayed" id="date_stayed">
                	<option>2011 Jully</option>
                    <option>2011 June</option>
                    <option>2011 May</option>
                    <option>2011 April</option>
                    <option>2011 March</option>
                    <option>2011 Februray</option>
                    <option>2011 Janury</option>
                </select>
            </div>
        </div>

        <div id="part">
        	<div class="col1">
            	Kind of Visit
            </div>
            <div class="col2" id="kind_of_visit">
                <label for="visit_kind_1" tabindex="1" style="margin-left: 0px;">Family</label>
                <label for="visit_kind_2" tabindex="1" style="margin-left: 10px;">Couples</label>
                <label for="visit_kind_3" tabindex="1" style="margin-left: 10px;">Friends</label>
                <label for="visit_kind_4" tabindex="1" style="margin-left: 10px;">Business</label>
                <label for="visit_kind_5" tabindex="1" style="margin-left: 10px;">School</label>
                <label for="visit_kind_6" tabindex="1" style="margin-left: 10px;">Other</label>


            	<input type="radio" name="visit_kind" id="visit_kind_1" style="margin-left:0;" value="Family" />
                <input type="radio" name="visit_kind" id="visit_kind_2" value="Couples" />
                <input type="radio" name="visit_kind" id="visit_kind_3" value="Friends" />
                <input type="radio" name="visit_kind" id="visit_kind_4" value="Business" />
                <input type="radio" name="visit_kind" id="visit_kind_5" value="School" />
                <input type="radio" name="visit_kind" id="visit_kind_6" value="Other" checked="checked" />
            </div>
        </div>

        <div id="part">
        	<div class="col1">
            	Rate Hotel
            </div>
            <div class="col2">

          <!--<form name="frm" action="../php_sub/run_submit_write_review.php"  method="post">-->
            <span>
              <input class="hover-star" type="radio" name="rate" value="1" title="Very poor"/>
              <input class="hover-star" type="radio" name="rate" value="2" title="Poor"/>
              <input class="hover-star" type="radio" name="rate" value="3" title="OK"/>
              <input class="hover-star" type="radio" name="rate" value="4" title="Good"/>
              <input class="hover-star" type="radio" name="rate" value="5" title="Very Good"/>
              <span id="hover-status" style="margin:0 0 0 20px;">Rate here!<!--Hover tips will appear in here--></span>
              <!--
              <span id="votes" style="margin:0 0 0 20px;"></span>
              <span class="vote_count" style="margin:0 0 0 20px;"></span>
              -->

              <!--<div class="test">-->
              	<!--<span class="test" style="color:#FF0000">Results will be displayed here</span>-->
              <!--</div>-->
           	</span>

            <p>
              <!--<input type="submit" value="Submit scores!"/>-->
            </p>
          <!--</form>-->
            </div>
        </div>

        <div id="part">
        	<div class="col1">
            	Title
            </div>
            <div class="col2">
            	<input type="text" id="title" name="title" size="80"/>
            </div>
        </div>

        <div id="part">
        	<div class="col1">
            	Review
            </div>
            <div class="col2 claro">
            	<!--<textarea id="comment" name="comment" cols="81" rows="5"  ></textarea>-->

                <textarea wicket:id="content" name="review" dojoType="dijit.Editor" id="review_editor" onChange="console.log('review_editor onChange handler: ' + arguments[0])" style="width:610px;">
                </textarea>
                <!--<input type="hidden" name="review" id="txt_review" />-->
            </div>
        </div>

        <div id="part">
            <div class="col1">Your Photos</div>
            <div class="col2">
              <div class="Upload_Block" id="Photos">
                  <div class="Upload_Header" id="Photos_Header"></div>
                  <div class="Upload_Content" id="Photos_Content">
                  </div>
                  <div class="Upload_Footer" id="Photos_Footer">
                      <div class="Upload_Status" id="Photos_Status"></div>
                  </div>
              </div>
            </div>
        </div>

        <div id="part">
              <div class="col1">Your Videos</div>
              <div class="col2">
                <div class="Upload_Block" id="Videos">
                  <div class="Upload_Header" id="Videos_Header"></div>
                  <div class="Upload_Content" id="Videos_Content">
                  </div>
                  <div class="Upload_Footer" id="Videos_Footer">
                      <div class="Upload_Status" id="Videos_Status"></div>
                  </div>
                </div>
              </div>
        </div>
        <div id="part">
            <div class="col1" style="width: 250px;">Confirmation</div>
            <div class="col2" style="margin-left:120px;width:610px;">
                <p style="text-align: justify;">
            	I certify that this review is my genuine opinion of this hotel,
                and that I have no personal or business affiliation with this establishment,
                and have not been offered any incentive or payment originating from the establishment to write this review.
				</p>
                <br />
                <label for="certify" tabindex="1" style="margin-left: 0px;">I Agree</label>
                <input type="checkbox" id="certify" name="certify" />
            </div>
        </div>


        <div id="part">
        	<div class="col1">
                <!--
            	<button type="submit" id="submit_review" name="submit">Submit </button>
                -->
                <!--
            	<button type="reset" value="Preview">Preview </button>
                -->
            </div>
            <div class="col2">
				<div class="fileupload-buttonbar" style="border: none;">
            		<button type="submit" id='submit' class="start">Start upload</button>
                    <span class="submit_status" id="submit_status"></span>
                </div>
            </div>
        </div>

    </div>
</div>

</form>
<iframe id="upload_target" name="upload_target" style="display:none"></iframe>
</div>


</body>
