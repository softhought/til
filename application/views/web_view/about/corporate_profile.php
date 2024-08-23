<?php include APPPATH . 'views/web_view/header-banner.php' ?>
<script>setBreadcrumbAndBackground('<?php echo base_url(); ?>assets/images/inner_page_banners/corporate-profile-banner.png', "Corporate Profile");</script>
<section class="content_section">
    <div class="wrapper clearfix">
</section>
<section class="member-section">
    <div class="wrapper clearfix">
        <div class="">
            <div class="header-section">
                <div class="container">
                    <h3 class="m-0"></h3>
                </div>
            </div>
            <div class="bodycont" id="mainCol">
                <article class="status-publish hentry">
                    <div class="entry-content">

                        <section style="background:none">
                            <div class="container">
                                <div class="row curvebg pl-0">
                                    <div class="col-lg-4">
                                        <div class="homepix">
                                            <div class="box-behind"></div>
                                            <img src="<?php echo base_url(); ?>/tilindia/assets/images/corporate-content-img.jpg"
                                                class="img-responsive" alt="Crane Manufacturer in India" />
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-12 p-responsive">
                                        <div class="aboutText">
                                            <h1>Technology. <span>Innovation.</span> <span>Leadership.</span></h1>
                                            <h2>TIL as an organization stands for Technology, Innovation and Leadership.
                                            </h2>
                                            <figure>
                                                <img src="<?php echo base_url(); ?>/tilindia/assets/images/Rectangle.png"
                                                    alt="rectangle" />
                                                <hr />
                                            </figure>
                                            <p>TIL Limited has been a valuable partner in India's infrastructure
                                                development since 1944, and is reckoned for offering a diverse range of
                                                infrastructure equipment representing some of the finest in global
                                                technology. Starting from 2023, TIL Limited has seamlessly integrated
                                                itself into Indocrest Defence Services Private Limited (IDSPL), a
                                                subsidiary of Gainwell Group.<br /><br />We are engaged in the design,
                                                manufacturing, and marketing of a comprehensive selection of material
                                                handling and port equipment specifically tailored for the Indian market.
                                                These products are supported by a seamless after-sales service. TIL has
                                                earned a reputation as a market leader in mobile cranes and reach
                                                stackers, with our offerings known for their unwavering reliability,
                                                productivity, and efficiency. The company's values of integrity,
                                                transparency, accountability, leadership, teamwork, knowledge, and
                                                customer orientation serve as the guiding principles that shape and
                                                define our everyday actions.<br /> <br />Headquartered in Kolkata, we
                                                have regional offices in major cities across India, ensuring a
                                                widespread presence. The company operates two factories in Eastern
                                                India, including a state-of-the-art, purpose-built mobile crane
                                                manufacturing facility in Kamarhatty, Kolkata - the sole of its kind in
                                                the country. Additionally, TIL boasts an ERP-enabled factory in
                                                Kharagpur. Both factories hold certifications under ISO 9001:2015 and
                                                DIN EN ISO 3834-2 international quality management system
                                                standards.<br /> <br />We have established global alliances with Grove
                                                Worldwide and Manitowoc Crane Group of the USA, as well as Hyster® (a
                                                division of Hyster-Yale Group, Inc.) of the USA.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section style="background:#F5F5F5;padding:0 0 30px 0">
                            <div class="container">
                                <div class="header-section">
                                    <h3 class="m-0">Products on <span>offer include</span></h3>
                                    <div class="icon-container">
                                        <hr>
                                        <img src="<?php echo base_url(); ?>/tilindia/assets/images/Rectangle.png" alt=""
                                            srcset="">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row px-20">

                                    <ul class="offered-product-showcase">
                                        <?php foreach ($bodycontent["product"] as $key => $value) {
                                            if ($value['level'] < 3) { ?>
                                                <a href="<?php echo base_url() . $value["url"] ?>">
                                                    <li> <?php echo $value["name"] ?> </li>
                                                </a>
                                            <?php }
                                        } ?>
                                    </ul>

                                </div>

                                <div class="row mt-040 mb-040 ">

                                    <div class="col-md-4">
                                        <img src="<?php echo base_url(); ?>/tilindia/assets/images/til-300x137.jpg"
                                            class="iso-img" alt="till" srcset="">
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <p class="m-0 fw-400">Our unwavering commitment lies in the pursuit of
                                            establishing a sustainable institution and securing a sustainable future for
                                            all stakeholders.<br /><br />The ISO 9001 certification signifies our
                                            unwavering dedication to upholding the utmost quality standards.
                                            <br>The numerous CSR initiatives TIL undertakes are aimed at the betterment
                                            of society, community and environment.
                                        </p>
                                        <p class="fw-bold"><br />At TIL, quality is engineered to stringent and
                                            predetermined process parameters. Engineers,workmen, marketers and even
                                            vendors, all committed to a shared singular purpose…Customer
                                            Satisfaction.The unyielding commitment of the entire TIL team is reflected
                                            in the ISO: 9001 certification from the Bureau Veritas Quality
                                            International.</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
    </div>
</section>
