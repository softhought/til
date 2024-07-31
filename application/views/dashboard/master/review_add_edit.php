<style>
    .review-rating-edit .rating {
        font-size: 40px;
        color: #dba717;
        margin-right: 10px;
    }

    .review-rating-edit .rating {
        font-size: 40px;
        color: #dba717;
        margin-right: 10px;
        cursor: pointer;
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

    .category_css-md-3 {
        flex: 0 0 25%;
        max-width: 20%;
    }

    .browseBtn {
        margin-left: 10px;
    }

    @media only screen and (max-width: 600px) {
        .category_css-md-3 {
            position: relative;
            padding-left: 7.5px;
            flex: 0 0 80%;
            max-width: 100%;
        }

        .browseBtn {
            margin-left: 10px;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {


        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });

        var basepath = $("#basepath").val();


        $(document).on('submit', '#sectorFrom', function (event) {
            event.preventDefault();
            $("#errormsg").text('');
            var formData = new FormData($(this)[0]);


            if (Validate()) {

                $("#savebtn").css('display', 'none');
                $("#loaderbtn").css('display', 'inline-block');

                $.ajax({
                    type: "POST",
                    url: basepath + 'master/review_action',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (result) {
                        if (result.msg_status == 1) {
                            Toast.fire({
                                type: "success",
                                title: result.msg_data,
                            });
                            $("#savebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'master/review_view';
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
        var name = $('#name').val();
        var occupation = $('#occupation').val();
        var review = $('#review').val();
        var rating_value = $('#rating_value').val();
        var imagefile = $('#image').val();

        if (name == "") {
            $("#name").focus().addClass("err-border");
            Toast.fire({
                type: "error",
                title: "Enter Name",
            });
            return false;
        }
        if (occupation == "") {
            $("#occupation").focus().addClass("err-border");
            Toast.fire({
                type: "error",
                title: "Enter Occupation",
            });
            return false;
        }
        if (review == "") {
            $("#review").focus().addClass("err-border");
            Toast.fire({
                type: "error",
                title: "Enter Review",
            });
            return false;
        }

        if (rating_value == 0) {
            $("#rating_value").focus().addClass("err-border");
            Toast.fire({
                type: "error",
                title: "Enter Rating",
            });
            return false;
        }

        if (imagefile == 0) {
            $("#image").focus().addClass("err-border");
            Toast.fire({
                type: "error",
                title: "Upload Image",
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
            <h3 class="card-title">Review </h3>
            <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">
                <a href="<?php echo base_url(); ?>master/review_view" class="btn btn-info btnpos">
                    <i class="fas fa-clipboard-list"></i> List </a>
            </div>
        </div>
        <!-- /.card-header -->
        <form name="sectorFrom" id="sectorFrom" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
            <input type="hidden" name="id" id="id" value="<?php echo $bodycontent['id']; ?>">
            <input type="hidden" name="modelId" id="modelId" value="<?php echo $bodycontent['mode'] == "EDIT" ? $bodycontent['faqEditdata']->model_id : "" ?>">
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
                                            <option value="<?php echo $value['product_master_id'] ?>" <?php echo $value['product_master_id'] == $bodycontent['reviewEditdata']->product_id ? 'selected' : '' ?>>
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
                        <div class="col-md-3">
                            <label for="groupname"> Name
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Name" value="<?php if ($bodycontent['mode'] == 'EDIT') {
                                            echo $bodycontent['reviewEditdata']->name;
                                        } ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="groupname"> Occupation
                                <span id="occupation_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="occupation" id="occupation"
                                        placeholder="Enter Occupation" value="<?php if ($bodycontent['mode'] == 'EDIT') {
                                            echo $bodycontent['reviewEditdata']->occupation;
                                        } ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <input type="file" name="imagefile" class="file fileName" id="imagefile"
                            accept="image/*">

                        <div class="row">
                            <div class="col-md-10" style="margin-left: 4%;">
                                <div class="form-group">
                                    <label for="groupname">Upload image</label>
                                    <div class="input-group input-group-sm" id="imageerr">
                                        <input type="text" name="image" id="image"
                                            class="form-control userFileName" style="border-radius: 5px;"
                                            value="<?php echo isset($bodycontent["reviewEditdata"]) ? $bodycontent["reviewEditdata"]->image : '' ?>"
                                            readonly placeholder="512 x 512">
                                        <span class="input-group-btn" style="margin-left: 23px">
                                            <button class="btn btn-sm browse" type="button"
                                                style="background: #f8bb06; color: #000; padding: 7px;"
                                                id="imageUploadBtn">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2"> </div>
                        <div class="col-md-8">
                            <label for="groupname"> Review
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" name="review" id="review" cols="5" rows="5"><?php if ($bodycontent['mode'] == 'EDIT') {
                                        echo $bodycontent['reviewEditdata']->review;
                                    } ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2"> </div>
                        <div class="col-md-6">
                            <label for="groupname"> Rating
                                <span id="account_name_err" style="color:red;font-weight:bold;"></span>
                            </label>
                            <div class="review-rating-edit"
                                data-rating="<?php echo ($bodycontent['mode'] == 'EDIT') ? $bodycontent['reviewEditdata']->rating : 0; ?>">
                                <span class="rating"></span>
                            </div>
                            <input type="hidden" id="rating_value" name="rating_value"
                                value="<?php echo ($bodycontent['mode'] == 'EDIT') ? $bodycontent['reviewEditdata']->rating : 0; ?>">
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.review-rating-edit').forEach(function (ratingElement) {
            const ratingValue = parseFloat(ratingElement.getAttribute('data-rating'));
            const ratingContainer = ratingElement.querySelector('.rating');
            const hiddenInput = document.getElementById('rating_value');

            function renderStars(value) {
                ratingContainer.innerHTML = '';
                const fullStars = Math.floor(value);
                const halfStars = (value % 1) >= 0.5 ? 1 : 0;
                const emptyStars = 5 - fullStars - halfStars;

                for (let i = 0; i < fullStars; i++) {
                    const star = document.createElement('i');
                    star.className = 'fas fa-star';
                    star.dataset.value = i + 1;
                    ratingContainer.appendChild(star);
                }

                if (halfStars > 0) {
                    const halfStar = document.createElement('i');
                    halfStar.className = 'fas fa-star-half-alt';
                    halfStar.dataset.value = fullStars + 0.5;
                    ratingContainer.appendChild(halfStar);
                }

                for (let i = 0; i < emptyStars; i++) {
                    const star = document.createElement('i');
                    star.className = 'far fa-star';
                    star.dataset.value = fullStars + halfStars + i + 1;
                    ratingContainer.appendChild(star);
                }
            }

            function updateRating(newRating) {
                hiddenInput.value = newRating;
                renderStars(newRating);
            }

            renderStars(ratingValue);
            hiddenInput.value = ratingValue;

            ratingContainer.addEventListener('click', function (event) {
                if (event.target.tagName === 'I') {
                    const newRating = parseFloat(event.target.dataset.value);
                    updateRating(newRating);
                }
            });
        });
    });

</script>

<script>
    $("#imageUploadBtn").on("click", function () {
        $("#imagefile").click();
    });

    $("#imagefile").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $("#image").val(fileName);
    });
</script>

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
                        if ($("#mode").val() == "EDIT") {
                            var modelId = $("#modelId").val();
                            var selected = (item.spec_sheet_dt_id == modelId) ? ' selected' : '';
                        } else {
                            selected = '';
                        }
                        
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