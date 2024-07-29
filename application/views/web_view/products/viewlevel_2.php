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

    .testimonial-profile .text-content {
        flex: 1;
    }

    .testimonial-profile .title {
        font-size: 19px;
        font-weight: bold;
        color: #dca842;
        margin: 0;
    }

    .error-message {
        color: red;
        font-size: 0.875rem;
        margin-top: 0.25rem;
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
        top: 6rem;
        left: 20px;
    }

    .breadcrumb {
        padding: 10px;
        border-radius: 5px;
    }

    .breadcrumb-item a {
        color: white;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
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

        #productSearchForm {
            display: none;
        }

        .content_section {
            margin: 10rem 0 0 2rem;
        }

        .product_content {
            margin-top: 10rem;
            margin-right: 10rem;
        }
    }

    @media (max-width: 576px) {

        .form-inline input,
        .form-inline button {
            width: 100%;
            margin: 0.5rem 0;
        }

        .product-item img {
            width: 100%;
            height: auto;
        }

        .breadcrumb-nav {
            bottom: 5px;
            left: 5px;
            font-size: 10px;
        }

        .breadcrumb {
            padding: 5px;
        }

        .breadcrumb-item a {
            font-size: 12px;
        }

        .col-md-6 {
            width: 100%;
        }

        .col-md-9,
        .col-md-1 {
            width: 100%;
            padding: 0;
        }

        .toggle-button {
            font-size: 14px;
        }
    }
</style>
<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->banner_image; ?>)">
    <div class="container">
        <h1 class="m-0">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"
                            style="color: white; text-decoration: none;">TIL</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>products"
                            style="color: white; text-decoration: none;">Products</a></li>
                    <li class="breadcrumb-item"><a
                            href="<?php echo base_url(); ?>products/<?php echo $bodycontent['slug'] ?>"
                            style="color: white; text-decoration: none;"><?php echo ucwords(str_replace('-', ' ', $bodycontent['slug'])); ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#"
                            style="color: white; text-decoration: none;"><?php echo $bodycontent["main-section"][0]->name; ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>contact-us/inquiry"
                            style="color: white; text-decoration: none;">Support</a></li>
                </ol>
            </nav>
        </h1>
    </div>
</section>


<section class="content_section">
    <div class="wrapper clearfix">
        <div class="header-section">
            <div class="container">
                <h3 class="m-0 fc-black"><?php echo $bodycontent["main-section"][0]->name; ?></h3>

                <?php echo $bodycontent["main-section"][0]->about; ?>
                <div class="icon-container">
                    <hr>
                    <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png" alt="rectangle" />
                    <hr>
                </div>
            </div>
        </div>
        <div class="bodycont" id="mainCol">
            <h1 class="m-0"> </h1>
            <article class="status-publish hentry">
                <div class="entry-content">
                </div>
            </article>
            <div class="range_loop">
                <div class="">
                    <div class="container">
                        <div class="row product-showcase pb-070">
                            <?php foreach ($bodycontent['products'] as $product): ?>
                                <div class="col-lg-3 col-md-3 col-12">
                                    <a
                                        href="<?php echo base_url() . "products/" . $bodycontent['slug'] . "/" . $bodycontent["main-section"][0]->slug . "/" . $product->slug; ?>">
                                        <div class="product-item material-card">
                                            <img src="<?php echo base_url('assets/images/' . $product->catagory_image); ?>">
                                            <h5><?php echo $product->name; ?></h5>
                                            <button class="mt-010">Know More</button>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>