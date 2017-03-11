<?php
    require_once("../../connection/connection.php");
    require_once("../../module/module.php");

    class payment_method{
        private $id;
        private $name;
        private $icon_path;
        private $active;

        private $php_path;
        private $js_path;

        public function set_php_path($path){
            $this->php_path = $path;
        }
        public function set_js_path($path){
            $this->js_path = $path;
        }

        public function set($id){
            $this->id = $id;
            $this->name = getValue("SELECT payment_name FROM tbl_payments WHERE payment_id = " . $id);
        }

        public function insert($name, $path=""){
            if($path == "") runSQL("INSERT INTO tbl_payments(payment_name) VALUES('" . $name . "')");
            else runSQL("INSERT INTO tbl_payments(payment_name, payment_icon) VALUES('" . $name . "', '" . $path . "')");
            $this->id = mysql_insert_id();
        }

        public function update_name($name){
            runSQL("UPDATE tbl_payments SET payment_name = '" . $name . "'");
        }

        public function update_icon($file_id){
            $destination_path = "../../data_images/payment/" . $this->id;
            $result=upload($file_id,$destination_path, "");
            $file_name = $_FILES[$file_id]['name'];

            $tem=explode(";",$result);
            $result=$tem[0];
            $target_path=$tem[1];
            if($result=="0"){
              $target_path=substr($target_path,3,strlen($target_path));
              runSQL("UPDATE tbl_payments SET payment_icon = '" . "data_images/payment/" . $this->id . "/" . $file_name . "' WHERE payment_id = " . $this->id);
              //$photo_id = getValue("SELECT photo_id FROM tbl_photos WHERE hotel_id = " . $hotel_id . " AND photo_path = '" . $target_path . "'");
            ?>
                <script language="javascript">
                    window.top.window.save_payment();
                </script>
            <?php
            }
            else{
                echo "Uploaded fail.";
            }

        }

        public function get_id($name="")
        {
            if($name != "") return getValue("SELECT payment_id FROM tbl_payments WHERE payment_name= '" . $name . "'");
            else return $this->id;
        }

        public function get_name($id="")
        {
            if($id != "") return getValue("SELECT payment_name FROM tbl_payments WHERE payment_id= " . $id);
            else return $this->name;
        }

        public function get_path(){
              return getValue("SELECT payment_icon FROM tbl_payments WHERE payment_id=" . $this->id);
        }

        public function activate(){
            runSQL("UPDATE tbl_payments SET payment_activate = 1 WHERE payment_id = " . $this->id);
        }

        public function deactivate(){
            runSQL("UPDATE tbl_payments SET payment_activate = 0 WHERE payment_id = " . $this->id);
        }

        public function get_activate_status(){
            return getValue("SELECT payment_activate FROM tbl_payments WHERE payment_id = " . $this->id);
        }

        public function preset_display(){
            if($this->get_activate_status() == "1") $check = " checked ";
            else $check = "";
            echo '
            <span class="admin_edit" id="payments_' . $this->id . '">
                <label for="payment-checkbox-' . $this->id . '">' . $this->name . '</label><input type="checkbox" name="payment-checkbox-' . $this->id . '" id="payment-checkbox-' . $this->id . '" value="' . $this->name . '" ' . $check . '/>
                <span class="func">[Icon]</span><span class="func">[Edit]</span><span class="func">[Delete]</span>
            </span>';
        }

        public function choice_display($hotel_id){
            if($this->get_activate_status() == "0") return;
            if(getValue("SELECT COUNT(*) FROM tbl_hotel_payment WHERE hotel_id = " . $hotel_id . " AND payment_id = " . $this->id)== 1) $checked = " checked ";
            else $checked = "";
            echo '
            <span style="display:block;" id="payments_' . $this->id . '">
                <label for="payment-checkbox-' . $this->id . '">' . $this->name . '</label><input type="checkbox" name="payment-checkbox[]" id="payment-checkbox-' . $this->id . '" value="' . $this->id . '" ' . $checked . '/>
            </span>';
        }

        public function popup_add(){
            echo '
                <form action="' . $this->php_path . '?action=add" method="post" target="upload_target">
                    <table>
                        <tr><td>
                            <label></label><input type="text" name="txt_payment_name"/>
                        </td></tr>
                        <tr><td align="right">
                            <input type="submit" name="submit_payment_method" value="Save" />
                            <input type="button" value="Cancel" onclick="close_form_over    ()" />
                        </td></tr>
                    </table>
                </form><iframe style="display:none;" name="upload_target" id="upload_target"></iframe>
            ';
        }

        public function popup_edit(){
            echo '
                <form action="' . $this->php_path . '?action=add" method="post" target="upload_target">
                    <table>
                        <tr><td>
                            <label></label><input type="text" name="txt_payment_name" value="' . $this->name . '"/>
                        </td></tr>
                        <tr><td align="right">
                            <input type="submit" name="submit_payment_method" value="Save" />
                            <input type="button" value="Cancel" onclick="close_form_over    ()" />
                        </td></tr>
                    </table>
                </form><iframe style="display:none;" name="upload_target" id="upload_target"></iframe>
            ';
        }

        public function browse_icon(){
            echo '
                <form action="' . $this->php_path . '?id=' . $this->id . '&action=icon" method="post" enctype="multipart/form-data" target="upload_target">
                    <table>
                        <tr>
                            <td>Choose icon</td>
                            <td><input type="file" id="payment_icon" name="payment_icon" />
                            <input type="hidden" value="2000000" name="MAX_FILE_SIZE" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                                <input type="submit" name="submit_payment_icon" value="Save" />
                                <input type="button" value="Cancel" onclick="close_form_over()" />
                            </td>
                        </tr>
                    </table>
                </form>
                <iframe id="upload_target" name="upload_target" style="display:none;"></iframe>
            ';
        }

    }
?>