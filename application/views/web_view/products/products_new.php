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
            </ol>
        </nav>

        <form class="form-inline" style="margin: -3rem 0 0 1rem;" id="productSearchForm" method="post">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Products" aria-label="Search"
                style="margin: 2rem; width: 40rem; height: 2.7rem;" name="productSearch" id="productSearch">
            <button class="btn btn-outline-success my-2 my-sm-0" style="background: #ffc72c;"
                type="submit">Search</button>
        </form>

        <section class="content_section" style="margin: 0 0 0 2rem;">
            <div class="container">
                <h1 class="m-0 fc-black"><?php echo $bodycontent["main-section"][0]->name; ?></h1>

                <h2><?php echo $bodycontent["main-section"][0]->short_description; ?></h2>
                <p><span><strong>Looking for robust and reliable cranes?</strong></span> Tractors India Limited (TIL)
                    offers a comprehensive range of
                    high-performance cranes
                    designed to tackle challenging terrains with ease. As a leading crane manufacturer company and crane
                    supplier, we specialize in
                    delivering top-quality equipment that meets the demands of diverse industrial applications. </p>
                <?php foreach ($bodycontent['products'] as $proKey => $product) {
                    $count = 1; ?>
                    <h2 class="m-0 fc-black"><strong><?php echo $product->name; ?></strong></h2>

                    <div class="row">
                        <?php if ($proKey % 2 == 0 && $proKey != 0) { ?>
                            <div class="card">
                                <div class="col-lg-4">
                                    <div class="product-item no-product-item">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="rectangle" />
                                        </figure>
                                        <!-- <a href="<?php echo base_url() ?>products" style="width:100%">
                                            <button>More Products</button>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php foreach ($bodycontent["productList"] as $key => $value) {
                            if ($value['parent_id'] == $product->product_master_id) {
                                $count++; ?>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <a href="<?php echo base_url() . $value["url"]; ?>">
                                        <div class="product-item">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>assets/images/<?php echo $value["catagory_image"] ?>"
                                                    style="width: 260px; height: 139px;" alt="rectangle" />
                                            </figure>
                                            <h3 style="text-align: left;color: black;"><?php echo $value["name"]; ?></h3>
                                            <p
                                                style="text-align: left;color: black;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;">
                                                <?php echo $value["short_description"]; ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                        } ?>

                        <?php if ($proKey % 2 != 0 && $count <= 3) { ?>
                            <div class="card">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="product-item no-product-item">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="rectangle" />
                                        </figure>
                                        <!-- <a href="<?php echo base_url() ?>products" style="width:100%">
                                            <button>More Products</button>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="conduct-content curvebg" style="display:grid">
                    <a onclick="openForm()" style="cursor:pointer">Want to know more about TIL Cranes? Get in touch
                        now</a>
                </div>

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

                <h1 style="margin-top: 3rem;">Schedule a call with an expert</h1>

                <form action="" method="post">
                    <div class="row" style="margin-bottom: 2rem;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control-ff" placeholder="Name" name="name">
                            </div>
                        </div>
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
                                <input type="text" class="form-control-ff" placeholder="Organization" name="organization">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name=""> </textarea>
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

                <div class="product_content">
                    <h2>The Essential Role of Cranes in Modern Industry</h2>
                    <p>Cranes are vital tools in various industries, providing unmatched capabilities for lifting and
                        moving
                        heavy materials. As a top crane manufacturer, we pride ourselves on delivering high-quality
                        cranes
                        tailored to diverse industrial applications. In this article, we'll delve into the different
                        types
                        of cranes, their key applications, pricing considerations, and the benefits of partnering with a
                        reputable crane company.</p>

                    <h2>What is a Crane?</h2>
                    <p>A crane is a sophisticated machine designed to lift and transport heavy loads using hoist ropes,
                        chains, and sheaves. Cranes can be stationary or mobile, each type engineered for specific tasks
                        and
                        environments. Their ability to handle weights far beyond human capacity makes them indispensable
                        in
                        construction, manufacturing, shipping, and more.</p>

                    <h2>Types of Cranes</h2>
                    <ul>
                        <li><strong>Truck Crane:</strong> These cranes are essential for constructing tall buildings,
                            offering substantial height and lifting capacity. They are commonly seen on urban skylines,
                            facilitating the assembly of skyscrapers and large structures.</li>
                        <li><strong>Pick and Carry Cranes:</strong> Mounted on wheeled vehicles, mobile cranes are
                            highly
                            versatile and can be transported easily to various job sites. They are widely used in
                            construction, infrastructure development, and transport.</li>
                        <li><strong>Crawler Crane:</strong> Found in manufacturing and warehouse settings, overhead
                            cranes
                            are fixed on a runway system, allowing them to move heavy items across a set area
                            efficiently.
                        </li>
                        <li><strong>Rough Terrain Cranes:</strong> Designed for off-road use, rough terrain cranes are
                            equipped with four-wheel drive undercarriages, enabling them to operate on uneven and
                            challenging surfaces.</li>
                    </ul>

                    <h2>Applications of Cranes</h2>
                    <ul>
                        <li><strong>Construction:</strong> Cranes are used to lift and position building materials,
                            heavy
                            machinery, and structural components, making them indispensable for construction projects.
                        </li>
                        <li><strong>Manufacturing:</strong> Overhead cranes streamline manufacturing processes by moving
                            heavy parts and materials along production lines.</li>
                        <li><strong>Shipping and Ports:</strong> Cranes are essential for loading and unloading cargo
                            from
                            ships, ensuring efficient port operations and logistics management.</li>
                        <li><strong>Mining:</strong> In the mining industry, cranes facilitate the transportation of
                            heavy
                            equipment and materials, supporting efficient extraction and processing operations.</li>
                    </ul>

                    <h2>Selecting a Crane Manufacturer</h2>
                    <p>Choosing the right crane manufacturer is crucial to obtaining reliable and effective equipment.
                        Key
                        considerations include:</p>
                    <ul>
                        <li><strong>Quality:</strong> A reputable manufacturer provides high-quality cranes built to
                            perform
                            in demanding conditions.</li>
                        <li><strong>Support:</strong> Look for manufacturers that offer comprehensive support, including
                            maintenance services, spare parts availability, and technical assistance.</li>
                        <li><strong>Innovation:</strong> Opt for manufacturers that prioritize research and development,
                            offering cutting-edge technology and innovative crane solutions.</li>
                    </ul>

                    <h2>Partnering with a Reliable Crane Company</h2>
                    <p>Working with a reliable crane company ensures you receive the best equipment and support for your
                        projects. A reputable company will offer a wide range of cranes and provide expert guidance to
                        help
                        you choose the right crane for your needs. They will also ensure their cranes are
                        well-maintained
                        and comply with safety standards, minimizing downtime and maximizing productivity.</p>

                    <p>In conclusion, cranes are crucial for various industries, providing the capability to lift and
                        move
                        heavy loads efficiently. By selecting a trusted crane manufacturer and understanding the factors
                        that affect crane price, you can ensure your projects are completed safely and effectively.
                        Partnering with a reliable crane company will provide you with high-quality equipment and the
                        necessary support to achieve your lifting and construction goals.</p>

                    <h2>Crane: A Comprehensive Guide</h2>

                    <h3>Definition</h3>
                    <p>A crane is a machine used for lifting and moving heavy loads, typically equipped with hoist
                        ropes,
                        chains, and sheaves. Cranes are essential in construction, manufacturing, shipping, and other
                        industries requiring material handling.</p>

                    <h2>Crane Services</h2>
                    <ul>
                        <li><strong>Rental Services:</strong> Short-term and long-term crane rentals for various
                            projects.
                        </li>
                        <li><strong>Maintenance and Repairs:</strong> Regular maintenance and repair services to ensure
                            crane safety and efficiency.</li>
                        <li><strong>Operator Training:</strong> Certified training programs for crane operators.</li>
                        <li><strong>Sales and Leasing:</strong> Purchase or lease options for new and used cranes.</li>
                    </ul>
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
                                        <?php foreach ($parentMenu["children"] as $key => $children) { ?>
                                            <li class="first"><a
                                                    href="<?php echo base_url(); ?>products/<?php echo $rootMenu["slug"]; ?>/<?php echo $parentMenu["slug"]; ?>/<?php echo $children["slug"]; ?>"><?php echo $children["name"]; ?></a>
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