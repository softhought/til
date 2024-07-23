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

    .error-message {
        color: red;
        font-size: 0.875rem;
        margin-top: 0.25rem;
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
                            href="<?php echo base_url(); ?>products/<?php echo $bodycontent['rootSlug'] ?>"
                            style="color: white; text-decoration: none;"><?php echo ucwords(str_replace('-', ' ', $bodycontent['rootSlug'])); ?></a>
                    </li>
                    <li class="breadcrumb-item"><a
                            href="<?php echo base_url(); ?>products/<?php echo $bodycontent['rootSlug'] . "/" . $bodycontent['parentSlug']; ?>"
                            style="color: white; text-decoration: none;"><?php echo ucwords(str_replace('-', ' ', $bodycontent['parentSlug'])); ?></a>
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


<div class="row" style="margin-top: 6rem">
    <div class="col-md-1"></div>
    <div class="col-md-9">


        <section class="content_section">
            <div class="container">
                <form class="form-inline" style="margin: -3rem 0 0 -2rem;" id="productSearchForm" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search Products" aria-label="Search"
                        style="margin: 2rem; width: 40rem; height: 2.7rem;" name="productSearch" id="productSearch">
                    <button class="btn btn-outline-success my-2 my-sm-0" style="background: #ffc72c;"
                        type="submit">Search</button>
                </form>
                
                <h1 class="m-0 fc-black"><?php echo $bodycontent["main-section"][0]->name; ?></h1>

                <h2><?php echo $bodycontent["main-section"][0]->short_description; ?></h2>

                <section class="product-details">
                    <div class="container">
                        <div class="row curvebg pl-0">
                            <div class="col-lg-5">
                                <div class="homepix">
                                    <div class="box-behind"></div>
                                    <img src="<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->left_image != "" ? $bodycontent["main-section"][0]->left_image : $bodycontent["main-section"][0]->catagory_image; ?>"
                                        class="img-responsive"
                                        alt="<?php echo $bodycontent["main-section"][0]->name; ?>" />
                                </div>

                            </div>

                            <div class="col-lg-7 col-12 p-responsive">
                                <div class="aboutText"><?php echo $bodycontent["main-section"][0]->about; ?>
                                    <a class="read-btn quote-btn" data-toggle="modal" data-target="#myModal">
                                        Get TIL Rough Terrain crane Cost
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
                        <div class="row" style="margin-top: 4rem;">
                            <div class="col-md-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                    alt=""
                                    style="width: 16rem; height: 10rem; border: 2px dashed black;border-radius: 5px;">
                            </div>
                            <div class="col-md-9">
                                <h2><?php echo $value->model . " (" . $bodycontent["main-section"][0]->name . ")"; ?></h2>
                                <p><?php echo $value->model . " (" . $bodycontent["main-section"][0]->name . ")"; ?> is
                                    specifically designed for off-road and
                                    rugged environment operations. A Rough Terrain Hydraulic Crane combines heavy-duty
                                    off-road capability with powerful hydraulic lifting technology, making it ideal for
                                    challenging and uneven work sites.</p>
                                <a href="<?php echo base_url() . "products/" . $bodycontent['rootSlug'] . "/" . $bodycontent['parentSlug'] . "/" . $bodycontent["main-section"][0]->slug . "/" . $value->slug; ?>"
                                    style="background: #ffc72c; color: black; font-size: 16px; border-radius: 5px; text-transform: uppercase; display: flex; gap: 10px; font-weight: 500; padding: 15px; width: 15rem;">Click
                                    to know more</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <h1 style="margin-top: 3rem;">Schedule a call with an expert</h1>

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
                </form>

                <div class="">
                    <?php if (!empty($bodycontent["faq"])) { ?>
                        <h1 class="mt-ff-2">Frequently Asked Questions</h1>
                        <!-- <div class="accordion">
                        <div class="accordion-item">
                            <button id="accordion-button-1" aria-expanded="false">
                                <span class="accordion-title">
                                    <h5 style="font-size: 16px;font-weight: bold;">What types of cranes does TIL offer?
                                    </h5>
                                </span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>TIL offers a comprehensive range of cranes, including Truck Cranes, Pick and Carry
                                    Cranes, Crawler Cranes, and Rough Terrain Cranes. Each type is designed to meet
                                    specific industrial needs and tackle challenging terrains with ease.</p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-2" aria-expanded="false">
                                <span class="accordion-title">
                                    <h5 style="font-size: 16px;font-weight: bold;">What are the key applications of TIL
                                        cranes?</h5>
                                </span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>TIL cranes are used in a variety of industries, including construction,
                                    manufacturing, shipping, and mining. They are essential for lifting and moving heavy
                                    materials, positioning building components, and ensuring efficient operations in
                                    ports and industrial sites.</p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-3" aria-expanded="false">
                                <span class="accordion-title">
                                    <h5 style="font-size: 16px;font-weight: bold;">Why choose TIL as your crane
                                        manufacturer?</h5>
                                </span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>TIL is a trusted crane manufacturer known for high-quality, reliable equipment. We
                                    provide comprehensive support, including maintenance services, spare parts
                                    availability, and technical assistance. Our innovative approach ensures cutting-edge
                                    crane solutions that meet the demands of modern industries.</p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-4" aria-expanded="false">
                                <span class="accordion-title">
                                    <h5 style="font-size: 16px;font-weight: bold;">What services does TIL offer for
                                        crane operations?</h5>
                                </span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>TIL offers a range of services, including short-term and long-term crane rentals,
                                    regular maintenance and repair services, certified operator training programs, and
                                    options to purchase or lease new and used cranes. Our goal is to support your
                                    operations with reliable equipment and expert guidance.</p>
                            </div>
                        </div>
                    </div> -->
                        <div id="accordion" role="tablist" aria-multiselectable="true">
                            <?php $index = 1;
                            foreach ($bodycontent["faq"] as $key => $faqValue) { ?>
                                <div class="panel">
                                    <div class="panel-heading" role="tab" id="heading_<?php echo $index; ?>">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapse_<?php echo $index; ?>" aria-expanded="false"
                                                aria-controls="collapse_<?php echo $index; ?>">
                                                <?php echo $faqValue->faq_question; ?>
                                            </a>
                                        </h4>
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
                    <?php } ?>
                </div>

                <div class="conduct-content curvebg" style="display:grid">
                    <a onclick="openForm()" style="cursor:pointer">Want to know more about TIL Cranes? Get in touch
                        now</a>
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
                                            alt="Review" style="object-fit: cover;width: 100px;height: 100px;">
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
                    <a class="toggle-button">View Content <span class="arrow"><i class="fa fa-arrow-down"
                                aria-hidden="true"></i></span></a>
                    <div class="content">
                        <h2>The Versatility and Efficiency of Rough Terrain Cranes</h2>
                        <p>Rough terrain cranes are indispensable in the construction and heavy lifting industry. These
                            cranes, specifically designed to operate on rough and uneven surfaces, offer unparalleled
                            flexibility and efficiency. As a leading rough terrain crane manufacturer, our company
                            provides
                            top-quality cranes that meet diverse lifting needs. In this article, we will explore the
                            features, benefits, and applications of rough terrain cranes, along with insights into
                            pricing
                            and the role of a reputable crane company.</p>

                        <h2>Understanding Rough Terrain Cranes</h2>
                        <p>Rough terrain cranes are a type of mobile crane mounted on a four-wheel drive undercarriage.
                            Their robust construction allows them to navigate and operate on challenging terrains such
                            as
                            construction sites, mining areas, and off-road locations. These cranes are equipped with
                            large,
                            durable tires that provide excellent traction and stability, making them ideal for lifting
                            heavy
                            loads in difficult conditions.</p>

                        <h2>Key Features of Rough Terrain Cranes</h2>
                        <ul>
                            <li><strong>Mobility and Maneuverability:</strong> Rough terrain cranes are designed for
                                easy
                                movement on uneven surfaces. Their all-wheel drive system ensures that they can traverse
                                soft ground, gravel, and other challenging terrains without getting stuck.</li>
                            <li><strong>Compact Design:</strong> Despite their powerful capabilities, rough terrain
                                cranes
                                are compact and can be transported easily. This compact design also allows them to
                                operate
                                in confined spaces, making them suitable for a variety of construction and industrial
                                applications.</li>
                            <li><strong>Hydraulic Boom:</strong> The hydraulic boom of a rough terrain crane provides
                                superior lifting capacity and reach. These booms can be extended and retracted quickly,
                                allowing for efficient load handling.</li>
                            <li><strong>Safety Features:</strong> Safety is paramount in crane operations. Rough terrain
                                cranes come equipped with advanced safety features such as load moment indicators,
                                anti-tip
                                mechanisms, and ergonomic operator cabins to ensure safe and efficient operations.</li>
                        </ul>

                        <h2>Applications of Rough Terrain Cranes</h2>
                        <p>Rough terrain cranes are versatile and find applications in various industries, including:
                        </p>
                        <ul>
                            <li><strong>Construction:</strong> They are widely used in construction projects for lifting
                                and
                                placing heavy materials such as steel beams, concrete slabs, and prefabricated
                                components.
                            </li>
                            <li><strong>Mining:</strong> In the mining industry, rough terrain cranes assist in the
                                transportation and installation of heavy mining equipment.</li>
                            <li><strong>Oil and Gas:</strong> These cranes are essential for lifting and positioning
                                heavy
                                machinery and equipment in oil and gas fields.</li>
                            <li><strong>Infrastructure Development:</strong> Rough terrain cranes play a crucial role in
                                infrastructure projects like bridge construction, road building, and power plant
                                installations.</li>
                        </ul>

                        <h2>Choosing the Right Rough Terrain Crane Manufacturer</h2>
                        <p>Selecting a reputable rough terrain crane manufacturer is critical to ensuring the quality
                            and
                            reliability of your crane. A trusted manufacturer will provide:</p>
                        <ul>
                            <li><strong>High-Quality Cranes:</strong> Look for manufacturers with a proven track record
                                of
                                producing durable and efficient rough terrain cranes.</li>
                            <li><strong>Comprehensive Support:</strong> Choose a manufacturer that offers excellent
                                customer
                                support, including maintenance, repair services, and availability of spare parts.</li>
                            <li><strong>Competitive Pricing:</strong> While rough terrain crane prices can vary, it is
                                essential to find a manufacturer that offers competitive pricing without compromising on
                                quality.</li>
                        </ul>

                        <h2>Factors Affecting Rough Terrain Crane Price</h2>
                        <p>Several factors influence the price of rough terrain cranes, including:</p>
                        <ul>
                            <li><strong>Capacity and Specifications:</strong> Cranes with higher lifting capacities and
                                advanced features tend to be more expensive.</li>
                            <li><strong>Brand and Manufacturer:</strong> Reputable brands and manufacturers may charge a
                                premium due to their established quality and reliability.</li>
                            <li><strong>Market Demand:</strong> The demand for rough terrain cranes in specific regions
                                can
                                also affect pricing.</li>
                            <li><strong>Customization:</strong> Customized cranes with specific modifications to meet
                                unique
                                project requirements may come at a higher cost.</li>
                        </ul>

                        <h2>Partnering with a Reliable Crane Company</h2>
                        <p>Partnering with a reliable crane company ensures that you receive the best equipment and
                            support
                            for your projects. A good crane company will offer a wide range of cranes, including rough
                            terrain cranes, and provide expert guidance to help you select the right equipment for your
                            needs. They will also ensure that their cranes are well-maintained and comply with safety
                            standards.</p>

                        <p>In conclusion, rough terrain cranes are versatile, efficient, and essential for various
                            industries. By choosing a reputable rough terrain crane manufacturer and understanding the
                            factors that influence rough terrain crane price, you can ensure that your projects run
                            smoothly
                            and efficiently. Partner with a trusted crane company to access high-quality equipment and
                            expert support, enabling you to achieve your lifting and construction goals with confidence.
                        </p>
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
                                <li class="first"><a
                                        href="<?php echo base_url(); ?>products/<?php echo $rootMenu["slug"]; ?>/<?php echo $parentMenu["slug"]; ?>"
                                        class="sub_nav"><?php echo $parentMenu["name"] ?> <span class="caret"></span></a>
                                    <ul>
                                        <?php foreach ($parentMenu["children"] as $key => $children) {
                                            $activeColor = $children["slug"] == $bodycontent["main-section"][0]->slug ? "style='background: #ffc72c;'" : ""; ?>
                                            <li class="first"><a
                                                    href="<?php echo base_url(); ?>products/<?php echo $rootMenu["slug"]; ?>/<?php echo $parentMenu["slug"]; ?>/<?php echo $children["slug"]; ?>"
                                                    <?php echo $activeColor ?>><?php echo $children["name"]; ?></a>
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