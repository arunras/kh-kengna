<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}
	$hotel_id=0;

	if(isset($_SESSION['added_hotel_id'])){
		$hotel_id = $_SESSION['added_hotel_id'];
		$sr = getValue("SELECT hotel_images FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
?>

<script language="javascript" type="text/javascript">
	function invisibleajax(){
		document.getElementById('loading_ajax').style.visibility="hidden";
	}
</script>


<body onload="invisibleajax()">
<div id="container" align="left">
    	<div class="profilepanel">
			<table>
            	<tr height="150">
                	<td align="center" width="150">
                    	<label>Hotel Profile Picture</label>
                    	<span id='profile'>
                    	<div class="profilepic">
                    	<img class="profilepic" src="<?php echo $sr ?>"/>
                        </div>
                        </span>
                    </td>
                    <td valign="bottom">
                    <div id="loading_ajax"><p align="center"><img src="app_images/loader.gif" /><br />Uploading.....</p></div>
                    <span class="error_text" id="sms"></span>
                    <form action="php_ajax/save_profile_pic.php" method="post" enctype="multipart/form-data" onSubmit="return check_profile_upload();" target="upload_target" >
                        <input type="hidden" value="2000000" name="MAX_FILE_SIZE" />
                        <input type="file" id="txtfile" name="txtfile" class="upload" style="width:200px; margin:0;"/>&nbsp;&nbsp;<input type="submit" value="" name="submit" class="upload submit" style="width:110px;"/>
                        <iframe id='upload_target' name='upload_target' src='#' style='width:0;height:0;border:0px solid #fff;'></iframe>
                    </form>
                    </td>
                </tr>
            </table>
        </div>
        <br />
	</div>
<?php
	}
	else{
 ?>
 <div id="container">
 	<div class="form">
 	<h2>Please add hotel first.</h2>
    </div>
 </div>
 
 <?php
	}
 ?>
 
 </body>