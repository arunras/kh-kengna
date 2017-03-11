<html>
    <head>

    <!-- loading script -->
    <script language="JavaScript" src="JavaScript/jquery-1.6.2.js"></script>
    <script language="JavaScript" src="JavaScript/JQuery.MultiUpload.js"></script>
    <!-- end of loading script -->

    <!-- loading style sheet -->
    <link rel="stylesheet" href="CSS/MultiUploadStyle.css" />
    <!-- end of loading css  -->

    <script language="JavaScript">
        $(document).ready(function(){
            $("#Upload_Block_1").Uploader({
                HeaderText : "Please Choose Photo",
                BrowseText  : "Add",
                ClearText   : "Clear",
                AcceptTypes : "jpg|png|gif|jpeg",
            });

            $("#Upload_Block_2").Uploader({
                HeaderText : "Please Choose Photo",
                BrowseText  : "Add",
                ClearText   : "Clear",
                AcceptTypes : "avi|swf|flv|mp4|wmv",
            });

        });
    </script>

    </head>
    <body>

    <form action="Save_Upload/Save_Upload.php" method="post" enctype="multipart/form-data">
    <div class="Upload_Block" id="Upload_Block_1">
        <div class="Upload_Header" id="Upload_Header_1"></div>
        <div class="Upload_Content" id="Upload_Content_1">
        </div>
        <div class="Upload_Footer" id="Upload_Footer_1">
            <div class="Upload_Status" id="Upload_Status_1"></div>
        </div>
    </div>


    <div class="Upload_Block" id="Upload_Block_2">
        <div class="Upload_Header" id="Upload_Header_2"></div>
        <div class="Upload_Content" id="Upload_Content_2">
        </div>
        <div class="Upload_Footer" id="Upload_Footer_2">
            <div class="Upload_Status" id="Upload_Status_2"></div>
        </div>
    </div>
    <input type="Submit" />
    </form>

    </body>

</html>