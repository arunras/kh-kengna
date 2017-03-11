<?php

require_once("../../connection/connection.php");
require_once("../../module/module.php");
require_once("summary_review.class.php");
require_once("hotel_facebook.class.php");

class hotel_review{

    protected $hotel_id;
    protected $css_path;
    protected $js_path;

    private $summary_review;
    private $hotel_facebook;

    function __construct(){
        $this->summary_review = new summary_review;
        $this->hotel_facebook = new hotel_facebook;
    }

    public function set_hotel_id($id){
        $this->hotel_id = $id;

        $this->summary_review->set_hotel_id($id);
        $this->hotel_facebook->set_hotel_id($id);
    }

    public function set_css_path($path){
        $this->css_path = $path;
    }

    public function set_js_path($path){
        $this->js_path = $path;
    }

    public function id(){
        return $this->hotel_id;
    }

    public function draw_review(){
        //call for css
        echo '
            <link rel="stylesheet" type="text/css" href="' . $this->css_path . '"/>
            <script type="text/javascript" src="' . $this->js_path . '"></script>
        ';
        //design html
        $hotel_name = getValue("SELECT hotel_name FROM tbl_hotels WHERE hotel_id = " . $this->hotel_id);
        echo '<div class="hotel_review" id="hotel_review">';

        $this->summary_review->draw_summary_review();

        echo '<div style="display:table-cell;"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';

        echo '
            <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
            <!-- Place this tag where you want the +1 button to render -->
            <g:plusone size="medium"></g:plusone>';

        $this->hotel_facebook->draw_like();
        $this->hotel_facebook->draw_find();


        echo '</div>';
    }

}

?>