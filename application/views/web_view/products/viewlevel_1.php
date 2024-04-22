<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->banner_image; ?>">
    <div class="container">
        <h1 class="m-0">
        </h1>
    </div>
</section>


<section class="content_section">
    <div class="wrapper clearfix">
        <div class="header-section">
            <div class="container">
                <h3 class="m-0 fc-black"><?php echo $bodycontent["main-section"][0]->name; ?></h3>

                <h5><?php echo $bodycontent["main-section"][0]->about; ?></h5>
                <div class="icon-container">
                    <hr>
                    <img src="<?php echo base_url();?>tilindia/assets/images/Rectangle.png" alt="rectangle" />
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
                                    <a href="<?php echo base_url() . "products/" . $bodycontent["main-section"][0]->slug . "/" . $product->slug; ?>">
                                        <div class="product-item material-card">
                                            <img src="<?php echo base_url('assets/images/' . $product->catagory_image); ?>">
                                            <h5><?php echo $product->name; ?></h5>
                                            <p><?php echo $product->short_description; ?></p>
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