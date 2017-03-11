$(document).ready(function () {
    $('div#cities').click(function () {		
		if($(this).val() == 'false'){
			$(this).val('true');
			$(this).removeClass('dd_selected');
		}
		else {
			$(this).val('false');
			$(this).addClass('dd_selected');			
		}		
		$('ul#cities').slideToggle('fast');		
    });
	
	$('a').click(function(){
		var city_id = $(this).attr('id');
		$.ajax({	
			'url':'php_ajax/session_set_selected_city_view.php',
			'data':'city_id='+city_id,
			'type':'POST',
			'success':function(data)  
			   	{
				   	$("#view").html(data);
				}		
    	});
	});
});