
$(document).ready(function () {

    var basepath = $("#basepath").val();
    $media_tag = '';
    loadPartialView("#tab_one", basepath + "media/video_partial_view",$media_tag);
    $(document).on("click", "#tab_one-tab", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        loadPartialView("#tab_one", basepath + "media/video_partial_view",$media_tag);
    });
    $(document).on("click", "#tab_two-tab", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var media_tag = $(this).data("mediatag");
        loadPartialView("#tab_two", basepath + "media/news_partial_view",media_tag);
        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
    });
    $(document).on("click", "#tab_three-tab", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        loadPartialView("#tab_three", basepath + "media/events_happining_partial_view",$media_tag);
    });
    $(document).on("click", "#tab_four-tab", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var media_tag = $(this).data("mediatag");
        loadPartialView("#tab_four", basepath + "media/till_talk_partal_view",media_tag);
        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);

    });
    $(document).on("click", "#tab_five-tab", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var media_tag = $(this).data("mediatag");
        loadPartialView("#tab_five", basepath + "media/till_touch_partal_view",media_tag);
        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);

    });
    $(document).on("click", ".update_btn", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var id = $(this).data('id');
        var title = ($(this).data('title'));
        var videoid = $(this).data('videoid');
        $("#videoId").val(id);
        $("#mode").val("EDIT");
        $("#title").val(title);
        $("#link").val(videoid);
        $("#save_btn").html("Update");
    });
    
    $(document).on("click", ".update_news_newslater", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var id = $(this).data('id');
        var title = ($(this).data('title'));
        var filename = $(this).data('filename');
        $("#docID").val(id);
        $(".mode").val("EDIT");
        $("#title_desc").val(title);
        $(".isdocumentname").val(filename);
        $(".save_btn").html("Update");
    });

    $(document).on("submit", "#videoForm", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var formData = new FormData($(this)[0]);

        if (validation()) {
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
    });/**end video  submit */
    $(document).on('change', '#file', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        $("#isdocument").val('Y');

    });/**end */
    $(document).on("submit", "#newsandnewslaterForm", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var formData = new FormData($(this)[0]);

        //if(validation()){
        $("#save_btn").css("display", "none");
        //$("#loaderbtn").css("display", "block");
        $.ajax({
            type: "POST",
            url: basepath + "media/defaultViewNewsAndNewslater_action",
            dataType: "json",
            processData: false,
            contentType: false,
            data: formData,
            success: function (result) {
                if (result.msg_status == 1) {
                    //loadPartialView("#tab_one", basepath + "media/video_partial_view");
                    var media_tag = result.media_tag;
                    if(result.media_tag == 'NEWS'){
                        loadPartialView("#tab_two", basepath + "media/news_partial_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
                    }else if(result.media_tag == 'TIL_TALK'){
                        loadPartialView("#tab_four", basepath + "media/till_talk_partal_view",media_tag);
                    }else if(result.media_tag == 'TIL_TOUCH'){
                        loadPartialView("#tab_five", basepath + "media/till_touch_partal_view",media_tag);
                    }
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
        //}/** end if */
    });/**end */

    $(document).on("click", ".status", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var uid = $(this).attr("id");
        var status = $(this).data("setstatus");
        //var url = basepath + "media/setStatus";
        $.ajax({
            url: basepath + 'media/setStatus',
            dataType: 'json',
            type: 'post',
            data: { uid: uid, status: status },
            success: function (result) {
                if (result.msg_status == 1) {
                    loadPartialView("#tab_one", basepath + "media/video_partial_view");
                    //location.reload();
                }
            }
        });

    });/**end */
    $(document).on("click", ".news_newslater_status", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var uid = $(this).attr("id");
        var status = $(this).data("setstatus");
        var media_tag = $(this).data("mediatag");
        //var url = basepath + "media/setStatus";
        $.ajax({
            url: basepath + 'media/news_newslater_status',
            dataType: 'json',
            type: 'post',
            data: { uid: uid, status: status,media_tag:media_tag},
            success: function (result) {
                if (result.msg_status == 1) {
                    var media_tag=result.media_tag;
                    if(result.media_tag == 'NEWS'){
                        loadPartialView("#tab_two", basepath + "media/news_partial_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
                    }else if(result.media_tag == 'TIL_TALK'){

                    }else if(result.media_tag == 'TIL_TOUCH'){

                    }
                    
                    //location.reload();
                }
            }
        });

    });/**end */


}); // end of document ready
function displayFileName() {
    var fileInput = document.getElementById('file');
    var fileName = fileInput.files[0].name;

    var fileLabel = document.getElementById('file-label');
    var isDocumentName = document.getElementById('isdocumentname');

    fileLabel.textContent = fileName;
    isDocumentName.value = fileName;
}


function loadPartialView(tabId, partialViewUrl,media_tag) {
    //$('#tab_one_data,#tab_two_data,#tab_three_data,#tab_four_data,#tab_five_data').html('');
    $.ajax({
        url: partialViewUrl,
        //type: 'GET',
        type: 'post',
        data: { media_tag: media_tag },
        success: function (data) {
            $(tabId + "_data").html(data);
            $('.dataTable2').DataTable();
        },
        error: function (xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
    return;
}
function validation() {
    var title = $('#title').val();
    var link = $('#link').val();
    $("#error_title").text('');
    $("#error_link").text('');
    if (title == "") {
        $("#error_title").text('Error : Enter title');
        $("#title").focus();
        return false;
    } else if (link == "") {
        $("#error_link").text('Error : Enter link');
        $("#link").focus();
        return false;
    }
    return true;
}/**end  */
function changeSerial(id, slno, action,media_tag,table_name,ref_id) {
    var slectedvalue = $("#otherslno_" + slno).val();
    var basepath = $("#basepath").val()
   
    $.ajax({
        url: basepath + 'media/videoserialchange',
        dataType: 'json',
        type: 'post',
        data: { id: id, slno: slno, action: action, slectedvalue: slectedvalue,media_tag:media_tag,table_name:table_name,ref_id:ref_id },
        success: function (result) {
            if (result.msg_status == 1) {
                var media_tag = result.media_tag;
                if(result.media_tag == 'NEWS'){
                    loadPartialView("#tab_two", basepath + "media/news_partial_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
                }
                //loadPartialView("#tab_one", basepath + "media/video_partial_view");   //location.reload();
            }
        }
    });
}
/** for default view load start */
function defaultViewNewsAndNewslater(targetElement, partialViewUrl, media_tag) {
    $.ajax({
        url: partialViewUrl,
        type: 'POST',
        dataType: 'html',
        data: { media_tag: media_tag },
        success: function (data) {
            // Update the target element with the loaded partial view content
            $(targetElement).html(data);
        },
        error: function (xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}/** for default view load end */


