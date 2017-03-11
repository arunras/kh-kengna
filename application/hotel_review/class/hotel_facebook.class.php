<?php
    require_once("../../connection/connection.php");
    require_once("../../module/module.php");

    class hotel_facebook{
        protected $hotel_id;
        protected $php_path;

        public function set_hotel_id($id){
            $this->hotel_id = $id;
        }

        public function set_php_path($path){
            $this->php_path = $path;
        }

        public function draw_popup(){
            echo '
                <form action="' . $this->php_path . '?hotel_id=' . $this->hotel_id . '" method="post" target="upload_target">
                <table>
                <tr><td><label>www.facebook.com/</label><input type="text" value="' . $this->get_hotel_facebook() . '" name="txt_facebook" /></td></tr>
                <tr><td align="right"><input type="submit" name="submit_facebook_profile" value="Save" />
                <input type="button" value="Cancel" onclick="close_form()" /></td></tr></table>
                </form>
                <iframe style="display:none;" name="upload_target" id="upload_target"></iframe>
            ';
        }

        public function save_facebook(){
            $new_url = $_POST['txt_facebook'];
            runSQL("UPDATE tbl_hotels SET hotel_facebook = '" . $new_url  . "' WHERE hotel_id = " . $this->hotel_id);
            ?>
            <script language="javascript">window.top.window.saved_facebook("<?php echo $new_url; ?>")</script>
            <?php
        }

        public function draw_find(){
            $hotel_name = getValue("SELECT hotel_name FROM tbl_hotels WHERE hotel_id = " . $this->hotel_id);
            echo '<a id="find_on_facebook" href="http://www.facebook.com/' . $this->get_hotel_facebook() . '" style="display:table-cell;" class="facebook_profile"><div class="first"></div><div class="center"><span class="text">' . $hotel_name . '</span></div><div class="end"></div></a>';
        }

        public function draw_like(){
            if($this->get_hotel_facebook() == "")$url_for_box = $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
            else $url_for_box = $this->get_hotel_facebook();

            echo '<div style="display:table-cell;"><iframe src="http://www.facebook.com/plugins/like.php?app_id=174841709252599&amp;href=' . $url_for_box . '&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe></div>';
        }

        public function get_hotel_facebook(){
            return getValue("SELECT hotel_facebook FROM tbl_hotels WHERE hotel_id = " . $this->hotel_id);
        }
    }
?>