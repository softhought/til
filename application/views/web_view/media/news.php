<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .news-card {
        margin: 15px 0;
        padding: 14px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .news-card:hover {
        transform: translateY(-5px);
    }

    .news img {
        width: 100%;
        height: auto;
        border-radius: 10px 10px 0 0;
    }

    .news h5 {
        margin: 15px 0 10px;
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        position: relative;
        padding-bottom: 10px;
    }

    .news h5::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #007bff;
    }

    .news .btn {
        background-color: #ffc72c;
        color: black;
        border-radius: 20px;
        padding: 5px 15px;
    }

    .news .btn:hover {
        background-color: #b98f1c;
    }

    .publication-title {
        color: #715500;
        font-weight: bold;
        font-size: 18px;
        margin-top: 14px;
        font-family: system-ui;
    }
</style>

<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/inner_page_banners/Media-page.jpg)">

    <div class="container">

        <h1 class="m-0" style="line-height:50px">TIL in the News</h1>

    </div>

</section>

<section class="content_section">

    <div class="wrapper clearfix">

        <div class="container">

            <div class="header-section">

                <div class="container">

                    <h3 class="m-0"></h3>

                </div>

            </div>

            <div class="container" id="mainCol">
                <div class="row mt-4">
                    <?php foreach ($bodycontent["news"] as $key => $value) { ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="news-card">
                                <img style="width: 100%; height: 200px; border-radius: 5px;"
                                    src="<?php echo base_url(); ?>assets/docs/pdf/<?php echo $value->random_file_name ?>"
                                    alt="News Image">
                                <div class="news">
                                    <h2 class="publication-title"><?php echo $value->publication; ?></h2>
                                    <h5><?php echo $value->uploaded_file_desc; ?></h5>
                                    <a href="<?php echo $value->url; ?>" target="_blank" class="btn">Read More <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>

</section>