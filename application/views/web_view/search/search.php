<?php include APPPATH . 'views/web_view/header-banner.php' ?>
<script>setBreadcrumbAndBackground('<?php echo base_url(); ?>assets/images/inner_page_banners/crushing_screening_plants.jpg', "");</script>
<section class="content_section">
    <div class="wrapper clearfix">
        <?php if (isset($bodycontent["searchResult"])) { ?>
            <div class="container cont_area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="centerbox">
                            <div id="crumbs">
                                <a><a href="<?php echo base_url(); ?>">Home</a></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 bodycont" id="mainCol">
                        <h1>Search Results for: </h1>
                        <article class="post-352 page type-page status-publish hentry">
                            <div class="entry-content">

                                <h2 class="sr_result_head"
                                    style="font-size:30px; line-height:34px; font-weight:normal; color:#f8bf20">
                                    <?php echo $bodycontent["searchResult"]["query"]; ?>
                                </h2>
                                <nav id="nav-above" style="margin-bottom:20px">
                                    <div class="nav-next" style="display:inline-block"></div>
                                </nav>
                                <?php if (isset($bodycontent["searchResult"]["content"])) { foreach ($bodycontent["searchResult"]["content"] as $key => $value) { ?>
                                    <section class="sr_result">
                                        <h1 class="entry-title">
                                            <a href="<?php echo $value["url"]; ?>"
                                                class="search-head"><?php echo $value["title"]; ?></a>
                                        </h1>
                                        <div class="entry-summary">
                                            <p> <?php echo $value["content"] ?>... <a href="<?php echo $value["url"]; ?>"
                                                    target="_blank">Continue reading <span class="meta-nav">→</span></a> </p>

                                        </div>
                                    </section>
                                <?php } } ?>
                                <nav id="nav-above" style="margin-bottom:20px">
                                    <div class="nav-next" style="display:inline-block"></div>
                                </nav>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>