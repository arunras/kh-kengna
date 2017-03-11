$(document).ready(function(){

    //hotel_id get from hotel_detail.js

    $("#hotel_review").append("<div style='display:table-cell;padding-top:0px;'><a href='#' style='float:left;margin-top:0px;' id='edit_review'  class='edit hide'><span>[Edit]</span></a></div>");

    $("#edit_review").click(function(){
      var url = "application/hotel_review/hotel_facebook.php?hotel_id=" + hotel_id;
      popup_show(
      'popup',
      'form_content',
      'title',
      'popup_drag',
      'popup_exit',
      'screen-center',
      0,   0,
      'pos_bottom',
      'Facebook profile',
      url
      );
    });

});

function saved_facebook(new_url){
    close_form(); //in hotel_detail.js
    $("#find_on_facebook").attr("href","http://www.facebook.com/" + new_url);
}