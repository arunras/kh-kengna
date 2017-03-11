// JavaScript Document

		function check_add_hotel(hotel_id){
			if(hotel_id != ""){
				return confirm("Finish your last hotel?");
			}
			return true;
		}


		var xmlobj;
		var htmlid="";

		/* change city after choosing the country --*/
		function ChangeCity(){
			htmlid="city";
			var item_country = 1;
			if(item_country != ""){
				xmlobj =getHTTPObject();
				if(xmlobj==null){
					return;
				}

				document.getElementById('khan').innerHTML = "<option> -- District -- </option>";
				document.getElementById('sangkat').innerHTML = "<option> -- Commune -- </option>";

				url ="php_ajax/get_cities.php?country_id="+item_country;
				xmlobj.onreadystatechange=ajax_return;
				xmlobj.open("GET",url,true)
				xmlobj.send(null)
				return false;
			}
		}

		/*-- change khan after choosing the city --*/
		function ChangeKhan(){
			htmlid="khan";
			var item_city = document.getElementById("city").value;
			if(item_city != ""){
				xmlobj =getHTTPObject();
				if(xmlobj==null){
					return;
				}

				document.getElementById('sangkat').innerHTML = "<option> -- Commune -- </option>";

				url ="php_ajax/get_khan.php?city_id="+item_city;
				xmlobj.onreadystatechange=ajax_return;
				xmlobj.open("GET",url,true)
				xmlobj.send(null)
				return false;
			}
		}

		/*-- change sangkat after choosing the khan --*/
		function ChangeSangkat(){
			htmlid="sangkat";
			var item_khan = document.getElementById("khan").value;
			if(item_khan != ""){
				xmlobj =getHTTPObject();
				if(xmlobj==null){
					return;
				}
				url ="php_ajax/get_sangkat.php?khan_id="+item_khan;
				xmlobj.onreadystatechange=ajax_return;
				xmlobj.open("GET",url,true)
				xmlobj.send(null)
				return false;
			}
		}

		////////////----------------------------- JQuery ------------------ ///////////////
function init_add(){
    //original field values
    var field_values = {
            //id        :  value
            'country'  : 'Country',
            'city'  : 'City',
			'khan'  : 'khan',
			'sangkat'  : 'sangkat',
            'hotel' : 'Hotel Name',
            'address'  : 'Address',
            'description'  : 'Description',
			'star'  : 'Star'

    };



    //inputfocus
    $('input#country').inputfocus({ value: field_values['country'] });
    $('input#city').inputfocus({ value: field_values['city'] });
	$('input#khan').inputfocus({ value: field_values['khan'] });
	$('input#sangkat').inputfocus({ value: field_values['sangkat'] });
	$('input#hotel').inputfocus({ value: field_values['hotel'] });
    $('input#address').inputfocus({ value: field_values['address'] });
    $('input#description').inputfocus({ value: field_values['description'] });
	$('input#star').inputfocus({ value: field_values['star'] });




    //reset progress bar
   	$('#progress').css('width','0');
    $('#progress_text').html('0% Complete');

    //first_step
    //$('form').submit(function(){ return false; });




    $('#submit_first').click(function(){
        //remove classes
        $('#first_step input').removeClass('error').removeClass('valid');

        //ckeck if inputs aren't empty
		var error = 0;

		if($('#star').val() == "error_star"){
			$('#first_step select[id=star]').each(function(){
				$(this).removeClass('valid').addClass('error');
				$(this).effect("shake", { times:3 }, 50);
			});
			error++;
		}

        $('#hotel').each(function(){
            var value = $('#hotel').val();
            if( value.length<3 || value==field_values[$('#hotel').attr('id')] ) {
                $('#hotel').addClass('error');
                $('#hotel').effect("shake", { times:3 }, 50);

                error++;
            } else {
                $('#hotel').addClass('valid');
            }
			return false;
        });

		$('#address').each(function(){
            var value = $('#address').val();
            if( value.length<2 || value==field_values[$('#address').attr('id')] ) {
                $('#address').addClass('error');
                $('#address').effect("shake", { times:3 }, 50);

                error++;
            } else {
                $('#address').addClass('valid');
            }
			return false;
        });

        if(!error) {

		 	/*var fields = $('#first_step select');
            if( ($('#sangkat').val() == "error_sangkat") || ($('#khan').val() == "error_khan") || ($('#country').val() == "error_country") || ($('#city').val() == "error_city") || ($('#star').val() == "error_star")){

				if($('#sangkat').val() == "error_sangkat"){
                    $('#first_step select[id=sangkat]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
				}

				if($('#khan').val() == "error_khan"){
                    $('#first_step select[id=khan]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
				}

				if($('#country').val() == "error_country"){
                    $('#first_step select[id=country]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
				}

				if($('#city').val() == "error_city"){
                    $('#first_step select[id=city]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
				}

				if($('#star').val() == "error_star"){
					$('#first_step select[id=star]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
				}
                    return false;
            }
			else{

			$.ajax({
	'url':'php_ajax/db_save_hotel.php','data':'hotel='+$('#hotel').val()+'&address='+$('#address').val()+'&description='+$('#description').val()+'&star='+$('#star').val()+'&country='+$('#country').val()+'&city='+$('#city').val()+'&khan='+$('#khan').val()+'&sangkat='+$('#sangkat').val(),'type':'POST','success':function(data)
			   {
				   	if(data.length)
				   	{
						$('#first_step').slideUp();
		                $('#fourth_step').slideDown();
						$('#result').html(data);
					}
				}
			});

				$('#first_step').slideUp();
		        $('#second_step').slideDown();


				$('#progress').css('width','20%');
    			$('#progress_text').html('20% Complete');

				//$('#result').html(data);

				return false;
			}
		   */

		  /*$.ajax({
	'url':'php_ajax/db_save_hotel.php','data':'hotel='+$('#hotel').val()+'&address='+$('#address').val()+'&description='+$('#description').val()+'&star='+$('#star').val()+'&country='+$('#country').val()+'&city='+$('#city').val()+'&khan='+$('#khan').val()+'&sangkat='+$('#sangkat').val(),'type':'POST','success':function(data)
			   {
				   alert("successful");
				   	if(data.length)
				   	{

					}
				}
		  });*/

        }
		 else {

			return false;
		 }
    });

	$('#submit_second').click(function(){
		$('#second_step').slideUp();
		$('#third_step').slideDown();


		$('#progress').css('width','40%');
		$('#progress_text').html('40% Complete');
		return false;
	});

	$('#submit_third').click(function(){
		$('#third_step').slideUp();
		$('#fourth_step').slideDown();


		$('#progress').css('width','60%');
		$('#progress_text').html('60% Complete');
		return false;
	});





$('#submit_fourth').click(function(){
        //send information to server


	/*
	$.ajax({
	'url':'php_ajax/db_save_hotel.php','data':'hotel='+$('#hotel').val()+'&address='+$('#address').val()+'&description='+$('#description').val()+'&star='+$('#star').val()+'&country='+$('#country').val()+'&city='+$('#city').val()+'&khan='+$('#khan').val()+'&sangkat='+$('#sangkat').val(),'type':'POST','success':function(data)
			   {
					if(data.length)
				   	{
						$('#first_step').slideUp();
		                $('#fourth_step').slideDown();
						$('#result').html(data);
					}
				}
			});	*/

    });


    ///---------------------- add facilities -------------------//

    $("#facilities").asmSelect({
				animate: true,
				highlight: false,
				sortable: true
			});

			$("#sports_recreation").asmSelect({
				animate: true,
				highlight: false,
				sortable: true
			});

			$("#add_facilities_btn").click(function() {

				var facility = $("#add_facility").val();
				var $option = $("<option></option>").text(facility).attr("selected", true);

				$("#facilities").append($option).change();
				$("#add_facility").val('');

				return false;
			});


			$("#add_recreation_btn").click(function() {

				var recreation = $("#add_recreation").val();
				var $option = $("<option></option>").text(recreation).attr("selected", true);

				$("#sports_recreation").append($option).change();
				$("#add_recreation").val('');

				return false;
			});


return false;
}



		function check_profile_upload(){
			var re=true;
			if(document.getElementById('txtfile').value==""){
				re=false;
				document.getElementById('sms').innerHTML="* Select a file to upload";
			}
			else{
				document.getElementById('sms').innerHTML="";
			}
			if(re==true){
				document.getElementById('loading_ajax').style.visibility="visible";
			}
			else{
				document.getElementById('loading_ajax').style.visibility="hidden";
			}
			return re;
		}

		function finish_submit_profile(type,resultid,value){
			var doc_error=document.getElementById('sms');
			var result = document.getElementById(resultid);
			var sms="";
			if(type==0)	{
				sms="* Upload successfully...";
				window.location.reload();
			}
			if(type==1) {
				sms="* File size is too big.....(2MB) Only";
				//var doc_loc=document.location.toString();
				//var tem=doc_loc.split("?");
				//document.location=tem[0]+"?step=4";
			}
			if(type==2){
				sms="* This file type is not allowed...";
			}
			if(type==3){
				sms="* Error while uploading...";
			}
			doc_error.innerHTML=sms;
			window.location.reload();
			document.getElementById('loading_ajax').style.visibility="hidden";
			result.innerHTML = value;
		}


function hotel_address_type(type){
    type = type.toLowerCase();
    if(type == "city") ChangeCity();
    else if(type == "khan") ChangeKhan();
    else if(type == "sangkat") ChangeSangkat();
    close_form();
}