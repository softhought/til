<?php include APPPATH . 'views/web_view/header-banner.php' ?>
<script>setBreadcrumbAndBackground('<?php echo base_url(); ?>tilindia/assets/images/inner_page_banners/investor_relations.png', "Fostering Trust Through Transparency");</script>
<section class="content_section">
        <div class="wrapper clearfix">
                <div class="container">
                        <div class="row curvebg pl-0 ">
                                <div class="mobl_dropHeading"><span>Submenu</span></div>

                                <div class="col-lg-3 col-md-12 col-12 invester_nav" id="leftCol">
                                        <section>
                                                <?php foreach ($bodycontent["investorMenu"] as $key => $mainMenu) { ?>
                                                        <h4><?php echo $mainMenu->investor_relation_head; ?></h4>
                                                        <div class="sidebarlist" style="display: none;">
                                                                <div class="menu-investor-menu-container">
                                                                        <ul id="menu-investor-menu" class="left-nav">
                                                                                <?php foreach ($mainMenu->details as $key => $subMenu) { ?>
                                                                                        <li><a href="<?php echo base_url() . $subMenu->page_url ?>"><?php echo $subMenu->title ?></a>
                                                                                        </li>
                                                                                <?php } ?>
                                                                        </ul>
                                                                </div>
                                                        </div>
                                                <?php } ?>
                                        </section>
                                </div>
                                <div class="col-lg-9 col-md-12 col-12 invester_cont" id="mainCol">
                                        <div class="aboutText">
                                                <h1 style="line-height:40px">Investor <span>Relations</span></h1>

                                                <figure>
                                                        <img src="tilindia/assets/images/Rectangle.png" alt="Rectangle"
                                                                srcset="">
                                                        <hr>
                                                </figure>
                                        </div>
                                        <div class="entry-content">

                                                <article class="status-publish hentry">
                                                        <div class="entry-content">
                                                                <p>For share related queries / assistance / information,
                                                                        please contact:</p>
                                                                <p>TIL Limited<br>
                                                                        Secretarial Department<br>
                                                                        1, Taratolla Road, Garden Reach, Kolkata-700
                                                                        024<br>
                                                                        Phone Nos. 033 66332000, 2469-3732/36 (5
                                                                        lines)<br>
                                                                        Fax Nos. 2469-2143/2469-3731<br>
                                                                        Email &ndash; <a
                                                                                href="mailto:Secretarial.Department@tilindia.com">Secretarial.Department@tilindia.com</a>
                                                                </p>
                                                        </div>
                                                </article>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</section>