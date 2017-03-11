$(document).ready(function(){
    $("#Mgt_Payment input[type=checkbox]").change(function(){
        var id = $(this).parent().attr("id").split("_")[1];
        var value = $(this).attr("checked");
        if(value) value = 1;
        else value = 0;
        $.ajax({
            "url":"application/payment_method/hotel_payment_method.php?action=activate&value=" + value + "&id=" + id,
            "success": function(data){
            }
        });
    });


});

function save_payment(){
    $.get("application/payment_method/hotel_payment_method.php?action=admin_display",
    function(data){
        load_payment(data);
    });
    close_form_over();
}

function save_detail_payment(){
    $.ajax({
		"url":"application/payment_method/detail_payment.php?hotel_id=" + hotel_id,
		"success": function(data){
			 $("#hotel_payment_display").html(data);
		}
	});
    close_form();
}