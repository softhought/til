<style>
    .slick-carousel {
        position: relative;
    }

    .slick-prev::before,
    .slick-next::before {
        line-height: 1;
        color: #ffc72c;
        font-weight: bold !important;
        font-size: 35px;
    }

    .testimonial-profile {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .testimonial-profile .pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 1px solid #dca842;
        overflow: hidden;
        margin-right: 20px;
    }

    .view-more-container {
        text-align: center;
        margin-top: 1.5rem;
    }

    #view-more-faqs {
        background-color: #ffc72c;
        color: #000;
        border: none;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #view-more-faqs:hover {
        background-color: #cea32a;
    }

    .testimonial-profile .text-content {
        flex: 1;
    }

    .testimonial-profile .title {
        font-size: 19px;
        font-weight: bold;
        color: #dca842;
        margin: 0;
    }

    .testimonial-profile .post {
        display: block;
        font-size: 14px;
        font-weight: normal;
        color: #888;
        margin-top: 10px;
    }

    .testimonial-content {
        margin-top: 20px;
    }

    .slick-prev,
    .slick-next {
        font-size: 24px;
        color: #dca842;
        width: 30px;
        height: 30px;
    }

    .slick-prev::before,
    .slick-next::before {
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        content: "\f053";
    }

    .slick-next::before {
        content: "\f054";
    }

    .slick-prev {
        left: 10px;
    }

    .slick-next {
        right: 10px;
    }

    .slick-dots {
        display: none;
    }

    .review-rating .rating {
        font-size: 20px;
        color: #dba717;
        margin-right: 10px;
    }

    .product_content h2 {
        font-size: 18px;
        font-weight: bold;
    }

    .curvebg {
        margin-top: 20px;
        margin-bottom: 45px;
        background: none;
        padding: 0 30px;
    }

    .form-control-ff {
        display: block;
        width: 100%;
        height: 50px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }

    .panel-default>.panel-heading {
        color: #333;
    }

    .mt-ff-2 {
        margin-bottom: 2rem;
    }

    .quote-btn {
        width: 400px !important;
    }

    .toggle-button {
        cursor: pointer;
        color: black;
        font-size: 16px;
        display: flex;
        align-items: center;
        font-weight: 600;
        margin-bottom: 2rem;
    }

    .toggle-button:hover {
        color: black;
    }

    .toggle-button .arrow {
        margin-left: 10px;
        transition: transform 0.3s;
    }

    .content {
        display: none;
        margin-top: 20px;
    }

    .toggle-button.active .arrow {
        transform: rotate(180deg);
    }

    .about-banner-section {
        position: relative;
        background-size: cover;
        background-position: center;
        height: 300px;
    }

    .breadcrumb-nav {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
    }

    .breadcrumb {
        padding: 10px;
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .breadcrumb-item a {
        color: white;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .breadcrumb>li+li::before {
        padding: 0 5px;
        color: #ccc;
        content: "|";
    }

    .form-inline {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .form-inline input,
    .form-inline button {
        margin: 0.5rem;
    }

    .content_section {
        margin: 0 0 0 2rem;
    }

    .error-message {
        color: red;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .bg-pix {
        position: relative;
        padding-left: 20px !important;
        margin-bottom: 20px !important;
        height: 10rem;
    }

    .bg-pix img {
        width: 100% !important;
        height: 470px;
        object-fit: cover;
        border-radius: 6px;
        position: inherit;
        left: 0 !important;
    }

    .bg-pix::before {
        position: absolute;
        left: 5px;
        top: 20px;
        width: calc(100% - 35px);
        height: 10rem;
        background-color: #ffc72c;
        border-radius: 6px;
        content: "";
    }

    .aboutText-p p {
        line-height: 18px !important;
        font-size: 14px;
        width: 97%;
        text-align: left;
        color: #525252;
        margin: 25px 0;
        margin: 0;
        font-weight: 400;
    }

    @media (max-width: 768px) {
        .form-inline input {
            width: calc(100% - 1rem);
        }

        .form-inline button {
            width: 100%;
        }

        .product-item-blank {
            display: none;
        }

        .product-item img {
            width: 100%;
            height: auto;
        }

        .about-banner-section {
            height: 200px;
        }

        .breadcrumb-nav {
            bottom: 10px;
            left: 10px;
            font-size: 12px;
        }

        .breadcrumb {
            padding: 5px;
        }

        .breadcrumb-item a {
            font-size: 14px;
        }

        .about-banner-section::before {
            background: rgba(0, 0, 0, 0);
        }

        .form-inline button {
            width: 35%;
            margin-left: 2.1rem;
            margin-top: -1rem;
        }

        .aboutText h2 {
            font-size: 13px;
        }

        .responsive-product {
            margin-left: -1rem;
        }

        .product-item {
            margin-left: -1rem;
        }

        .slick-next {
            margin-right: -0.2rem;
        }

        .no-product-item {
            display: none;
        }

        .product-head-mobile {
            display: block;
        }

        .product-head-mobile strong {
            font-size: 22px !important;
        }

        .call-mobile a {
            display: block;
            text-align: center;
        }

        .quote-btn {
            width: 23rem !important;
            display: block;
            text-align: center;
            align-content: center;
        }

        #productSearchForm {
            margin: -6rem 0 2rem -2rem !important;
        }

        .model-mobile h2 {
            margin-top: 5rem !important;
        }

        .bg-pix::before {
            height: 12rem !important;
        }

        .bg-pix img {
            height: 12rem !important;
        }
    }
</style>
<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->banner_image; ?>); position: relative;">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">TIL</a></li>
                <!-- <li class="breadcrumb-item"><a href="<?php echo base_url() . isNew(); ?>category">Category</a></li> -->
                <li class="breadcrumb-item"><a
                        href="<?php echo base_url() . isNew(); ?>category"><?php echo ucwords(str_replace('-', ' ', $bodycontent['rootSlug'])); ?></a>
                </li>
                <li class="breadcrumb-item"><a href="#"><?php echo $bodycontent["main-section"][0]->name; ?></a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>contact-us/inquiry">Support</a></li>
            </ol>
        </nav>
    </div>
</section>



<div class="row" style="margin-top: 6rem">
    <!-- <div class="col-md-1"></div> -->
    <div class="col-md-10">


        <section class="content_section">
            <div class="container">
                <form class="form-inline" style="margin: -3rem 0 0 -2rem;" id="productSearchForm" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search Products" aria-label="Search"
                        style="margin: 2rem; width: 40rem; height: 2.7rem;" name="productSearch" id="productSearch">
                    <button class="btn btn-outline-success my-2 my-sm-0" style="background: #ffc72c;"
                        type="submit">Search</button>
                </form>
                <div class="responsive-product">
                    <div class="aboutText mb-2">
                        <h1 class="mb-2 fc-black"><?php echo $bodycontent["main-section"][0]->name; ?></h1>
                        <h2><?php echo $bodycontent["main-section"][0]->short_description; ?></h2>
                        <figure>

                            <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png" alt="rectangle" />

                            <hr style="width: 30rem;" />

                        </figure>
                    </div>

                    <section class="product-details">
                        <div class="container">
                            <div class="row curvebg pl-0">
                                <div class="col-lg-5">
                                    <div class="homepix" style="margin-left: -14px;margin-right: 14px;">
                                        <div class="box-behind"></div>
                                        <img src="<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->left_image != "" ? $bodycontent["main-section"][0]->left_image : $bodycontent["main-section"][0]->catagory_image; ?>"
                                            class="img-responsive"
                                            alt="<?php echo $bodycontent["main-section"][0]->name; ?>" />
                                    </div>

                                </div>

                                <div class="col-lg-7 col-12 p-responsive">
                                    <div class="aboutText-p"><?php echo $bodycontent["main-section"][0]->about; ?>
                                        <a class="read-btn quote-btn" data-toggle="modal" data-target="#myModal">
                                            <!-- Get TIL <?php echo $bodycontent["main-section"][0]->model; ?> Cost -->
                                            <!-- Check <?php echo $bodycontent["main-section"][0]->name; ?> Price -->
                                            Request for a quote
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="product_content">
                        <?php echo $bodycontent["main-section"][0]->general_description; ?>
                    </div>

                    <div>
                        <?php foreach ($bodycontent['sheet_model'] as $key => $value) { ?>
                            <div class="row" style="margin-top: 4rem;margin-left: 0px;">
                                <div class="col-md-3 bg-pix">
                                    <?php
                                    $image = !empty($value->image)
                                        ? base_url() . "assets/images/" . $value->image
                                        : 'https://icon-library.com/images/no-picture-available-icon/no-picture-available-icon-1.jpg';
                                    ?>
                                    <img src="<?php echo $image ?>" alt="<?php echo $image ?>"
                                        style="width: 16rem; height: 10rem; border-radius: 5px;">
                                </div>
                                <div class="col-md-9 model-mobile">
                                    <h2><?php echo $value->model . " (" . $bodycontent["main-section"][0]->name . ")"; ?>
                                    </h2>
                                    <p><?php echo $value->short_description ?></p>
                                    <a href="<?php echo base_url() . isNew() . "category/" . $bodycontent['rootSlug'] . "/" . $bodycontent["main-section"][0]->slug . "/" . $value->slug; ?>"
                                        style="background: #ffc72c; color: black; font-size: 16px; border-radius: 5px; text-transform: uppercase; display: flex; gap: 10px; font-weight: 500; padding: 15px; width: 12rem;">Learn
                                        More <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="">
                        <h1 class="mt-ff-2" style="margin-top: 2rem;">Frequently Asked Questions</h1>
                        <div id="accordion" role="tablist" aria-multiselectable="true" style="margin-left: 10px;">
                            <?php $index = 1;
                            $totalFAQs = count($bodycontent["faq"]);
                            foreach ($bodycontent["faq"] as $key => $faqValue) {
                                // Hide FAQs if there are more than 2
                                $isHidden = $index > 3 ? 'style="display:none;"' : ''; ?>
                                <div class="panel" <?php echo $isHidden; ?> data-index="<?php echo $index; ?>">
                                    <div class="panel-heading" role="tab" id="heading_<?php echo $index; ?>">
                                        <h3 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapse_<?php echo $index; ?>"
                                                aria-expanded="false" aria-controls="collapse_<?php echo $index; ?>">
                                                <?php echo $faqValue->faq_question; ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapse_<?php echo $index; ?>" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="heading_<?php echo $index; ?>">
                                        <div class="panel-body">
                                            <p><?php echo $faqValue->faq_answer; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php $index++;
                            } ?>
                        </div>
                        <?php if ($totalFAQs > 2) { ?>
                            <div class="view-more-container">
                                <button id="view-more-faqs" class="btn btn-primary">View More</button>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="conduct-content curvebg" style="display:grid">
                        <a onclick="openForm()" style="cursor:pointer">Learn more about
                            <?php echo $bodycontent["main-section"][0]->name; ?></a>
                    </div>

                    <h1 style="margin-top: 3rem;">Products Customer Review </h1>

                    <div id="testimonial-slider" class="slick-carousel"
                        style="border-radius: 12px; background: #f4f4f4; padding: 2rem; margin-bottom: 2rem;">
                        <?php if (!empty($bodycontent['reviewList'])) {
                            foreach ($bodycontent['reviewList'] as $key => $value) { ?>
                                <div class="testimonial">
                                    <div class="testimonial-profile" style="margin-left: 2rem;">
                                        <div class="pic">
                                            <img src="<?php echo base_url(); ?>assets/docs/review/<?php echo $value->image ?>"
                                                alt="<?php echo $value->name ?>"
                                                style="object-fit: cover;width: 100px;height: 100px;">
                                        </div>
                                        <div class="text-content">
                                            <h3 class="title">
                                                <?php echo $value->name ?>
                                                <span class="post"><?php echo $value->occupation ?></span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <p class="description"><?php echo $value->review ?></p>
                                        <div class="review-rating" data-rating="<?php echo $value->rating ?>">
                                            <span class="rating"></span>
                                            <span class="rating-text"></span>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="testimonial">
                                <div class="testimonial-profile" style="margin-left: 2rem;">
                                    <div class="text-content">
                                        <h3 class="title">The review is currently unavailable.
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div style="margin: 3rem 0 3rem 0;" class="call-mobile">
                        <a onclick="openForm()"
                            style="background: #ffc72c;border-radius: 50px;color: black;padding: 1rem; cursor: pointer">Schedule
                            a call with an expert</a>
                    </div>

                    <!-- <h1 style="margin-top: 3rem;">Schedule a call with an expert</h1>

                <form action="<?php echo base_url() ?>dashboard/callwithexpertform" method="post"
                    id="callwithexpertForm">
                    <input type="hidden" name="product_id" id="product_id"
                        value="<?php echo $bodycontent['productId'] ?>" />
                    <input type="hidden" name="model_id" id="model_id" value="<?php echo $bodycontent['modelId'] ?>" />
                    <div class="row" style="margin-bottom: 2rem;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control-ff" placeholder="Name" name="name" id="name"
                                    required autocomplete="off">
                                <div class="error-message" id="nameError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control-ff onlynumber" placeholder="Phone" name="phone"
                                    id="phone" required autocomplete="off">
                                <div class="error-message" id="phoneError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control-ff" placeholder="Email" name="email" id="email"
                                    required autocomplete="off">
                                <div class="error-message" id="emailError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control-ff" placeholder="Organization"
                                    name="organization" id="organization" required autocomplete="off">
                                <div class="error-message" id="organizationError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select name="country_id" id="country_id" required="required" class="form-control-ff">
                                <option value="">Select Country</option>
                                <?php foreach ($menu["country"] as $key => $value) {
                                    echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
                                } ?>
                            </select>
                            <div class="error-message" id="countryError"></div>
                        </div>
                        <div class="col-md-6">
                            <select name="state_id" id="state_id" required="required" class="form-control-ff">
                                <option value="">Select State</option>
                            </select>
                            <div class="error-message" id="stateError"></div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <div class="form-group">
                                <textarea name="comment" id="comment" class="form-control-ff" placeholder="Query"
                                    style="height: 10rem;" required></textarea>
                                <div class="error-message" id="commentError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" class="form-control-ff" name="submitProductExpert"
                                    id="submitProductExpert" value="Submit"
                                    style="background: #ffc72c;margin-top: 1rem;border-radius: 50px;color: black;">
                            </div>
                        </div>
                    </div>
                </form> -->


                    <?php if (!empty($bodycontent["main-section"][0]->content)) { ?>
                        <div class="product_content">
                            <a class="toggle-button">Learn more <?php echo $bodycontent["main-section"][0]->name; ?> <span
                                    class="arrow"><i class="fa fa-arrow-down" aria-hidden="true"></i></span></a>
                            <div class="content">
                                <?php echo $bodycontent["main-section"][0]->content; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-2">
        <div class="menu-about-us-container" style="padding: 1rem;">

            <ul id="menu-thank-you" class="pro_left">
                <?php foreach ($bodycontent["product_menu"] as $key => $rootMenu) { ?>
                    <li class="first last">
                        <ul id="menu-thank-you" class="pro_left">
                            <?php foreach ($bodycontent["product_menu"] as $key => $rootMenu) { ?>
                                <li class="first last">
                                    <ul>
                                        <?php foreach ($rootMenu["children"] as $key => $parentMenu) { ?>
                                            <li class="first">
                                                <a href="<?php echo base_url() . isNew(); ?>category"
                                                    class="sub_nav"><?php echo $parentMenu["name"] ?> <span
                                                        class="caret"></span></a>
                                                <!-- <a
                                        href="<?php echo base_url() . isNew(); ?>category/<?php echo $rootMenu["slug"]; ?>/<?php echo $parentMenu["slug"]; ?>"
                                        class="sub_nav"><?php echo $parentMenu["name"] ?> <span class="caret"></span></a> -->
                                                <ul>
                                                    <?php foreach ($parentMenu["children"] as $key => $children) { ?>
                                                        <li class="first"><a
                                                                href="<?php echo base_url() . isNew(); ?>category/<?php echo $rootMenu["slug"]; ?>/<?php echo $children["slug"]; ?>"><?php echo $children["name"]; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Your custom script -->
<script>
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        // Only allow numbers in the phone input
        $('.onlynumber').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#view-more-faqs').click(function () {
            $('#accordion .panel').slideDown(); // Show all FAQ items
            $(this).parent().hide(); // Hide the "View More" button
        });


        $("#callwithexpertForm").on('submit', function (event) {
            event.preventDefault();

            if (validate()) {
                $("#submitProductExpert").prop("disabled", true);
                $("#submitProductExpert").val("Processing....");

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: base_url + "dashboard/callwithexpertform",
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $("#submitProductExpert").prop("disabled", false);
                            $("#submitProductExpert").val("Submit");
                            window.location.replace(base_url + "thank-you");
                        } else {
                            $("#submitProductExpert").prop("disabled", false);
                            $("#submitProductExpert").val("Submit");
                            // Handle error if needed
                        }
                    },
                    error: function (jqXHR, exception) {
                        console.log(jqXHR);
                        console.log(exception);
                        $("#submitProductExpert").prop("disabled", false);
                        $("#submitProductExpert").val("Submit");
                    }
                });
            }
        });

        function validate() {
            var isValid = true;

            $('.error-message').text('');

            // Validate name
            var name = $('#name').val().trim();
            if (name.length < 4) {
                $('#nameError').text('Name must be at least 4 characters long.');
                isValid = false;
            }

            // Validate phone
            var phone = $('#phone').val().trim();
            var phonePattern = /^[6-9]\d{9}$/;
            if (!phonePattern.test(phone)) {
                $('#phoneError').text('Phone number must start with 6-9 and be 10 digits long.');
                isValid = false;
            }

            // Validate email
            var email = $('#email').val().trim();
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email)) {
                $('#emailError').text('Please enter a valid email address.');
                isValid = false;
            }

            // Validate organization
            var organization = $('#organization').val().trim();
            if (organization.length < 1) {
                $('#organizationError').text('Organization is required.');
                isValid = false;
            }

            // Validate country
            var country = $('#country_id').val().trim();
            if (country.length < 1) {
                $('#countryError').text('Please select a country.');
                isValid = false;
            }

            // Validate state
            var state = $('#state_id').val().trim();
            if (state.length < 1) {
                $('#stateError').text('Please select a state.');
                isValid = false;
            }

            // Validate comment
            var comment = $('#comment').val().trim();
            if (comment.length < 1) {
                $('#commentError').text('Query is required.');
                isValid = false;
            }

            return isValid;
        }
    });
</script>