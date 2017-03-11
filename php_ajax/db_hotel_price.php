<?php
    $hotel_id = $_GET['id'];

    include("../connection/connection.php");
    include("../module/module.php");

    if(!isset($_POST['submit_price'])){
      $old_price = "";
      $old_price = getValue("SELECT hotel_lowest_price FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
?>
    <form action="php_ajax/db_hotel_price.php?id=<?php echo $hotel_id; ?>" method="post" target="upload_target">
    <table>
        <tr>
            <td align="left">
                Value(USD):<br />
                <input type="text" value="<?php echo $old_price; ?>" name="text_price" />
            </td>
        </tr>
        <tr>
            <td align="right">
                <input type="submit" value="Save" name="submit_price" />
            </td>
        </tr>
    </table>
    </form>
    <iframe id="upload_target" style="display:none"></iframe>
<?php
    }
    else{
        $p = $_POST['text_price'];
        $hotel_id  =  $_GET['id'];
        $sql = "UPDATE tbl_hotels SET hotel_lowest_price = '" . $p . "' WHERE hotel_id = " . $hotel_id;
        runSQL($sql);
?>
<script language="javascript">
    window.top.window.finish_change_price("<?php echo $p ?>");
</script>
<?php
    }
?>