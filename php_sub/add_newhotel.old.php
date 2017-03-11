<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}
	$hotel_id=0;
	//unset($_SESSION['added_hotel_id']);
	if(isset($_SESSION['added_hotel_id'])){		
		$hotel_id = $_SESSION['added_hotel_id'];
		$hotel_name = "";
		$hotel_description = "";
		$hotel_star = "";
		$hotel_city = "";
		$hotel_khan = "";
		$hotel_sangkat = "";
		$hotel_address = "";
		$hotel_country = "";
		
		$rs = getResultSet("SELECT hotel_name,hotel_description,hotel_star,hotel_city,hotel_khan,hotel_sangkat,hotel_address,hotel_country
							FROM tbl_hotels 
							WHERE hotel_id=" . $hotel_id);
		while($r=mysql_fetch_array($rs)){
			$hotel_name = $r[0];
			$hotel_description = $r[1];
			$hotel_star = $r[2];
			$hotel_city = $r[3];
			$hotel_khan = $r[4];
			$hotel_sangkat = $r[5];
			$hotel_address = $r[6];
			$hotel_country = $r[7];
		}
	}
?>
	<div id="container">
        <form action="php_ajax/db_save_hotel.php" method="post">
	
            <!-- #first_step -->
            <div id="first_step">
                <h1><span> Hotel </span> Basic Information</h1>

                <div class="form">
                <table border=0><tr>
 	               	<!-- hotel name -->

                    <td><input type="text" name="hotel" id="hotel" value="<?php if($hotel_id != 0) echo $hotel_name; else echo "Hotel Name"; ?>" /></td>
                    <td><label for="hotel_Name">At least 3 characters. Uppercase letters, lowercase letters and numbers only.</label></td>
                    </tr>
                    
                    <tr>
                    <!-- hotel address -->
                    <td><input type="text" name="address" id="address" value="<?php if($hotel_id != 0) echo $hotel_address; else echo "Address";  ?>" /></td>
                    <td><label for="address">Address or location </label></td>
                    </tr>
                    
                    <!-- hotel description -->
                    <tr>
                    <td><textarea id="description" name="description" rows="5" cols="27"><?php if($hotel_id != 0) echo $hotel_description;  ?>
                    </textarea>
                    <!--<input type="text" name="description" id="description" value="Description" />-->
                    </td>
                    <td><label for="description">Hotel description. </label></td>
                    </tr>
                    
                    <tr>
                    <!-- hotel star -->
                    <td>
                    <select id="star" name="star">
                       <option value="error_star">-- Please choose Star --</option>
                       <?php
					   		for($i=5;$i>=0;$i--)
							{								
								echo '<option value="' . $i . '"';
								if($hotel_id != 0)if($i == $hotel_star) echo ' selected="selected"';
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
                		<option value="error_city">-- Please choose city --</option>
              
                  		<?php 							
							/* ----------- get value of city --------*/
							$rs = getResultSet("SELECT * FROM tbl_cities");
							while($r = mysql_fetch_array($rs)){
								echo "<option value=" . $r['city_id'];
								if($hotel_id != 0) if($r['city_id'] == $hotel_city) echo ' selected="selected"';
								echo  ">" . $r['city_name'] . "</option>";
							}
						
						?>                                
                
                   	</select>
                    </td>
                
              		<td><label for="City">City </label></td> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    </tr>
                    
                    
                    <tr>
                    <!-- select the khan-->
                    <td>
                    <select id="khan" name="khan" onchange="ChangeSangkat()">
                		<option value="error_khan">-- Please choose khan/district --</option>
              
                  		<?php 							
							/* ----------- get value of khan --------*/
							$rs = getResultSet("SELECT * FROM tbl_khan");
							while($r = mysql_fetch_array($rs)){
								echo "<option value=" . $r['khan_id'];
								if($hotel_id != 0) if($r['khan_id'] == $hotel_khan) echo ' selected="selected"';
								echo  ">" . $r['khan_name'] . "</option>";
							}
						
						?>                                
                
                   	</select>
                    </td>
                
              		<td><label for="Khan">Khan or District </label></td> <!-- clearfix --><div class="clear"></div><!-- /clearfix --> 
                    </tr>
                    
                    <tr>
                    <!-- select the sangkat-->
                    <td><select id="sangkat" name="sangkat">
                		<option value="error_sangkat">-- Please choose sangkat/commune --</option>
              
                  		<?php 							
							/* ----------- get value of sangkat --------*/
							$rs = getResultSet("SELECT * FROM tbl_sangkat");
							while($r = mysql_fetch_array($rs)){
								echo "<option value=" . $r['sangkat_id'];
								if($hotel_id != 0)if($r['sangkat_id'] == $hotel_sangkat) echo ' selected="selected"';
								echo  ">" . $r['sangkat_name'] . "</option>";								
							}
						
						?>                                
                
                   	</select>
                    </td>
                
              		<td><label for="Khan">Sangkat or Commune</label></td> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
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
	//}
  ?>