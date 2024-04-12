<script type="text/javascript">
$(document).ready(function() {

    var Toast = Swal.mixin({
        toast: true,

        position: "top-end",

        showConfirmButton: false,

        timer: 3000,
    });
    var basepath = $("#basepath").val();

    $(document).on('click', '#savebtn', function(event) {
        event.preventDefault();
        $("#errormsg").text('');

        var userId = $('#userId').val();
        var mode = $('#mode').val();
        var new_password = $('#new_password').val();


        if (Validate()) {
            $("#savebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');

            $.ajax({
                type: "POST",
                url: basepath + 'user/passward_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {
                    userId: userId,
                    mode: mode,
                    new_password: new_password
                },
                success: function(result) {

                    if (result.msg_status == 1) {



                        Toast.fire({
                            type: "success",

                            title: result.msg_data,
                        });

                        $("#savebtn").css('display', 'inline-block');
                        $("#loaderbtn").css('display', 'none');
                        window.location.href = basepath + 'dashboard';

                    } else {

                        Toast.fire({
                            type: "error",

                            title: result.msg_data,
                        });

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


        }


    });


    $(document).on("input", "#old_password", function() {
        var userId = $("#userId").val();
        var old_password = $("#old_password").val();
        var urlpath = basepath + "user/checkPass";

        // $("#old_password_right,#old_password_wrong").hide();
        $.ajax({
            type: "POST",
            url: urlpath,
            data: {
                userId: userId,
                old_password: old_password
            },
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(result) {
                if (result.msg_status == 1) {
                    $("#savebtn,#old_password_right").show();
                    $("#old_password_wrong").hide();
                } else {
                    $("#old_password_wrong").show();
                    $("#old_password_right,#savebtn").hide();
                }
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
                alert(msg);
            },
        }); /*end ajax call*/
    });


    function Validate() {
        var Toast = Swal.mixin({
            toast: true,

            position: "top-end",

            showConfirmButton: false,

            timer: 3000,
        });

        $(".err-border").removeClass("err-border");

        if ($("#old_password").val() == "") {
            $("#old_password").focus().addClass("err-border");

            Toast.fire({
                type: "error",

                title: "Enter Current Password",
            });

            return false;
        }



        var password = $("#new_password").val();

        var cpassword = $("#cpassword").val();

        if (password == "") {
            $("#new_password").focus().addClass("err-border");

            Toast.fire({
                type: "error",

                title: "Enter new password",
            });

            return false;
        }

        if (cpassword == "") {
            $("#cpassword").focus().addClass("err-border");

            Toast.fire({
                type: "error",

                title: "Confirm password",
            });

            return false;
        }

        if (password != cpassword) {
            Toast.fire({
                type: "error",

                title: "Confirm is not matching",
            });

            $("#cpassword").focus().addClass("err-border");

            return false;
        }

        return true;
    }

});
</script>


<section class="layout-box-content-format1">

    <div class="card card-primary form-view">

        <div class="card-header box-shdw">
            <h3 class="card-title">Change Password</h3>
            <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" > -->
            <!--  <a href="<?php echo base_url(); ?>sector" class="btn btn-info btnpos">
                        <i class="fas fa-clipboard-list"></i> List </a> -->
            <!-- </div>            -->
        </div><!-- /.card-header -->



        <form name="sectorFrom" id="sectorFrom" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
            <input type="hidden" name="userId" id="userId" value="<?php echo $bodycontent['userId']; ?>">
            <div class="card-body">



                <div class="formblock-box">
                    <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Info</h3>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label for="groupname"> Current Password *
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="old_password" id="old_password"
                                        placeholder="Enter Current Password" value="" autocomplete="off">
                                    &nbsp; <span style="color: green;display:none;" id="old_password_right"><i
                                            class="fa fa-check-circle" aria-hidden="true"></i></span>
                                    <span style="color: red;display:none;" id="old_password_wrong"><i
                                            class="fa fa-times" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div></div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label for="groupname"> New Password *
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="password" class="form-control" name="new_password" id="new_password"
                                        placeholder="Enter New Password" value="" autocomplete="off">

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label for="groupname"> Confirm Password *
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="password" class="form-control" name="cpassword" id="cpassword"
                                        placeholder="Enter Confirm Password" value="" autocomplete="off">

                                </div>
                            </div>
                        </div>

                    </div>


                </div>



            </div> <!-- /.card-body -->



            <div class="formblock-box">
                <div class="row">
                    <div class="col-md-10">
                        <p id="errormsg" class="errormsgcolor"></p>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="submit" class="btn btn-sm action-button" id="savebtn"
                            style="width: 80%;"><?php echo $bodycontent['btnText']; ?>&nbsp;<i class="fas fa-chevron-right"></i></button>
                        <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                            style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>

                    </div>
                </div>
            </div>





        </form>





    </div><!-- /.card -->


</section>