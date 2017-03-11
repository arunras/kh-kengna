<?php
	ob_start();
	if(!isset($_SESSION))
	{
		session_start();
	}


	/*---- parameters for showing filtering address : country-privince/city-district-commune.*/

	// coutnry is for next version
	$countries_select_option = '';
	/*$countries_rs = getResultSet("SELECT country_name,country_id FROM tbl_countries");
	if(mysql_num_rows($countries_rs) == 0){
		$countries_select_option = '';
	}
	else{
		//
		$countries_select_option = '
			<div style="display:inline;">
			<div id="button" class="menu">
				Choose country<img src="app_images/arrow.png" />
			</div>
			<ul class="the_menu">';
		$i=0;
		while($countries = mysql_fetch_array($countries_rs)){
			$i++;
			$countries_select_option .= '<li><a class="menu" href="">';
			$countries_select_option .= $countries['country_name'];
			$countries_select_option .= '</a></li>';
		}
		$countries_select_option .= '</ul></div>';
	}*/

	$cities_select_option = "";


	/*$cities_rs = getResultSet("SELECT city_name,city_id FROM tbl_cities");
	if(mysql_num_rows($cities_rs) == 0){
		$cities_select_option = '';
	}
	else{
		//
		$cities_select_option = '
			<div style="display:inline;">
			<div id="cities" class="menu button">
				Choose City/Province<img src="app_images/arrow.png" />
			</div>
			<ul id="cities" class="the_menu">';
		$i=0;
		while($cities = mysql_fetch_array($cities_rs)){
			$i++;
			$cities_select_option .= '<li><a id="' . $cities['city_id'] . '" class="menu">';
			$cities_select_option .= $cities['city_name'];
			$cities_select_option .= '</a></li>';
		}
		$cities_select_option .= '</ul></div>';
	}*/


	/* ----------- session for user id: _user_13_5_2011_email------------------*/
	if(isset($_SESSION['_user_13_5_2011_id'])){
		/*-------------  show_my_account : parameter to check whether user is logged in or not
				in or der to know that view the "my account" menu or not"
		 --------------*/
		$show_my_account = true;
		$user_id = $_SESSION['_user_13_5_2011_id'];
		$user_type = getValue("SELECT level_id FROM tbl_users WHERE user_id =" . $user_id);
		$user_type = getValue("SELECT level_name FROM tbl_user_level WHERE level_id = " . $user_type);
	}
	else{
		$show_my_account = false;
		$user_type = "";
	}
?>


<script language="javascript" type="text/javascript">
	function hideme(){
	$('#over_image').hide(100);
}
</script>
    	<div id="float_top">
        	<div class="menu_left">
            	<table>
                <tr valign="top">
                <td>
            	<a href="?mangoparam=index" class="menu" style="border-right:solid 1px #919090;display:inline;">
                	<img src="app_images/home.gif" align="top" height="20"/>
                </a>
                </td>
                <!--<a class="menu" style="cursor:pointer;">-->
                <td>
                <?php
					//determine whether show country
					if($countries_select_option != ''){
						echo $countries_select_option;
					}
				?>
                </td>
                <td>
				<?php
					if($cities_select_option != ''){
						echo $cities_select_option;
					}
				?>
                <!--</a>-->
                </td>
                </tr></table>
            </div>


        	<div class="menu_right">
            	<table><tr><td>
            	<?php
				  	if(strcmp(strtoupper($user_type),"ADMINISTRATOR") == 0 ){
				?>
                	<a class="menu" href="?mangoparam=admin_main">Administrator</a>
                <?php
					}
				?>


                <?php
					if($show_my_account){
				?>
               	<a class="menu" href="?mangoparam=profile&id=<?php echo $user_id; ?>">My Account</a>
				<?php
					}
				?>

                <?php
					if(!$show_my_account){
				?>
               	<a class="menu" href="?mangoparam=login">Sign In</a>
                <a class="menu" href="?mangoparam=register">Register</a>
				<?php
					}
				?>


                <?php
					if($show_my_account){
				?>
               	<a class="menu" href="?mangoparam=util_logout">Sign Out</a>
				<?php
					}
				?>
              <!--
                <span style="padding:0;float:right;"><fb:login-button autologoutlink="true"></fb:login-button></span>
                    <p><fb:like></fb:like></p>
              -->
              <!--
                <div id="fb-root"></div>
                <script>
                  window.fbAsyncInit = function() {
                    FB.init({appId: '240539029302555', status: true, cookie: true,
                             xfbml: true});
                  };
                  (function() {
                    var e = document.createElement('script');
                    e.type = 'text/javascript';
                    e.src = document.location.protocol +
                      '//connect.facebook.net/en_GB/all.js';
                    e.async = true;
                    document.getElementById('fb-root').appendChild(e);
                  }());
                </script>
               -->
                </td></tr></table>
            </div>

        </div>