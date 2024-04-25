
$(document).ready(function () {

    var basepath = $("#basepath").val();
    var media_tag = '';
   
    loadPartialView("#tab_one", basepath + "media/video_partial_view",media_tag);
    $(document).on("click", "#tab_one-tab", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        loadPartialView("#tab_one", basepath + "media/video_partial_view",media_tag);
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
        loadPartialView("#tab_three", basepath + "media/events_happining_partial_view",media_tag);
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
    /** ---------------for video section start ------------------*/
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
        $("#loaderbtn").html("Updating...");
    });
    $(document).on("submit", "#videoForm", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var formData = new FormData($(this)[0]);

        if (validation()) {
            $("#save_btn").css("display", "none");
            $("#loaderbtn").css("display", "block");
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
                        $("#save_btn").css("display", "block");
                        $("#loaderbtn").css("display", "none");
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
    /** ---------------for video section end ------------------*/

    /** ----------------------for news and news later section start ------------------------ */
    $(document).on("click", ".update_news_newslater", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var id = $(this).data('id');
        var title = ($(this).data('title'));
        var filename = $(this).data('filename');
        var randomname = $(this).data('randomname');
        $("#docID").val(id);
        $(".mode").val("EDIT");
        $("#title_desc").val(title);
        $(".userFileName").val(filename);
        $(".randomFileName").val(randomname);
        $(".prvFilename").val(filename);
        $(".save_btn").html("Update");
        $(".loaderbtn").html("Updating...");
    });
    $(document).on("click", ".browse", function () {
		var file = $(this).parent().parent().parent().find(".file");
		file.trigger("click");
	});
	$(document).on("change", ".file", function () {
		$(this).parent().find(".form-control").val($(this).val().replace(/C:\\fakepath\\/i, "")
			);
            $(".isChangedFile").val("Y");
	});
    $(document).on("submit", "#newsandnewslaterForm", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var formData = new FormData($(this)[0]);

        if(validationNewsNewslater()){
        $(".save_btn").css("display", "none");
        $(".loaderbtn").css("display", "block");
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
                    $(".save_btn").css("display", "block");
                    $(".loaderbtn").css("display", "none");
                    var media_tag = result.media_tag;
                    if(result.media_tag == 'NEWS'){
                        loadPartialView("#tab_two", basepath + "media/news_partial_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
                    }else if(result.media_tag == 'TIL_TALK'){
                        loadPartialView("#tab_four", basepath + "media/till_talk_partal_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
                    }else if(result.media_tag == 'TIL_TOUCH'){
                        loadPartialView("#tab_five", basepath + "media/till_touch_partal_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
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
        }/** end if */
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
                        loadPartialView("#tab_four", basepath + "media/till_talk_partal_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);

                    }else if(result.media_tag == 'TIL_TOUCH'){
                        loadPartialView("#tab_five", basepath + "media/till_touch_partal_view",media_tag);
                        defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);

                    }
                    
                    //location.reload();
                }
            }
        });

    });/**end */
   
    /** ----------------------for news and news later section end ------------------------ */
   
    
   
    /** ----------------------start event happinig section  ----------------------*/
  
    $(document).on("submit", "#eventsHappiningForm", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var formData = new FormData($(this)[0]);

        if (validationEvent()) {
            $("#save_btn").css("display", "none");
            $("#loaderbtn").css("display", "block");
            $.ajax({
                type: "POST",
                url: basepath + "media/eventsHappining_add_edit_action",
                dataType: "json",
                processData: false,
                contentType: false,
                data: formData,
                success: function (result) {
                    var media_tag = '';
                    if (result.msg_status == 1) {
                        $("#save_btn").css("display", "block");
                        $("#loaderbtn").css("display", "none");
                        //loadPartialView("#tab_one", basepath + "media/video_partial_view");
                        loadPartialView("#tab_three", basepath + "media/events_happining_partial_view",media_tag);
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
    });/**end event happining submit */
    $(document).on("click", ".showaddbtn", function() {
        let mode="ADD";
        let eventHappiningId=0;
        loadAddEditView(basepath,eventHappiningId);
    });
    $(document).on('click', ".showupdatebtn", function(e) {   
        e.preventDefault();
        
        let mode="EDIT";
        var eventHappiningId=$(this).data("eventid");
       
        loadAddEditView(basepath,eventHappiningId);  
       

    });
    
    $(document).on("change", "#fileName", function() {
        var files = $(this)[0].files;
        var previewContainer = $('#image-asset-preview-container');
    
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
    
            reader.onload = (function(theFile) {
                return function(e) {
                    var fileName = theFile.name;
                    var imageUrl = e.target.result;
                    var html = `<div class="image-preview-item">
                                    <img src="${imageUrl}" alt="${fileName}">
                                    <i class="fas fa-trash image-delete delete-icon"></i>
                                </div>`;
                    previewContainer.append(html);
                };
            })(file);
    
            reader.readAsDataURL(file);
        }
    });
    
    
    $(document).on("click", ".delete-icon", function() {
        var mode = $(this).data("mode");
    
        if (mode == 'EDIT') {
            var confirmDelete = window.confirm("Are you sure you want to delete this image?");
            if (confirmDelete) {
                var removeImageName = $(this).data("imagename");
                var eventid = $(this).data("srl");
    
                // Remove the deleted image container
                $("#event_" + eventid).remove();
    
                // Update the serial numbers of the remaining images
                $(".image-preview-item").each(function(index) {
                    // Update the ID attribute with the new serial number
                    $(this).attr("id", "event_" + (index + 1));
    
                    // Update the data-srl attribute with the new serial number
                    $(this).find(".delete-icon").data("srl", index + 1);
                });
    
                // Optional: Update the value of the hidden input fields if needed
                $("input[name='prev_img_name[]']").each(function(index) {
                    // Update the value of the input element to the corresponding file name in the array
                    // You can update other attributes if needed
                });
            }
        }else{
            $(this).parent().remove();
        }
    });
    
    $(document).on("click", ".eventstatus", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var uid = $(this).attr("id");
        var status = $(this).data("setstatus");
        //var url = basepath + "media/setStatus";
        $.ajax({
            url: basepath + 'media/setEventStatus',
            dataType: 'json',
            type: 'post',
            data: { uid: uid, status: status },
            success: function (result) {
                var media_tag = '';
                if (result.msg_status == 1) {
                    loadPartialView("#tab_three", basepath + "media/events_happining_partial_view",media_tag);
                    
                }
            }
        });

    });/**end */
    
    
   /** ----------------------end event happinig section  ----------------------*/
   
   
}); // end of document ready
function loadAddEditView(basepath,eventHappiningId){
    
    $("#add_edit_view_data").html("Loading....");
    
    $.ajax({
        url: basepath + "media/add_edit_event_happining_partial_view",
        type: 'POST',
        data:{eventHappiningId:eventHappiningId},
        success: function(data) {
            $("#add_edit_view_data").html(data);
          
        },
        error: function(xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}

function loadPartialView(tabId, partialViewUrl,media_tag) {
    $('#tab_one_data,#tab_two_data,#tab_three_data,#tab_four_data,#tab_five_data').html('');
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
                else if(result.media_tag == 'TIL_TALK'){
                    loadPartialView("#tab_four", basepath + "media/till_talk_partal_view",media_tag);
                    defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
                }
                else if(result.media_tag == 'TIL_TOUCH'){
                    loadPartialView("#tab_five", basepath + "media/till_touch_partal_view",media_tag);
                    defaultViewNewsAndNewslater(".partial_view_news_and_newslater", basepath + "media/defaultViewNewsAndNewslater", media_tag);
                } 
            }else if(result.msg_status == 2){
                var media_tag = result.media_tag;
                loadPartialView("#tab_one", basepath + "media/video_partial_view",media_tag);
            }
        }
    });
}
/** for event happining serial start */
function changeSerialEvent(id, slno, action) {
    var slectedvalue = $("#otherslno_" + slno).val();
    var basepath = $("#basepath").val()
   
    $.ajax({
        url: basepath + 'media/eventHappiningserialchange',
        dataType: 'json',
        type: 'post',
        data: { id: id, slno: slno, action: action, slectedvalue: slectedvalue },
        success: function (result) {
            var media_tag = '';
            if (result.msg_status == 1) {
                loadPartialView("#tab_three", basepath + "media/events_happining_partial_view",media_tag);
               
            }
        }
    });
}
/** for event happining serial end */

/** -------------start validation section -----------------*/
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
        $("#error_link").text('Error : Enter video id');
        $("#link").focus();
        return false;
    }
    return true;
}/**end  */
function validationNewsNewslater() {
    var title = $('.title_desc').val();
    var mode = $('.mode').val();
    var fileInput = $('.fileName')[0];

    $(".error_title").text('');
    $(".error_file").text('');

    if (title == "") {
        $(".error_title").text('Error : Enter title');
        $(".title_desc").focus();
        return false;
    } 
    if(mode == 'ADD'){
        if (fileInput.files.length === 0) { 
            $(".error_file").text('Error: Select a document');
            return false;
        }
    }
    return true;
}/**end  */

function validationEvent() {
    var title = $('.event_title').val();
    var mode = $('#mode').val();
    var fileInput = $('#fileName')[0];
    $(".error_event_title").text('');
    $(".error_image").text('');

    if (title == "") {
        $(".error_event_title").text('Error : Enter event title');
        $(".event_title").focus();
        return false;
    } 
    if(mode == 'ADD'){
        if (fileInput.files.length === 0) { 
            $(".error_image").text('Error: Select at least one image');
            return false;
        }
    }
    return true;
}/**end  */
/** -------------start validation section -----------------*/


