<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}
	$hotel_id=0;
	$_SESSION['_cur_Page'] = $add_hotel_page;
	//unset($_SESSION['added_hotel_id']);

	if(isset($_SESSION['added_hotel_id'])){
		unset($_SESSION['added_hotel_id']);
		header("location:?mangoparam=add_hotel&menu=1");
?>
	<div id="container">
    	<div>
        </div>
    </div>
<?php
	}
	else{

		$url_city = "php_ajax/db_save_type_address.php?type=city&view=true";
		$url_khan = "php_ajax/db_save_type_address.php?type=khan&view=true";
		$url_sangkat = "php_ajax/db_save_type_address.php?type=sangkat&view=true";

?>
	<div class="sample_popup" id="popup_over" style="display: none;width:250px;">

                <div id="popup_drag_over" class="menu_form_header" style="width:250px;">
                <div id="title_over" style="display:inline;"></div>
                <img class="menu_form_exit" id="popup_exit_over" src="app_images/exit.gif" alt="" />
                </div>

                <div class="menu_form_body" id="form_content_over" style="width:250px;">

                </div>

    </div>
	<div id="container" style="height: 450px !important;">
        <form action="php_ajax/db_save_hotel.php" method="post">
            <!-- #first_step -->
            <div id="first_step">
                <h1><span> Hotel </span> Basic Information</h1>

                <div class="form">
                <table border=0><tr>
 	               	<!-- hotel name -->

                    <td><input type="text" name="hotel" id="hotel" value="Hotel Name" /></td>
                    <td width="200"><label for="hotel_Name">At least 3 characters. Uppercase letters, lowercase letters and numbers only.</label></td>
                    </tr>

                    <tr>
                    <!-- hotel address -->
                    <td><input type="text" name="address" id="address" value="Address"/></td>
                    <td><label for="address">Address or location </label></td>
                    </tr>

                    <!-- hotel description -->
                    <tr>
                    <td><textarea id="description" name="description" rows="1" cols="23"></textarea>
                    <!--<input type="text" name="description" id="description" value="Description" />-->
                    </td>
                    <td><label for="description">Hotel description. </label></td>
                    </tr>

                    <tr>
                    <!-- hotel star -->
                    <td align="left">
                    <select id="star" name="star">
                       <option value="error_star">-- Please choose Star --</option>
                       <?php
					   		for($i=5;$i>0;$i--)
							{
								echo '<option value="' . $i . '"';
								if($i > 0) echo '>' . $i . 'stars</option>';
								else echo '>Guest House</option>';
							}
					   ?>
                    </select>
                    </td>
                    <td><label for="star">Give hotel star or class </label></td>
                    </tr>

                    <tr>
                    <td>
                    <!-- select the country -->
                    <input type="hidden" value="1" name="country" /> <!-- id=1 country = cambodia -->
                    <!--<select id="country" name="country" onchange="ChangeCity()">
                    	<option value="error_country">-- Please choose country --</option>-->
                        <?php
							/* ----------- get value of country --------*/
							/*$rs = getResultSet("SELECT * FROM tbl_countries");
							while($r = mysql_fetch_array($rs)){
								echo "<option value=" . $r['country_id'];
								if($hotel_id != 0) if($r['country_id'] == $hotel_country) echo ' selected="selected"';
								echo  ">" . $r['country_name'] . "</option>";
							}*/
						?>
                    <!--</select>-->
                    </td>
                    <td><!--<label for="Country">Country </label></td>-->
                    	 <!-- clearfix -->
                         <!--<div class="clear"></div>-->
                         <!-- /clearfix -->
                	</tr>

                    <tr>
                    <!-- select the city-->
                    <td>
                    <select id="city" name="city" onchange="ChangeKhan()">
                		<option value="0">-- City --</option>

                  		<?php
							/* ----------- get value of city --------*/
							$rs = getResultSet("SELECT * FROM tbl_cities");
							while($r = mysql_fetch_array($rs)){
								echo "<option value=" . $r['city_id'];
								echo  ">" . $r['city_name'] . "</option>";
							}

						?>

                   	</select>
                    </td>

              		<td><label for="City"><a href="#" onclick="popup_show('popup_over', 'form_content_over', 'title_over', 'popup_drag_over', 'popup_exit_over', 'screen-center',         0,   0, 'pos_bottom', 'Add New City', '<?php echo $url_city . "&up=1"; ?>')"> Add City</a></label>
                    </td> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    </tr>

                    <tr>
                    <!-- select the khan-->
                    <td>
                    <select id="khan" name="khan" onchange="ChangeSangkat()">
                		<option value="0">-- District --</option>

                  		<?php
							/* ----------- get value of khan --------*/
							$rs = getResultSet("SELECT * FROM tbl_khan");
							while($r = mysql_fetch_array($rs)){
								echo "<option value=" . $r['khan_id'];
								echo  ">" . $r['khan_name'] . "</option>";
							}

						?>

                   	</select>
                    </td>

              		<td><label for="Khan"><a href="#" onclick="popup_show('popup_over', 'form_content_over', 'title_over', 'popup_drag_over', 'popup_exit_over', 'screen-center',         0,   0, 'pos_bottom', 'Add New Khan', '<?php echo $url_khan . "&up="; ?>' + document.getElementById('city').value)">Add Khan or District</a> </label></td> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    </tr>

                    <tr>
                    <!-- select the sangkat-->
                    <td><select id="sangkat" name="sangkat">
                		<option value="0">-- Commune --</option>

                  		<?php
							/* ----------- get value of sangkat --------*/
							$rs = getResultSet("SELECT * FROM tbl_sangkat");
							while($r = mysql_fetch_array($rs)){
								echo "<option value=" . $r['sangkat_id'];
								echo  ">" . $r['sangkat_name'] . "</option>";
							}

						?>

                   	</select>
                    </td>

              		<td><label for="Khan"><a href="#" onclick="popup_show('popup_over', 'form_content_over', 'title_over', 'popup_drag_over', 'popup_exit_over', 'screen-center',         0,   0, 'pos_bottom', 'Add New Sangkat', '<?php echo $url_sangkat . "&up="; ?>' + document.getElementById('khan').value)">Add Sangkat or Commune</a></label></td> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    </tr>


                    <tr><td>
                    </td><td>
                    <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                	<input class="send submit" type="submit" name="submit_first" id="submit_first" value="" style="float:right;" />
                    </td></tr></table>
                </div>

            </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->



        </form>

	</div>

  	<?php
	//}
	//else{
	?>
<!--	<div id="container">
    	<br />
        <br />
    	<span>Hotel Registered Successfully.</span><br /> <span>Please go to other menu to edit.</span>
        <br />
        <span>Thank you</span>
    </div>-->
   <?php
	}
  ?>