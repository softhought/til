<script src="<?php echo base_url(); ?>assets-admin/ckeditor/ckeditor.js?v=<?php echo date('YmdHis'); ?>"></script>
<style>
    #cke_description {
        width: -moz-available;
    }

    .cke_2 {
        width: -moz-available;
    }

    .file {
        visibility: hidden;
        position: absolute;
    }

    .checkbox input[type="checkbox"] {
        position: relative;
        right: 0px;

    }

    .table td,
    .table th {
        vertical-align: middle !important;
    }

    #detail_Document .form-group {
        margin-bottom: 0;
        padding: 4px;
    }

    .fa-trash-alt {
        color: #c01212;
        font-size: 15px;
        font-weight: bold;
    }

    .browse {
        margin-left: -20px !important;
    }

    #category_css {
        margin-left: -115px;
    }

    @media only screen and (max-width: 600px) {
        #category_css {
            margin-left: -0px;
        }
    }
</style>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <section class="layout-box-content-format1">
            <div class="card card-primary list-view">
                <div class="card-header box-shdw">
                    <h3 class="card-title">Products Page</h3>
                </div><!-- /.card-header -->
                <form name="productform" id="productform" class="p-4" enctype="multipart/form-data">

                    <input type="hidden" id="mode" name="mode"
                        value="<?php echo isset($bodycontent["editData"]) ? "edit" : "add" ?>">
                    <input type="hidden" name="slug" id="slug"
                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->slug : "" ?>">
                    <input type="hidden" name="parent_id" id="parent_id"
                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->parent_id : $bodycontent["parentId"] ?>">
                    <input type="hidden" name="product_master_id" id="product_master_id"
                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->product_master_id : "" ?>">

                    <div class="row">
                        <div class="col-md-4">
                            <label for="groupname">Title</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm" id="titleerr">
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="Enter Title"
                                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->name : "" ?>"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <input type="file" name="bannerimagefile" class="file fileName" id="bannerimagefile"
                            accept="image/*">
                        <div class="col">
                            <label for="groupname">Upload banner image</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group input-group-sm" id="bannerimageerr">
                                        <input type="text" name="bannerimage" id="bannerimage"
                                            style="width: max-content;" class="form-control userFileName"
                                            value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->banner_image : "" ?>"
                                            readonly placeholder="Upload Document">
                                    </div>
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button class="browse btn input-xs btn-sm" type="button"
                                    style="background: #f8bb06; color: #000; padding: 7px; margin-top: 30px; margin-left: -8px !important;"
                                    id="bannerimageUploadBtn">
                                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                        <input type="file" name="catagory_image_file" class="file fileName" id="catagory_image_file"
                            accept="image/*">
                        <div class="col" id="category_css">
                            <label for="groupname">Upload catagory image</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group input-group-sm" id="catagory_image_err">
                                        <input type="text" name="catagory_image" id="catagory_image"
                                            style="width: max-content;" class="form-control userFileName"
                                            value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->catagory_image : "" ?>"
                                            readonly placeholder="Upload Document">
                                    </div>
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button class="browse btn input-xs btn-sm" type="button"
                                    style="background: #f8bb06; color: #000; padding: 7px; margin-top: 30px; margin-left: -8px !important;"
                                    id="catagoryimageuploadBtn">
                                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> Short Description</label>
                            <div class="form-group" id="short_descriptionerr">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" style="width: 100%;" name="short_description"
                                        id="short_description"><?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->short_description : "" ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> Description</label>
                            <div class="form-group" id="mail_bodyerr">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control ckeditor" style="width: 100%;" name="description"
                                        id="description"><?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->about : "" ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="p-3" style="margin-top: -35px">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="product_model_partialview"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="formblock-box p-2">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-sm action-button" id="createmodeltemplate"
                                    style="width: 60%;" disabled>Create Model Template</button>
                            </div>
                            <div class="col-md-4"><span id="msg" style="font-weight: bold;color: #1c1809;"><span>
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="submit" class="btn btn-sm action-button" id="savebtn"
                                    style="width: 60%;"><?php echo isset($bodycontent["editData"]) ? "Update" : "Save" ?></button>
                                <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                                    style="display:none;width: 100%;">Processing....</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-1"></div>
</div>

<!-- Model -->
<div id="createmodeltemplateModel" class="modal fade customModal format1 right" data-keyboard="false"
    data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background:#ffcd11; padding: 10px; color: #fff;">
                <h4 class="frm_header"></h4>
                <button type="button" class="close" style="color: white; opacity: 1;" data-dismiss="modal">&times;<span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body" style="min-height: 350px;height: 650px overflow-y: auto;">
                <form name="createtemplateform" id="createtemplateform" class="p-4" enctype="multipart/form-data">
                    <input type="hidden" value="" name="model_product_master_id" id="model_product_master_id">
                    <input type="hidden" value="" name="model_mode" id="model_mode">
                    <input type="hidden" value="" name="prodect_model_dt_id" id="prodect_model_dt_id">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="groupname">Title</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm" id="model_titleerr">
                                    <input type="text" class="form-control" name="model_title" id="model_title"
                                        placeholder="Enter Title" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="Function" class="form-label">Chose Template</label>
                                <div id="template_seterr">
                                    <select class="form-select select2" name="template_set" id="template_set"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tableContainer"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> Description</label>
                            <div class="form-group" id="mail_bodyerr">
                                <div class="input-group input-group-sm" id="model_descriptionerr">
                                    <textarea class="form-control" style="width: 100%; height: 100px"
                                        name="model_description" id="model_description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="formblock-box">
                        <div class="row">
                            <div class="col-md-10"><span id="msg" style="font-weight: bold;color: #1c1809;"><span>
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="submit" class="btn btn-sm action-button" id="modelsavebtn"
                                    style="width: 60%;"></button>
                                <span class="btn btn-sm action-button loaderbtn" id="modelloaderbtn"
                                    style="display:none;width: 100%;">Processing....</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('input', "#title", function (e) {
        e.preventDefault();
        var title = $(this).val();
        var formattedText = title.toLowerCase().replace(/ /g, "-");
        $(slug).val(formattedText);

    });
    CKEDITOR.replaceAll('ckeditor1');
    function updateEditorContent() {
        var ckeditors = CKEDITOR.instances;
        for (var instance in ckeditors) {
            ckeditors[instance].updateElement();
        }
    }
</script>

<script>
    $(document).ready(function () {
        load_product_model_partial_view($("#product_master_id").val());
        $("#createmodeltemplate").click(function () {
            $("#createtemplateform")[0].reset();
            $("#model_product_master_id").val($("#product_master_id").val());
            $("#model_mode").val("add");
            $("#modelsavebtn").text("Save");
            var selectElement = $("#template_set");
            selectElement.empty();
            selectElement.append($("<option>").val("").text("Select"));
            $.ajax({
                url: `<?php echo base_url(); ?>product/fetchtemplate`,
                type: 'GET',
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status) {
                        response.data.forEach(function (item) {
                            var newOption = $("<option>")
                                .val(item.template_id)
                                .text(item.template_name);
                            selectElement.append(newOption);
                        });
                    }
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                }
            });
            $("#createmodeltemplateModel").modal("show");
        });

        $("#template_set").change(function () {
            var template_id = $("#template_set").val();
            showTemplateTable(template_id);
        });
    });

    function showTemplateTable(template_id) {
        $("#tableContainer").empty();
        $.ajax({
            url: `<?php echo base_url(); ?>product/fetchtemplatecolumn`,
            type: 'POST',
            dataType: "json",
            data: { template_id: template_id },
            success: function (response) {
                if (response.status) {
                    var tableContainer = $("#tableContainer");
                    var table = $("<table>").addClass("table customTbl table-bordered table-hover dataTable dataContainer");
                    var tableHeader = $("<thead>");
                    var headerRow = $("<tr>");

                    for (var key in response.data) {
                        if (response.data.hasOwnProperty(key)) {
                            var th = $("<th>").text(response.data[key]);
                            headerRow.append(th);
                        }
                    }
                    tableHeader.append(headerRow);
                    table.append(tableHeader);

                    var tableBody = $("<tbody>");
                    var tableRow = $("<tr>");
                    for (var key in response.data) {
                        if (response.data.hasOwnProperty(key)) {
                            if (key == "spec_sheet") {
                                var td = $("<td>").text("PDF");
                            } else {
                                var td = $("<td>").text("TEXT");
                            }
                            tableRow.append(td);
                        }
                    }
                    tableBody.append(tableRow);
                    table.append(tableBody);

                    tableContainer.append(table);
                }
            },
            error: function (jqXHR, exception) {
                console.error(jqXHR);
                console.error(exception);
            }
        });
    }

    function editModelTemplate(prodect_model_dt_id) {
        $.ajax({
            url: `<?php echo base_url(); ?>product/fetchtemplatedata`,
            type: 'POST',
            dataType: "json",
            data: { prodect_model_dt_id: prodect_model_dt_id },
            success: function (response) {
                if (response.status) {
                    $("#modelsavebtn").text("Update");
                    $("#model_mode").val("edit");
                    $("#prodect_model_dt_id").val(response.data.prodect_model_dt_id);
                    $("#model_product_master_id").val(response.data.product_master_id);
                    $("#model_title").val(response.data.title);
                    $("#model_description").val(response.data.about);

                    var selectElement = $("#template_set");
                    selectElement.empty();
                    selectElement.append($("<option>").val("").text("Select"));
                    $.ajax({
                        url: `<?php echo base_url(); ?>product/fetchtemplate`,
                        type: 'GET',
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function (template_response) {
                            if (template_response.status) {
                                var selectedTemplateId = response.data.template_master_id;
                                template_response.data.forEach(function (item) {
                                    var newOption = $("<option>")
                                        .val(item.template_id)
                                        .text(item.template_name);
                                    if (item.template_id === selectedTemplateId) {
                                        newOption.attr("selected", "selected");
                                    }
                                    selectElement.append(newOption);
                                });
                            }
                        },
                        error: function (jqXHR, exception) {
                            console.log(jqXHR);
                            console.log(exception);
                        }
                    });

                    showTemplateTable(response.data.template_master_id);
                    $("#createmodeltemplateModel").modal("show");
                }
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
                console.log(exception);
            }
        });
    }

    function templateValidate() {
        var valid = true;

        if ($("#model_title").val().trim() === "") {
            $("#model_titleerr").css("border", "1px solid red");
            $("#model_titleerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#model_titleerr").css("border", "");
        }

        if ($("#template_set").val().trim() === "") {
            $("#template_setrr").css("border", "1px solid red");
            $("#template_setrr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#template_setrr").css("border", "");
        }

        if ($("#model_description").val().trim() === "") {
            $("#model_descriptionerr").css("border", "1px solid red");
            $("#model_descriptionerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#model_descriptionerr").css("border", "");
        }

        return valid;
    }

    function load_product_model_partial_view(product_master_id) {
        $("#product_model_partialview").html("");
        $.ajax({
            url: "<?php echo base_url(); ?>product/fetchproductmodelpartialview",
            type: 'POST',
            data: { product_master_id: product_master_id },
            success: function (data) {
                $("#product_model_partialview").html(data);

            },
            error: function (xhr, status, error) {
                console.error("Error loading partial view:", error);
            }
        });
    }

    $("#createtemplateform").on("submit", function (e) {
        e.preventDefault();

        var isValid = templateValidate();

        if (isValid) {
            $("#modelloaderbtn").show();
            $("#modelsavebtn").hide();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: `<?php echo base_url(); ?>product/modeladdeditaction`,
                type: 'POST',
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status) {
                        $("#modelloaderbtn").hide();
                        $("#modelsavebtn").show();
                        $("#createtemplateform")[0].reset();
                        $("#createmodeltemplateModel").modal("hide");
                    }
                    load_product_model_partial_view($("#product_master_id").val());

                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function () {
        if ($("#product_master_id").val() != "") {
            $("#createmodeltemplate").prop("disabled", false);
        }
        $("#bannerimageUploadBtn").on("click", function () {
            $("#bannerimagefile").click();
        });

        $("#bannerimagefile").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $("#bannerimage").val(fileName);
        });

        $("#catagoryimageuploadBtn").on("click", function () {
            $("#catagory_image_file").click();
        });

        $("#catagory_image_file").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $("#catagory_image").val(fileName);
        });

        $("#savebtn").on("click", function(e) {
            $("#productform").submit();
        })

        $("#productform").on("submit", function (e) {
            e.preventDefault();

            var isValid = validate();

            if (isValid) {
                updateEditorContent();
                $("#loaderbtn").show();
                $("#savebtn").hide();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: `<?php echo base_url(); ?>product/addeditaction`,
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $("#loaderbtn").hide();
                            $("#savebtn").show();
                            if ($("#mode").val() == "add") {
                                $("#product_master_id").val(response.product_master_id);
                                $("#createmodeltemplate").prop("disabled", false);
                                window.location.replace(
                                    window.location.href.split("/").slice(0, -3).concat(response.product_master_id, "product", "edit").join("/")
                                );

                            }
                        }
                    },
                    error: function (jqXHR, exception) {
                        console.log(jqXHR);
                        console.log(exception);
                    }
                });
            }
        });


    });

    function validate() {
        var valid = true;

        if ($("#title").val().trim() === "") {
            $("#titleerr").css("border", "1px solid red");
            $("#titleerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#titleerr").css("border", "");
        }

        if ($("#bannerimage").val().trim() === "") {
            $("#bannerimageerr").css("border", "1px solid red");
            $("#bannerimageerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#bannerimageerr").css("border", "");
        }

        if ($("#catagory_image").val().trim() === "") {
            $("#catagory_image_err").css("border", "1px solid red");
            $("#catagory_image_err").css("border-radius", "5px");
            valid = false;
        } else {
            $("#catagory_image_err").css("border", "");
        }

        if ($("#short_description").val().trim() === "") {
            $("#short_descriptionerr").css("border", "1px solid red");
            $("#short_descriptionerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#short_descriptionerr").css("border", "");
        }

        return valid;
    }
</script>