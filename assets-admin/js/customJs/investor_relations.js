$(document).ready(function () {
    var basepath = $("#basepath").val();
    var rowNoUpload = 0;
    var Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 500,
	});
  
    loadPartialView("#tab_one", basepath + "investor/corporate_governance_partial_view");
   

    $(document).on('click', "#tab_one-tab", function(e) {    
        e.preventDefault();
        $("#relations_master_id").val(1);
        $("#investor_relation_head").val("Corporate Governance");
        loadPartialView("#tab_one", basepath + "investor/corporate_governance_partial_view");
    });

    
    $(document).on('click', "#tab_two-tab", function(e) {      
        e.preventDefault();
        $("#relations_master_id").val(2);
        $("#investor_relation_head").val("Shareholders Information");
        loadPartialView("#tab_two", basepath + "investor/shareholders_information_partial_view");
    });

    $(document).on('click', "#tab_three-tab", function(e) {    
        e.preventDefault();
        $("#relations_master_id").val(3);
        $("#investor_relation_head").val("Financials");
        loadPartialView("#tab_three", basepath + "investor/financials_partial_view");
    });

    $(document).on('click', "#tab_four-tab", function(e) {   
        e.preventDefault();
        $("#relations_master_id").val(4);
        $("#investor_relation_head").val("Notice");
        loadPartialView("#tab_four", basepath + "investor/notice_partial_view");
    });


    $(document).on('click', ".showaddbtn", function(e) {   
        e.preventDefault();
        let mode="ADD";
        let relations_master_id=$("#relations_master_id").val();
        let relations_dtl_id=0;
        loadAddEditView(basepath,relations_master_id,relations_dtl_id);     
        $(".frm_header").html($("#investor_relation_head").val());

    });

    $(document).on('click', ".showupdatebtn", function(e) {   
        e.preventDefault();
        let mode="EDIT";
        let relations_master_id=$(this).data("relationsmasterid");
        var relations_dtl_id = $(this).data("relationsdtlid");

        loadAddEditView(basepath,relations_master_id,relations_dtl_id);     
        $(".frm_header").html($("#investor_relation_head").val());

    });

    $(document).on('click', ".showDocs", function(e) {   
        e.preventDefault();
        let mode="EDIT";
        let relations_master_id=$(this).data("relationsmasterid");
        var relations_dtl_id = $(this).data("relationsdtlid");
        var dochead = $(this).data("dochead");

        loadDocumentView(basepath,relations_master_id,relations_dtl_id);     
        $(".frm_header").html(dochead);

    });


    $(document).on("submit", "#investorRelationFrom", function(event) {
        event.preventDefault();
        var mode = $("#mode").val();
        var formData = new FormData($(this)[0]);
        console.log(formData);
    if (valiadteMaster()) {
        if (detailDocumentValidation()) {
            $("#savebtn").css("display", "none");
            $("#loader").css("display", "block");
            $.ajax({
                url: basepath + "investor/investor_relation_action",
                type: "POST",
                dataType: "json",
                processData: false,
                contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                success: function(data) {
                    if (data.msg_status == 1) {
                        $("#msg").text(data.msg_data);
                        $("#loader").css("display", "none");
                        if(mode=="EDIT"){ $("#savebtn").css("display", "block");}
                    }else{
                        $("#msg").text(data.msg_data);
                        $("#savebtn").css("display", "block");
                        $("#loader").css("display", "none");
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
            });
         }
    }

    });

    $(document).on('input', "#title", function(e) {    
        e.preventDefault();
       var title= "investor-relations/"+$(this).val();
       var formattedText = title.toLowerCase().replace(/ /g, "-");
       $(page_url).val(formattedText);
    });

    	// Add Document Detail
	$(document).on("click", ".addDocument", function () {
		rowNoUpload++;
		$.ajax({
			type: "POST",
			url: basepath + "investor/adddetaildocument",
			dataType: "html",
			data: { rowNo: rowNoUpload },
			success: function (result) {
				//$("#detail_Document table").css("display", "block");
				$("#detail_Document table tbody").append(result);
				$(".select2").select2();
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
	}); // End Document Detail

	// Delete Table Row

	$(document).on("click", ".delDocType", function () {
		var currRowID = $(this).attr("id");
		var rowDtlNo = currRowID.split("_");
		$("tr#rowDocument_" + rowDtlNo[1] + "_" + rowDtlNo[2]).remove();
	});

	$(document).on("change", ".fileName", function () {
		var currRowID = $(this).attr("id");
		var rowDtlNo = currRowID.split("_");
		var IDSNo = rowDtlNo[1] + "_" + rowDtlNo[2];
		//var inpID = "#isChangedFile_"+rowDtlNo[1]+"_"+rowDtlNo[2];

		var newfileName = $("#fileName_" + IDSNo)[0].files[0].name;
		var prvVal = $("#prvFilename_" + IDSNo).val();

		if (newfileName != prvVal) {
			$("#isChangedFile_" + IDSNo).val("Y");
		}
	});
	$(document).on("click", ".browse", function () {
		var file = $(this).parent().parent().parent().find(".file");
		file.trigger("click");
	});
	$(document).on("change", ".file", function () {
		$(this).parent().find(".form-control").val($(this).val().replace(/C:\\fakepath\\/i, "")
			);
	});

    $(document).on("click", ".relstatus", function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var uid = $(this).attr("id");
        var status = $(this).data("setstatus");
        var status = $(this).data("setstatus");
        var relations_master_id = $(this).data("relationsmasterid");
        //var url = basepath + "media/setStatus";
        $.ajax({
            url: basepath + 'investor/setRelationStatus',
            dataType: 'json',
            type: 'post',
            data: { uid: uid, status: status },
            success: function (result) {
                if (result.msg_status == 1) {
                   if (relations_master_id==1) {loadPartialView("#tab_one", basepath + "investor/corporate_governance_partial_view"); }
                   if (relations_master_id==2) {loadPartialView("#tab_two", basepath + "investor/shareholders_information_partial_view");}
                   if (relations_master_id==3) {loadPartialView("#tab_three", basepath + "investor/financials_partial_view"); }
                   if (relations_master_id==4) {loadPartialView("#tab_four", basepath + "investor/notice_partial_view"); }
                }

                Toast.fire({
                    type: 'success',
                    title: result.msg_data
                })
            }
        });

    });


    
}); // end of document ready

function loadAddEditView(basepath,relations_master_id,relations_dtl_id){
    
    $("#add_edit_view_data").html("Loading....");
    
    $.ajax({
        url: basepath + "investor/add_edit_investor_relations_partial_view",
        type: 'POST',
        data: {relations_master_id:relations_master_id,relations_dtl_id:relations_dtl_id},
        success: function(data) {
            $("#add_edit_view_data").html(data);
          
        },
        error: function(xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}


function loadDocumentView(basepath,relations_master_id,relations_dtl_id){
    
    $("#document_view_data").html("Loading....");
    
    $.ajax({
        url: basepath + "investor/investor_relations_docs_partial_view",
        type: 'POST',
        data: {relations_master_id:relations_master_id,relations_dtl_id:relations_dtl_id},
        success: function(data) {
            $("#document_view_data").html(data);
          
        },
        error: function(xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}
function loadPartialView(tabId, partialViewUrl) {

    
    $("#tab_one_data,#tab_two_data,#tab_three_data,#tab_four_data").html("");
    $.ajax({
        url: partialViewUrl,
        type: 'GET',
        success: function(data) {
            $(tabId + "_data").html(data);
            $('.dataTable').DataTable({ paging: false });
        },
        error: function(xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}

function valiadteMaster(){
    var title = $("#title").val();

	$("#titleerr").css("border", "unset");

	if (title == "") {
		$("#titleerr").css("border", "1px solid red");
		$("#title").focus();
		return false;
	}

	return true;
}


function detailDocumentValidation() {
	var isValid = true;
	$(".docType").each(function () {
		var doctype_id = $(this).attr("id");
		var docTypeIDS = doctype_id.split("_");
		var docTypeVal = $(this).val();
        
		

		var tdIDS = "#docType_" + docTypeIDS[1] + "_" + docTypeIDS[2];
		var tdIDS2 = "#userFileName_" + docTypeIDS[1] + "_" + docTypeIDS[2];

		var filename = $(tdIDS2).val();

		$(tdIDS).removeAttr("title");
		$(tdIDS).css("background", "inherit");

		if (docTypeVal == "") {
			$(tdIDS).attr("title", "Enter Title");
			$(tdIDS).css("background", "#FFD2D2");

			isValid = false;
		}

		if (filename == "") {
			$(tdIDS2).attr("title", "Select Document");
			$(tdIDS2).css("background", "#FFD2D2");

			isValid = false;
		}
	});

	return isValid;
}