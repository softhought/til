<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url();?>assets/images/inner_page_banners/Media-page.jpg)">
    <div class="container">
        <h1 class="m-0" style="line-height:50px">TIL Captured in Motion</h1>
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
            <div class="bodycont" id="mainCol">
                <h1></h1>
                <div class="entry-content video-showcase">

                    <div class="row curvebg pl-0 mt-0">
                        <?php foreach ($bodycontent["video"] as $key => $value) { ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="embed-responsive embed-responsive-16by9"><iframe width="293" height="165"
                                        src="https://www.youtube.com/embed/<?php echo $value->video_id ?>?rel=0" frameborder="0"
                                        allowfullscreen="allowfullscreen"></iframe></div>
                                <p style="padding-top: 10px;"><?php echo $value->title?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>