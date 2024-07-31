<script type="text/javascript">
    $(document).ready(function () {


        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });

        var basepath = $("#basepath").val();


        $(document).on('click', '#savebtn', function (event) {
            event.preventDefault();
            $("#errormsg").text('');
            var faq_del_id = $('#faq_del_id').val();
            var mode = $('#mode').val();
            var faq_question = $('#faq_question').val();
            var faq_answer = $('#faq_answer').val();
            var model_id = $('#model_id').val();
            var product_id = $('#product_id').val();



            if (Validate()) {

                $("#savebtn").css('display', 'none');
                $("#loaderbtn").css('display', 'inline-block');

                $.ajax({
                    type: "POST",
                    url: basepath + 'master/faq_action',
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data: {
                        faq_del_id: faq_del_id,
                        mode: mode,
                        faq_question: faq_question,
                        faq_answer: faq_answer,
                        model_id: model_id,
                        product_id: product_id
                    },
                    success: function (result) {
                        if (result.msg_status == 1) {
                            Toast.fire({
                                type: "success",
                                title: result.msg_data,
                            });
                            $("#savebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'master/faq_view';
                        } else {
                            Toast.fire({
                                type: "error",
                                title: result.msg_data,
                            });
                        }
                    },

                    error: function (jqXHR, exception) {
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


    });

    function Validate() {

        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });

        $(".err-border").removeClass("err-border");
        var faq_question = $('#faq_question').val();
        var faq_answer = $('#faq_answer').val();

        if (faq_question == "") {
            $("#faq_question").focus().addClass("err-border");
            Toast.fire({
                type: "error",
                title: "Enter faq question",
            });
            return false;
        }
        if (faq_answer == "") {
            $("#faq_answer").focus().addClass("err-border");
            Toast.fire({
                type: "error",
                title: "Enter faq answer",
            });
            return false;
        }


        return true;

    }


    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>
<section class="layout-box-content-format1">
    <div class="card card-primary form-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">FAQ </h3>
            <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">
                <a href="<?php echo base_url(); ?>master/faq_view" class="btn btn-info btnpos">
                    <i class="fas fa-clipboard-list"></i> List </a>
            </div>
        </div>
        <!-- /.card-header -->
        <form name="sectorFrom" id="sectorFrom" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
            <input type="hidden" name="faq_del_id" id="faq_del_id" value="<?php echo $bodycontent['faqid']; ?>">
            <div class="card-body">
                <div class="formblock-box">

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="Function" class="form-label">Chose Product</label>
                                <div id="product_iderr">
                                    <select class="form-select select2" name="product_id" id="product_id">
                                        <option value="">Select</option>
                                        <?php foreach ($bodycontent['productList'] as $key => $value) { ?>
                                            <option value="<?php echo $value['product_master_id'] ?>" <?php echo $value['product_master_id'] == $bodycontent['faqEditdata']->product_id ? 'selected' : '' ?>>
                                                <?php echo $value['name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="Function" class="form-label">Chose Model</label>
                                <div id="model_iderr">
                                    <select class="form-select select2" name="model_id" id="model_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <label for="groupname"> Question
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="faq_question" id="faq_question"
                                        placeholder="Enter Question" value="<?php if ($bodycontent['mode'] == 'EDIT') {
                                            echo $bodycontent['faqEditdata']->faq_question;
                                        } ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2"> </div>
                        <div class="col-md-8">
                            <label for="groupname"> Answer
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" name="faq_answer" id="faq_answer" cols="5" rows="5"><?php if ($bodycontent['mode'] == 'EDIT') {
                                        echo $bodycontent['faqEditdata']->faq_answer;
                                    } ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="formblock-box">
                <div class="row">
                    <div class="col-md-10">
                        <p id="errormsg" class="errormsgcolor"></p>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="submit" class="btn btn-sm action-button" id="savebtn"
                            style="width: 80%;"><?php echo $bodycontent['btnText']; ?>&nbsp;<i
                                class="fas fa-chevron-right"></i></button>
                        <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                            style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>

<script>
    $(document).ready(function () {
        $("#product_id").on("change", function () {
            var basepath = $("#basepath").val();
            var product_id = $("#product_id").val();
            $("#model_id").empty();

            $.ajax({
                type: "POST",
                url: basepath + "master/fetchmodel",
                dataType: "json",
                data: { product_id: product_id },
                success: function (result) {
                    $("#model_id").append('<option value="">Select</option>');
                    result.forEach(function (item) {
                        var selected = (item.spec_sheet_dt_id == <?php echo $bodycontent['faqEditdata']->model_id; ?>) ? ' selected' : '';
                        $("#model_id").append('<option value="' + item.spec_sheet_dt_id + '"' + selected + '>' + item.model + '</option>');
                    });

                },
                error: function (jqXHR, exception) {

                }
            });
        });

        if ($("#mode").val() == "EDIT") {
            $("#product_id").val(<?php echo $bodycontent['faqEditdata']->product_id ?>).trigger("change");
        }
    });
</script>