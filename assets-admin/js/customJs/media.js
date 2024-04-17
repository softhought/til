
$(document).ready(function () {
    var basepath = $("#basepath").val();
    //loadPartialView("#tab_one", basepath + "media/video_partial_view");
    $(document).on("click", "#tab_one-tab", function (event){
        event.preventDefault();
        event.stopImmediatePropagation();
        loadPartialView("#tab_one", basepath + "media/video_partial_view");
    });
    $(document).on("click", "#tab_two-tab", function (event){
        event.preventDefault();
        event.stopImmediatePropagation();
        loadPartialView("#tab_two", basepath + "media/news_partial_view");
    });
    $(document).on("click", "#tab_three-tab", function (event){
        event.preventDefault();
        event.stopImmediatePropagation();
        loadPartialView("#tab_three", basepath + "media/events_happining_partial_view");
    });
    $(document).on("click", "#tab_four-tab", function (event){
        event.preventDefault();
        event.stopImmediatePropagation();
        loadPartialView("#tab_four", basepath + "media/newslater_partal_view");
    });
    $(document).on("click", ".update_btn", function (event){
        event.preventDefault();
        var id = $(this).data('id');
        var title = $(this).data('title');
        var videoid = $(this).data('videoid');
        $("#videoId").val(id);
        $("#mode").val("EDIT");
        $("#title").val(title);
        $("#link").val(videoid);
        $("#save_btn").html("Update");
    });

    $(document).on("submit", "#videoForm", function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
        
        if(validation()){
            $("#save_btn").css("display", "none");
        //$("#loaderbtn").css("display", "block");
        $.ajax({
            type: "POST",
            url: basepath + "media/video_add_edit_action",
            dataType: "json",
            processData: false,
            contentType: false, 
            data: formData,
            success: function (result) {
                if (result.msg_status == 1) {
                    loadPartialView("#tab_one", basepath + "media/video_partial_view");
                } else {
                }
            },

            error: function (jqXHR, exception) {
                var msg = "";

                if (jqXHR.status === 0) {
                    msg = "Not connect.\n Verify Network.";
                } else if (jqXHR.status == 404) {
                    msg = "Requested page not found. [404]";
                } else if (jqXHR.status == 500) {
                    msg = "Internal Server Error [500].";
                } else if (exception === "parsererror") {
                    msg = "Requested JSON parse failed.";
                } else if (exception === "timeout") {
                    msg = "Time out error.";
                } else if (exception === "abort") {
                    msg = "Ajax request aborted.";
                } else {
                    msg = "Uncaught Error.\n" + jqXHR.responseText;
                }

                // alert(msg);
            },
        }); /*end ajax call*/
        }/** end if */
	});
    $(document).on("click", ".status", function () {
        var uid = $(this).attr("id");
        var status = $(this).data("setstatus");
        var url = basepath + "media/setStatus";
        setActiveStatus(uid, status, url);
      });
    
}); // end of document ready
function loadPartialView(tabId, partialViewUrl) {
    $.ajax({
        url: partialViewUrl,
        type: 'GET',
        success: function(data) {
            $(tabId + "_data").html(data);
        },
        error: function(xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}
function validation(){
    var title = $('#title').val();
    var link = $('#link').val();
    $("#error_title").text('');
    $("#error_link").text('');
    if(title == ""){
        $("#error_title").text('Error : Enter title');
        $("#title").focus();
        return false;
   }else if(link == ""){
     $("#error_link").text('Error : Enter link');
     $("#link").focus();
     return false;
   }
   return true;
}/**end  */
function changeSerial(id,slno,action){
	var slectedvalue = $("#otherslno_"+ slno).val();
    var basepath = $("#basepath").val()
    $.ajax({
    url: basepath+'media/videoserialchange',
    dataType: 'html',
    type: 'post',
    data: {id:id,slno:slno,action:action,slectedvalue:slectedvalue},
    success: function(data) {		
        loadPartialView("#tab_one", basepath + "media/video_partial_view");
            //$("#event_list").html(data);
          //  $('.dataTable').DataTable();	
           // $(".select2").select2();
        }
    });
}