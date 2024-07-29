$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        orientation: 'auto',
        todayHighlight: true
    });
    investorList();
    var rowNoUpload = 0;
    $("#maincontainer").removeClass("container");
    $("#maincontainer").addClass("container-fluid");
    bsCustomFileInput.init();
    var basepath = $("#basepath").val();
    $("#reln_other").hide();
    var mode = $("#mode").val();
    // if (mode == "EDIT") {
    // 	var selectedCode = $("#relationship_id").find("option:selected");
    // 	var rel_type = selectedCode.data("type");

    // 	if (rel_type == "Others") {
    // 		$("#reln_other").show();
    // 	} else {
    // 		$("#reln_other").hide();
    // 	}
    // }
    // $('.dataTable').DataTable();
    $(".dataTable3").DataTable({
        lengthMenu: [
            [100, 250, 500, -1],
            [100, 250, 500, "All"],
        ],
    });


    $(document).on("keyup", "#invoice_no", function() {

        var invoice_no = $("#invoice_no").val();
        var invoice_type = $("#invoice_type").val();


        $("#generateproformainvoicebtn,#generategstinvoicebtn").hide();
        $("#error").html('');
        $.ajax({
            url: basepath + "investor/checkInvoiceNumber",
            method: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { invoice_no: invoice_no, invoice_type: invoice_type },
            success: function(data) {
                if (data.msg_status == 0) {
                    $("#error").html('This invoice number already used.' + data.msg_data);
                } else {
                    $("#generateproformainvoicebtn,#generategstinvoicebtn").show();
                }

            },
        });


    });

    /*------------------------------------------------*/
    $(document).on("click", ".editStatus", function(event) {
        event.preventDefault();
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');


        var inv_id = rowDtlNo[1];

        $("#drp_status_" + inv_id).toggle();
        $("#sample_status_" + inv_id).toggle();

    });

    $(document).on('change', '.invstatus', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');


        var inv_id = rowDtlNo[1];
        var changeType = 'D';
        var status = $("#invstatus_" + inv_id).val();


        var urlpath = basepath + 'investor/changestatus';
        if (confirm('are you sure!')) {



            $.ajax({
                type: "POST",
                url: urlpath,
                data: { inv_id: inv_id, status: status },
                dataType: "json",
                success: function(result) {
                    if (result.msg_status == 1) {
                        // $("#statusspan_"+inv_id).html("<b style='color: #4e3497;'>"+status+"</b>");
                        $("#drp_status_" + inv_id).hide();
                        var setStatus = '';
                        if (status == 'Active') {
                            setStatus = '<span class="badge badge-success">Active</span>';
                        } else if (status == 'Non Active') {
                            setStatus = '<span class="badge badge-dark">Non Active</span>';

                        } else if (status == 'Left') {
                            setStatus = '<span class="badge badge-danger">Left</span>';
                        }

                        $("#sample_status_" + inv_id).show();
                        $("#sample_status_" + inv_id).html(setStatus);
                        // $("#editStatus_"+inv_id).show();
                    }



                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    // alert(msg);  
                }
            });
        }



    });


    /*-----------------------------------------*/
    $(document).on("keyup", "#date_of_joining", function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var date_of_joining = $("#date_of_joining").val();
        var mode = $("#mode").val();

        if (mode == 'ADD') {
            $("#last_renewal_date").val(date_of_joining);
            $("#last_renewal_lebel").html('Membership Start Date');
        }




    });



    $(document).on("change", "#last_renewal_date", function(event) {
        event.preventDefault();
        event.stopImmediatePropagation()
        calculateNextRenewal();
    });

    $(document).on("keyup", "#tenure_of_membership", function(event) {
        event.preventDefault();
        event.stopImmediatePropagation()
        calculateNextRenewal();
    });

    $(document).on("click", ".addRel", function(event) {
        event.preventDefault();
        $("#new_rel_div").toggle();
    });

    $(document).on("click", "#saveNewRel", function(event) {
        event.preventDefault();
        var new_relationship = $("#new_relationship").val();
        $("#new_relationship").removeClass("form_error");

        if (new_relationship == "") {
            $("#new_relationship").addClass("form_error");
            $("#new_relationship").focus();
            return false;
        }
        $("#saveNewRel").addClass("nonclick");
        $.ajax({
            url: basepath + "investor/saveRelationship",
            method: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { new_relationship: new_relationship },
            success: function(data) {
                if (data.msg_status == 1) {
                    $("#new_relationship").val("");
                    resetRelationshipDrp(data.insert_id);
                    $("#new_rel_div").hide();
                    $("#saveNewRel").removeClass("nonclick");
                }
            },
        });
    });

    $(document).on("click", ".verifydtl", function(event) {
        event.preventDefault();
        var investor_id = $(this).attr("data-invid");
        var invcode = $(this).attr("data-invcode");
        $.ajax({
            url: basepath + "investor/checkVerify",
            method: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { investor_id: investor_id },
            success: function(data) {
                if (data.msg_status == 1) {
                    Swal.fire({
                        title: data.msg_data,
                        text: "(" + invcode + ")",
                        icon: "info",
                        width: 450,
                        padding: "1em",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok",
                        customClass: {
                            title: "alerttitale",
                            content: "alerttext",
                            confirmButton: "btn tbl-action-btn padbtn",
                        },
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = basepath + "investor";
                        }
                    });
                } else {
                    Swal.fire({
                        title: data.msg_data,
                        text: data.missing_data,
                        icon: "info",
                        width: 450,
                        padding: "1em",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok",
                        customClass: {
                            title: "alerttitale",
                            content: "alerttext",
                            confirmButton: "btn tbl-action-btn padbtn",
                        },
                    });
                }
            },
        });
    });

    $(document).on("submit", "#import_form", function(event) {
        event.preventDefault();

        if (validateform()) {
            $("#import").css("display", "none");
            $("#importloader").css("display", "block");
            $("#loader").css("display", "block");
            $.ajax({
                url: basepath + "investor/import",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.msg_status == 1) {
                        Swal.fire({
                            title: data.msg_data,
                            text: "(Insert:" +
                                data.insertcount +
                                " rows ,Update:" +
                                data.update_count +
                                " rows )",
                            icon: "info",
                            width: 450,
                            padding: "1em",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok",
                            customClass: {
                                title: "alerttitale",
                                content: "alerttext",
                                confirmButton: "btn tbl-action-btn padbtn",
                            },
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = basepath + "investor/import_view";
                            }
                        });
                    }
                },
            });
        }
    });

    $(document).on("click", ".update", function() {
        var id = $(this).attr("data-insid");
        var dsr_rate = $("#dsr_rate_" + id).val();
        var market_rate = $("#market_rate_" + id).val();

        $("#update_" + id).css("display", "none");
        $("#updloader_" + id).css("display", "block");
        $.ajax({
            url: basepath + "Itemimport/item_update",
            method: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { id: id, dsr_rate: dsr_rate, market_rate: market_rate },
            success: function(data) {
                if (data.msg_status == 1) {
                    $("#update_" + id).css("display", "block");
                    $("#updloader_" + id).css("display", "none");
                }
            },
        });
    });

    $(document).on("submit", "#investorFrom", function(event) {
        event.preventDefault();
        $("#errormsg").text("");
        var mode = $("#mode").val();
        if (valiadteInvestor()) {
            if (detailDocumentValidation()) {
                var formData = new FormData($(this)[0]);

                // var formDataserialize = $("#investorFrom").serialize();
                // formDataserialize = decodeURI(formDataserialize);
                // var formData = { formDatas: formDataserialize };

                $("#investorsavebtn").css("display", "none");
                $("#loaderbtn").css("display", "block");
                $.ajax({
                    type: "POST",
                    url: basepath + "investor/investor_action",
                    dataType: "json",
                    processData: false,
                    contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                    data: formData,
                    success: function(result) {
                        if (result.msg_status == 1) {
                            window.location.href = basepath + "investor";
                        } else {}
                    },

                    error: function(jqXHR, exception) {
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

    $(document).on("change", "#sector_interest_to_invest", function(event) {
        event.stopImmediatePropagation();

        var sectorIDs = [];

        $.each($("#sector_interest_to_invest option:selected"), function() {
            sectorIDs.push($(this).val());
        });
        $("#dtl_sectorValues").val(sectorIDs.toString());
    });
    mode = $("#mode").val();
    if (mode == "EDIT") {
        var selected_sectorId = $("#dtl_sectorValues").val();
        var selected_attr = selected_sectorId.split(",");
        // console.log(selected_attr);
        $("#sector_interest_to_invest").val(selected_attr).change();


        var country_master_id = $("#country_master_id").val();

        // if(country_master_id==99 || country_master_id==0) {
        // 		$("#state_name_div").hide();
        // 		$("#state_drp_div,#inv_gstin_no_div,#inv_has_gstin_div").show();
        // 	}else{
        // 		$("#state_name_div").show();
        // 		$("#state_drp_div,#inv_gstin_no_div,#inv_has_gstin_div").hide();
        // 	}	



    }



    $(document).on("change", "#country_master_id", function() {

        var country_master_id = $("select[name=country_master_id]").val();



        // $("#state_master_iderr").html("");
        // $.ajax({
        //   type: "POST",
        //   url: basepath + "investor/getStateByCountry",
        //   data: { country_master_id: country_master_id},

        //   success: function (data) {

        //     $("#inv_state_iderr").html(data);
        //      $('.select2').select2();

        //   },
        //   error: function (jqXHR, exception) {
        //     var msg = "";
        //     if (jqXHR.status === 0) {
        //       msg = "Not connect.\n Verify Network.";
        //     } else if (jqXHR.status == 404) {
        //       msg = "Requested page not found. [404]";
        //     } else if (jqXHR.status == 500) {
        //       msg = "Internal Server Error [500].";
        //     } else if (exception === "parsererror") {
        //       msg = "Requested JSON parse failed.";
        //     } else if (exception === "timeout") {
        //       msg = "Time out error.";
        //     } else if (exception === "abort") {
        //       msg = "Ajax request aborted.";
        //     } else {
        //       msg = "Uncaught Error.\n" + jqXHR.responseText;
        //     }
        //     // alert(msg);
        //   },
        // }); 



        getStateByCountry(country_master_id, basepath);
    });

    $(document).on("change", "#inv_state_id", function() {

        var inv_state_id = $("select[name=inv_state_id]").val();



        // $("#city_mastererr").html("");
        // $.ajax({
        //   type: "POST",
        //   url: basepath + "investor/getCityByState",
        //   data: { inv_state_id: inv_state_id},

        //   success: function (data) {

        //     $("#city_mastererr").html(data);
        //      $('.select2').select2();

        //   },
        //   error: function (jqXHR, exception) {
        //     var msg = "";
        //     if (jqXHR.status === 0) {
        //       msg = "Not connect.\n Verify Network.";
        //     } else if (jqXHR.status == 404) {
        //       msg = "Requested page not found. [404]";
        //     } else if (jqXHR.status == 500) {
        //       msg = "Internal Server Error [500].";
        //     } else if (exception === "parsererror") {
        //       msg = "Requested JSON parse failed.";
        //     } else if (exception === "timeout") {
        //       msg = "Time out error.";
        //     } else if (exception === "abort") {
        //       msg = "Ajax request aborted.";
        //     } else {
        //       msg = "Uncaught Error.\n" + jqXHR.responseText;
        //     }
        //     // alert(msg);
        //   },
        // }); /*end ajax call*/

        getCityByState(basepath, inv_state_id);

    });




    /* On select  select state */
    $(document).on("change", "#sel_chapter_filter,#sel_status,#city_master_filter,#user_master_id", function() {
        // var sel_chapter = $("select[name=sel_chapter_filter]").val();
        var sel_chapter = 0;
        var city_master_id = $("select[name=city_master_filter]").val();
        var user_master_id = $("select[name=user_master_id]").val();
        //var sel_chapter = 0;
        var sel_status = $("select[name=sel_status]").val();
        $("#loader").css("display", "block");
        $("#investor_list").html("");
        $.ajax({
            type: "POST",
            url: basepath + "investor/getInvestorListByChapter",
            data: { sel_chapter: sel_chapter, sel_status: sel_status, city_master_id: city_master_id, user_master_id: user_master_id },

            success: function(data) {
                $("#loader").css("display", "none");
                $("#investor_list").html(data);
                $('.select2').select2();
                $(".dataTable3").DataTable({
                    "scrollX": true,
                    "scrollY": 500,
                    lengthMenu: [
                        [100, 250, 500, -1],
                        [100, 250, 500, "All"],
                    ],
                });
            },
            error: function(jqXHR, exception) {
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

    $(document).on("change", "#membership_type_id", function() {
        var selectedCode = $("#membership_type_id").find("option:selected");
        $("#subscription_amt").val(selectedCode.data("subamt"));
        $("#renewal_amt").val(selectedCode.data("renamt"));
    });

    // $(document).on("change", "#relationship_id", function () {
    // 	var selectedCode = $("#relationship_id").find("option:selected");
    // 	var rel_type = selectedCode.data("type");

    // 	if (rel_type == "Others") {
    // 		$("#reln_other").show();
    // 	} else {
    // 		$("#reln_other").hide();
    // 	}
    // });

    $(document).on("click", ".addNominee", function(e) {
        e.preventDefault();
        var rowno = $("#rowno").val();

        var relationship_id = $("#relationship_id").val();
        var relationship_name = $("#relationship_id option:selected").text();
        var nominee = $("#nominee").val();

        $("#nominee,#relationshiperr").removeClass("form_error");
        $("#error_msg").text("");

        if (nominee == "") {
            $("#nominee").addClass("form_error");
            $("#nominee").focus();
            return false;
        }

        if (relationship_id == "0") {
            $("#relationshiperr").addClass("form_error");
            $("#relationshiperr").focus();
            return false;
        }

        rowno++;
        $.ajax({
            type: "POST",
            url: basepath + "investor/addNomineeDetail",
            dataType: "html",
            data: {
                rowNo: rowno,
                relationship_id: relationship_id,
                relationship_name: relationship_name,
                nominee: nominee,
            },

            success: function(result) {
                $("#rowno").val(rowno);
                $("#detail_investdata table").show();
                $("#detail_investdata table tbody").append(result);

                $("#relationship_id").val("").change();
                $("#nominee").val("");

                //resetSerial();
            },
            error: function(jqXHR, exception) {
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
    }); // End Visiting Details

    $(document).on("click", ".editchilddetails", function(e) {
        e.preventDefault();
        var currRowID = $(this).attr("id");
        var rowDtlNo = currRowID.split("_");
        var editcheck = $("#editbtncheck_" + rowDtlNo[1]).val();
        $(".showdata1_" + rowDtlNo[1]).hide();
        $(".showdata2_" + rowDtlNo[1]).hide();

        $(".dispblock_" + rowDtlNo[1]).css("display", "block");
        $(".select2").select2();
    });

    $(document).on("click", ".emaildtl_btn", function(e) {
        e.preventDefault();

        $("#email_msg").html('');
        $("#sendmailbtn").show();
        $("#emailloaderbtn").hide();
        var investorid = $(this).data("investorid");
        var investorname = $(this).data("investorname");
        var investoremail = $(this).data("investoremail");
        var investorproinvid = $(this).data("investorproinvid");
        var investorgstinvid = $(this).data("investorgstinvid");

        $("#einvestor_id").val(investorid);
        $("#eproforma_invoice_id").val(investorproinvid);
        $("#egst_invoice_id").val(investorgstinvid);

        $("#investor_name").val(investorname);
        $("#email_investor").val(investoremail);

        getEmailSettings('New Membership', 'Y', 'Y');


    });

    $(document).on("change", "#is_gst_invoice,#is_proforma_invoice", function(e) {
        e.preventDefault();

        var checkboxValueproforma = $('#is_proforma_invoice').is(':checked');
        if (checkboxValueproforma) {
            var is_proforma_invoice = 'Y';
        } else {
            var is_proforma_invoice = 'N';
        }


        var checkboxValueinvoice = $('#is_gst_invoice').is(':checked');
        if (checkboxValueinvoice) {
            var is_gst_invoice = 'Y';
        } else {
            var is_gst_invoice = 'N';
        }

        getEmailSettings('New Membership', is_proforma_invoice, is_gst_invoice);
    });



    $(document).on("click", ".nomineedtl_btn", function(e) {
        e.preventDefault();
        var investorid = $(this).data("investorid");
        if (1) {
            $("#nominee_details_data").html("");
            $.ajax({
                type: "POST",
                url: basepath + "investor/nomineeDetails",
                dataType: "html",
                data: { investorid: investorid },
                success: function(result) {
                    $("#nomineeDetails").modal({ backdrop: false });
                    $("#nominee_details_data").html(result);
                    // $('.dataTable3').DataTable();
                },

                error: function(jqXHR, exception) {
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
    });

    // Add Document Detail
    $(document).on("click", ".addDocument", function() {
        rowNoUpload++;
        $.ajax({
            type: "POST",
            url: basepath + "investor/adddetaildocument",
            dataType: "html",
            data: { rowNo: rowNoUpload },
            success: function(result) {
                //$("#detail_Document table").css("display", "block");
                $("#detail_Document table tbody").append(result);
                $(".select2").select2();
            },
            error: function(jqXHR, exception) {
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

    $(document).on("click", ".delDocType", function() {
        var currRowID = $(this).attr("id");
        var rowDtlNo = currRowID.split("_");
        $("tr#rowDocument_" + rowDtlNo[1] + "_" + rowDtlNo[2]).remove();
    });

    $(document).on("change", ".fileName", function() {
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
    $(document).on("click", ".browse", function() {
        var file = $(this).parent().parent().parent().find(".file");
        file.trigger("click");
    });
    $(document).on("change", ".file", function() {
        $(this)
            .parent()
            .find(".form-control")
            .val(
                $(this)
                .val()
                .replace(/C:\\fakepath\\/i, "")
            );
    });


    $(document).on("click", ".createInvoiceSubscription", function(event) {
        event.preventDefault();
        var investor_id = $(this).attr("data-invid");
        var invcode = $(this).attr("data-invcode");
        var invtype = $(this).attr("data-invtype");


        if (invtype == 'PINV') {
            $(".frm_header").html("Generate Proforma Invoice ");
            var URL = basepath + "investor/proformaInvDetails";
        } else {
            $(".frm_header").html("Generate GST Invoice ");
            var URL = basepath + "investor/gstInvDetails";
        }


        var startDate = $("#acstartDate").val();
        var endDate = $("#acendDate").val();

        if (1) {
            $("#invoice_details_data").html("");
            $.ajax({
                type: "POST",
                url: URL,
                dataType: "html",
                data: { investor_id: investor_id },
                success: function(result) {
                    $("#invoiceDetails").modal({ backdrop: false });
                    $("#invoice_details_data").html(result);
                    $('.datepicker').datepicker({
                        format: 'dd/mm/yyyy',
                        startDate: startDate,
                        endDate: endDate,
                        autoclose: true,
                        orientation: 'bottom'
                    });
                    // $('.dataTable3').DataTable();
                },

                error: function(jqXHR, exception) {
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






        //createProformaInvoice(basepath,investor_id,invcode);

    });

    $(document).on("click", "#generateproformainvoicebtn", function(event) {
        event.preventDefault();


        var investor_code = $("#investor_code").val();
        var investor_id = $("#investor_id").val();
        var invest_dt = $("#invest_dt").val();

        var invoice_no = $("#invoice_no").val();
        //var mants_point = $("#mants_point").val();

        if (validateInvoice()) {

            $("#proInv_" + investor_id).hide();
            $("#generateproformainvoicebtn").hide();
            $("#loaderbtn").show();



            $.ajax({
                url: basepath + "investor/processGenerateProformaInvoice",
                method: "POST",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: { investor_id: investor_id, invest_dt: invest_dt, invoice_no: invoice_no },
                success: function(data) {
                    $("#invoice_no").prop('readonly', true);
                    if (data.msg_status == 1) {
                        $(".pfinvprint").show();
                        $("#loaderbtn").hide();
                        $("#proInvprint_" + investor_id).show();

                        var printlink = basepath + "investor/printProformaInvoice/" + data.proformaInvoiceid;
                        $("#success").html(data.missing_data);

                        //console.log(whatsapp);
                        $(".pfinvprint").prop("href", printlink);

                        $("#proInvprint_" + investor_id).prop("href", printlink);
                    } else {
                        $("#error").html(data.missing_data);
                    }




                },
            });
        }


    });


    /*--------------------start Send mail -----------------------*/

    $(document).on("click", "#sendmailbtn", function(event) {
        event.preventDefault();


        var email_investor = $("#email_investor").val();
        var investor_id = $("#einvestor_id").val();
        var proforma_invoice_id = $("#eproforma_invoice_id").val();
        var gst_invoice_id = $("#egst_invoice_id").val();



        var checkboxValueproforma = $('#is_proforma_invoice').is(':checked');
        if (checkboxValueproforma) {
            var is_proforma_invoice = 'Y';
        } else {
            var is_proforma_invoice = 'N';
        }


        var checkboxValueinvoice = $('#is_gst_invoice').is(':checked');
        if (checkboxValueinvoice) {
            var is_gst_invoice = 'Y';
        } else {
            var is_gst_invoice = 'N';
        }



        if (is_proforma_invoice == 'N' && is_gst_invoice == 'N') {
            alert("Please select check box")
            return false;
        }


        $("#sendmailbtn").hide();
        $("#emailloaderbtn").show();


        $.ajax({
            url: basepath + "investor/emailInvoice",
            method: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {
                email_investor: email_investor,
                investor_id: investor_id,
                gst_invoice_id: gst_invoice_id,
                proforma_invoice_id: proforma_invoice_id,
                is_proforma_invoice: is_proforma_invoice,
                is_gst_invoice: is_gst_invoice,
            },
            success: function(data) {
                if (data.msg_status == 1) {

                    $("#emailloaderbtn").hide();
                    $("#sendmailbtn").show();
                    $("#email_msg").html(data.msg_data);


                    var printlink = basepath + "investor/printGstInvoice/" + data.gstInvoiceid;
                    $("#success").html(data.missing_data);


                } else {
                    $("#error").html(data.missing_data);
                }




            },
        });


    });


    /*--------------------end Send mail -----------------------*/



    $(document).on("click", "#generategstinvoicebtn", function(event) {
        event.preventDefault();


        var investor_code = $("#investor_code").val();
        var investor_id = $("#investor_id").val();
        var proforma_invoice_id = $("#proforma_invoice_id").val();
        var invest_dt = $("#invest_dt").val();
        var invoice_no = $("#invoice_no").val();

        if (validateInvoice()) {
            $("#gstInv_" + investor_id).hide();
            $("#generategstinvoicebtn").hide();
            $("#loaderbtn").show();


            $.ajax({
                url: basepath + "investor/processGenerateGstInvoice",
                method: "POST",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: { investor_id: investor_id, invest_dt: invest_dt, proforma_invoice_id: proforma_invoice_id, invoice_no: invoice_no },
                success: function(data) {
                    $("#invoice_no").prop('readonly', true);
                    if (data.msg_status == 1) {
                        $(".gstinvprint").show();
                        $("#loaderbtn").hide();
                        $("#gstInvprint_" + investor_id).show();

                        var printlink = basepath + "investor/printGstInvoice/" + data.gstInvoiceid;
                        $("#success").html(data.missing_data);

                        //console.log(whatsapp);
                        $(".gstinvprint").prop("href", printlink);
                        $("#gstInvprint_" + investor_id).prop("href", printlink);
                    } else {
                        $("#error").html(data.missing_data);
                    }




                },
            });

        }


    });




    // $(document).on("change", "#country_master_id", function (event) {
    // 	event.preventDefault();
    // 	var country_master_id = $("#country_master_id").val();
    // 	//alert(country_master_id);
    // 	$("#inv_state_name").val('');

    // 	if(country_master_id==99 || country_master_id==0) {
    // 		$("#state_name_div").hide();
    // 		$("#state_drp_div,#inv_gstin_no_div,#inv_has_gstin_div").show();
    // 	}else{
    // 		$("#state_name_div").show();
    // 		$("#state_drp_div,#inv_gstin_no_div,#inv_has_gstin_div").hide();
    // 	}
    // 	//$("#new_rel_div").toggle();
    // });



    $(document).on('click', '#saveStatebtn', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        $("#errormsg").text('');

        var stateId = 0;
        var state_name_model = $('#state_name_model').val();
        var mode = "ADD";
        var country_master_id = $('#country_master_id_model').val();

        $("#state_name_model,#countryeerr").removeClass('form_error');

        if (country_master_id == '0') {
            $("#countryeerr").addClass('form_error');
            $("#countryeerr").focus();
            return false;
        }
        if (state_name_model == '') {
            $("#state_name_model").addClass('form_error');
            $("#state_name_model").focus();
            return false;
        }
        $('#saveStatebtn').prop('disabled', true);


        $.ajax({
            type: "POST",
            url: basepath + 'state/state_action',
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {
                stateId: stateId,
                mode: mode,
                country_master_id: country_master_id,
                state_name: state_name_model
            },
            success: function(result) {

                if (result.msg_status == 1) {

                    $('#saveStatebtn').prop('disabled', false);
                    $('#stateModal').modal('hide');
                    $("#country_master_id").val(country_master_id).change();
                    getStateByCountry(country_master_id, basepath);
                    $("#inv_state_id").val(result.state_id).change();

                }


            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                // alert(msg);  
            }
        }); /*end ajax call*/





    });



    $(document).on('click', '.addState', function() {
        var country_master_id = $("select[name=country_master_id]").val();

        $("#country_master_id_model").val(country_master_id).change();
    });



    $(document).on('click', '.addCity', function() {

        var country_master_id = $("select[name=country_master_id]").val();
        var state_master_id = $("select[name=inv_state_id]").val();
        $("#city_model_body").html("loading...");

        $.ajax({
            type: "POST",
            url: basepath + "city/add_city_partial_view",
            data: { country_master_id: country_master_id, state_master_id: state_master_id },

            success: function(data) {

                $("#city_model_body").html(data);
                $('.select2').select2();

            },
            error: function(jqXHR, exception) {
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


    //Inactive Investor 
    $(document).on("click", "#view_inactive", function() {

        var from_dt = $("#from_dt").val();
        var to_dt = $("#to_dt").val();
        $("#investor_list").html("");
        $("#loader").show();
        $.ajax({
            type: "POST",
            url: basepath + "investor/partialinactiveinvestor",
            data: { from_dt: from_dt, to_dt: to_dt },

            success: function(data) {
                $("#investor_list").html(data);
                $("#loader").hide();
                $(".dataTable3").DataTable({
                    lengthMenu: [
                        [100, 250, 500, -1],
                        [100, 250, 500, "All"],
                    ],
                });
            },
            error: function(jqXHR, exception) {
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

    $("#view_inactive").trigger('click');


}); /* end of document ready  */

function detailDocumentValidation() {
    var isValid = true;
    $(".docType").each(function() {
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

function validateform() {
    var file = $("#file").val();
    var sel_chapter = $("#sel_chapter").val();
    $("#fileerr,#sel_chaptererr").css("border", "unset");
    if (sel_chapter == "0") {
        $("#sel_chaptererr").css("border", "1px solid red");
        $("#sel_chapter").focus();
        return false;
    }
    if (file == "") {
        $("#fileerr").css("border", "1px solid red");
        $("#file").focus();
        return false;
    }
    return true;
}

function valiadteInvestor() {
    var country_master_id = $("#country_master_id").val();

    var city_master_id = $("#city_master_id").val();
    var inv_state_id = $("#inv_state_id").val();
    var date_of_joining = $("#date_of_joining").val();

    var membership_type_id = $("#membership_type_id").val();
    var last_renewal_date = $("#last_renewal_date").val();
    var renewal_date = $("#renewal_date").val();
    var calculated_renewal_date = $("#calculated_renewal_date").val();
    var tenure_of_membership = $("#tenure_of_membership").val();
    $("#city_mastererr,#last_renewal_date,#renewal_date,#renewal_date_note,#date_of_joining,#countryerr,#inv_state_iderr,#has_gstinerr,#inv_state_name,#inv_gstin_no,#membership_typeerr,#tenure_of_membershiperr").css(
        "border",
        "1px solid #ced4da"
    );

    $("#sel_chaptererr,#countryerr,#inv_state_iderr").css(
        "border",
        "unset"
    );


    // $(
    // 	"#collapseOne1,#collapseTwo2,#collapseThree3,#collapseThree4,#collapseThree5"
    // ).hide();




    if (country_master_id == "0") {
        $("#collapseOne1").show();
        $("#countryerr").css("border", "1px solid red");
        $("#country_master_id").focus();
        return false;
    }

    // if(country_master_id==99) {
    // 		var inv_state_id = $("#inv_state_id").val();
    // 		var inv_gstin_no = $("#inv_gstin_no").val();

    // 	if (inv_state_id == "0") {
    // 	$("#collapseTwo2").show();
    // 	$("#inv_state_iderr").css("border", "1px solid red");
    // 	$("#inv_state_id").focus();
    // 	return false;
    // 	}

    // }else{
    // 	var inv_state_name = $("#inv_state_name").val();
    // 	if (inv_state_name == "") {
    // 		$("#collapseTwo2").show();
    // 		$("#inv_state_name").css("border", "1px solid red");
    // 		$("#inv_state_name").focus();
    // 		return false;
    // 	}

    // }

    if (inv_state_id == "0") {
        $("#collapseOne1").show();
        $("#inv_state_iderr").css("border", "1px solid red");
        $("#inv_state_id").focus();
        return false;
    }


    if (city_master_id == "0") {
        $("#collapseOne1").show();
        $("#city_mastererr").css("border", "1px solid red");
        $("#sel_chapter").focus();
        return false;
    }

    if (date_of_joining == "") {
        $("#collapseOne1").show();
        $("#date_of_joining").css("border", "1px solid red");
        $("#date_of_joining").focus();
        return false;
    }



    if (membership_type_id == "0") {
        $("#collapseThree5").show();
        $("#membership_typeerr").css("border", "1px solid red");
        $("#membership_type_id").focus();
        return false;
    }

    if (last_renewal_date == "") {
        $("#collapseThree5").show();
        $("#last_renewal_date").css("border", "1px solid red");
        $("#last_renewal_date").focus();
        return false;
    }
    /* commented on 23022023 by shankha*/
    // if (
    //     tenure_of_membership == "" ||
    //     tenure_of_membership == "0" ||
    //     tenure_of_membership == "0.00"
    // ) {
    //     $("#collapseThree5").show();
    //     $("#tenure_of_membershiperr").css("border", "1px solid red");
    //     $("#tenure_of_membership").focus();
    //     return false;
    // }


    // if (renewal_date == "") {
    //     $("#collapseThree5").show();
    //     $("#renewal_date").css("border", "1px solid red");
    //     $("#renewal_date").focus();
    //     return false;
    // }



    // if (renewal_date != calculated_renewal_date) {

    //     var renewal_date_note = $("#renewal_date_note").val();
    //     if (renewal_date_note == "") {
    //         $("#collapseThree5").show();
    //         $("#renewal_date_note").css("border", "1px solid red");
    //         $("#renewal_date_note").focus();
    //         return false;
    //     }

    // }

    return true;
}

function resetRelationshipDrp(rel_id) {
    $("#loader").css("display", "block");
    $("#relationshiperr").html("");
    var basepath = $("#basepath").val();
    $.ajax({
        type: "POST",
        url: basepath + "investor/getRelationshipDrp",
        data: { rel_id: rel_id },

        success: function(data) {
            $("#loader").css("display", "none");
            $("#relationshiperr").html(data);
            $(".select2").select2();
        },
        error: function(jqXHR, exception) {
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


function calculateNextRenewal() {

    var basepath = $("#basepath").val();
    var tenure_of_membership = $("#tenure_of_membership").val();
    var last_renewal_date = $("#last_renewal_date").val();

    if (last_renewal_date == '') { return false; }
    if (tenure_of_membership == '') { return false; }
    $("#renewal_date").val('');

    $.ajax({
        url: basepath + "investor/calculateRenewalDate",
        method: "POST",
        dataType: "json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { tenure_of_membership: tenure_of_membership, last_renewal_date: last_renewal_date },
        success: function(data) {
            if (data.msg_status == 1) {
                $("#renewal_date,#calculated_renewal_date").val(data.renewal_date);
                $("#valid_upto").val(data.valid_upto);
            }




        },
    });


}



function getEmailSettings(invoice_type, is_proforma, is_gst) {
    var basepath = $("#basepath").val();
    $("#sendmailbtn").show();
    $("#errormsg").text('');
    $.ajax({
        url: basepath + "investor/checkEmailSettings",
        method: "POST",
        dataType: "json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { is_proforma: is_proforma, is_gst: is_gst, invoice_type: invoice_type },
        success: function(data) {
            if (data.msg_status == 1) {
                $("#email_subject").val(data.msg_data.mail_subject);
                $("#email_body").html(data.msg_body);
            } else {
                $("#errormsg").html(data.msg_data);
                $("#sendmailbtn").hide();
            }




        },
    });


}



function validateInvoice() {

    var invoice_no = $("#invoice_no").val();
    var invoice_type = $("#invoice_type").val();
    $("#invoice_no,#tenure_of_membership").css("border", "1px solid #c7b7bf");
    if (invoice_no == "") {
        $("#invoice_no").css("border", "1px solid red");
        $("#invoice_no").focus();
        return false;
    }

    // if (invoice_type=='G') {

    //    var tenure_of_membership = $("#tenure_of_membership").val();
    //     if (tenure_of_membership == "") {
    //       $("#tenure_of_membership").css("border", "1px solid red");
    //       $("#tenure_of_membership").focus();
    //       return false;
    //     }


    //     if (renewal_date == "") {
    //       $("#collapseThree5").show();
    //       $("#renewal_date").css("border", "1px solid red");
    //       $("#renewal_date").focus();
    //       return false;
    //     }



    //     if (renewal_date!=calculated_renewal_date) {

    //       var renewal_date_note = $("#renewal_date_note").val();
    //       if (renewal_date_note == "") {
    //       $("#collapseThree5").show();
    //       $("#renewal_date_note").css("border", "1px solid red");
    //       $("#renewal_date_note").focus();
    //       return false;
    //     }

    //     }

    // }

    return true;
}


function getStateByCountry(country_master_id, basepath) {



    $("#country_master_id_model").val(country_master_id).change();

    $("#state_master_iderr").html("");
    $.ajax({
        type: "POST",
        url: basepath + "investor/getStateByCountry",
        data: { country_master_id: country_master_id },

        success: function(data) {

            $("#inv_state_iderr").html(data);
            $('.select2').select2();

        },
        error: function(jqXHR, exception) {
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

function getCityByState(basepath, inv_state_id) {
    $("#city_mastererr").html("");
    $.ajax({
        type: "POST",
        url: basepath + "investor/getCityByState",
        data: { inv_state_id: inv_state_id },

        success: function(data) {

            $("#city_mastererr").html(data);
            $('.select2').select2();

        },
        error: function(jqXHR, exception) {
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

function investorList() {
    var rowNoUpload = 0;
    $("#maincontainer").removeClass("container");
    $("#maincontainer").addClass("container-fluid");
    //bsCustomFileInput.init();
    var basepath = $("#basepath").val();

    var page_heading = $("#page_heading").val();

    if (page_heading == "Investor List") {

        // var sel_chapter = $("select[name=sel_chapter_filter]").val();
        var sel_chapter = 0;
        var city_master_id = $("select[name=city_master_filter]").val();
        var user_master_id = $("select[name=user_master_id]").val();
        //var sel_chapter = 0;
        var sel_status = $("select[name=sel_status]").val();
        $("#loader").css("display", "block");
        $("#investor_list").html("");
        $.ajax({
            type: "POST",
            url: basepath + "investor/getInvestorListByChapter",
            data: { sel_chapter: sel_chapter, sel_status: sel_status, city_master_id: city_master_id, user_master_id: user_master_id },

            success: function(data) {
                $("#loader").css("display", "none");
                $("#investor_list").html(data);
                $('.select2').select2();
                $(".dataTable3").DataTable({
                    "scrollX": true,
                    "scrollY": 500,
                    lengthMenu: [
                        [100, 250, 500, -1],
                        [100, 250, 500, "All"],
                    ],
                });
            },
            error: function(jqXHR, exception) {
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

}