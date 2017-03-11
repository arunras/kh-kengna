
var onMouseOutOpacity = 0.87;
var gallery;
var gallery;
var hotel_id;
function detail(){

hotel_id = $("#photos div").find("span").attr("id").split("_")[2];
	//end of mouseover on thumbnail <br />
     $.ajax({
        "url":"php_sub/viewing_hotel_info.php?hotel_id="+hotel_id+"&type=Basics",
        "success": function(data){
            $("#Basic").html(data);
            $("#Basic input[type=checkbox]").prettyCheckboxes();
        }
    });

     $.ajax({
        "url":"php_sub/viewing_hotel_info.php?hotel_id="+hotel_id+"&type=Facilities",
        "success": function(data){
            $("#Facilities").html(data);
            $("#Facilities input[type=checkbox]").prettyCheckboxes();
        }
    });

    $.ajax({
        "url":"php_sub/viewing_hotel_info.php?hotel_id="+hotel_id+"&type=Sports",
        "success": function(data){
            $("#Sports").html(data);
            $("#Sports input[type=checkbox]").prettyCheckboxes();
        }
    });
    //Accessibilities
    $.ajax({
        "url":"php_sub/viewing_hotel_info.php?hotel_id="+hotel_id+"&type=Accessibilities",
        "success": function(data){
            $("#Accessibilities").html(data);
            $("#Accessibilities input[type=checkbox]").prettyCheckboxes();
        }
    });

    //rating
    $.get("php_ajax/rating_hotel.php?hotel_id="+hotel_id+"&edit=no",
     function(data){
       $("#hotel_star").html(data);
       $('#hotel_star .hotel-star').rating();
     });

    $("#hotel_reviews .hotel-rate").rating();

    $.ajax({
      "url":"php_sub/hotel_gallerific.php",
      "success":function(data){
            set_photos(data);
      }
    });


    $.ajax({
        "url":"application/hotel_review/hotel_review.php?id="+hotel_id,
        "success": function(data){
            $("#summary_review").html(data);
        }
    });

	$.ajax({
		"url":"application/payment_method/detail_payment.php?hotel_id=" + hotel_id,
		"success": function(data){
    	    $("#hotel_payment_display").html(data);
		}
	});

    //review
    /*$.get("include/run_read_review.php?id=" + hotel_id,function(data){
        $("#hotel_reviews").html(data);
    });*/




	//load hotels write review

    //get contact information
    $.get("php_sub/hotel_contact.php?id="+hotel_id,function(data){
        show_contact(data);
    });
    //end of contact information

    //edit contact
    $("#add_contact").click(function(){
        var url = "php_sub/hotel_contact.php?contact_id=0&edit_form=1&id="+hotel_id;
            popup_show(
           'popup',
           'form_content',
           'title',
           'popup_drag',
           'popup_exit',
           'screen-center',
           0,   0,
           'pos_bottom',
           'Add Contact',
           url
           );
    });
    //end of edit contact

    //edit hotel price
    //edit contact
    $("#edit_price").click(function(){
        var url = "php_ajax/db_hotel_price.php?id=" + hotel_id;
            popup_show(
           'popup',
           'form_content',
           'title',
           'popup_drag',
           'popup_exit',
           'screen-center',
           0,   0,
           'pos_bottom',
           'Change Lowest price',
           url
           );
    });
    //end of edit price

    //edit payment method
    $("#edit_payment").click(function(){
        var url = 'application/payment_method/detail_payment.php?hotel_id=' + hotel_id + '&edit=mCKmeeerr';
        popup_show(
        'popup',
        'form_content',
        'title',
        'popup_drag',
        'popup_exit',
        'screen-center',
        0,   0,
        'pos_bottom',
        'Edit Payment Method',
        url
        );
    });
    //end of edit payment method

    //click to add, edit, delete photos
    $("#photos div span").click(function(e){
      var this_id= $(this).attr("id").split("_");
      hotel_id = this_id[2];
      if(this_id[0] == "edit"){//span for edit
      if(gallery.data.length == 0 || $("#page").hasClass("hide"))return false;
       image_id = gallery.currentImage.hash;
         var url = 'php_ajax/db_hotel_photo_description.php?photo_id=' + image_id;
         popup_show(
         'popup',
         'form_content',
         'title',
         'popup_drag',
         'popup_exit',
         'screen-center',
         0,   0,
         'pos_bottom',
         'Change Description',
         url
         );

         //gallery.appendImage();
      }
      else if(this_id[0] == "delete"){//span for delete
        if(gallery.data.length == 0 || $("#page").hasClass("hide"))return false;
        var answer = confirm("Do you want to delete the viewing picture?");
        if(answer){
          //to do: delete photos
          var image_id = gallery.removeCurrentImage();
          if (image_id < 0)
		    alert('No Image to remove!');
          if (gallery.data.length == 0){
            history.go(0);
          }

          //delete from database
          htmlid="nothing";
          xmlobj =getHTTPObject();
          if(xmlobj==null){
          	return;
          }
          url ="php_ajax/db_delete_photos.php?photo_id="+image_id;
          xmlobj.onreadystatechange=ajax_return;
          xmlobj.open("GET",url,true)
          xmlobj.send(null)
          return false;

		  e.preventDefault();
        }
      }
      else{ //this_id[0] == "add" span for add
        var url = 'php_ajax/db_hotel_photos.php?hotel_id=' + hotel_id;
         popup_show(
         'popup',
         'form_content',
         'title',
         'popup_drag',
         'popup_exit',
         'screen-center',
         0,   0,
         'pos_bottom',
         'Add Photos',
         url
         );

         //gallery.appendImage();
         gallery.refresh();
      }
    });//end of add photos


                /********************** Attach click event to the Add Image Link ************************/

				$('#addImageLink').click(function(e) {
					gallery.insertImage('', 5);
					e.preventDefault();
				});

				/****************************************************************************************/

				/***************** Attach click event to the Remove Image By Index Link *****************/

				$('#removeImageByIndexLink').click(function(e) {
					if (!gallery.removeImageByIndex(5))
						alert('There is no longer an image at position 5 to remove!');

					e.preventDefault();
				});

				/****************************************************************************************/

				/***************** Attach click event to the Remove Image By Hash Link ******************/

				$('#removeImageByHashLink').click(function(e) {
					if (!gallery.removeImageByHash('lizard'))
						alert('The lizard image has already been removed!');

					e.preventDefault();
				});

				/****************************************************************************************/


				/* for hotel info tabs*/
				var hash = window.location.hash.replace('#', '');
				var currentTab = $('ul.navigationTabs a')
									.bind('click', showTab)
									.filter('a[rel=' + hash + ']');
				if (currentTab.size() == 0) {
					currentTab = $('ul.navigationTabs a:first');
				}
				showTab.apply(currentTab.get(0));

				currentTab.click(function(){
					var tabIndex = $('ul.navigationTabs a')
							.removeClass('active')
							.index(this);
					$(this)
						.addClass('active')
						.blur();
					$('div.tab')
						.hide()
							.eq(tabIndex)
							.show();
				});


				/* end of info tab */

				/* checkbox style */
				/* end of checkbox style */

                                /*
                                 * edit the profile part
                                 */

                                $("#edit").click(function(){
                                   var edit_text = $(this).find('span');
                                   if(edit_text.html() == "Edit"){
                                      edit_text.html("Preview");
                                      show_edit();
                                   }
                                   else{
                                      edit_text.html("Edit");
                                      hide_edit();
                                   }
                                })
                                .mouseover(function(){
                                    $(this).find("span").css("text-decoration","underline");
                                })
                                .mouseleave(function(){
                                   $(this).find("span").css("text-decoration","none");
                                });
                                /* end of edit profile part */




    /* for change profile picture */
    $("label.upload_fake_style").click(function(){
        $("#" + $(this).attr("for")).trigger("click");
    });

    original_profile = $("#profile_picture").attr("src");

    //after choosing a picture for profile picture
    var file_profile =  $("#file_profile_picture");
   file_profile.change(function(){
      var val = $(this).val();
        $("#upload_status").html(val);
        if(val==""){
           $(this).siblings("input").hide(100);
           $(this).siblings("span").hide(100);
        }
        else{
          $(this).siblings("input").show(100);
          $(this).siblings("span").show(100);

        }
    });//end of file profile click



    if(document.getElementById('loading_ajax'))document.getElementById('loading_ajax').style.visibility="hidden";
    /* end of change profile */

    /* Change hotel name */
    $("#edit_name").click(function(){
       var hotel_id = $("#photos div span").attr("id").split("_")[2];
       var url = 'php_ajax/db_change_hotel_name.php?hotel_id=' + hotel_id;
       popup_show(
       'popup',
       'form_content',
       'title',
       'popup_drag',
       'popup_exit',
       'screen-center',
       0,   0,
       'pos_bottom',
       'Change Hotel Name',
       url
       );
       return false;
    });
    /* End of change hotel name */


    /* Change hotel address */
    $("#edit_address").click(function(){
       var hotel_id = $("#photos div span").attr("id").split("_")[2];
       var url = 'php_ajax/db_change_hotel_address.php?hotel_id=' + hotel_id;
       popup_show(
       'popup',
       'form_content',
       'title',
       'popup_drag',
       'popup_exit',
       'screen-center',
       0,   0,
       'pos_bottom',
       'Change Hotel Address',
       url
       );
       return false;
    });
    /* End of change hotel address */

    /* Change hotel description */
    $("#edit_description").click(function(){
       var hotel_id = $("#photos div span").attr("id").split("_")[2];
       var url = 'php_ajax/db_change_hotel_description.php?hotel_id=' + hotel_id;
       popup_show(
       'popup',
       'form_content',
       'title',
       'popup_drag',
       'popup_exit',
       'screen-center',
       0,   0,
       'pos_bottom',
       'Change Hotel Description',
       url
       );
       return false;
    });
    /* End of change hotel description */


    /* save facilities */
    $("#save_facilities").click(function(){
        $("#input_facilities").val("");
        $("#Facilities").find("label.checkbox").each(function(){
           facility = $("#" + $(this).attr("for"));
           if(facility.attr("checked")){
             var $option = facility.val();
             if($("#input_facilities").val()=="")$old_val = "";
             else $old_val = $("#input_facilities").val() + ";";
             //for select option
             $("#input_facilities").val($old_val + $option);
           }
        });
        //alert($("#input_facilities").val());return false;
        $.ajax({
         'url':"php_ajax/db_save_facilities.php?input_facilities=" +  $("#input_facilities").val(),
         'success':function(data){
           //window.location.reload();
           //('#Facilities').fadeOut('fast').load('php_sub/viewing_hotel_facilities.php?hotel_id='+hotel_id+'&can_edit=true').fadeIn("fast");
            $.get("php_sub/viewing_hotel_info.php?hotel_id="+hotel_id+"&type=Facilities",function(data){
                    $('#Facilities').fadeOut(100).html(data).fadeIn(500);
   					$('#Facilities input[type=checkbox]').prettyCheckboxes();
                    $('#Facilities input[type=checkbox]').removeAttr("disabled");
                });
         }
       });
        return false;
    });
    /* end of save facilities*/

    /* add facilities */
        $("#add_facility").click(function(){
            var url = "php_ajax/db_save_hotel_info.php?hotel_id=" + hotel_id +"&table_name=tbl_hotel_facilities&field_name=facility_description";
            popup_show(
             'popup',
             'form_content',
             'title',
             'popup_drag',
             'popup_exit',
             'screen-center',
             0,   0,
             'pos_bottom',
             'Add More Facilities',
             url
             );
             return false;
          });
    /* end of add facilities */

    /* save sports */
    $("#save_sports").click(function(){
        $("#input_sports").val("");
        $("#Sports").find("label.checkbox").each(function(){
           facility = $("#" + $(this).attr("for"));
           if(facility.attr("checked")){
             var $option = facility.val();
             if($("#input_sports").val()=="")$old_val = "";
             else $old_val = $("#input_sports").val() + ";";
             //for select option
             $("#input_sports").val($old_val + $option);
           }
        });
        $.ajax({
         'url':"php_ajax/db_save_sports.php?input_sports=" +  $("#input_sports").val(),
         'success':function(data){
           //window.location.reload();
           $.get("php_sub/viewing_hotel_info.php?hotel_id="+hotel_id+"&type=Sports",function(data){
                    $('#Sports').fadeOut(100).html(data).fadeIn(500);
   					$('#Sports input[type=checkbox]').prettyCheckboxes();
                    $('#Sports input[type=checkbox]').removeAttr("disabled");
                });
         }
       });
        return false;
    });
    /* end of save sports*/

    /* add sports */
        $("#add_sports").click(function(){
            var url = "php_ajax/db_save_hotel_info.php?hotel_id=" + hotel_id +"&table_name=tbl_hotel_sports&field_name=sport_description";
            popup_show(
             'popup',
             'form_content',
             'title',
             'popup_drag',
             'popup_exit',
             'screen-center',
             0,   0,
             'pos_bottom',
             'Add More Sports',
             url
             );
             return false;
          });
    /* end of add sports */

    /* save accessibilities */
    $("#save_accessiblities").click(function(){
        $("#input_accessibilities").val("");
        $("#Accessibilities label.checkbox").each(function(){
           facility = $("#" + $(this).attr("for"));
           if(facility.attr("checked") == false){
             var $option = facility.val();
             if($("#input_accessibilities").val()=="")$old_val = "";
             else $old_val = $("#input_accessibilities").val() + ";";
             //for select option
             $("#input_accessibilities").val($old_val + $option);
           }
        });
        //alert($("#input_accessibilities").val());return false;
        $.ajax({
         'url':"php_ajax/db_save_accessibilities.php?delete_accessibilities=" +  $("#input_accessibilities").val(),
         'success':function(data){
           //alert(data);
           //window.location.reload();
            $('#Accessibilities').fadeOut(100).html(data).fadeIn(500);
            $('#Accessibilities input[type=checkbox]').prettyCheckboxes();
            $('#Accessibilities input[type=checkbox]').removeAttr("disabled");
         }
       });
        return false;
    });
    /* end of save accessibilities*/

    /* add accessibilities */
        $("#add_accessiblities").click(function(){
            var url = "php_ajax/db_save_hotel_info.php?hotel_id=" + hotel_id +"&table_name=tbl_hotel_accessibilities&field_name=hotel_accessibility_name";
            popup_show(
             'popup',
             'form_content',
             'title',
             'popup_drag',
             'popup_exit',
             'screen-center',
             0,   0,
             'pos_bottom',
             'Add More Accessibilities',
             url
             );
             return false;
          });
    /* end of add accessibilities */

    /* save basic information */
    $("#save_basic").click(function(){
      var $data = "";
      var id    = "";
      $("#Basic Input,Select").each(function(){
         id = $(this).attr("name").split("-")[2];
         if($data == "") $data = id + ";" + $(this).attr("value");
         else $data += ";" + id + ";" + $(this).attr("value");
      });
      $.ajax({
        "url":"php_ajax/db_save_basic_info.php?hotel_id="+hotel_id+"&data="+$data,
        "success":function(data){
            //alert(data);
            $("#save_basic_status").fadeIn(300).html("Saved successful.").fadeOut(900);
        }
      });
      return false;
    });
    /* end of save basic information */


}

function finish_photo_description(photo_id,des){
    gallery.setCurrentImageDescription(des);
    $("#thumbs ul li").each(function(){
      if($(this).find("a").attr("href").replace("#","")== photo_id){
        $(this).find("img").attr("title",des);
        $(this).find("img").attr("alt",des);
      }
    });
    gallery.refresh();
    close_form();
}

function finish_add_info(type){
    //alert(type);
    //window.location.reload();
    $this = $('#'+type);
    height = $this.height();
    $.get("php_sub/viewing_hotel_info.php?hotel_id="+hotel_id+"&type="+type,function(data){
      $this.fadeOut(100).html(data).fadeIn(500);
      $('#'+type + ' input[type=checkbox]').prettyCheckboxes();
      $('#'+type + ' input[type=checkbox]').removeAttr("disabled");
    });
    return false;
}

var allow_image_type = ["jpg","jpeg","gif","png"];

function check_image_upload(form_id){
    var file_name = $("#"+form_id + " input[type=file]").val();
    var file_type = file_name.split(".")[1];
    if(jQuery.inArray(file_type.toLowerCase(),allow_image_type)<0){
      $("#upload_status").html("Invalid file type. &bull;");
      //$("#upload_status").siblings("input").hide();
      //$("#upload_status").siblings("span").hide();
      return false;
    }
}

function hide_siblings(sender){
    $(sender).siblings("input").hide(100);
    $(sender).siblings("span").hide(100);
    $(sender).hide(100);
    $("#profile_pic").attr("src",original_profile);
}

function hide_edit(){
   //todo: all the edit link
   //hide edit link
   $(".edit").addClass("hide");

   //make checkbox disabled
   $('input:checkbox').each(function() {
      $(this).attr("disabled",true);
   });

   $.get("php_ajax/db_save_basic_info.php?hotel_id="+hotel_id+"&view=true",
   function(data){
     $('#Basic').fadeOut(100).html(data).fadeIn(500);
     $('#Basic input[type=checkbox]').prettyCheckboxes();
   });

    //hide edit/delete link for
   $.get("php_sub/hotel_contact.php?id="+hotel_id,function(data){
        show_contact(data);
   });

   $.get("php_ajax/rating_hotel.php?hotel_id="+hotel_id+"&edit=no",
     function(data){
       $("#hotel_star").html(data);
       $('#hotel_star .hotel-star').rating();
     });
}

function show_edit(){
   //todo: preview the edited page and visiable all edit link
   $(".edit").removeClass("hide");

   $.get("php_ajax/db_save_basic_info.php?hotel_id="+hotel_id+"&view=false",
   function(data){
     $('#Basic').fadeOut(100).html(data).fadeIn(500);
     $('#Basic input[type=checkbox]').prettyCheckboxes();
   });

   $.get("php_ajax/rating_hotel.php?hotel_id="+hotel_id+"&edit=yes",
   function(data){
     $("#hotel_star").html(data);
     $('#hotel_star .hotel-star').rating({
       callback: function(value, link){
            if(!value)value = 0;
            $.ajax({
                "url": "php_ajax/rating_hotel.php?hotel_id=" + hotel_id + "&edit=no&value=" + value
            });
       }
     });
   });


   //show edit/delete link for
   $.get("php_sub/hotel_contact.php?id="+hotel_id+"&view_edit=1",function(data){
        show_contact(data);
   });


   //make checkbos enabled
   $('input:checkbox').each(function() {
      $(this).attr("disabled",false);
   });
}

function upload_photos(type,src,fname,fid,desc){
    	var doc_error=$('#sms_photos');
			var sms="";
			if(type==0)	{
				sms="Upload successfully... ";
				//window.location.reload();
			}
			if(type==1) {
				sms="File size is too big.....(2MB) Only ";
				//var doc_loc=document.location.toString();
				//var tem=doc_loc.split("?");
				//document.location=tem[0]+"?step=4";
			}
			if(type==2){
				sms="This file type is not allowed... ";
			}
			if(type==3){
				sms="Error while uploading... ";
			}
			doc_error.html(sms);
			document.getElementById('loading_ajax').style.visibility="hidden";
            doc_error.fadeOut(1600, "linear");
            $("#popup").fadeOut(1600,"linear");

            var list_item = ' <li>'+
            '<a class="thumb" name="'+ fid + '"' +
            'href="' + src + '" title="' + fname + '">' +
            '<img src="' + src + '" alt="' + fname + '"' +
            ' class="thumbnail_photo"/>' +
            '</a>' +
            '<div class="caption">' +
    		'	<div class="image-title"></div>' +
    		'	<div class="image-desc">' + desc + '</div>' +
    		'	<div class="download">' +
    		'	</div>' +
    		'</div>' +
            '</li>';


            gallery.addImage(list_item, false, false);

            $("#page").removeClass("hide");
            if(document.getElementById("no_image")){
              gallery.removeImageByIndex(0);
            }

            if($("#photos div").hasClass("edit")){
              $("#photos div").removeClass("edit");
            }


    		return false;
    }// end of upload photos


function change_profile(type,src){
    	var doc_error=document.getElementById('sms');
			var result = document.getElementById("profile_picture");
			var sms="";
			if(type==0)	{
				sms="Upload successfully... ";
				//window.location.reload();
			}
			if(type==1) {
				sms="File size is too big.....(2MB) Only ";
				//var doc_loc=document.location.toString();
				//var tem=doc_loc.split("?");
				//document.location=tem[0]+"?step=4";
			}
			if(type==2){
				sms="This file type is not allowed... ";
			}
			if(type==3){
				sms="Error while uploading... ";
			}
			doc_error.innerHTML=sms;
			document.getElementById('loading_ajax').style.visibility="hidden";
			result.src = src;

            $("#upload_status").html(sms + " &bull;")
                                .siblings("span").hide()
                                .siblings("input").hide();
           $("#upload_status").fadeOut(1600, "linear");
}



function changed_name(new_name){
    $("#info div.hotel_name").html(new_name);
    $("#sms_name").html("Name saved.");
    close_form();
}

function changed_description(new_description){
  $("#info div.hotel_description").html(new_description + '<span style="display:inline;"><a href="" id="edit_description"  class="edit">[Change Description]</a></span>');
  $("#sms_description").html("Description saved.");
  close_form();
}

function add_address_type(type,new_val,id){
  $option_change = $("<option></option>").text(new_val).attr("value", id);
   $("#"+type).append($option_change).change();
}

function changed_address(text){
  $("#info div.hotel_address em").html(text);
  close_form();
}

function close_form(){
  $("#popup").fadeOut(500);
}

function close_form_over(){
  $("#popup_over").fadeOut(500);
}

function savemap(hotel_id){
		xmlobj =getHTTPObject();
		if(xmlobj==null){
			return;
		}
        htmlid="save_map_status";
        $("#"+htmlid).fadeIn(200);
		url ="php_ajax/db_savemap.php?hotel_id="+hotel_id+"&lat="+x+"&lon="+y;
		xmlobj.onreadystatechange=map_returned
        xmlobj.open("GET",url,true)
   		xmlobj.send(null)

		return false;
  }

  function map_returned()
	{
		if (xmlobj.readyState==4 || xmlobj.readyState=="complete")
		{
			document.getElementById(htmlid).innerHTML=xmlobj.responseText;
            $("#"+htmlid).fadeOut(900);
		}
	}

  function show_contact(data){
      $("#contact").html(data);

      //edit
      $("#contact div span:nth-child(2) span:nth-child(1)").click(function(){
            var id  = $(this).parent().attr("id").split("_")[1];
            var url = "php_sub/hotel_contact.php?contact_id="+id+"&edit_form=1&id="+hotel_id;
            popup_show(
           'popup',
           'form_content',
           'title',
           'popup_drag',
           'popup_exit',
           'screen-center',
           0,   0,
           'pos_bottom',
           'Edit Contact',
           url
           );
      });

      //delete
      $("#contact div span:nth-child(2) span:nth-child(2)").click(function(){
            var id = $(this).parent().attr("id").split("_")[1];
            if(confirm("Are you sure?")){
                $.get("php_sub/hotel_contact.php?delete=1&contact_id="+id+"&id="+hotel_id,function(data){
                    show_contact(data);
                });
            }
      });
  }

  function finish_save_contact(){
    $.get("php_sub/hotel_contact.php?id="+hotel_id +"&view_edit=1",function(data){
        show_contact(data);
    });
  }

  function finish_change_price(p){
        if(p == "" || p == "0")p = "";
        else p = 'From <span>' + p + '</span> USD';
        $(".hotel_price span:first").html(p);
        close_form();
  }

  // JavaScript Document
function PopupCenter(pageURL, title,w,h) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	return false;
}

function set_photos(data){
// We only want these styles applied when javascript is enabled
                 $("#include_gallerfic").html(data);
				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
                $('div.content').css('display', 'block');
				var onMouseOutOpacity = 0.87;
				$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});



                // Initialize Advanced Galleriffic Gallery
                gallery = $('#thumbs').galleriffic({
					delay:                     5000,
					numThumbs:                 5,
					preloadAhead:              5,
					enableTopPager:            false,
					enableBottomPager:         false,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play',      // change the text to class
					pauseLinkText:             'Pause',     // ---
					prevLinkText:              'Previous',  // ---
					nextLinkText:              'Next',      // change the text to class
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             true,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 1200,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);

						// Update the photo index display
						this.$captionContainer.find('div.photo-index')
							.html('Photo '+ (nextIndex+1) +' of '+ this.data.length);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
						var nextPageLink = this.find('a.next').css('visibility', 'hidden');

						// Show appropriate next / prev page links
						if (this.displayedPage > 0)
							prevPageLink.css('visibility', 'visible');

						var lastPage = this.getNumPages() - 1;
						if (this.displayedPage < lastPage)
							nextPageLink.css('visibility', 'visible');

						this.fadeTo('fast', 1.0);
					}
				});

				/**************** Event handlers for custom next / prev page links **********************/

				gallery.find('a.prev').click(function(e) {
					gallery.previousPage();
					e.preventDefault();
				});

				gallery.find('a.next').click(function(e) {
					gallery.nextPage();
					e.preventDefault();
				});


				/****************************************************************************************/

				/**** Functions to support integration of galleriffic with the jquery.history plugin ****/

				// PageLoad function
				// This function is called when:
				// 1. after calling $.historyInit();
				// 2. after calling $.historyLoad();
				// 3. after pushing "Go Back" button of a browser
				function pageload(hash) {
					// alert("pageload: " + hash);
					// hash doesn't contain the first # character.
					if(hash) {
						$.galleriffic.gotoImage(hash);
					} else {
						gallery.gotoIndex(0);
					}
				}
}