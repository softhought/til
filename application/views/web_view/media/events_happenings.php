<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/inner_page_banners/Media-page.jpg)">
    <!-- <img src="/assets/images/inner_page_banners/Media-page.jpg" class="img-responsive" height="400"  alt="Events & Happenings"> -->
    <div class="container">
        <h1 class="m-0">Stay Updated, Stay Connected</h1>
    </div>
</section>
<section class="content_section">
    <div class="wrapper clearfix">
        <div class="container">
            <div class="header-section ">
                <div class="container">
                    <h3 class="m-0 fc-black"></h3>
                </div>
            </div>
            <div class="row curvebg pl-0 mt-0">
                <h1></h1>
                <div class="entry-content">
                    <div class="events-section">
                        <?php $index = 1; foreach ($bodycontent["mediaGallery"] as $mediaKey => $mediaValue) { ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <?php foreach ($mediaValue->gallery as $key => $value) {
                                    if ($key == 0) { ?>
                                        <a href="<?php echo base_url(); ?>assets/images/<?php echo $value["banner_image"] ?>"
                                            data-gall="gall1_<?php echo $index ?>" class="venobox" title="Excon 2019" data-alt="Excon 2019">
                                            <img src="<?php echo base_url(); ?>assets/images/<?php echo $value["banner_image"] ?>"
                                                alt="<?php echo $value["banner_alt"] ?>" width="350" height="250" />
                                        </a>
                                        <h4 style="font-weight:600"><?php echo $mediaValue->name ?></h4>
                                    <?php } else { ?>
                                        <div style="display: none">
                                            <a href="<?php echo base_url(); ?>assets/images/<?php echo $value["banner_image"] ?>"
                                                data-gall="gall1_<?php echo $index ?>" class="venobox" data-alt="<?php echo $value["banner_alt"] ?>" title="<?php echo $value["banner_alt"] ?>"></a>
                                        </div>
                                    <?php }
                                } $index++; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>