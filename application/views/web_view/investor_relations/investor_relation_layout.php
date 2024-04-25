<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>tilindia/assets/images/inner_page_banners/investor_relations.png)">
    <div class="container">
        <h1 class="m-0">Fostering Trust Through Transparency</h1>
    </div>
</section>

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
                                        <?php foreach ($mainMenu->details as $key => $subMenu) { 
                                            $activeStatus = $bodycontent["investorRelationsDetails"]->page_url == $subMenu->page_url ? "activemenu" : ""; ?>
                                            <li class="<?php echo $activeStatus; ?>"><a
                                                    href="<?php echo base_url() . $subMenu->page_url ?>"><?php echo $subMenu->title ?></a>
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
                        <h1 style="line-height:40px"><?php echo $bodycontent["investorRelationsDetails"]->title ?></h1>

                        <figure>
                            <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png" alt="" srcset="">
                            <hr>
                        </figure>
                    </div>
                    <?php echo $bodycontent["investorRelationsDetails"]->description ?>
                    <div class="entry-content">
                        <?php if ($bodycontent["investorRelationsDetails"]->is_file_uploaded == "Y") { ?>
                            <div class="news_list" style="width:100%">
                                <ul>
                                    <?php foreach ($bodycontent["investorRelationsDetails"]->file as $key => $file) { ?>
                                        <p><a class="pdf_link" href="<?php echo base_url(); ?>assets/docs/pdf/<?php echo $file->random_file_name; ?>" target="_blank">Click to view / download the documents.</a></p>
                                        <hr>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>