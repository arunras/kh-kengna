// JavaScript Document
$(document).ready(function(){
	var f = $(".txt");
	f.each(function(){
		$(this).val('');
	});
});


$(function(){

$("#register").click(function(){
	var check_text = $(".txt");
	var error = 0;
	check_text.each(function(){
		var value = $(this).val();
		if(value=="") {
			$(this).addClass('error');
			$(this).effect("shake", { times:0 }, 50);			
			error++;
		} else {
			$(this).addClass('valid');
		}		
	});
	if( $("#txtconfirmpassword").val() != $("#txtpassword").val() ){
		alert("Password not match.");
		error++;
	}
	if(error !=0 )return false;
	else return true;
});


});//end of function