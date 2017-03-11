var number_of_file = 0;
var ajax_path;

var $upload_button;
var $file_input;
var file_id;
var $file_upload_form;
var form_action = "";
var $this_id;

jQuery.fn.FileUpload = function() {

    $file_upload_form = $(this).closest("form");
    $upload_button = $(this).find("label span");
    $file_input    = $(this).find("input[type=file]:last");
    number_of_file = $(this).size();
    $this_id       = $(this).attr("id");
    //$file_input.attr("id","file_upload_0");
    //$file_input.attr("name","file_upload_0");
    //file_id        = "file_upload_0";
    file_id        = $file_input.attr("id");

    $upload_button.click(function(){
        $("#"+file_id).trigger("click");
        file_id = "file_upload_" + number_of_file;
    });

    $("#"+file_id).change(function(){
        var $val = $(this).val();

        if($val != ""){
            var new_input = document.createElement("input");

            $(this).parent().append("<input type='file' id='file_upload_" + number_of_file + "' name='file_upload_" + number_of_file + "' />");//.addClass("upload_file_style");
            file_id = "file_upload_" + number_of_file;

            $("#" + $this_id).FileUpload();
            return false;
        }
    });

    $file_upload_form.submit(function(){
      number_of_file = $(this).find("input[type=file]").length;
      alert(number_of_file);
      return false;
        form_action    = $file_upload_form.attr("action");
        var punctuation = "";
        if(form_action.indexOf("?") > 0)punctuation = "&";
        else punctuation = "?";

        $file_upload_form.attr("action",form_action + punctuation + "number_of_files="+(number_of_file+1)+"&prefix=file_upload_");
    });

};

function get_file(_file){
    alert(_file);
}