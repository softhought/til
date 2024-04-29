<section class="about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/inner_page_banners/bod-banner.png)">
    <div class="container">
        <h1 class="m-0">Board of <span> Directors</span></h1>
    </div>
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

                        <section>
                            <div class="container">
                                <div class="row curvebg pl-0 mt-0 mb-0">
                                    <?php $index = 1;
                                    foreach ($bodycontent["teamList"] as $key => $value) {
                                        if ($value->team_member_type == "BOD") { ?>

                                            <div class="col-lg-12 col-12">
                                                <div class="product-item board-showcase">
                                                    <figure>
                                                        <img src="<?php echo base_url() . "tilindia/assets/images/" . $value->member_pic; ?>"
                                                            alt="<?php echo $value->member_name ?>" />
                                                    </figure>
                                                    <div class="text-content">
                                                        <h3><?php echo $value->member_name ?></h3>
                                                        <p><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                                viewBox="0 0 512 512">
                                                                <path
                                                                    d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                                                            </svg>
                                                            <span
                                                                style="padding-left:8px; font-size:17px"><?php echo $value->designation ?></span>
                                                        </p>
                                                        <p id="elipse_bod_<?php echo $index; ?>" class="text-elipse"
                                                            style="padding:12px 0"><?php echo $value->about; ?>

                                                            <br><br>
                                                            <b>Address:</b> &nbsp; <?php echo $value->address; ?>
                                                            <br>
                                                            <b>DIN No:</b> &nbsp; <?php echo $value->din_no; ?>
                                                        </p>
                                                        <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn6"
                                                                data-target="elipse_bod_<?php echo $index++; ?>">Read
                                                                more</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                            <div class="container">
                                <div class="header-section">
                                    <h3 class="m-0">Management<span> Team</span></h3>
                                    <div class="icon-container">
                                        <hr />
                                        <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png"
                                            alt="rectangle" />
                                        <hr />
                                    </div>
                                </div>
                                <div class="row curvebg pl-0 mt-0">
                                    <?php $index = 1;
                                    foreach ($bodycontent["teamList"] as $key => $value) {
                                        if ($value->team_member_type == "MT") { ?>

                                            <div class="col-lg-12 col-12">
                                                <div class="product-item board-showcase">
                                                    <figure>
                                                        <img src="<?php echo base_url() . "tilindia/assets/images/" . $value->member_pic; ?>"
                                                            alt="<?php echo $value->member_name ?>" />
                                                    </figure>
                                                    <div class="text-content">
                                                        <h3><?php echo $value->member_name ?></h3>
                                                        <p><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                                viewBox="0 0 512 512">
                                                                <path
                                                                    d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                                                            </svg>
                                                            <span
                                                                style="padding-left:8px; font-size:17px"><?php echo $value->designation ?></span>
                                                        </p>
                                                        <p id="elipse_mt_<?php echo $index; ?>" class="text-elipse"
                                                            style="padding:12px 0"><?php echo $value->about; ?>

                                                            <br><br>
                                                            <b>Address:</b> &nbsp; <?php echo $value->address; ?>
                                                            <br>
                                                            <b>DIN No:</b> &nbsp; <?php echo $value->din_no; ?>
                                                        </p>
                                                        <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn6"
                                                                data-target="elipse_mt_<?php echo $index++; ?>">Read
                                                                more</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>