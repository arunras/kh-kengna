<link type="text/css" rel="stylesheet" href="app_plugin/popup_form/css/frm_addroom.css" />
<!--
<link href="app_plugin/popup_form/css/general.css" type="text/css" rel="stylesheet" media="screen">
-->
<!--
<script type="text/javascript" src="app_plugin/popup_form/js/jquery-latest.pack.js"></script>
-->
<script type="text/javascript" src="app_plugin/popup_form/js/popup.js"></script>
<script type="text/javascript" src="app_plugin/popup_form/js/validation.js"></script>
<script type="text/javascript" src="app_plugin/popup_form/js/validation1.js"></script>



<div id="room_wrapper">
	<div id="roomtype_title" style="margin-bottom: 3px;">
    	<img src="app_images/cat_room_type.png" />
        <p> Room Type 
            <a href="#dialog1" class="room_caption" name="modal">Add New</a>
            <!--
            <a href="#dialog2" class="room_caption" name="modal">| Edit</a>
            -->
            <!--
            <a href="<?php //echo "http:/o/".DOMAIN.ROOT.'/php_sub/run_room_form.php'; ?>">Add New</a>
            -->
        </p>    
	</div>			 

<?php
	$hotel_id = $_GET['id'];
	$q_room =getResultSet("SELECT hotel_id, room_id, room_name, room_description, room_photo FROM tbl_room_hotel 
					WHERE hotel_id=".$hotel_id);
	//$room_id_edit=array();	
	//$count_r =0;
	while($rr = mysql_fetch_array($q_room))
	{
		$room_id = $rr['room_id'];
		$room_name = $rr['room_name'];
		$room_descripion = $rr['room_description'];
		$room_photo = $rr['room_photo'];
		$room_photo = substr($room_photo, 3);//from left
		
		echo '<div id="room">';
			echo '<img src="'.$room_photo.'" />';
		echo '<div id="room_title">';
		echo '<p id="room_name_of_'.$room_id.'">'.$room_name.'</p>';
		echo '</div>';
		
		echo '<div id="room_feature">';
		echo '<h3 style="margin: 0px 0px 0px 0px; padding: 2px 2px 2px 0px;">Room Feature</h3>';
		echo '<ul id="room_feature_of_'.$room_id.'">';
		
		$q_feature = getResultSet("SELECT feature_id FROM tbl_room_hotel_feature 
								WHERE room_id=".$room_id);
		
		while($rf = mysql_fetch_array($q_feature))
		{
			$feature_id = $rf['feature_id'];
			$get_feature = getValue("SELECT feature_name FROM tbl_room_feature WHERE feature_id=".$feature_id);							
			//echo '<span style="float: left;">&diams;&nbsp; </span>';
			echo '<li>';
				echo '&diams; '. $get_feature;
				//echo $get_feature;
			echo '</li>';
			echo '<br/>';
			
		}
		echo '</ul>';
		echo '</div>';
		
		echo '<p id="room_desc_of_'.$room_id.'" class="room_description">';//id="room_description">';	
			echo $room_descripion;
		echo '</p>';
		echo ' <a href="#dialog2" name="modal" tabindex="'.$room_id.'" title="'.'Update Room Information'.'" style="margin-left: 5px; font-size: 10px;">Edit</a>';
		echo '</div>';
		//$room_id_edit[$count_r]=$rr['room_id'];
		//echo "Room".$count_r."=".$room_id_edit[$count_r];
		//$count_r++;
	}
?>  
</div>

<!--===Popup Form Add Room===========================================================================================================--->
<div id="boxes">
<!-- Start of Login Dialog -->  
<div id="dialog1" class="window">

	<h1 style="font-weight:bold; margin: 5px 0px 10px 0px;padding: 2px 0px 7px 0px; text-align:center; color:#09F; border-bottom: 1px #CCC solid;"><!-- background-color:rgba(200, 200, 200, 0.15);">-->
    	Add Room Information
    </h1>
    <!--
	<a href="#"class="close"/>Close it</a><br/>
    --> 
  <Form action="php_sub/run_room_add.php" id="form_addroom" name="form_addroom" method="post" enctype="multipart/form-data">  
  <div class="d-header">   
  				<input type="hidden" name="hotel_id" value="<?php echo $_GET['id']; ?>" />
  	<table border=0 class="textbox">
    	<tr>
        	<td align="right">Room Type:</td>
            <td align="left">
            	<input type="text" name="room_name" id="room_name" value=""/> <!-- onfocus="this.value=''"-->
                
                <span id="nameInfo">name?</span>
                
            </td>
        </tr>
        
        <tr>
        	<td aligh="right">Descripton:</td>
            <td align="left">
            	<input type="text" name="room_desc" id="room_desc" value="" /> <!--onfocus="this.value=''"-->
                <span id="messageInfo"></span>
                <!--
                <textarea name="room_description" id="room_description" value="description" onfocus="this.value=''" cols="" rows=""></textarea>
                -->
            </td>
        </tr>
        
        <tr>
        	<td align="right">Photo:</td>
            <td align="left">
            	<input type="file" name="rphoto" id="rphoto" value="file"  style="border:none; color: #CCC;"/>
                <span id="photoInfo"></span>
            </td>
        </tr>
    </table>
    
  </div>
  <!--
  <div class="d-blank"></div>
  -->
  <p style="text-align: left; font-size: 20px; margin: 10px 0px 10px 0px;">
	Room Feature: 
  </p>
  
  
  
  <table id="feature" border="1" style="margin-left: 5px; text-align:left; border: 1px solid rgba(200, 200, 200, 0.05);" width="380px">    
        <?php
			$sql_feature="SELECT * FROM tbl_room_feature";
			$q_featues = getResultSet($sql_feature);
			$count_f=0;
			while($rf = mysql_fetch_array($q_featues))
			{
				$feature_id = $rf['feature_id'];
				$feature = $rf['feature_name'];
				if($count_f%2==0)
					{
							echo '<tr>';				
					}
							echo '<td>';
							
								echo '<input type="checkbox" name="feature[]" id="feature" value="'.$feature_id.'" style="width: 20px;" />';
								//echo '<span onClick="document.form_addroom.id['.$feature_id.'].checked=(! document.form_addroom.id['.$feature_id.'].checked);">'.$feature.'</span>';		
								echo '<span>'.$feature.'</span>';		
							echo '</td>';
				$count_f++; 
			}
		?>
   	</table>    
    <!--
  	<input type="submit" name="submit" value="Add Room" style="margin-left:300px;"/>
    -->
    <br />
    <input type="submit" class="btn_save" name="save"  value="Save Room" style="margin-left:215px;" />
    <input type="button" value="Close" class="close" id="btn_close"/>
  </Form>



  <!--
  <div class="d-login"><input type="image" alt="Login" title="Login" src="images/login-button.png"/></div>
  -->
  	  
</div>
<!-- End of Login Dialog -->  


<!-- Mask to cover the whole screen -->
  <div id="mask"></div>
</div>
<!--===Popup Form===========================================================================================================--->





<!--===Popup Form Edit Room===========================================================================================================--->
<div id="boxes">
<!-- Start of Login Dialog -->  

<div id="dialog2" class="window">
    <h1 style="font-weight:bold; margin: 5px 0px 10px 0px;padding: 2px 0px 7px 0px; text-align:center; color:#09F; border-bottom: 1px #CCC solid;"><!-- background-color:rgba(200, 200, 200, 0.15);">-->
    	Edit Room Information
    </h1>
    
    <!--
	<a href="#"class="close"/>Close it</a><br/>
    --> 
  <Form action="php_sub/run_room_edit.php" id="form_editroom" name="form_editroom" method="post" enctype="multipart/form-data">  
  <div class="d-header">   
  				<input type="hidden" name="hotel_id" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" name="room_id1" id="room_id1" value="<?php echo $room_id_edit; ?>" />
  	<table border=0 class="textbox">
    	<tr>
        	<td align="right">Room Type:</td>
            <td align="left">
            	<?php	
					//echo "ROOM= ". $room_id_edit[0];
					//$q_room_name = getValue("SELECT room_name, room_description FROM tbl_room_hotel WHERE hotel=".$hotel_id);<br />

					$q_room_name = getValue("SELECT room_name FROM tbl_room_hotel WHERE hotel_id=".$hotel_id); //"room_id=".;
					echo '<input type="text" name="room_name1" id="room_name1" value="'.$q_room_name.'"/>';
				?>
                <!--
            	<input type="text" name="room_name1" id="room_name1" value=""/> <!-- onfocus="this.value=''"--
                -->
                
                <span id="nameInfo1">name?</span>
                
            </td>
        </tr>
        
        <tr>
        	<td aligh="right">Descripton:</td>
            <td align="left">
            	<?php 
					$q_room_desc = getValue("SELECT room_description FROM tbl_room_hotel WHERE hotel_id=".$hotel_id);
					echo '<input type="text" name="room_desc1" id="room_desc1" value="'.$q_room_desc.'" />';
				?>
                <!--
            	<input type="text" name="room_desc1" id="room_desc1" value="" /> <!--onfocus="this.value=''"--
                -->
                <span id="messageInfo1"></span>
                <!--
                <textarea name="room_description" id="room_description" value="description" onfocus="this.value=''" cols="" rows=""></textarea>
                -->
            </td>
        </tr>
        
        <tr>
        	<td align="right">Photo:</td>
            <td align="left">
            	<input type="file" name="rphoto1" id="rphoto1" value="file"  style="border:none; color: #CCC;"/>
                <span id="photoInfo1"></span>
            </td>
        </tr>
    </table>
    
  </div>
  <!--
  <div class="d-blank"></div>
  -->
  <p style="text-align: left; font-size: 20px; margin: 10px 0px 10px 0px;">
	Room Feature: 
  </p>
  
  
  
  <table id="feature1" border="1" style="margin-left: 5px; text-align:left; border: 1px solid rgba(200, 200, 200, 0.05);" width="380px">    
        <?php
			$sql_feature="SELECT * FROM tbl_room_feature";
			
			$q_room_id = getValue("SELECT room_id FROM tbl_room_hotel WHERE hotel_id=". $hotel_id);
			if(!$q_room_id){
				$q_room_id=1;
			}
			echo '<input type="hidden" name="room_id1" value="'.$q_room_id.'" />';
			
			//$q_feature_id = getValue("SELECT feature_id FROM tbl_room_hotel_feature WHERE room_id=".$q_room_id);
			$q_featues = getResultSet($sql_feature);
			
			$count_f=0;
			while($rf = mysql_fetch_array($q_featues))
			{
				$feature_id = $rf['feature_id'];
				$feature = $rf['feature_name'];
				if($count_f%2==0)
					{
							echo '<tr>';				
					}
							echo '<td>';
							$q_feature_id = getValue("SELECT feature_id FROM tbl_room_hotel_feature WHERE room_id=".$q_room_id." AND feature_id=".$feature_id);
							
							if(true)
							{
								echo '<input type="checkbox" name="feature1[]" id="' . $feature . '" value="'.$feature_id.'"  style="width: 20px;">';
								//echo '<span onClick="document.form_addroom.id['.$feature_id.'].checked=(! document.form_addroom.id['.$feature_id.'].checked);">'.$feature.'</span>';		
								echo '<span>'.$feature.'</span>';		
								echo '</input>';
							}
							else{
								echo '<input type="checkbox" name="feature1[]" id="feature1" value="'.$feature_id.'" style="width: 20px;" />';
								//echo '<span onClick="document.form_addroom.id['.$feature_id.'].checked=(! document.form_addroom.id['.$feature_id.'].checked);">'.$feature.'</span>';		
								echo '<span>'.$feature.'</span>';	
								echo '</input>';	
							}
								
							echo '</td>';
				$count_f++; 
			}
		?>
   	</table>    
    <!--
  	<input type="submit" name="submit" value="Add Room" style="margin-left:300px;"/>
    -->
    <br />
    <input type="submit" class="btn_save" name="save"  value="Save Room" style="margin-left:215px;" />
    <input type="button" value="Close" class="close" id="btn_close"/>
  </Form>



  <!--
  <div class="d-login"><input type="image" alt="Login" title="Login" src="images/login-button.png"/></div>
  -->	  
</div>
<!-- End of Login Dialog -->  


<!-- Mask to cover the whole screen -->
  <div id="mask"></div>
</div>
<!--===Popup Form Edit Room===========================================================================================================--->








