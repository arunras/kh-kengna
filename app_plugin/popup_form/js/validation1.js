/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#form_editroom");
	var name = $("#room_name1");
	var message = $("#room_desc1");
	var rphoto = $("#rphoto1");
	var feature = $("#feature1");
	
	/////////////////////////////
	var nameInfo = $("#nameInfo1");
	var messageInfo = $("#messageInfo1");
	var photoInfo = $("#photoInfo1");
	
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	var pass1 = $("#pass1");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#pass2");
	var pass2Info = $("#pass2Info");
	
	
	
	
	
	//On blur
	name.blur(validateName);
	email.blur(validateEmail);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	//On key press
	name.keyup(validateName);
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	message.keyup(validateMessage);
	
	//setFocus();
	/*
	document.forms['form_addrom'].elements['room_name'].focus();
	
	function setFocus()
	{
     document.getElementById("room_name").focus();
	}
	*/
	
	//On Submitting
	form.submit(function(){
		//if(validateName() & validateEmail() & validatePass1() & validatePass2() & validateMessage())
		//if(validateName() & validateMessage())
		if(validateName() & validateMessage() & validateCheckbox())
			return true
		else
			return false;
	});
	
	//validation functions
	function validateName(){
		//if it's NOT valid
		if(name.val().length < 4){
			name.addClass("error");
			//nameInfo.text("We want names with more than 3 letters!");
			nameInfo.text("X");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			name.removeClass("error");
			//nameInfo.text("What's your name?");
			nameInfo.text("");
			nameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateMessage(){
		//it's NOT valid
		if(message.val().length < 10){
			message.addClass("error");
			messageInfo.text("X");
			messageInfo.addClass("error");
			return false;
		}
		//it's valid
		else{			
			message.removeClass("error");
			messageInfo.text("");
			messageInfo.removeClass("error");
			return true;
		}
	}	
	
	function validateUpload(){
		//it's NOT valid
		//if ($('[name=rphoto]').val() == "")
		if (rphoto.val() == "")
		{
			rphoto.addClass("error");
			photoInfo.text("");
			photoInfo.addClass("error");
			return false;	
		}
		//it's valid
		else
		{
			rphoto.removeClass("error");
			photoInfo.text("");
			photoInfo.removeClass("error");
			return true;	
		}
	}
	
	
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error");
			emailInfo.text("Valid E-mail please, you will need it to log in!");
			emailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			emailInfo.text("Stop cowboy! Type a valid e-mail please :P");
			emailInfo.addClass("error");
			return false;
		}
	}
	
	function validatePass1(){
		var a = $("#password1");
		var b = $("#password2");

		//it's NOT valid
		if(pass1.val().length <5){
			pass1.addClass("error");
			pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			pass1.removeClass("error");
			pass1Info.text("At least 5 characters: letters, numbers and '_'");
			pass1Info.removeClass("error");
			validatePass2();
			return true;
		}
	}
	function validatePass2(){
		var a = $("#password1");
		var b = $("#password2");
		//are NOT valid
		if( pass1.val() != pass2.val() ){
			pass2.addClass("error");
			pass2Info.text("Passwords doesn't match!");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2.removeClass("error");
			pass2Info.text("Confirm password");
			pass2Info.removeClass("error");
			return true;
		}
	}
	
	function validdateCheckbox11(){
		if(feature.checked()=false)
		{
			alert("false");
			return false;	
		}
		else
		{
			alert("true");
			return true;	
		}		
	}
	
	function validateCheckbox()
	{
		frmCheckform	= document.Checkform;
		// assigh the name of the checkbox;
		var chks = document.getElementsByName('feature1[]');

		var hasChecked = false;
		// Get the checkbox array length and iterate it to see if any of them is selected
			for (var i = 0; i < chks.length; i++)
			{
				if (chks[i].checked)
				{
		        	hasChecked = true;
					feature.removeClass("check_error");
					return true;
				//break;
				}
			}
			// if ishasChecked is false then throw the error message
		if (!hasChecked)
		{
			//alert("Please select at least one feature.");
			chks[0].focus();
			feature.addClass("check_error");
			return false;
		}
	}

	
	
});

