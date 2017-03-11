 <script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript" src="jquery/jquery.ui.js"></script>
	<script type="text/javascript" src="jquery/jquery.asmselect.js"></script>




	<script type="text/javascript">

		$(document).ready(function() {

			$("#cities").asmSelect({
				animate: true,
				highlight: true,
				sortable: true
			});

			$("#add_amenities_btn").click(function() {

				var amenities = $("#add_amenities").val();
				var $option = $("<option></option>").text(amenities).attr("selected", true); 

				$("#cities").append($option).change();
				$("#add_amenities").val('');

				return false; 
			}); 
			
		}); 

	</script>

    
    	<link rel="stylesheet" type="text/css" href="css/jquery.asmselect.css" />
	<link rel="stylesheet" type="text/css" href="css/example.css" />


</head>

<body>



 <table border="0" width="1000" bgcolor="#FFFFFF" height="800" align="center" cellpadding="0" cellspacing="0">
    <tr valign="top" height="150"><td>
   
        <?php	 include("banner.html");  ?>
    
    </td></td>
         
         <tr valign="top" height="30"><td>
            <table border="0" cellpadding="0" cellspacing="0" background="../images/app_login.jpg">
            <tr><td width="900">
            <div class="Path"> You are in : <a href="home.php" title="back to admin page"> Home </a> &nbsp;&nbsp;>>&nbsp;
			Hotel Managerment Page 
	        </div>  
            </td></tr></table>
    </td></tr>
    
   <tr valign="top"><td>
   
   <br/>	
 
 
   
   
<table border="0" width="770" align="center"><tr><td>
	<div id="menu">
		<ul>
			<li><a href="hotel_add.php">     Add New Hotel     </a></li>
			<li><a href="add_facilities.php">     Hotel Facilities     </a></li>
			<li id="current"><a href="#">     Room and Amenities    </a></li>
			<li><a href="add_sports_recreation.php">     Sports and Recreation      </a></li>
            <li><a href="add_upload_photo.php"> Upload Photo </a></li>
            <li><a href="add_manage.php"> Manage Hotel </a></li>
			
		</ul>		
	</div>
    					
</td></tr><tr><td>

	<br/><br/>

	
	

	<form action="submit_db_faci.php" method="post">

		<label for="cities">What is Room and Amenities</label>
        
        <br/>
         <input type="hidden" value="room_amenity" name="hiden_paramet" />
		<select id="cities" multiple="multiple" name="cities[]" title="Please Choose Room and Amenities">
        
                       <option>hair dryer</option>
                       <option>mini bar</option>
                       <option>daily newspaper</option>
                       <option>DVD/CD player</option>
                       <option>kitchenette</option>
                       <option>microwave</option>
                       <option>ironing board</option>
                       <option>water sports (motorized)</option>
                       <option >television LCD/plasma screens</option>
                        <option>jacuzzi bathtub</option>
                        
                        <option selected="selected">air conditioning</option>
                        <option selected="selected">fan</option>
                        <option selected="selected">balcony/terrace</option>
                        <option selected="selected">coffee/tea maker</option>
                        <option selected="selected">complimentary bottled water</option>
                        <option selected="selected">desk</option>
                        <option selected="selected">refrigerator</option>
                        <option selected="selected">satellite/cable TV</option>
                        <option selected="selected">inhouse movies</option>
                        <option selected="selected">television</option>
                        <option selected="selected">bathrobes</option>
                        <option selected="selected">bathtub</option>
                        <option selected="selected">shower</option> 
                       
                       </select>
        
    <p align="center"><input type="submit" name="submit" value="Submit to Database" /></p>
	
		<p><em>You may click and drag cities to order of preference.</em></p>

	</form>

	<p>
		<label for="add_amenities">add more Room and Amenities ?</label>
		<input type="text" id="add_amenities" value="" />
		<button type="button" id="add_amenities_btn" href="#">add</button>
	</p>

  
  </td></tr></table>
  
      
</td></tr><tr height="20"><td>
  <?php	 // include("footer.php");  ?>
<!-- **** Close The First Table**** -->
</td></tr></table>

<br/>                            
<?php // mysql_close($o_conn); ?>