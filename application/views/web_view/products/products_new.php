<style>
    .slick-carousel {
        position: relative;
    }

    .product-item {
        border: 1px solid rgba(0, 0, 0, 0);
        border-radius: 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px;
        justify-content: center;
        margin-bottom: 30px;
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        width: 350px;
        height: 360px;
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

    .slick-prev {
        display: block;
        margin-left: -1rem;
    }

    .slick-next {
        display: block;
        margin-right: -3rem;
    }

    .product-item img {
        border-radius: 0.3rem;
    }

    .product-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    .bg-pix {
        position: relative;
        padding-left: 20px !important;
        margin-bottom: 20px !important;
        height: 15rem;
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
        width: calc(100% - 18px);
        height: 14rem;
        background-color: #ffc72c;
        border-radius: 6px;
        content: "";
    }


    .error-message {
        color: red;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .product-item:hover {
        border: 1px solid rgba(0, 0, 0, 0);
        box-shadow: 0 0 0 rgba(0, 0, 0, 0);
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

    .product-item-card {
        border: 1px solid rgba(0, 0, 0, 0);
        border-radius: 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px;
        justify-content: center;
        margin-bottom: 30px;
        overflow: hidden;
        transition: box-shadow 0.3s ease-in-out;
        width: 330px;
    }

    .no-product-item {
        background: #ffc72c;
        height: 303px;
        margin-top: 1.7rem;
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

    .rem-2 strong {
        font-size: 2.2rem !important;
    }

    .product-head-mobile {
        display: none;
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
    }
</style>
<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->banner_image; ?>); position: relative;">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">TIL</a></li>
                <!-- <li class="breadcrumb-item"><a href="<?php echo base_url() . isNew(); ?>category">Category</a></li> -->
                <li class="breadcrumb-item"><a href="<?php echo base_url() . isNew(); ?>category">Material Handling Solutions</a></li>
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

                    <?php echo $bodycontent["main-section"][0]->about; ?>

                    <?php foreach ($bodycontent['products'] as $proKey => $product) {
                        $count = 1; ?>
                        <div class="product-card" id="<?php echo $product->slug; ?>">
                            <h2 class="m-0 fc-black rem-2 product-head-mobile">
                                <strong><?php echo $product->name; ?></strong></h2>
                            <div class="row">
                                <?php if ($proKey % 2 != 0) { ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="product-item-card no-product-item" style="margin-left: 2.8rem;">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" />
                                                <h2 class="m-0 fc-black rem-2"
                                                    style="color: #4a4141 !important;margin-top: 1rem;">
                                                    <strong><?php echo $product->name; ?></strong>
                                                </h2>
                                            </figure>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-8">
                                    <div class="product-slider slick-carousel">
                                        <?php foreach ($bodycontent["productList"] as $key => $value) {
                                            if ($value['parent_id'] == $product->product_master_id) {
                                                $count++; ?>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <a href="<?php echo base_url() . isNew() . $value["url"]; ?>">
                                                        <div class="product-item">
                                                            <figure>
                                                                <div class="bg-pix">
                                                                    <img data-lazy="<?php echo base_url(); ?>assets/images/<?php echo $value["catagory_image"]; ?>"
                                                                        src="<?php echo base_url(); ?>assets/images/logos/til.png"
                                                                        style="width: 310px; height: 200px;"
                                                                        alt="<?php echo $value["name"]; ?>" />
                                                                </div>
                                                                <h2 style="text-align: left;color: black;">
                                                                    <?php echo $value["name"]; ?>
                                                                </h2>
                                                            </figure>
                                                            <p
                                                                style="text-align: left;color: #525252;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;">
                                                                <?php echo $value["short_description"]; ?>
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if ($proKey % 2 == 0) { ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="product-item-card no-product-item product-item-blank"
                                            style="margin-left: 1.4rem;">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" />
                                                <h2 class="m-0 fc-black rem-2"
                                                    style="color: #4a4141 !important;margin-top: 1rem;">
                                                    <strong><?php echo $product->name; ?></strong>
                                                </h2>
                                            </figure>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>



                    <div class="conduct-content curvebg" style="display:grid">
                        <a onclick="openForm()" style="cursor:pointer">Learn more about <?php echo $bodycontent["main-section"][0]->name; ?></a>
                    </div>

                    <div class="">
                        <h1 class="mt-ff-2">Frequently Asked Questions</h1>
                        <div id="accordion" role="tablist" aria-multiselectable="true">
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


                    <div style="margin: 3rem 0 0 0;" class="call-mobile">
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


                    <div class="product_content">
                        <a class="toggle-button">Learn more <?php echo $bodycontent["main-section"][0]->name; ?> <span
                                class="arrow"><i class="fa fa-arrow-down" aria-hidden="true"></i></span></a>
                        <div class="content">
                            <h2>The Essential Role of Cranes in Modern Industry</h2>
                            <p>Cranes are vital tools in various industries, providing unmatched capabilities for
                                lifting
                                and
                                moving
                                heavy materials. As a top crane manufacturer, we pride ourselves on delivering
                                high-quality
                                cranes
                                tailored to diverse industrial applications. In this article, we'll delve into the
                                different
                                types
                                of cranes, their key applications, pricing considerations, and the benefits of
                                partnering
                                with a
                                reputable crane company.</p>

                            <h2>What is a Crane?</h2>
                            <p>A crane is a sophisticated machine designed to lift and transport heavy loads using hoist
                                ropes,
                                chains, and sheaves. Cranes can be stationary or mobile, each type engineered for
                                specific
                                tasks
                                and
                                environments. Their ability to handle weights far beyond human capacity makes them
                                indispensable
                                in
                                construction, manufacturing, shipping, and more.</p>

                            <h2>Types of Cranes</h2>
                            <ul>
                                <li><strong>Truck Crane:</strong> These cranes are essential for constructing tall
                                    buildings,
                                    offering substantial height and lifting capacity. They are commonly seen on urban
                                    skylines,
                                    facilitating the assembly of skyscrapers and large structures.</li>
                                <li><strong>Pick and Carry Cranes:</strong> Mounted on wheeled vehicles, mobile cranes
                                    are
                                    highly
                                    versatile and can be transported easily to various job sites. They are widely used
                                    in
                                    construction, infrastructure development, and transport.</li>
                                <li><strong>Crawler Crane:</strong> Found in manufacturing and warehouse settings,
                                    overhead
                                    cranes
                                    are fixed on a runway system, allowing them to move heavy items across a set area
                                    efficiently.
                                </li>
                                <li><strong>Rough Terrain Cranes:</strong> Designed for off-road use, rough terrain
                                    cranes
                                    are
                                    equipped with four-wheel drive undercarriages, enabling them to operate on uneven
                                    and
                                    challenging surfaces.</li>
                            </ul>

                            <h2>Applications of Cranes</h2>
                            <ul>
                                <li><strong>Construction:</strong> Cranes are used to lift and position building
                                    materials,
                                    heavy
                                    machinery, and structural components, making them indispensable for construction
                                    projects.
                                </li>
                                <li><strong>Manufacturing:</strong> Overhead cranes streamline manufacturing processes
                                    by
                                    moving
                                    heavy parts and materials along production lines.</li>
                                <li><strong>Shipping and Ports:</strong> Cranes are essential for loading and unloading
                                    cargo
                                    from
                                    ships, ensuring efficient port operations and logistics management.</li>
                                <li><strong>Mining:</strong> In the mining industry, cranes facilitate the
                                    transportation of
                                    heavy
                                    equipment and materials, supporting efficient extraction and processing operations.
                                </li>
                            </ul>

                            <h2>Selecting a Crane Manufacturer</h2>
                            <p>Choosing the right crane manufacturer is crucial to obtaining reliable and effective
                                equipment.
                                Key
                                considerations include:</p>
                            <ul>
                                <li><strong>Quality:</strong> A reputable manufacturer provides high-quality cranes
                                    built to
                                    perform
                                    in demanding conditions.</li>
                                <li><strong>Support:</strong> Look for manufacturers that offer comprehensive support,
                                    including
                                    maintenance services, spare parts availability, and technical assistance.</li>
                                <li><strong>Innovation:</strong> Opt for manufacturers that prioritize research and
                                    development,
                                    offering cutting-edge technology and innovative crane solutions.</li>
                            </ul>

                            <h2>Partnering with a Reliable Crane Company</h2>
                            <p>Working with a reliable crane company ensures you receive the best equipment and support
                                for
                                your
                                projects. A reputable company will offer a wide range of cranes and provide expert
                                guidance
                                to
                                help
                                you choose the right crane for your needs. They will also ensure their cranes are
                                well-maintained
                                and comply with safety standards, minimizing downtime and maximizing productivity.</p>

                            <p>In conclusion, cranes are crucial for various industries, providing the capability to
                                lift
                                and
                                move
                                heavy loads efficiently. By selecting a trusted crane manufacturer and understanding the
                                factors
                                that affect crane price, you can ensure your projects are completed safely and
                                effectively.
                                Partnering with a reliable crane company will provide you with high-quality equipment
                                and
                                the
                                necessary support to achieve your lifting and construction goals.</p>

                            <h2>Crane: A Comprehensive Guide</h2>

                            <h3>Definition</h3>
                            <p>A crane is a machine used for lifting and moving heavy loads, typically equipped with
                                hoist
                                ropes,
                                chains, and sheaves. Cranes are essential in construction, manufacturing, shipping, and
                                other
                                industries requiring material handling.</p>

                            <h2>Crane Services</h2>
                            <ul>
                                <li><strong>Rental Services:</strong> Short-term and long-term crane rentals for various
                                    projects.
                                </li>
                                <li><strong>Maintenance and Repairs:</strong> Regular maintenance and repair services to
                                    ensure
                                    crane safety and efficiency.</li>
                                <li><strong>Operator Training:</strong> Certified training programs for crane operators.
                                </li>
                                <li><strong>Sales and Leasing:</strong> Purchase or lease options for new and used
                                    cranes.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-2">
        <div class="menu-about-us-container" style="padding: 1rem;">

            <ul id="menu-thank-you" class="pro_left">
                <?php foreach ($bodycontent["product_menu"] as $key => $rootMenu) { ?>
                    <li class="first last">
                        <ul>
                            <?php foreach ($rootMenu["children"] as $key => $parentMenu) { ?>
                                <li class="first">
                                    <a href="<?php echo base_url() . isNew(); ?>category"
                                        class="sub_nav"><?php echo $parentMenu["name"] ?> <span class="caret"></span></a>
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

    $(document).ready(function () {
        $('.product-slider').slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            autoplay: false,
            autoplaySpeed: 3000,
            lazyLoad: 'ondemand',
            prevArrow: '<button type="button" class="slick-prev" style="z-index: 100;"></button>',
            nextArrow: '<button type="button" class="slick-next"></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    });

</script>