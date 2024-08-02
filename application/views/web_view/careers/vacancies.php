<style>
    .card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 25px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        margin-top: 40px;
    }

    .card:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .card .content {
        padding: 20px;
        position: relative;
    }

    .short-description {
        max-height: 30px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .expanded {
        max-height: none;
    }

    .read-more {
        color: #007bff;
        cursor: pointer;
        position: absolute;
        bottom: 10px;
        right: 20px;
        background: #fff;
        padding: 5px;
        border-radius: 5px;
    }
</style>
<?php include APPPATH . 'views/web_view/header-banner.php' ?>
<script>setBreadcrumbAndBackground('<?php echo base_url();?>assets/images/inner_page_banners/vacancies_new.jpg', "We are Hiring!");</script>
<section class="content_section">
    <div class="wrapper clearfix">

        <div class="container-fluid">

            <div class="header-section">
                <div class="container">
                    <h3 class="m-0"></h3>
                </div>
            </div>
            <div class="row ">
                <div class="bodycont" id="mainCol">
                    <article class="status-publish hentry">
                        <div class="entry-content">

                        </div>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="bodycont" id="mainCol">
                    <h1></h1>
                    <article class="status-publish hentry">
                        <div class="entry-content">
                            <section>
                                <div class="container">
                                    <div class="row curvebg pl-0">
                                        <div class="col-lg-4 col-12">
                                            <div class="homepix">
                                                <div class="box-behind"></div>
                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/vacancies.jpg"
                                                    class="img-responsive" alt="vacancies" srcset="">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-12 p-responsive">
                                            <div class="aboutText">
                                                <h1>Current Openings</h1>
                                                <figure>
                                                    <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png"
                                                        alt="rectangle" srcset="">
                                                    <hr>
                                                </figure>
                                                <p>
                                                    You may submit your CV here and we will consider the same as and
                                                    when suitable opportunities arise.
                                                    <br>
                                                    For further queries you may contact:<a
                                                        href="mailto:recruitment@tilindia.com"> <span
                                                            style="font-size:18px;"> recruitment@tilindia.com
                                                        </span></a>
                                                </p>
                                                <a href="<?php echo base_url(); ?>careers/submit_cv/0"><button
                                                        style="border:none"> SUBMIT CV
                                                    </button></a>
                                            </div>
                                        </div>
                                        <?php foreach ($bodycontent["openings"] as $key => $value) {
                                            $type = $value->opening_type == "FT" ? "Full Time" : "Part Time"; ?>
                                            <div class="col-md-4" style="cursor: pointer"
                                                onclick="cardClick('<?php echo base_url() . 'careers/submit_cv/' . $value->current_opening_id ?>')">
                                                <div class="card mt-4">
                                                    <div class="content">
                                                        <h3><?php echo $type; ?></h3>
                                                        <h5><?php echo $value->opening_title; ?></h5>
                                                        <div class="short-description">
                                                            <p><?php echo $value->opening_description; ?></p>
                                                        </div>
                                                        <span class="read-more"
                                                            onclick="toggleDescription(event, this)">Read More</span>
                                                        <span
                                                            style="position: relative; color: #666666; font-size: 16px; margin-right: 15px; display: inline-block;">
                                                            <span class="icon fa fa-calendar"
                                                                style="color: #a87c01;"></span>
                                                            <?php echo date("d-M-Y", strtotime($value->entry_date)); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </section>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function cardClick(url) {
        window.location.href = url;
    }

    function toggleDescription(event, element) {
        event.stopPropagation();

        const content = element.parentNode.querySelector('.short-description');
        const isExpanded = content.classList.toggle('expanded');
        element.textContent = isExpanded ? 'Read Less' : 'Read More';
    }

</script>