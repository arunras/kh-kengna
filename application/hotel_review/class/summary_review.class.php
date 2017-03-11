<?php

    class summary_review{
        protected $hotel_id;
        protected $css_path = "";
        protected $js_path  = "";

        public function set_hotel_id($id){
            $this->hotel_id = $id;
        }

        public function draw_summary_review(){
            if($this->css_path != ""){
                echo '<link rel="stylesheet" type="text/css" href="' . $this->css_path . '"/>';
            }
                echo '
                    <div class="summary_review" style="margin-right:15px;">
                        <div class="summary_value">
                            <div class="value"> ' . $this->summary_value() . ' </div>
                            <div class="begin"></div>
                        </div>
                        <div class="title">
                            <div class="summary_logo"></div>
                            <div class="caption">Review</div>
                        </div>
                    </div>
                ';
        }

        protected function summary_value(){
            $rate  = getValue("SELECT SUM(hotel_rate_value) FROM tbl_write_review WHERE hotel_id = " . $this->hotel_id);
            $count = getValue("SELECT COUNT(*) FROM tbl_write_review WHERE hotel_id = " . $this->hotel_id);
            if($count == "0") return 0;
            else return $rate/$count;
        }

    }
?>