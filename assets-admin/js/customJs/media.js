
$(document).ready(function () {
    var basepath = $("#basepath").val();
    //loadPartialView("#tab_one", basepath + "media/video_partial_view");
    $("#tab_one-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_one", basepath + "media/video_partial_view");
    });
    $("#tab_two-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_two", basepath + "media/news_partial_view");
    });
    $("#tab_three-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_three", basepath + "media/events_happining_partial_view");
    });
    $("#tab_four-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_four", basepath + "media/newslater_partal_view");
    });
    $(".update_btn").on("click", function(event) {
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

    $(document).on("submit", "#videoForm", function (event) {
		event.preventDefault();
		var formData = new FormData($(this)[0]);
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