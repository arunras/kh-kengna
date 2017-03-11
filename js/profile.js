var id;

function init_profile(){
  original_profile = "";

    id = $("span#profile_id").html();

    /* load profile information */
    $.get("php_sub/profile_information.php?id="+id,function(data){
        load_profile_info(data);
    });
    /* end of load profile information */

    /* load added hotels */
    if(document.getElementById("my_hotels")){
        $.get("php_sub/profile_user_hotels.php?id="+id+"&type=added",function(data){
            $("#my_hotels").html(data);
            $("#my_hotels .hotel-rate").rating();
        });
    }

    /* load reviewed hotels */
    if(document.getElementById("reviewd_hotels")){
        $.get("php_sub/profile_user_hotels.php?id="+id+"&type=reviewed",function(data){
            $("#reviewd_hotels").html(data);
            $("#reviewd_hotels .hotel-rate").rating();
        });
    }


    /* end of load hotels */

    /* for user profile tabs*/
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
     /* end of user profile tab */

     $("#edit_profile").click(function(){
        if($(this).html() == "[Edit]"){// call for editing the profile
            $.get("php_sub/profile_information.php?id="+id+"&edit=1",function(data){
                load_profile_info(data);
            });
            $(this).html("");
            $("#cancel").removeClass("profile_hide");
        }
        else{ //call after saving profile
            $.get("php_sub/profile_information.php?id="+id,function(data){
                load_profile_info(data);
            });
            $(this).html("[Edit]");
            $("#cancel").addClass("profile_hide");
        }
    });

}

function load_profile_info(data){
  $("#my_account").html(data);

  original_profile = $("#user_profile_pic").attr("src");

  //for choosing profile picture
  if(document.getElementById("select_profile_picture")){
    $("#select_profile_picture").click(function(){
          $("#fl_profile_picture").trigger("click");
    });
  }

    $("#cancel").click(function(){//call for finish editing
        $("#edit_profile").html("[Edit]");
        $(this).addClass("profile_hide");
        $.get("php_sub/profile_information.php?id="+id,function(data){
                load_profile_info(data);
        });
        $("#edit_profile").removeClass("profile_hide");
    });

  if(document.getElementById("fl_profile_picture")){
    $("#fl_profile_picture").change(function(){
        var val = $(this).val();
        if(val==""){
           $(this).siblings("input").hide(100);
           $(this).siblings("span").hide(100);
        }
        else{
          $(this).siblings("input").show(100);
          //$(this).siblings("span").show(100);
        }
    });
  }
}

function check_submit_profile(){
    if($("#txt_password").val() != ""){
        if($("#txt_new_password").val() != "" && $("#txt_new_password").val() != "" && $("#txt_con_password").val() != ""){
            if( $("#txt_con_password").val() != $("#txt_new_password").val() ){
        		alert("Password not match.");
                return false;
            }
        }
        else{
            alert("Password cannot blank.");
            return false;
        }
    }
    return true;
}

function finish_save_profile(messages){
    if(messages != "")
        alert(messages);
    $("#edit_profile").trigger("click");
}

function change_profile_user(type,src){
    	var doc_error=document.getElementById('select_status');
			var result = document.getElementById("user_profile_pic");
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

            $("#select_status").html(sms)
                                .siblings("span").hide()
                                .siblings("input").hide();
           $("#select_status").fadeOut(1600, "linear");
           $("#select_profile_picture").show();

           $.get("php_sub/profile_information.php?id="+id,function(data){
                load_profile_info(data);
        });
}
