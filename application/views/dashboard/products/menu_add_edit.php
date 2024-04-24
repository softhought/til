<script src="<?php echo base_url(); ?>assets-admin/ckeditor/ckeditor.js?v=<?php echo date('YmdHis'); ?>"></script>
<style>
    #cke_description {
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
                    <h3 class="card-title">Products Menu</h3>
                </div><!-- /.card-header -->
                <form name="menuForm" id="menuForm" class="p-4" enctype="multipart/form-data">

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
                    <hr>
                    <div class="formblock-box">
                        <div class="row">
                            <div class="col-md-10"><span id="msg" style="font-weight: bold;color: #1c1809;"><span>
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="submit" class="btn btn-sm action-button" id="savebtn"
                                    style="width: 60%;"><?php echo isset($bodycontent["editData"]) ? "Update" : "Save" ?></button>
                                <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                                    style="display:none;width: 60%;">Processing....</span>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </div>
    <div class="col-md-1"></div>
</div>

<script>
    $(document).on('input', "#title", function (e) {
        e.preventDefault();
        var title = $(this).val();
        var formattedText = title.toLowerCase().replace(/ /g, "-");
        $(slug).val(formattedText);
    });
</script>

<script>
    $(document).ready(function () {
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

            if ($("#short_description").val().trim() === "") {
                $("#short_descriptionerr").css("border", "1px solid red");
                $("#short_descriptionerr").css("border-radius", "5px");
                valid = false;
            } else {
                $("#short_descriptionerr").css("border", "");
            }

            return valid;
        }

        $("#menuForm").on("submit", function (e) {
            e.preventDefault();

            var isValid = validate();

            if (isValid) {
                $("#loaderbtn").show();
                $("#savebtn").hide();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: `<?php echo base_url(); ?>menu/addeditaction`,
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $("#loaderbtn").hide();
                            $("#savebtn").show();
                            window.location.replace(`${base_url}product-list`);
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
</script>