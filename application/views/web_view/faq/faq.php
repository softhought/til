<style>
    .template_faq {
        background: #edf3fe none repeat scroll 0 0;
    }

    .panel-group {
        background: #fff none repeat scroll 0 0;
        border-radius: 3px;
        box-shadow: 0 5px 30px 0 rgba(0, 0, 0, 0.04);
        margin-bottom: 0;
        padding: 30px;
    }

    #accordion .panel {
        border: medium none;
        border-radius: 0;
        box-shadow: none;
        margin: 0 0 15px 10px;
    }

    #accordion .panel-heading {
        border-radius: 30px;
        padding: 0;
    }

    #accordion .panel-title a {
        background: #ffb900 none repeat scroll 0 0;
        border: 1px solid transparent;
        border-radius: 30px;
        color: #fff;
        display: block;
        font-size: 18px;
        font-weight: 600;
        padding: 12px 20px 12px 50px;
        position: relative;
        transition: all 0.3s ease 0s;
    }

    #accordion .panel-title a.collapsed {
        background: #fff none repeat scroll 0 0;
        border: 1px solid #ddd;
        color: #333;
    }

    #accordion .panel-title a::after,
    #accordion .panel-title a.collapsed::after {
        background: #ffb900 none repeat scroll 0 0;
        border: 1px solid transparent;
        border-radius: 50%;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.58);
        color: #fff;
        content: "";
        font-family: fontawesome;
        font-size: 25px;
        height: 55px;
        left: -20px;
        line-height: 55px;
        position: absolute;
        text-align: center;
        top: -5px;
        transition: all 0.3s ease 0s;
        width: 55px;
    }

    #accordion .panel-title a.collapsed::after {
        background: #fff none repeat scroll 0 0;
        border: 1px solid #ddd;
        box-shadow: none;
        color: #333;
        content: "";
    }

    #accordion .panel-body {
        background: transparent none repeat scroll 0 0;
        border-top: medium none;
        padding: 20px 25px 10px 9px;
        position: relative;
    }

    #accordion .panel-body p {
        border-left: 1px dashed #8c8c8c;
        padding-left: 25px;
    }
</style>

<?php include APPPATH . 'views/web_view/header-banner.php' ?>
<script>setBreadcrumbAndBackground('<?php echo base_url(); ?>assets/images/inner_page_banners/customer-support.png', "Frequently Asked Questions");</script>
<section class="content_section">
    <div class="wrapper clearfix">
</section>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-title text-center wow zoomIn aboutText">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php $index = 1;
                foreach ($bodycontent["faq"] as $key => $faqValue) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_<?php echo $index; ?>">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                    href="#collapse_<?php echo $index; ?>" aria-expanded="false"
                                    aria-controls="collapse_<?php echo $index; ?>">
                                    <?php echo $faqValue->faq_question; ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_<?php echo $index; ?>" class="panel-collapse collapse" role="tabpanel"
                            aria-labelledby="heading_<?php echo $index; ?>">
                            <div class="panel-body">
                                <p><?php echo $faqValue->faq_answer; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php $index++;
                } ?>
            </div>
        </div>
    </div>
</div>