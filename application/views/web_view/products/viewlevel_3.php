<style>
    .product_content {
        /* padding: 1rem; */
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

    .quote-btn {
        width: 36rem !important;
    }

    .form-control-ff {
        display: block;
        width: 100%;
        height: 50px;
        padding-top: 6px;
        padding-right: 12px;
        padding-bottom: 6px;
        padding-left: 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }
</style>
<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->banner_image; ?>)">
    <div class="container">
        <h1 class="m-0">
        </h1>
    </div>
</section>


<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-9">
        <nav aria-label="breadcrumb" style="margin: 0 0 0 2rem;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"
                        style="color: #374048; text-decoration: none;">TIL</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>products"
                        style="color: #374048; text-decoration: none;">Products</a></li>
                <li class="breadcrumb-item"><a href="#"
                        style="color: #374048; text-decoration: none;"><?php echo $bodycontent["main-section"][0]->name; ?></a>
                </li>
            </ol>
        </nav>

        <form class="form-inline" style="margin: -3rem 0 0 1rem;">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Products" aria-label="Search"
                style="margin: 2rem; width: 40rem; height: 2.7rem;">
            <button class="btn btn-outline-success my-2 my-sm-0" style="background: #ffc72c;"
                type="submit">Search</button>
        </form>


        <section class="content_section" style="margin: 0 0 0 2rem;">
            <div class="container">
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
                                <div class="aboutText">
                                    <p><span><strong>Looking for robust and reliable cranes?</strong></span> Tractors
                                        India Limited (TIL)
                                        offers a comprehensive range of
                                        high-performance cranes
                                        designed to tackle challenging terrains with ease. As a leading crane
                                        manufacturer company and crane
                                        supplier, we specialize in
                                        delivering top-quality equipment that meets the demands of diverse industrial
                                        applications. </p>

                                    <br><br>
                                    <p><?php echo $bodycontent["main-section"][0]->about; ?></p>
                                    <a class="read-btn quote-btn" data-toggle="modal" data-target="#myModal">
                                        Get TIL Rough Terrain crane Cost
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="product_content">
                    <h2>Experience the TIL Advantage:</h2>
                    <p>With decades of experience in crane manufacturing and supply, TIL is your trusted partner for
                        rough
                        terrain cranes. Discover why leading industries rely on TIL for their heavy equipment needs.
                        Contact
                        us to learn more about our products and how we can support your business goals.</p>

                    <h2>Why Choose TIL Rough Terrain Cranes?</h2>
                    <p>At TIL, we understand the importance of reliability and efficiency in your operations. Our rough
                        terrain cranes are engineered to deliver exceptional performance in rugged environments,
                        ensuring
                        optimal productivity and safety. Whether you're in construction, mining, or oil and gas sectors,
                        TIL
                        cranes are designed to exceed your expectations.</p>

                    <h2>Rough Terrain Crane - Models</h2>
                    <p>Rough Terrain (RT) Cranes from TIL are compact and highly maneuverable (by virtue of all wheel
                        steering), with robust construction and high torque multiplicity, which make them
                        performance-worthy
                        for rough terrains and applications. TIL holds the distinction of rolling out the first
                        indigenously
                        manufactured Rough Terrain Crane in India from its state-of-the-art factory at Kamarhatty,
                        Kolkata
                        (West Bengal).</p>
                </div>

                <div>
                    <?php foreach ($bodycontent['sheet_model'] as $key => $value) { ?>
                        <div class="row" style="margin-top: 4rem;">
                            <div class="col-md-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                    alt="" style="width: 16rem; height: 10rem; border: 2px dashed black;border-radius: 5px;">
                            </div>
                            <div class="col-md-9">
                                <h2><?php echo $value->model . " (" . $bodycontent["main-section"][0]->name . ")";  ?></h2>
                                <p><?php echo $value->model . " (" . $bodycontent["main-section"][0]->name . ")"; ?> is specifically designed for off-road and
                                    rugged environment operations. A Rough Terrain Hydraulic Crane combines heavy-duty
                                    off-road capability with powerful hydraulic lifting technology, making it ideal for
                                    challenging and uneven work sites.</p>
                                <a href="#"
                                    style="background: #ffc72c; color: black; font-size: 16px; border-radius: 5px; text-transform: uppercase; display: flex; gap: 10px; font-weight: 500; padding: 15px; width: 15rem;">Click
                                    to know more</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <h1 style="margin-top: 3rem;">Schedule a call with an expert</h1>

                <form action="" method="post">
                    <div class="row" style="margin-bottom: 2rem;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control-ff onlynumber" placeholder="Phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control-ff" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control-ff" placeholder="Name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control-ff" placeholder="Organization"
                                    name="organization">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select name="country_id" id="country_id" required="required" class="form-control-ff">
                                <option value="">Select Country</option>
                                <?php foreach ($menu["country"] as $key => $value) {
                                    echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="state_id" id="state_id" required="required" class="form-control-ff">
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" class="form-control-ff" name="submitProductExpert" value="Submit"
                                    style="background: #ffc72c;margin-top: 1rem;">
                            </div>
                        </div>
                    </div>

                </form>

                <div class="">
                    <h1>Frequently Asked Questions</h1>
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
                            <div class="panel panel-default">
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
                </div>

                <div class="conduct-content curvebg" style="display:grid">
                    <a onclick="openForm()" style="cursor:pointer">Want to know more about TIL Cranes? Get in touch
                        now</a>
                </div>

                <div class="product_content" style="margin-top: 3rem;">
                    <h2>The Versatility and Efficiency of Rough Terrain Cranes</h2>
                    <p>Rough terrain cranes are indispensable in the construction and heavy lifting industry. These
                        cranes, specifically designed to operate on rough and uneven surfaces, offer unparalleled
                        flexibility and efficiency. As a leading rough terrain crane manufacturer, our company provides
                        top-quality cranes that meet diverse lifting needs. In this article, we will explore the
                        features, benefits, and applications of rough terrain cranes, along with insights into pricing
                        and the role of a reputable crane company.</p>

                    <h2>Understanding Rough Terrain Cranes</h2>
                    <p>Rough terrain cranes are a type of mobile crane mounted on a four-wheel drive undercarriage.
                        Their robust construction allows them to navigate and operate on challenging terrains such as
                        construction sites, mining areas, and off-road locations. These cranes are equipped with large,
                        durable tires that provide excellent traction and stability, making them ideal for lifting heavy
                        loads in difficult conditions.</p>

                    <h2>Key Features of Rough Terrain Cranes</h2>
                    <ul>
                        <li><strong>Mobility and Maneuverability:</strong> Rough terrain cranes are designed for easy
                            movement on uneven surfaces. Their all-wheel drive system ensures that they can traverse
                            soft ground, gravel, and other challenging terrains without getting stuck.</li>
                        <li><strong>Compact Design:</strong> Despite their powerful capabilities, rough terrain cranes
                            are compact and can be transported easily. This compact design also allows them to operate
                            in confined spaces, making them suitable for a variety of construction and industrial
                            applications.</li>
                        <li><strong>Hydraulic Boom:</strong> The hydraulic boom of a rough terrain crane provides
                            superior lifting capacity and reach. These booms can be extended and retracted quickly,
                            allowing for efficient load handling.</li>
                        <li><strong>Safety Features:</strong> Safety is paramount in crane operations. Rough terrain
                            cranes come equipped with advanced safety features such as load moment indicators, anti-tip
                            mechanisms, and ergonomic operator cabins to ensure safe and efficient operations.</li>
                    </ul>

                    <h2>Applications of Rough Terrain Cranes</h2>
                    <p>Rough terrain cranes are versatile and find applications in various industries, including:</p>
                    <ul>
                        <li><strong>Construction:</strong> They are widely used in construction projects for lifting and
                            placing heavy materials such as steel beams, concrete slabs, and prefabricated components.
                        </li>
                        <li><strong>Mining:</strong> In the mining industry, rough terrain cranes assist in the
                            transportation and installation of heavy mining equipment.</li>
                        <li><strong>Oil and Gas:</strong> These cranes are essential for lifting and positioning heavy
                            machinery and equipment in oil and gas fields.</li>
                        <li><strong>Infrastructure Development:</strong> Rough terrain cranes play a crucial role in
                            infrastructure projects like bridge construction, road building, and power plant
                            installations.</li>
                    </ul>

                    <h2>Choosing the Right Rough Terrain Crane Manufacturer</h2>
                    <p>Selecting a reputable rough terrain crane manufacturer is critical to ensuring the quality and
                        reliability of your crane. A trusted manufacturer will provide:</p>
                    <ul>
                        <li><strong>High-Quality Cranes:</strong> Look for manufacturers with a proven track record of
                            producing durable and efficient rough terrain cranes.</li>
                        <li><strong>Comprehensive Support:</strong> Choose a manufacturer that offers excellent customer
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
                        <li><strong>Market Demand:</strong> The demand for rough terrain cranes in specific regions can
                            also affect pricing.</li>
                        <li><strong>Customization:</strong> Customized cranes with specific modifications to meet unique
                            project requirements may come at a higher cost.</li>
                    </ul>

                    <h2>Partnering with a Reliable Crane Company</h2>
                    <p>Partnering with a reliable crane company ensures that you receive the best equipment and support
                        for your projects. A good crane company will offer a wide range of cranes, including rough
                        terrain cranes, and provide expert guidance to help you select the right equipment for your
                        needs. They will also ensure that their cranes are well-maintained and comply with safety
                        standards.</p>

                    <p>In conclusion, rough terrain cranes are versatile, efficient, and essential for various
                        industries. By choosing a reputable rough terrain crane manufacturer and understanding the
                        factors that influence rough terrain crane price, you can ensure that your projects run smoothly
                        and efficiently. Partner with a trusted crane company to access high-quality equipment and
                        expert support, enabling you to achieve your lifting and construction goals with confidence.</p>
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
                                                    href="<?php echo base_url(); ?>products/<?php echo $rootMenu["slug"]; ?>/<?php echo $parentMenu["slug"]; ?>/<?php echo $children["slug"]; ?>" <?php echo $activeColor ?>><?php echo $children["name"]; ?></a>
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