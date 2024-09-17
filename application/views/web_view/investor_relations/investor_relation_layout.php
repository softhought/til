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
                            <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png" alt="Rectangle"
                                srcset="">
                            <hr>
                        </figure>
                    </div>
                    <?php echo $bodycontent["investorRelationsDetails"]->description ?>

                    <?php if ($bodycontent["investorRelationsDetails"]->is_file_uploaded == "Y") { ?>
                        <div class="entry-content">
                            <div class="news_list" style="width:100%">
                                <ul>
                                    <?php foreach ($bodycontent["investorRelationsDetails"]->file as $key => $file) { ?>
                                        <li>
                                            <strong class="pdfIcon">
                                                <?php echo $file->uploaded_file_desc; ?>
                                            </strong>
                                            <aside>
                                                <a href="<?php echo base_url(); ?>assets/docs/pdf/<?php echo $file->random_file_name; ?>"
                                                    target="_blank" class="download_pdf tracklink"
                                                    title="<?php echo $file->uploaded_file_desc; ?>">
                                                    View
                                                </a>
                                                /
                                                <a href="<?php echo base_url(); ?>assets/docs/pdf/<?php echo $file->random_file_name; ?>"
                                                    download="<?php echo $file->uploaded_file_desc; ?>" class="tracklink"
                                                    title="<?php echo $file->uploaded_file_desc; ?>">
                                                    Download Document
                                                </a>
                                            </aside>
                                            <div class="clear"></div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.tracklink').click(function (e) {
            var url = $(this).attr('href');

            var filename = url.substring(url.lastIndexOf('/') + 1);

            var description = $(this).attr('title') || 'No description';

            var currentUrl = window.location.href;
            
            $.ajax({
                url: '<?php echo base_url(); ?>dashboard/save_download_info', 
                method: 'POST',
                data: {
                    filename: filename,
                    description: description,
                    current_url: currentUrl,
                    file_url: url
                },
                success: function (response) {
                },
                error: function (xhr, status, error) {
                    console.error('Error saving download information:', error);
                    window.open(url, '_blank');
                }
            });
        });
    });
</script>