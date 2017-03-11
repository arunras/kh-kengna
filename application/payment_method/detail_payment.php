<?php
	require_once("class/payment_method.class.php");

	$hotel_id = $_GET['hotel_id'];
	echo '<link rel="stylesheet" href="application/payment_method/css/payment_display.css" type="text/css" />';
    echo '<script language="javascript" type="text/javascript" src="application/payment_method/js/payment_method.js"></script>';
	if(!isset($_GET['edit'])) {
		echo '<div style="width:220px;text-align:left;">';
		payment_display($hotel_id);
		echo '</div>';
	}
	else if(!isset($_POST['save_method'])){
		payment_display_edit($hotel_id);
	}
    else{
        save_payment($hotel_id);
    }

    function save_payment($hotel_id){
        $p_chk = $_POST['payment-checkbox'];
        runSQL("DELETE FROM tbl_hotel_payment WHERE hotel_id = " . $hotel_id);
        while (list ($key,$val) = @each ($p_chk)) {
            runSQL("INSERT INTO tbl_hotel_payment(hotel_id, payment_id) VALUES(" . $hotel_id . ", " . $val . ")");
        }
    ?>
    <script language="javascript">
        window.top.window.save_detail_payment();
    </script>
    <?php
    }

	function payment_display($hotel_id){
		$sql = "SELECT payment_id FROM tbl_hotel_payment WHERE hotel_id = " . $hotel_id;
		$rs = getResultSet($sql);
		if(mysql_num_rows($rs) != 0 ){
			while($r = mysql_fetch_array($rs)){
				$payment = new payment_method;
				$payment->set($r[0]);
				echo '<div class="payment_display_thumb">';
				echo '<img src="' . $payment->get_path() . '" class="payment_thumbs"/>';
				echo '</div>';
			}
		}
	}

	function payment_display_edit($hotel_id){
    	$payment_rs = getResultSet("SELECT payment_id FROM tbl_payments");
        if(mysql_num_rows($payment_rs) != 0){
            $alt = 0;
            echo '<form action="application/payment_method/detail_payment.php?hotel_id=' . $hotel_id . '&edit=cccksdLTKCX_ik" method="post" target="upload_target">';//target="upload_target"
            echo '<br /><table id="lst_payment">';
            while($payment_info = mysql_fetch_array($payment_rs)){
                $payment  = new payment_method;
                $payment->set($payment_info[0]);


                echo '<tr><td align="right" style="width:80px;height:30px;">';
                echo '<img style="margin-right:20px;" src="' . $payment->get_path() . '" />';
                echo '</td>';

                echo '<td style="width:200px;" align="left">';

                $payment->choice_display($hotel_id);

                echo '</td>';
                echo '</tr>';
            }
            echo '<tr>
                   <td colspan="2" align="right">
                        <input type="submit" name="save_method" value="Save" />
                        <input type="button" value="Cancel" onclick="close_form()" />
                   </td>
                </tr>';
            echo '</table><br />';
            echo '</form><iframe style="display:none;" name="upload_target" id="upload_target"></iframe>';
        }

	}
?>