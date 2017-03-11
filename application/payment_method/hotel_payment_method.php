<?php
    require_once("class/payment_method.class.php");

    $action = $_GET['action'];

    echo '<script language="javascript" type="text/javascript" src="application/payment_method/js/payment_method.js"></script>';

    if($action == "admin_display"){
        display_all();
    }
    else if($action == "add"){
        $payment = new payment_method;
        if(!isset($_POST['submit_payment_method'])){
            $payment->set_php_path("application/payment_method/hotel_payment_method.php");
            $payment->popup_add();
        }
        else{
            $payment->insert($_POST['txt_payment_name']);
            ?>
            <script language="javascript">
                window.top.window.save_payment();
            </script>
            <?php
        }
    }
    else if($action == "edit"){
        $payment = new payment_method;
        if(!isset($_POST['submit_payment_method'])){
            $payment->set_php_path("application/payment_method/hotel_payment_method.php");
            $payment->set($_GET['id']);
            $payment->popup_edit();
        }
        else{
            $payment->insert($_POST['txt_payment_name']);
            ?>
            <script language="javascript">
                window.top.window.save_payment();
            </script>
            <?php
        }
    }
    else if($action == "delete"){
        runSQL("DELETE FROM tbl_payments WHERE payment_id = " . $_GET['id']);
        display_all();
    }
    else if($action == "icon"){
        $payment = new payment_method;
        if(!isset($_POST['submit_payment_icon'])){
            $payment->set_php_path("application/payment_method/hotel_payment_method.php");
            $payment->set($_GET['id']);
            $payment->browse_icon();
        }
        else{
            $payment->set($_GET['id']);
            $payment->update_icon("payment_icon");
        }
    }
    else if($action == "activate"){
        $value = $_GET['value'];
        $id = $_GET['id'];
        $payment = new payment_method;
        $payment->set($id);
        if($value=="1")$payment->activate();
        else $payment->deactivate();
    }


function display_all(){
    $payment_rs = getResultSet("SELECT payment_id FROM tbl_payments");
        if(mysql_num_rows($payment_rs) != 0){
            $alt = 0;
            echo '<table>';
            while($payment_info = mysql_fetch_array($payment_rs)){
                $payment  = new payment_method;
                $payment->set($payment_info[0]);

                if($alt % 2 == 0){
                    echo '<tr>';
                }

                echo '<td width=50 align="right">';
                echo '<img style="margin-right:5px;" src="' . $payment->get_path() . '" />';
                echo '</td>';

                echo '<td width="400">';

                $payment->preset_display();

                echo '</td>';

                if($alt % 2 != 0){
                    echo '</tr>';
                }
                $alt++;
            }
            echo '</table>';
        }
}
?>