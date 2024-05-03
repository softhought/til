<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/inner_page_banners/Media-page.jpg)">
    <div class="container">
        <h1 class="m-0">The Insider Story</h1>
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
            <div class="row curvebg  mt-0">
                <div class="bodycont" id="mainCol">
                    <h1></h1>
                    <div class="entry-content">
                        <div>
                            <table class="til_table_view">
                                <tr>
                                    <th>Details</th>
                                    <th>Actions</th>
                                </tr>
                                <tr>
                                    <?php foreach ($bodycontent["til_talk"] as $key => $value) { ?>
                                        <td><strong class="pdfIcon"><?php echo $value->uploaded_file_desc; ?></strong><br>
                                        </td>
                                        <td>
                                            <aside>
                                                <a href="<?php echo base_url(); ?>assets/docs/pdf/<?php echo $value->random_file_name ?>"
                                                    target="_blank" class="download_pdf"
                                                    title="SmartMoves_ABBytes_CW_September_2020.pdf">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18"
                                                        viewBox="0 0 576 512">
                                                        <path
                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                    </svg>
                                                    View
                                                </a> /
                                                <a href="javascript:void(0)" target="_blank" class="download_pdf"
                                                    onclick="downloadPDF('<?php echo base_url(); ?>assets/docs/pdf/<?php echo $value->random_file_name; ?>', '<?php echo $value->user_file_name; ?>')"
                                                    title="SmartMoves_ABBytes_CW_September_2020.pdf">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                                    </svg>
                                                    Download Document</a>

                                            </aside>
                                            <div class="clear"></div>
                                        </td>
                                    <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<script>
    function downloadPDF(url, filename) {
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        link.click();
    }
</script>