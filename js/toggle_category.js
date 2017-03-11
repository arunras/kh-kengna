// JavaScript Document
function toggle_category(){//showHideDiv){//, switchImgTag) {
        var ele = document.getElementById(cat_title);//(showHideDiv);
        //var imageEle = document.getElementById(switchImgTag);
        if(ele.style.display == "block") {
                ele.style.display = "none";
		//imageEle.innerHTML = '<img src="/wp-includes/images/plus.png">';
        }
        else {
                ele.style.display = "block";
                //imageEle.innerHTML = '<img src="/wp-includes/images/minus.png">';
        }
}


$(document).ready(function(){
	/*
	if (switchTog==false){
		
		$(".top_place1").hide();
		$(".pop1").hide();
		$(".facility1").hide();
		$(".price1").hide();
		$(".exp_cam1").hide();	
		
		return true;
	}
	*/
	//if (switchTog==true){
	$(".top_place1").click(function(){
		$(this).show();
		return true;
		alert("Hi");
	});
	$(".pop1").click(function(){
		$(this).show();
		return true;
		//switchTog = true;
	});
	$(".price1").click(function(){
		$(this).show();
		return true;
		//switchTog = true;
	});
	$(".facility1").click(function(){
		$(this).show();
		return true;
		//switchTog = true;
	});
	$(".exp_cam1").click(function(){
		$(this).show();
		return true;
		//switchTog = true;
	});
		//start(false);
	//}
	
    $(".top_place").click(function () {
	  	$(".pop1").hide();
		$(".facility1").hide();
		$(".price1").hide();
		$(".exp_cam1").hide();
	  
      $(".top_place1").slideToggle(0);
	  
    });
	
	$(".pop").click(function () {
		$(".top_place1").hide();
		$(".facility1").hide();
		$(".price1").hide();
		$(".exp_cam1").hide();
		
      $(".pop1").slideToggle(0);
    });
	
	$(".price").click(function () {
		$(".pop1").hide();
		$(".facility1").hide();
		$(".top_place1").hide();
		$(".exp_cam1").hide();
		
      $(".price1").slideToggle(0);
    });
	
	$(".facility").click(function () {
		$(".pop1").hide();
		$(".top_place1").hide();
		$(".price1").hide();
		$(".exp_cam1").hide();	
		
      $(".facility1").slideToggle(0);
    });
	
	$(".exp_cam").click(function () {
		$(".pop1").hide();
		$(".facility1").hide();
		$(".price1").hide();
		$(".top_place1").hide();
		
      $(".exp_cam1").slideToggle(0);
    });
});