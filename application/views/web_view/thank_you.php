<section class="about_header">
    <img src="<?php echo base_url() ?>assets/images/1.jpg" class="img-responsive" height="400" alt="">
</section>
<section class="content_section">
    <div class="wrapper clearfix">
        <div class="container cont_area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="centerbox">

                        <div id="crumbs">
                            <a><a href="index.html">Home</a></a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" id="leftCol">
                    <div class="sidebarlist">
                        <div class="menu-about-us-container">

                            <ul id="menu-thank-you" class="pro_left">
                                <?php foreach ($bodycontent["product_menu"] as $key => $rootMenu) { ?>
                                    <li class="first last"><a
                                            href="<?php echo base_url(); ?>products/<?php echo $rootMenu["slug"]; ?>"
                                            class="sub_nav"><?php echo $rootMenu["name"] ?> <span class="caret"></span></a>
                                        <ul>
                                            <?php foreach ($rootMenu["children"] as $key => $parentMenu) { ?>
                                                <li class="first"><a href="<?php echo base_url(); ?>products/<?php echo $rootMenu["slug"]; ?>/<?php echo $parentMenu["slug"]; ?>"
                                                        class="sub_nav"><?php echo $parentMenu["name"] ?> <span class="caret"></span></a>
                                                    <ul>
                                                        <?php foreach ($parentMenu["children"] as $key => $children) { ?>
                                                            <li class="first"><a
                                                                href="<?php echo base_url(); ?>products/<?php echo $rootMenu["slug"]; ?>/<?php echo $parentMenu["slug"]; ?>/<?php echo $children["slug"]; ?>"><?php echo $children["name"]; ?></a></li>
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
                <div class="col-md-9 bodycont" id="mainCol">
                    <h1 style=""></h1>
                    <article class="post-352 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="thankyou_banner">
                                <span>Thank You !</span>
                                <p>We appreciate you contacting us. We will get back to you shortly.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>