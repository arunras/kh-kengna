(function($){


jQuery.fn.Uploader = function(options){
    var defaults = {
        header_text  : "",
        footer_text  : "Status",
        browse_text  : "Browse",
        clear_text   : "Clear",
        accept_types : "",
    };

    var Custom = jQuery.extend(defaults,options);


    return this.each(function(){
        var $Uploader  = $(this);
        var $Header    = $(this).find("div:first");
        var $Content   = $Header.next();
        var $Footer    = $Content.next();
        var $Status    = $Footer.find("div");
        var allow_type = Custom.accept_types.split("|");
        var prefix     = $(this).attr("id");
        var FileCount  = 0;
        var FileAdd    = 0;


        //utilities for uploader
        $UploadButton = $("<span id='UploadButton' class='UploadButton'>" + Custom.browse_text + "</span>");
        $ClearButton = $("<span id='ClearButton' class='UploadButton'>" + Custom.clear_text + "</span>");
        $UploadForm   = $(this).closest("form");

        //initialize the display
        $Header.html(Custom.header_text);
        $Header.append($ClearButton);
        $Header.append($UploadButton);

        $Status.html(Custom.footer_text);



        //Uploader events
        $UploadButton.click(function(){

            if(FileAdd == FileCount){
                // add another file if needed
                $UploadFile   = $("<div class='row'><input type='file' id='" + prefix + "-" + FileCount + "' name='" + prefix + "-" + FileCount + "' /><label for='" + prefix + "-" + FileCount + "' class='file'></label></div>");
                $Content.append($UploadFile);
            }

            $("#" + prefix + "-" + FileCount).trigger("click");



            $("#" + prefix + "-" + FileCount).change(function(){
                var file_name = $(this).val();

                var file_type = file_name.split(".")[1];
                if(jQuery.inArray(file_type.toLowerCase(),allow_type)<0){
                    $Status.html("Invalid Type.");
                    $(this).parent().remove();
                    //FileAdd = FileCount;
                }
                else{

                    if(file_name != ""){

                        FileCount = $Content.find("input").length;
                        FileAdd = FileCount;

                        //add the remove button
                        if($(this).parent().find(".remove").length == 0)$(this).parent().append("<div id='delete_" + prefix + "-" + FileCount + "' class='remove'> X</div><input type='text' value='Description' id='description-" + prefix + "-" + FileCount + "' name='description-" + prefix + "-" + FileCount + "' />");

                        //display the file name
                        $Content.find("label:last").html(file_name);

                        $Content.find("div.remove:last").click(function(){
                            $remove_content = $(this).parent();
                            $remove_content.remove();
                        });

                        $("#description-" + prefix + "-" + FileCount).css("color","#999").css("font-style","italic");

                        $("#description-" + prefix + "-" + FileCount).focus(function(){
                            if($(this).val() == "Description") {
                                if($(this).css("font-style") == "italic")
                                    $(this).val("").css("color","#000").css("font-style","normal");
                            }
                        });

                        $("#description-" + prefix + "-" + FileCount).blur(function(){
                            if($(this).val() == "") $(this).val("Description").css("color","#999").css("font-style","italic");
                        });

                    }

                }

            });

            FileAdd++;

        });


        //clear button event
        $ClearButton.click(function(){
            $Content.html("");
            FileCount = 0;
            FileAdd   = 0;
        });

        //form submit event
        $UploadForm.submit(function(){
            var $form_action = $(this).attr("action");
            var punctuation  = "";

            //alert($(this).html());return false;

            //var _FileCount = $Content.find(".row").length;

            //reset the id if some files were deleted
            var i = 0;
            $Content.find(".row").each(function(){
                $(this).find("input[type=file]").attr("id", prefix + "-"+ i).attr("name", prefix + "-"+ i).siblings("input[type=text]").attr("name","description-" + prefix + "-" + i);
                i++;
            });


            var _FileCount = i;


            if($form_action.indexOf("?") > 0){
                punctuation  = "&";
            }
            else{
                punctuation  = "?";
            }

            $form_action     = $form_action + punctuation + "number_of_" + prefix + "=" + _FileCount + "&" + prefix + "-prefix=" + prefix;

            $(this).append("<input type='hidden' value='2000000' name='MAX_FILE_SIZE' />");

            $(this).attr("action", $form_action);
            //return false;
        });

   });
};

})(jQuery)
