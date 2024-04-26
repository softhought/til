<script src="<?php echo base_url(); ?>assets-admin/ckeditor/ckeditor.js?v=<?php echo date('YmdHis'); ?>"></script>
<style>
    #cke_about {
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
                    <h3 class="card-title">Team Add Edit</h3>
                </div><!-- /.card-header -->
                <form name="teamform" id="teamform" class="p-4" enctype="multipart/form-data">

                    <input type="hidden" id="mode" name="mode"
                        value="<?php echo isset($bodycontent["editData"]) ? "edit" : "add" ?>">
                    <input type="hidden" name="team_member_id" id="team_member_id"
                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->team_member_id : "" ?>">

                    <div class="row">
                        <div class="col-md-4">
                            <label for="groupname">Member Name</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm" id="member_name_err">
                                    <input type="text" class="form-control" name="member_name" id="member_name"
                                        placeholder="Enter member_name"
                                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->member_name : "" ?>"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <input type="file" name="member_picfile" class="file fileName" id="member_picfile"
                            accept="image/*">
                        <div class="col">
                            <label for="groupname">Upload Image</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group input-group-sm" id="member_picerr">
                                        <input type="text" name="member_pic" id="member_pic" style="width: max-content;"
                                            class="form-control userFileName"
                                            value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->member_pic : "" ?>"
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
                                    id="member_picBtn">
                                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="groupname"> Designation</label>
                            <div class="form-group" id="designation_err">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" style="width: 100%;" name="designation" id="designation"
                                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->designation : "" ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="groupname"> Din No</label>
                            <div class="form-group" id="din_no_err">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" style="width: 100%;" name="din_no" id="din_no"
                                        value="<?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->din_no : "" ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="Function" class="form-label">Role</label>
                                <div id="team_member_type_err">
                                    <select class="form-select select2" name="team_member_type" id="team_member_type">
                                        <option value="">Select</option>
                                        <?php foreach ($bodycontent["role"] as $key => $value) { ?>
                                            <option value="<?php echo $value["key"] ?>" <?php if (isset($bodycontent["editData"]) && $bodycontent["editData"]->team_member_type == $value["key"]) {
                                                echo "selected";
                                            } ?>><?php echo $value["value"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="set_name_error" class="invalid-feedback d-block error-text"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> Address</label>
                            <div class="form-group" id="address_err">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" style="width: 100%;" name="address"
                                        id="address"><?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->address : "" ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> About</label>
                            <div class="form-group" id="about_err">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control ckeditor" style="width: 100%;" name="about"
                                        id="about"><?php echo isset($bodycontent["editData"]) ? $bodycontent["editData"]->about : "" ?></textarea>
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
                                    style="display:none;width: 100%;">Processing....</span>
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
    $(document).ready(function () {
        $("#member_picBtn").on("click", function () {
            $("#member_picfile").click();
        });

        $("#member_picfile").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $("#member_pic").val(fileName);
        });

        function validate() {
            var valid = true;

            if ($("#member_name").val().trim() === "") {
                $("#member_name_err").css("border", "1px solid red");
                $("#member_name_err").css("border-radius", "5px");
                valid = false;
            } else {
                $("#member_name_err").css("border", "");
            }

            if ($("#member_pic").val().trim() === "") {
                $("#member_picerr").css("border", "1px solid red");
                $("#member_picerr").css("border-radius", "5px");
                valid = false;
            } else {
                $("#member_picerr").css("border", "");
            }


            if ($("#designation").val().trim() === "") {
                $("#designation_err").css("border", "1px solid red");
                $("#designation_err").css("border-radius", "5px");
                valid = false;
            } else {
                $("#designation_err").css("border", "");
            }

            if ($("#din_no").val().trim() === "") {
                $("#din_no_err").css("border", "1px solid red");
                $("#din_no_err").css("border-radius", "5px");
                valid = false;
            } else {
                $("#din_no_err").css("border", "");
            }

            if ($("#address").val().trim() === "") {
                $("#address_err").css("border", "1px solid red");
                $("#address_err").css("border-radius", "5px");
                valid = false;
            } else {
                $("#address_err").css("border", "");
            }

            if ($("#about").val().trim() === "") {
                $("#about_err").css("border", "1px solid red");
                $("#about_err").css("border-radius", "5px");
                valid = false;
            } else {
                $("#about_err").css("border", "");
            }

            if ($("#team_member_type").val().trim() === "") {
                $("#team_member_type_err").css("border", "1px solid red");
                $("#team_member_type_err").css("border-radius", "5px");
                valid = false;
            } else {
                $("#team_member_type_err").css("border", "");
            }

            return valid;
        }

        $("#teamform").on("submit", function (e) {
            e.preventDefault();

            var isValid = validate();

            if (isValid) {
                $("#loaderbtn").show();
                $("#savebtn").hide();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: `<?php echo base_url(); ?>team/addeditaction`,
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $("#loaderbtn").hide();
                            $("#savebtn").show();
                            window.location.replace(`<?php echo base_url(); ?>team`);
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