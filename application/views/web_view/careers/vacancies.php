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

    .card .image {
        background: #f5f5f5;
        text-align: center;
    }

    .card .image img {
        width: 100%;
        height: auto;
    }

    .card .content {
        padding: 20px;
    }

    .card h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 16px;
        color: #666;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .card a {
        text-decoration: none;
        color: #007bff;
    }

    .card button {
        height: 50px;
        width: 150px;
        background-color: #ffc72c;
        text-decoration: none;
        display: flex;
        align-items: center;
        color: #000 !important;
        box-shadow: 0 5px 0px 0 #000;
        border-radius: 6px;
        justify-content: center;
        font-weight: 600 !important;
        font-size: 15px;
        letter-spacing: 1px;
        margin-top: 25px;
    }

    .card button:hover {
        background-color: #000;
        box-shadow: 0 5px 0px 0 #ffc72c;
        color: #fff !important;
        transform: scaleY(10px);
        transition: transform 0.3s ease-in-out;
    }
</style>
<section class="about-banner-section "
    style="background-image:url(<?php echo base_url(); ?>assets/images/inner_page_banners/vacancies_new.jpg)">
    <div class="container">
        <h1 class="m-0">We are Hiring!</h1>
    </div>
</section>
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
                                                    class="img-responsive" alt="" srcset="">
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
                                            $type = $value->opening_type == "FT" ? "Full Time" : "Part Time" ?>
                                            <a href="<?php echo base_url() . "careers/submit_cv/" . $value->current_opening_id ?>" class="col-md-4" style="cursor: pointer" >
                                                <div class="card mt-4">
                                                    <div class="content">
                                                        <h3><?php echo $type; ?></h3>
                                                        <h5><?php echo $value->opening_title; ?></h5>
                                                        <p>
                                                            <?php echo $value->opening_description; ?>
                                                        </p>
                                                        <span
                                                            style="position: relative; color: #666666; font-size: 16px; margin-right: 15px; display: inline-block;">
                                                            <span class="icon fa fa-calendar"
                                                                style="color: #a87c01;"></span>
                                                            <?php echo date("d-M-Y", strtotime($value->entry_date)); ?></span>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </a>
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