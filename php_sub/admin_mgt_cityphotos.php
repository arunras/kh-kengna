<?php
    include("../connection/connection.php");
    include("../module/module.php");
    $city_id = $_GET['id'];

    $sql_    = "SELECT city_photo_id, city_photo, city_photo_description FROM tbl_city_photo WHERE city_id = " . $city_id;
    $city_rs = getResultSet($sql_);
    if(mysql_num_rows($city_rs) != 0){
?>

<center>
    <div id="page" class="city">
                <table>
                <tr><td valign="top">
                <div class="content">
			            <div class="slideshow-container">
                                <div id="controls_city" class="controls"></div>
                                <div id="loading_city" class="loader"></div>
                                <div id="slideshow_city" class="slideshow"></div>
                        </div>
                        <div id="caption_city" class="caption-container">
                                <div class="photo-index"></div>
                        </div>
                    </div>
                 </td>
                 <td valign="top">
                    <div id="container" style="display:inline;">
                        <!-- Start Advanced Gallery Html Containers -->
                        <div class="navigation-container">
                            <div id="thumbs_city" class="navigation">
                                <table height="240">
                                <tr><td height="20" align="center">
                                <a class="pageLink prev" style="visibility:hidden;" href="#" title="Previous Page">
                        	        <img src="app_images/prevPageArrow.gif" />
                                </a>
                                </td></tr>
                                <tr><td height="200" valign="top">
                                <ul class="thumbs noscript">
<?php
        while($photos = mysql_fetch_array($city_rs)){
?>

                                        <li>
                                        <a class="thumb" name="<?php echo $photos[0]; ?>"
                                            href="<?php echo $photos[1]; ?>" title="">
                                            <img src="<?php echo $photos[1]; ?>" alt=""
                                            class="thumbnail_photo"/>
                                        </a>
                                        <div class="caption">
        									<div class="image-title"></div>
        									<div class="image-desc"><?php echo $photos[2]; ?></div>
        									<div class="download">
        									</div>
        								</div>
                                        </li>
<?php
    }//end of while
?>
                                </ul>
                                </td></tr>
                                <tr><td height="20" align="center" valign="top">
                                <a class="pageLink next" style="visibility: hidden;clear:both;" href="#" title="Next Page">
                                    <img src="app_images/nextPageArrow.gif" />
                                </a>
                                </td></tr></table>
                            </div>
                            </div><!-- End Gallery Html Containers -->
                            <div style="clear: both;"></div>
			</div>

            </td></tr></table>
            </div>
            </center>
<?php
    }//end of if
    else{
        echo '<center><p><br /><br /><br /><br />No photos yet.</p></center>';
    }
?>
