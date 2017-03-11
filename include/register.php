<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION['added_hotel_id'])){
		unset($_SESSION['added_hotel_id']);
	}
?>

<div id="stretch_background">
<center>
<!--<div class="login" style="width:400px;">-->
    <div class="login">
    	<div class='mango_bar'>
            <label>Welcome Mangosteen</label>
        </div>
        <br />
    	<form action="php_ajax/db_save_account.php" method="post"><!--php_ajax/db_save_account.php-->
    	<table>
        	<tr>
            	<td width="120">
                	<label>Username:</label>
                </td>
                <td>
                	<input type="text" name="txtusername" id="txtusername" class="txt" />
                    <div class="error_text"><span id="error_username"></span></div>
                </td>
            </tr>
            <tr>
            	<td>
                	<label>Password:</label>
                </td>
                <td>
                	<input type="password" name="txtpassword" id="txtpassword" class="txt"/>
                    <div class="error_text"><span id="error_password"></span></div>
                </td>
            </tr>
            <tr>
            	<td>
                	<label>Confirm Password:</label>
                </td>
                <td>
                	<input type="password" name="txtconfirmpassword" id="txtconfirmpassword"  class="txt"/>
                    <div class="error_text"><span id="error_confirmpassword"></span></div>
                </td>
            </tr>
            <tr>
            	<td>
                	<label>Email:</label>
                </td>
                <td>
                	<input type="text" name="txtemail"  id="txtemail" class="txt"/>
                    <div class="error_text"><span id="error_email"></span></div>
                </td>
            </tr>
            <tr>
            	<td>
                	<label>Profile Name:</label>
                </td>
                <td>
                	<input type="text" name="txtprofilename" id="txtprofilename" class="txt"/>
                    <div class="error_text"><span id="error_profilename"></span></div>
                </td>
            </tr>
            <tr>
            	<td>
                	<label>User Type:</label>
                </td>
            	<td>
                	<select name="user_type" style="width:150px;">
                    	<?php
							$rs = getResultSet("SELECT * FROM tbl_user_level WHERE level_id > 1 ORDER BY level_id DESC");
							while($r = mysql_fetch_array($rs)){
								echo '<option value="' . $r['level_id'] . '">' . $r['level_name'] . '</option>';
							}
						?>
                    </select>
                </td>
            </tr>

            <tr>
            	<td colspan="2" align="right">
                <div>
               		<div style="display:inline;height:40px;float:none;">
                    	<input type="reset" value="Clear" style="height:30px;width:75px;" />
                    </div>
                    <div style="display:inline;height:40px;float:none;">
                    	<input type="submit" value="Sign Up" id="register" style="height:30px;width:75px;"/>
                    </div>
                </div>
                </td>
            </tr>
        </table>
        </form>
    </div>
<!--</div>-->
</center>
<!--</div>-->
</div>