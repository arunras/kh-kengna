<?php
    ob_start();
    if(!isset($_SESSION))session_start();


    if(isset($_GET['hotel_id'])){
        $hotel_id = $_GET['hotel_id'];
        include("../connection/connection.php");
        include("../module/module.php");
        $photos_rs = getResultSet("SELECT photo_path,photo_description,photo_id FROM tbl_photos WHERE hotel_id = " . $hotel_id);
    }
    else if(isset($_SESSION['viewing_hotel_id'])){
        include("../connection/connection.php");
        include("../module/module.php");
        $hotel_id = $_SESSION['viewing_hotel_id'];
        $photos_rs = getResultSet("SELECT photo_path,photo_description,photo_id FROM tbl_photos WHERE hotel_id = " . $hotel_id);
    }
    else {
      exit();
    }
    $view_photo = false;

    if(mysql_num_rows($photos_rs) == 0) $view_photo = false;
    else $view_photo = true;



    //get all the photos of hotel
    $num_photos = 0;
    if($view_photo){
    	while($p = mysql_fetch_array($photos_rs)){
    		$photos_path[$num_photos]  = $p[0];
    		$photos_title[$num_photos] = $p[1];
            $photos_id[$num_photos] = $p[2];
    		$num_photos++;
    	}
    }//end of getting photos

    $num_thumbnail_view = 5;
    $total_page = $num_photos / $num_thumbnail_view;
    $current_photo_page = 1;
?>

<div id="page" class="<?php if(!$view_photo) echo 'hide'; ?>">
                    <div class="content">
			            <div class="slideshow-container">
                                <div id="controls" class="controls"></div>
                                <div id="loading" class="loader"></div>
                                <div id="slideshow" class="slideshow"></div>
                        </div>
                        <div id="caption" class="caption-container">
                                <div class="photo-index"></div>
                        </div>
                    </div>

                    <div id="container">
                        <!-- Start Advanced Gallery Html Containers -->
                        <div class="navigation-container">
                            <div id="thumbs" class="navigation">
                                <a class="pageLink prev" style="visibility:hidden;" href="#" title="Previous Page">
                        	        <img src="app_images/prevPageArrow.gif" />
                                </a>
                                <ul class="thumbs noscript">
                                    <?php if(!$view_photo){ ?>
                                    <li id="no_image" class="hide" style="width:0;height:0;">
                                        <a class="thumb" name=""  style="width:0;height:0;"
                                            href="no_image" title="no_image">
                                            <img src="" alt=""   style="width:0;height:0"
                                            class="thumbnail_photo hide"/>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <?php
                                        for($i = 0; $i < $num_photos; $i++){
                                    ?>
                                        <li>
                                        <a class="thumb" name="<?php echo $photos_id[$i]; ?>"
                                            href="<?php echo $photos_path[$i]; ?>" title="<?php echo $photos_title[$i]; ?>">
                                            <img src="<?php echo $photos_path[$i]; ?>" alt="<?php echo $photos_title[$i]; ?>"
                                            class="thumbnail_photo"/>
                                        </a>
                                        <div class="caption">
        									<div class="image-title"></div>
        									<div class="image-desc"><?php echo $photos_title[$i]; ?></div>
        									<div class="download">
        									</div>
        								</div>
                                        </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                                <a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page">
                                    <img src="app_images/nextPageArrow.gif" vspace="17" />
                                </a>

                            </div>
                            </div><!-- End Gallery Html Containers -->
                            <div style="clear: both;"></div>
			</div>
		</div>