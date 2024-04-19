<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/<?php echo $bodycontent["main-section"][0]->banner_image; ?>">
    <div class="container">
        <h1 class="m-0">
        </h1>
    </div>
</section>
<section class="content_section">
    <div class="wrapper clearfix">
        <section class="product-details">
            <div class="container">
                <div class="row curvebg pl-0">
                    <div class="col-lg-4">
                        <div class="homepix">
                            <div class="box-behind"></div>
                            <img src="<?php echo base_url(); ?>tilindia/assets/images/technology.jpg"
                                class="img-responsive" alt="Crane Manufacturer in India" />
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 p-responsive">

                        <div class="aboutText">
                            <h1 class="fc-black"><?php echo $bodycontent["main-section"][0]->name; ?></h1>
                            <h2><?php echo $bodycontent["main-section"][0]->short_description; ?></h2>
                            <figure>
                                <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png"
                                    alt="rectangle" />
                                <hr />
                            </figure>
                            <p><?php echo $bodycontent["main-section"][0]->about; ?></p>
                            <a class="read-btn quote-btn" data-toggle="modal" data-target="#myModal">
                                Request for a quote
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php foreach ($bodycontent['product_model'] as $key => $products) { ?>
            <section class="gray-bg">
                <div class="container">
                    <div class="row curvebg pl-0">
                        <div class="col-md-12 col-12">
                            <div class="table-content">
                                <h3 class="m-0 fc-black"><?php echo $products->title; ?></h3>
                                <p><?php echo $products->about; ?></p>
                                <div class="table-responsive">
                                    <table id="tablepress-31" class="product-table tablepress tablepress-id-31">
                                        <thead>
                                            <tr class="row-1 odd">
                                                <?php $colNum = 1;
                                                foreach ($products->template_master as $key => $value) { ?>
                                                    <th class="column-<?php echo $colNum++; ?>">
                                                        <strong><?php echo $value ?></strong>
                                                    </th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <?php foreach ($products->spec_sheet_details as $value) {
                                                $index = 1; ?>
                                                <tr class="row-2 even">
                                                    <?php foreach ($products->template_master as $column => $columnName) {
                                                        if ($colNum - 1 > $index) { ?>
                                                            <td valign="top" class="column-<?php echo $index++; ?>">
                                                                <?php echo $value->$column; ?>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td class="column-<?php echo $index; ?>">
                                                                <a href="<?php echo base_url(); ?>assets/pdf/<?php echo $value->$column; ?>"
                                                                    target="_blank"><img
                                                                        src="<?php echo base_url(); ?>tilindia/assets/images/pdf2.png"
                                                                        alt="pdf2" width="22" height="22">
                                                                </a>
                                                            </td>
                                                        <?php }
                                                    } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    </div>
</section>