var gallery_city;
function init_admin(){
    /* for hotel admin tabs*/
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


    /* end of admin tab */

    /* load payment methods */
    $.get("application/payment_method/hotel_payment_method.php?action=admin_display",
        function(data){
            load_payment(data);
        });
    /* end of payment methods */

    /* load service display
    $.get(
    "php_sub/admin_display_service.php",
    function(data){
        load_service(data);
    });
     end of service display */

    /* load users */
    $.get(
    "php_sub/admin_mgt_users.php",
    function(data){
        load_user(data);
    });
    /* end of load users */


    /* Load hotels */
    $.get(
    "php_sub/admin_mgt_hotels.php",
    function(data){
        load_hotel(data);
    });
    /* end of load hotels */

    /* load facilities to div Mgt_Facilities */
    $.get(
    "php_sub/admin_view_facilities.php",
    function(data){
        load_facilities(data);
    });
    /* end of load facilities */

    /* load basic info */
    $.get(
    "php_sub/admin_view_basic_info.php",
    function(data){
        load_info(data);
    });
    /* end of load basic info */

    /* load sports to div Mgt_Sports */
    $.get(
    "php_sub/admin_view_sports.php",
    function(data){
        load_sports(data);
    });
    /* end of load Sports */

    /* load address */
     $.get(
    "php_sub/admin_view_addresses.php?type=city",
    function(data){
        load_cities(data);
    });
    /*$.get(
    "php_sub/admin_view_addresses.php?type=khan",
    function(data){
        load_khan(data);
    });
    $.get(
    "php_sub/admin_view_addresses.php?type=sangkat",
    function(data){
        load_sangkat(data);
    });*/

    /* end of load address */

     /*add payments */
     $("#admin_add_payment_method").click(function(){
        var title = "Add Payment method";
        var url = 'application/payment_method/hotel_payment_method.php?action=add';
        popup_show(
       'popup_over',
       'form_content_over',
       'title_over',
       'popup_drag_over',
       'popup_exit_over',
       'screen-center',
       0,   0,
       'pos_bottom',
       title,
       url
       );
    });
    /* end of add payment*/

    /* add facilty */
    $("#admin_add_facility").click(function(){
        var title = "Add Facility";
        var url = 'php_sub/admin_view_facilities.php?action=add';
        popup_show(
       'popup_over',
       'form_content_over',
       'title_over',
       'popup_drag_over',
       'popup_exit_over',
       'screen-center',
       0,   0,
       'pos_bottom',
       title,
       url
       );
    });
    /* end of add facility */


    /* add sport */
    $("#admin_add_sport").click(function(){
        var title = "Add Sport";
        var url = 'php_sub/admin_view_sports.php?action=add';
        popup_show(
       'popup_over',
       'form_content_over',
       'title_over',
       'popup_drag_over',
       'popup_exit_over',
       'screen-center',
       0,   0,
       'pos_bottom',
       title,
       url
       );
    });
    /* end of add sport */

    /* add basic info */
    $("#admin_add_basic_info").click(function(){
        var title = "Add Basic Information";
        var url = 'php_sub/admin_view_basic_info.php?action=add';
        popup_show(
       'popup_over',
       'form_content_over',
       'title_over',
       'popup_drag_over',
       'popup_exit_over',
       'screen-center',
       0,   0,
       'pos_bottom',
       title,
       url
       );
    });
    /* end of add basic info */

    /* add city */
        $("span#admin_add_city").click(function(){
        var title = "Add City";
        var url = 'php_ajax/db_save_type_address.php?view=true&type=city&up=1';
        popup_show(
       'popup_over',
       'form_content_over',
       'title_over',
       'popup_drag_over',
       'popup_exit_over',
       'screen-center',
       0,   0,
       'pos_bottom',
       title,
       url
       );
    });

    /* end of at city */

    /* add khan to city */
    $("span#admin_add_khan").click(function(){
        if(!current_city){
            alert("Please select city first");
            return false;
        }
        var title = "Add Khan";
        var url = 'php_ajax/db_save_type_address.php?view=true&type=khan&up='+current_city;
        popup_show(
       'popup_over',
       'form_content_over',
       'title_over',
       'popup_drag_over',
       'popup_exit_over',
       'screen-center',
       0,   0,
       'pos_bottom',
       title,
       url
       );
    });
    /* end of add khan */
    /* add sangkat */
     $("span#admin_add_sangkat").click(function(){
        if(!current_khan){
            alert("Please select khan first");
            return false;
        }
        var title = "Add Sangkat";
        var url = 'php_ajax/db_save_type_address.php?view=true&type=sangkat&up='+current_khan;
        popup_show(
       'popup_over',
       'form_content_over',
       'title_over',
       'popup_drag_over',
       'popup_exit_over',
       'screen-center',
       0,   0,
       'pos_bottom',
       title,
       url
       );
    });
    /* end of at sangkat */


    $("#admin_add_photo").click(function(){
                    //to add photo to city
                    var url = "php_ajax/db_save_cityphoto.php?action=add&city="+current_city;
                    popup_show(
                   'popup_over',
                   'form_content_over',
                   'title_over',
                   'popup_drag_over',
                   'popup_exit_over',
                   'screen-center',
                   0,   0,
                   'pos_bottom',
                   'Add Photo',
                   url
                   );
                });

                $("#admin_edit_photo").click(function(){
                    var id = gallery_city.currentImage.hash;
                    var url = "php_ajax/db_save_cityphoto.php?action=edit&id=" + id + "&city=" + current_city;
                    popup_show(
                   'popup_over',
                   'form_content_over',
                   'title_over',
                   'popup_drag_over',
                   'popup_exit_over',
                   'screen-center',
                   0,   0,
                   'pos_bottom',
                   'Edit Photo Description',
                   url
                   );
                });
                $("#admin_delete_photo").click(function(e){
                    if(gallery_city.data.length == 0 || $("#page").hasClass("hide"))return false;
                    var answer = confirm("Do you want to delete the viewing picture?");
                    if(answer){
                      //to do: delete photos
                      var image_id = gallery_city.removeCurrentImage();
                      if (image_id < 0)
            		    alert('No Image to remove!');
                      if (gallery_city.data.length == 0){
                        //history.go(0);
                         gallery_city.find("img").attr("src","");

                      }
                      //delete from database
                      var url = "php_ajax/db_save_cityphoto.php?action=delete&id=" + image_id + "&city=" + current_city;
                      $.ajax({
                        "url":url,
                        "success": function(data){
                            $("#city_photos").html(data);
                            reset_city_photo();
                        }
                      });
                      //gallery_city.refresh();
            		  //e.preventDefault();
                    }
                });


}//init admin

function load_facilities(data){
  $("#Mgt_Facilities").html(data);
  //

  $("#Mgt_Facilities span").click(function(){
        $("#Mgt_Facilities span span").addClass("func");
        $(this).find("span").removeClass("func");
  });

  $("#Mgt_Facilities span span").click(function(){
        var facility_id = $(this).parent().attr("id").split("_")[1];
        var url = 'php_sub/admin_view_facilities.php';

        var title = $(this).html().replace("]","").replace("[","")+"";
          url    += "?facility_id="+facility_id+"&action="+title.toLowerCase();

        if(title == "Delete"){
          if(confirm("Are you sure?")){
            $.get(
              "php_sub/admin_view_facilities.php?facility_id="+facility_id+"&action=delete",
              function(data){
                  load_facilities(data);
              });
          }
          return false;
        }
        else if(title == "Edit"){
            title  += " facility";
             popup_show(
             'popup_over',
             'form_content_over',
             'title_over',
             'popup_drag_over',
             'popup_exit_over',
             'screen-center',
             0,   0,
             'pos_bottom',
             title,
             url
             );
             return false;
        }
        else if(title=="Icon"){
            //alert("Icon");
             title  += " facility";
             popup_show(
             'popup_over',
             'form_content_over',
             'title_over',
             'popup_drag_over',
             'popup_exit_over',
             'screen-center',
             0,   0,
             'pos_bottom',
             title,
             "php_sub/admin_display_service.php?id="+facility_id + "&service=facility"
             );
             return false;
        }
  });

  $("#Mgt_Facilities input[type=checkbox]").prettyCheckboxes();
  $("#Mgt_Facilities input[type=checkbox]").change(function(){
        var checked = $(this).attr("checked");
        var id = $(this).attr("id").split("_")[1];
        if(checked)checked = 1;
        else checked = 0;
        $.ajax({
        "url":"php_sub/admin_display_service.php?id=" + id + "&service=facility&available=" + checked,
        "success":function(){

            }
        });
  });
}

function finish_save_facility(){
    close_popup();
    $.get(
    "php_sub/admin_view_facilities.php",
    function(data){
        load_facilities(data);
    });
}


function load_sports(data){
  $("#Mgt_Sports").html(data);
  $("#Mgt_Sports span").click(function(){
        $("#Mgt_Sports span span").addClass("func");
        $(this).find("span").removeClass("func");
  });

  $("#Mgt_Sports span span").click(function(){
        var sport_id = $(this).parent().attr("id").split("_")[1];
        var url = 'php_sub/admin_view_sports.php';

        var title = $(this).html().replace("]","").replace("[","")+"";
          url    += "?sport_id="+sport_id+"&action="+title.toLowerCase();

        if(title == "Delete"){
          if(confirm("Are you sure?")){
            $.get(
              "php_sub/admin_view_sports.php?sport_id="+sport_id+"&action=delete",
              function(data){
                  load_sports(data);
              });
          }
          return false;
        }
        else if(title == "Edit"){
            title  += " sport";
             popup_show(
             'popup_over',
             'form_content_over',
             'title_over',
             'popup_drag_over',
             'popup_exit_over',
             'screen-center',
             0,   0,
             'pos_bottom',
             title,
             url
             );
             return false;
        }
       else if(title=="Icon"){
            //alert("Icon");
             title  += " Sport";
             popup_show(
             'popup_over',
             'form_content_over',
             'title_over',
             'popup_drag_over',
             'popup_exit_over',
             'screen-center',
             0,   0,
             'pos_bottom',
             title,
             "php_sub/admin_display_service.php?id="+sport_id + "&service=sport"
             );
             return false;
        }
  });

  $("#Mgt_Sports input[type=checkbox]").prettyCheckboxes();

  $("#Mgt_Sports input[type=checkbox]").change(function(){
        var checked = $(this).attr("checked");
        var id = $(this).attr("id").split("_")[1];
        if(checked)checked = 1;
        else checked = 0;
        $.ajax({
        "url":"php_sub/admin_display_service.php?id=" + id + "&service=sport&available=" + checked,
        "success":function(){

            }
        });
  });
}
var current_city;
var current_khan;
function load_cities(data){
    $("#Cities").html(data);

    $("#Cities span").click(function(){
        current_city =  $(this).attr("id").split("_")[2];
        if(!current_city)return false;
        $("#Cities span").removeClass("active");
        $(this).addClass("active");

        //load city's photos
        $.get(
        "php_sub/admin_mgt_cityphotos.php?id="+ current_city,
        function(data){
            $("#city_photos").html(data);
            reset_city_photo();
        });

        //load khan
        $.get(
        "php_sub/admin_view_addresses.php?type=khan&up_id=" + current_city,
        function(data){
            load_khan(data);
        });
        $("#Sangkat").html("");
    });

    $("#Cities span span").click(function(){
       var curr_id = $(this).parent().attr("id").split("_")[2];
       var action  = $(this).html();
       if(action == "[Edit]"){
            var title = "Edit City";
            var url = 'php_ajax/db_save_type_address.php?edit=true&id='+curr_id+'&view=true&type=city&up=1';
            popup_show(
           'popup_over',
           'form_content_over',
           'title_over',
           'popup_drag_over',
           'popup_exit_over',
           'screen-center',
           0,   0,
           'pos_bottom',
           title,
           url
           );
       }
       else{
            if(confirm("Are you sure?")){
                $.get("php_ajax/db_save_type_address.php?action=delete&type=city&id=" + curr_id + "&up=1",
                function(data){
                  load_cities(data);
                });
            }
            else return false;
       }
    });
}
function load_khan(data){
    $("#Khan").html(data);
    $("#Khan span").click(function(){
        current_khan = $(this).attr("id").split("_")[2];
        if(!current_khan)return false;
        $("#Khan span").removeClass("active");
        $(this).addClass("active");
        $.get(
        "php_sub/admin_view_addresses.php?type=sangkat&up_id=" + current_khan,
        function(data){
            load_sangkat(data);
        });
    });

    $("#Khan span span").click(function(){
       var curr_id = $(this).parent().attr("id").split("_")[2];
       var action  = $(this).html();
       if(action == "[Edit]"){
            var title = "Edit Khan";
            var url = 'php_ajax/db_save_type_address.php?edit=true&id='+curr_id+'&view=true&type=khan&up='+ current_city;
            popup_show(
           'popup_over',
           'form_content_over',
           'title_over',
           'popup_drag_over',
           'popup_exit_over',
           'screen-center',
           0,   0,
           'pos_bottom',
           title,
           url
           );
       }
       else{
         if(confirm("Are you sure?")){
                $.get("php_ajax/db_save_type_address.php?action=delete&type=khan&id=" + curr_id + "&up=" + current_city,
                function(data){
                  load_khan(data);
                });
            }
            else return false;
       }
    });
}
function load_sangkat(data){
    $("#Sangkat").html(data);
    $("#Sangkat span").click(function(){
        $("#Sangkat span").removeClass("active");
        $(this).addClass("active");
    });

    $("#Sangkat span span").click(function(){
       var curr_id = $(this).parent().attr("id").split("_")[2];
       var action  = $(this).html();
       if(action == "[Edit]"){
            var title = "Edit Sangkat";
            var url = 'php_ajax/db_save_type_address.php?edit=true&id='+curr_id+'&view=true&type=sangkat&up='+current_khan;
            popup_show(
           'popup_over',
           'form_content_over',
           'title_over',
           'popup_drag_over',
           'popup_exit_over',
           'screen-center',
           0,   0,
           'pos_bottom',
           title,
           url
           );
       }
       else{
         if(confirm("Are you sure?")){
                $.get("php_ajax/db_save_type_address.php?action=delete&type=sangkat&id=" + curr_id + "&up="+current_khan,
                function(data){
                  load_sangkat(data);
                });
            }
            else return false;
       }
    });
}

function finish_save_sport(){
    close_popup();
    $.get(
    "php_sub/admin_view_sports.php",
    function(data){
        load_sports(data);
    });
}

function admin_address_type(type){
    switch(type){
      case "city":
          $.get(
          "php_sub/admin_view_addresses.php?type=city",
          function(data){
              load_cities(data);
          });
          break;
      case "khan":
          $.get(
          "php_sub/admin_view_addresses.php?type=khan&up_id="+current_city,
          function(data){
              load_khan(data);
          });
          break;
      case "sangkat":
          $.get(
          "php_sub/admin_view_addresses.php?type=sangkat&up_id="+current_khan,
          function(data){
              load_sangkat(data);
          });
          break;
    }
}


function load_user(data){
    //load users data to tabs Mgt_User
    $("#Mgt_User").html(data);

    //for edit/delete users
    $("#lst_users span").click(function(){
        var user_id = $(this).siblings("span:nth-child(1)").html();
        var action = $(this).html().replace("[","").replace("]","").toLowerCase();
        var url = 'php_sub/admin_mgt_users.php?id='+user_id + "&action=" + action;
        if(action == "edit"){
          title = "Edit User"
            popup_show(
           'popup_over',
           'form_content_over',
           'title_over',
           'popup_drag_over',
           'popup_exit_over',
           'screen-center',
           0,   0,
           'pos_bottom',
           title,
           url
           );
        }
        else{
           if(confirm("Are you sure?")){
                $.get(url,function(data){
                    load_user(data);
                });
           }
        }
    });
    //end of edit/delete users


    //make it a dataTable
    $('#lst_users').dataTable({
    	"sDom": '<"top"i>rt<"bottom"flp><"clear">'
    });
}

function load_hotel(data){
    $("#Mgt_Top_Hotel").html(data);

    $('#Mgt_Top_Hotel input[type=checkbox]').prettyCheckboxes();

    $("#lst_hotels input[type=checkbox]").change(function(){
        show_hotel_summary();
        var $this_id = $(this).attr("id");
        var checked  = $("#"+$this_id).attr("checked");
        $this_id     = $this_id.split("-");
        var type     = $this_id[0];
        var id       = $this_id[2];
        if(checked)checked = "1";
        else checked = "0";
        $.ajax({
            "url":"php_sub/admin_mgt_hotels.php?id="+id+"&type="+type+"&checked="+checked,
            "success":function(data){
              //alert(data);
            }
        });
    });

    show_hotel_summary();

    $("#lst_hotels").dataTable({
        "sDom": '<"top"i>rt<"bottom"flp><"clear">'
    });
}


function show_hotel_summary(){
    var count_hotels     = ($("#lst_hotels tr").length) - 2; //1st tr is head, last 1 is foot, besides are hotels
    var top_hotels       = ($("#lst_hotels tr td:nth-child(6) input[type=checkbox]:checked").length);
    var activated_hotels = ($("#lst_hotels tr td:nth-child(7) input[type=checkbox]:checked").length);

    $("#sum_top_slide").html(top_hotels + "/" + count_hotels);
    $("#sum_activate").html(activated_hotels + "/" + count_hotels);
}

function load_info(data){
    $("#Mgt_Basic_Info").html(data);

    $("#Mgt_Basic_Info span span").click(function(){
        var id = $(this).parent().attr("id").split("_")[1];
        var url = 'php_sub/admin_view_basic_info.php';

        var title = $(this).html().replace("]","").replace("[","")+"";
          url    += "?id="+id+"&action="+title.toLowerCase();
        if(title == "Delete"){
          if(confirm("Are you sure?")){
            $.get(
              "php_sub/admin_view_basic_info.php?id="+id+"&action=delete",
              function(data){
                  load_sports(data);
              });
          }
          return false;
        }
        else if(title == "Edit"){
            title  += " Basic info";
           popup_show(
           'popup_over',
           'form_content_over',
           'title_over',
           'popup_drag_over',
           'popup_exit_over',
           'screen-center',
           0,   0,
           'pos_bottom',
           title,
           url
           );
           return false;
        }
       else if(title=="Icon"){
            //alert("Icon");
             title  += " Basic Information";
             popup_show(
             'popup_over',
             'form_content_over',
             'title_over',
             'popup_drag_over',
             'popup_exit_over',
             'screen-center',
             0,   0,
             'pos_bottom',
             title,
             "php_sub/admin_display_service.php?id="+id + "&service=basic_info"
             );
             return false;
        }
  });
  $("#Mgt_Basic_Info input[type=checkbox]").prettyCheckboxes();
  $("#Mgt_Basic_Info input[type=checkbox]").change(function(){
        var checked = $(this).attr("checked");
        var id = $(this).attr("id").split("_")[1];
        if(checked)checked = 1;
        else checked = 0;
        $.ajax({
        "url":"php_sub/admin_display_service.php?id=" + id + "&service=basic_info&available=" + checked,
        "success":function(){

            }
        });
  });

}

function finish_save_basic(){
    $.get(
    "php_sub/admin_view_basic_info.php",
    function(data){
        load_info(data);
    });
    close_popup();
}

function save_user(){
    $.get(
    "php_sub/admin_mgt_users.php",
    function(data){
        load_user(data);
    });
    close_popup();
}

function save_service(service){
    if(service == "facility"){
      /* load facilities to div Mgt_Facilities */
      $.get(
      "php_sub/admin_view_facilities.php",
      function(data){
          load_facilities(data);
      });
      /* end of load facilities */
     }
     else if(service == "basic_info"){
      /* load basic info */
      $.get(
      "php_sub/admin_view_basic_info.php",
      function(data){
          load_info(data);
      });
      /* end of load basic info */
     }
     else if(service == "sport"){
      /* load sports to div Mgt_Sports */
      $.get(
      "php_sub/admin_view_sports.php",
      function(data){
          load_sports(data);
      });
      /* end of load Sports */
    }
    close_form_over();
}

function close_popup(){
  $("#popup_over").fadeOut(200);
}

function reset_city_photo(){
    var onMouseOutOpacity = 0.87;
				$('#thumbs_city ul.thumbs li, div.navigation a.pageLink').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});


                 $('div.content').css('display', 'inline');


				// Initialize Advanced Galleriffic Gallery
                gallery_city = $('#thumbs_city').galleriffic({
					delay:                     5000,
					numThumbs:                 6,
					preloadAhead:              10,
					enableTopPager:            false,
					enableBottomPager:         false,
					imageContainerSel:         '#slideshow_city',
					controlsContainerSel:      '#controls_city',
					captionContainerSel:       '#caption_city',
					loadingContainerSel:       '#loading_city',
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

                gallery_city.find('a.prev').click(function(e) {
					gallery_city.previousPage();
					e.preventDefault();
				});

				gallery_city.find('a.next').click(function(e) {
					gallery_city.nextPage();
					e.preventDefault();
				});
                function pageload(hash) {
					// alert("pageload: " + hash);
					// hash doesn't contain the first # character.
					if(hash) {
						$.galleriffic.gotoImage(hash);
					} else {
						gallery_city.gotoIndex(0);
					}
				}

}


function finish_city_photo_description(photo_id,des){
    gallery_city.setCurrentImageDescription(des);
    $("#thumbs_city ul li").each(function(){
      if($(this).find("a").attr("href").replace("#","")== photo_id){
        $(this).find("img").attr("title",des);
        $(this).find("img").attr("alt",des);
      }
    });
    gallery_city.refresh();
    close_form_over();
}

/*function load_service(data){
    $("#Mgt_Service").html(data);
    $("#DL_Service").asmSelect({
		animate: true,
		highlight: true,
		sortable: true
	});
}*/

function upload_city_photos(type,src,fname,fid,desc){
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
			/*document.getElementById('loading_ajax').style.visibility="hidden";*/
            doc_error.fadeOut(1600, "linear");
            $("#popup_over").fadeOut(1600,"linear");

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


            gallery_city.addImage(list_item, false, false);
            gallery_city.refresh();

    		return false;
    }// end of upload photos

function load_payment(data){
    $("#Mgt_Payment").html(data);
    $("#Mgt_Payment input[type=checkbox]").prettyCheckboxes();

    $("#Mgt_Payment span span").click(function(){
        var id = $(this).parent().attr("id").split("_")[1];
        var url = 'php_sub/admin_view_basic_info.php';

        var title = $(this).html().replace("]","").replace("[","")+"";
          url    += "?id="+id+"&action="+title.toLowerCase();
        if(title == "Delete"){
           if(confirm("Are you sure?")){
             $.ajax({
                "url":"application/payment_method/hotel_payment_method.php?action=delete&id=" + id,
                "success":function(data){
                    load_payment(data);
                }
            });
           }
        }
        else if(title == "Edit"){
            var title = "Edit Payment method";
            var url = 'application/payment_method/hotel_payment_method.php?action=edit&id=' + id;
            popup_show(
           'popup_over',
           'form_content_over',
           'title_over',
           'popup_drag_over',
           'popup_exit_over',
           'screen-center',
           0,   0,
           'pos_bottom',
           title,
           url
           );
        }
        else if(title == "Icon"){
            title  = " Change Icon";
             popup_show(
             'popup_over',
             'form_content_over',
             'title_over',
             'popup_drag_over',
             'popup_exit_over',
             'screen-center',
             0,   0,
             'pos_bottom',
             title,
             "application/payment_method/hotel_payment_method.php?id="+id + "&action=icon"
             );
             return false;
        }
    });

}