$(document).ready(function () {
	var basepath = $("#basepath").val();
	var rowNoUpload = 0;
	mode = $("#mode").val();
	if (mode == "EDIT") {
		var selected_commerceId = $("#dtl_commerceValues").val();
		var selected_attr = selected_commerceId.split(",");
		console.log(selected_attr);
		$("#type_of_commerce").val(selected_attr).change();
	}
	$(document).on("change", "#type_of_commerce", function (event) {
		event.stopImmediatePropagation();

		var commerceIDs = [];

		$.each($("#type_of_commerce option:selected"), function () {
			commerceIDs.push($(this).val());
		});
		$("#dtl_commerceValues").val(commerceIDs.toString());
	});

	$(document).on("submit", "#startupFrom", function (event) {
		event.preventDefault();
		$("#errormsg").text("");
		var mode = $("#mode").val();
		if (valiadteStartup()) {
			if (detailDocumentValidation()) {
				var formData = new FormData($(this)[0]);

				// var formDataserialize = $("#startupFrom").serialize();
				// formDataserialize = decodeURI(formDataserialize);
				// var formData = { formDatas: formDataserialize };

				$("#startupsavebtn").css("display", "none");
				$("#loaderbtn").css("display", "block");
				$.ajax({
					type: "POST",
					url: basepath + "startup/startup_action",
					dataType: "json",
					processData: false,
					contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
					data: formData,
					success: function (result) {
						if (result.msg_status == 1) {
							window.location.href = basepath + "startup";
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
			}
		} // end master validation
	});

	// Add Document Detail
	$(document).on("click", ".addDocument", function () {
		rowNoUpload++;
		$.ajax({
			type: "POST",
			url: basepath + "startup/adddetaildocument",
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
		$(this)
			.parent()
			.find(".form-control")
			.val(
				$(this)
					.val()
					.replace(/C:\\fakepath\\/i, "")
			);
	});
}); /* end of document ready */

function valiadteStartup() {
	var startup_type_id = $("#startup_type_id").val();
	var company_name = $("#company_name").val();

	$("#company_name,#startup_typeerr").css("border", "unset");

	if (startup_type_id == "0") {
		$("#startup_typeerr").css("border", "1px solid red");
		$("#startup_type_id").focus();
		return false;
	}

	if (company_name == "") {
		$("#company_name").css("border", "1px solid red");
		$("#company_name").focus();
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
		//console.log(doctype_id);

		var tdIDS = "#docTypeEr_" + docTypeIDS[1] + "_" + docTypeIDS[2];
		var tdIDS2 = "#userFileName_" + docTypeIDS[1] + "_" + docTypeIDS[2];

		var filename = $(tdIDS2).val();

		$(tdIDS).removeAttr("title");
		$(tdIDS).css("background", "inherit");

		if (docTypeVal == 0) {
			$(tdIDS).attr("title", "Select Doc Type");
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
