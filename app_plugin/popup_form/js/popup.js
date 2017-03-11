// JavaScript Document


$(document).ready(function() {	
	$('a[href="#dialog2"]').click(function () {
		var idr = $(this).attr('tabindex');
		$('#room_id1').val(idr);
		
	    var room_name = $("#room_name_of_" + idr).html();
		$('#room_name1').val(room_name);
		
		var room_desc = $("#room_desc_of_" + idr).html();
		$('#room_desc1').val(room_desc);
		
		//var room_feature = $("#room_feature_of_" + idr).att();
		//var arr = new Array();
		//var i = 0;
		$("#feature1 input[type=checkbox]").removeAttr("checked");
		$("#room_feature_of_" + idr).find("li").each(function(){
			var txt = $(this).html();
			txt = txt.substr(2);
			
			$("table#feature1 input[type=checkbox]").each(function(){
				if($(this).attr("id") == txt){
					$(this).attr("checked",true);
				}
			});
			
		});
		
		
		
	});	
	
	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2 - 50+ $(window).scrollTop() + "px");
		$(id).css('left', winW/2-$(id).width()/2 + $(window).scrollLeft() + "px");
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			
	
	$("#form_editroom").submit(function(){
		var room_id = $("#room_id1").val();	
		var action = $(this).attr("action");
		
		action = action + "?room_id1=" + room_id;
		$(this).attr("action",action);
	});

});
