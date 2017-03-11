<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start();
	}

	if(!isset($_SESSION['_user_13_5_2011_id'])){
		$_SESSION['_cur_Page'] = "home";
		header("location:?mangoparam=login");
	}
	else{
		$u_id = $_SESSION['_user_13_5_2011_id'];
		$u_level = getValue("SELECT level_id FROM tbl_users WHERE user_id = " . $u_id);
		if($u_level > 2){
			header("location:?mangoparam=home");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<body onload="init_add();">
 <center>
 <table border="0" width="1000" bgcolor="#FFFFFF" align="center" cellpadding="0" cellspacing="0">

    <tr valign="top" height="30">
    	<td align="center">
        	<div class="mango_bar">Hotel Management </div>
    	</td>
    </tr>

   <tr valign="top"><td>
		<?php
		    $add_goto_hotel_page = false;
			$hotel_id = 0;
			if(isset($_SESSION['added_hotel_id'])){
				$add_goto_hotel_page = true;
				$hotel_id=$_SESSION['added_hotel_id'];
			}
            echo $hotel_id;


            if(isset($_GET['menu'])){
				$menu = $_GET['menu'];
                $menu = 1;
				switch($menu){
					case 1:
						$page="add_newhotel";
					 break;
					case 2:
						$page="add_facilities";
					 break;
					case 3:
						$page="add_sports_recreation";
					 break;
					case 4:
						$page="";
					 break;
					case 5:
						$page="upload_photos";
					 break;
					default:
						$page="";
					 break;
				}


		?>
        <center>
        		<table border="0" align="center"><tr><td align="center">
                    <div>
                        <ul class="add_menu">
                           <?php
                                /*
						   		echo "<li class='rightborder'";
								if($menu==1) echo " id='current'><a href='#'>";
								else echo "><a href='?mangoparam=add_hotel&menu=1' onclick='return check_add_hotel(" . $hotel_id . ")'>";
								if($add_goto_hotel_page == true)echo "Add New Hotel</a></li>";
								else echo "Hotel Infomation</a></li>";


								echo "<li class='rightborder'";
								if($menu==2) echo " id='current'><a href='#'>";
								else echo "><a href='?mangoparam=add_hotel&menu=2'>";
								echo "Hotel Facilities</a></li>";



								echo "<li class='rightborder'";
								if($menu==3) echo " id='current'><a href='#'>";
								else echo "><a href='?mangoparam=add_hotel&menu=3'>";
								echo "Sport and Recreation</a></li>";
                                */

								/*echo "<li";
								if($menu==4) echo " id='current'><a href='#'>";
								else echo "><a href='?mangoparam=add_hotel&menu=4'>";
								echo "Accessibilities</a></li>";*/

                                /*
								echo "<li class='noborder'";
								if($menu==5) echo " id='current'><a href='#'>";
								else echo "><a href='?mangoparam=add_hotel&menu=5'>";
								echo "Upload Photos</a></li>";
                                */

								/*(echo "<li style='border-right:none;'";
								if($menu==6) echo " id='current'><a href='#'>";
								else echo "><a href='?mangoparam=add_hotel&menu=6'>";
								echo "Manage Hotel</a></li>";*/

								if($add_goto_hotel_page == true){
                                    echo "<li class='rightborder'";
    								if($menu==1) echo " id='current'><a href='#'>";
    								else echo "><a href='?mangoparam=add_hotel&menu=1' onclick='return check_add_hotel(" . $hotel_id . ")'>";
    								if($add_goto_hotel_page == true)echo "Add New Hotel</a></li>";
    								else echo "Hotel Infomation</a></li>";


									echo "<li class='leftborder'><a href='?mangoparam=detail&id=" . $hotel_id . "'>";
									//else echo "><a href='?mangoparam=add_hotel&menu=5'>";
									echo "Goto Detail Page</a></li>";
								}
						   ?>
                        </ul>
                    </div>
                </td></tr></table>

        <?php
				if($page == ""){
					header("location:?mangoparam=home");
				}

				require("php_sub/". $page.".php");
			}
        ?>
        </center>

  <!-- 	hotel_id	city	hotel_name	images	description	star	address	contact	rate	review -->
  <?php  ?>







</td></tr><tr height="20"><td>
  <?php	 // include("footer.php");  ?>
<!-- **** Close The First Table**** -->
</td></tr></table>

</center>

<br/>
</body>
</html>
<?php // mysql_close($o_conn); ?>