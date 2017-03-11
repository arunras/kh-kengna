<?php
	
	ob_start();
	if(!isset($_SESSION))
	{
		session_start();
	}
		
	/* --------- set current page session ------------- */
    if(!isset($_SESSION['_cur_Page']))$_SESSION['_cur_Page'] = "index";
	$last_page = $_SESSION['_cur_Page'];
	//$_SESSION['_cur_Page']=$login_page;
	/*------------------- txt_user_name,txt_user_password is for log in ---------------------*/
	if(isset($_POST['txt_user_name']) && isset($_POST['txt_user_password'])){

		require_once("../connection/connection.php");
		require_once("../module/module.php");

		$user_name = $_POST['txt_user_name'];
		$password = $_POST['txt_user_password'];		
		$user_password = md5($password);
		$user_id = getValue("SELECT user_id FROM tbl_users WHERE user_name = '$user_name' AND user_password = '$user_password'");
		
		$_SESSION['_user_13_5_2011_id'] = $user_id;
				
		if($user_id == ''){			
			header("location:../?mangoparam=login&error=" . RandomString());
		}
		else{			
			
			header("location:../?mangoparam=" . $last_page);

		}
	}
	else{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Mangosteen-LogIn</title>

<script>

	function check_input(){
		
		var alert_text = "";
		var login_result= true;
		//resut result of login
		document.getElementById('user_name_result').innerHTML = "";
		document.getElementById('password_result').innerHTML = "";
		
		//check the input
		if(document.getElementById('txt_name').value == ""){			
			alert_text = "Please Input Username";
			document.getElementById('user_name_result').innerHTML = alert_text;
			login_result = false;
		}

		if(document.getElementById('txt_password').value == ""){			
			alert_text = "Please Input Password";
			document.getElementById('password_result').innerHTML = alert_text;
			login_result = false;
		}
		
		return login_result;
	}


</script>

</head>

<body>
   
	<div id='stretch_background'>	
     
    
 	<!--view log in box-->    
    <center>         
    
    <div class="login">
    	<div class='mango_bar'>
        	<label>Mangosteen Login</label>
        </div>
        <br />
    <form action="include/login.php" method="post" onsubmit="return check_input();">
	<table cellpadding="5" hspace="5">
    	<!-- view user name box -->                
    	<tr>
        	<td>Username</td>
            <td>
            	<input type="text" id='txt_name' name="txt_user_name" style="width:150px;"/>
                <div class="error_text"><span id = 'user_name_result'></span></div>
            </td>            
        </tr>
        <!-- end of view user name box -->
        
        <!-- view password box -->
        <tr>
        	<td>Password</td>
            <td>
            	<input type="password" id='txt_password' name="txt_user_password" style="width:150px;"/>
                <div class="error_text"><span id = 'password_result'></span></div>
            </td>
        </tr>
        <!-- end ofview password box -->
        
        <!-- view submit box -->
        <tr>
        	<td></td>
        	<td align="left"><input type="submit" value="Log in" /></td>
            <!--<td align="left"><input type="reset" value="Log in" /></td>-->
        </tr>
        <!-- end of view submit box -->
    </table>
    
    
    </form>
    </div>
    </center>
    <!-- end of view log in box -->
    
    </div>
</body>
</html>
<?php
	}
?>  