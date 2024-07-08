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
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="news-card">
                            <img style="width: 100%; height: 200px; border-radius: 5px;" src="https://img.etimg.com/thumb/msid-107118118,width-300,height-225,imgsize-58026,resizemode-75/gainwell-engineering-enters-into-a-technology-licensing-agreement-for-underground-mining-equipment-with-caterpillar.jpg"
                                alt="News Image">
                            <div class="news">
                                <h5>The Economic Times Gainwell Group acquires TIL Limited, invest Rs 1000 crore for
                                    expansion</h5>
                                <a href="https://m.economictimes.com/industry/indl-goods/svs/engineering/gainwell-commosales-to-acquire-til-ltd-invest-rs-1000-crore-for-expansion/articleshow/107118104.cms"
                                    target="_blank" class="btn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="news-card">
                            <img style="width: 100%; height: 200px; border-radius: 5px;" src="https://www.tilindia.in/assets/images/rough-terrain-cranes.jpg"
                                alt="News Image">
                            <div class="news">
                                <h5>Indian Defence Review The Vanguard of India's Defence: High Technology Ground
                                    Support Equipment</h5>
                                <a href="https://www.indiandefencereview.com/news/the-vanguard-of-indias-defence-high-technology-ground-support-equipment/"
                                    target="_blank" class="btn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="news-card">
                            <img style="width: 100%; height: 200px; border-radius: 5px;" src="https://www.manufacturingtodayindia.com/cloud/2024/01/25/Gainwell-Pic-1-1024x768.jpg"
                                alt="News Image">
                            <div class="news">
                                <h5>Manufacturing Today India Gainwell Group secures majority stake in TIL Ltd, eyes $1
                                    Billion turnover</h5>
                                <a href="https://www.manufacturingtodayindia.com/gainwell-group-secures-majority-stake-in-til-ltd-eyes-1-billion-turnover/"
                                    target="_blank" class="btn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="news-card">
                            <img style="width: 100%; height: 200px; border-radius: 5px;" src="https://static.theprint.in/wp-content/uploads/2023/06/theprint_default_image_new-696x392.jpg?compress=true&quality=80&w=800&dpr=1"
                                alt="News Image">
                            <div class="news">
                                <h5>ThePrint Gainwell Group takes over management control of TIL Ltd after Rs 120 cr
                                    investment</h5>
                                <a href="https://theprint.in/economy/gainwell-group-takes-over-management-control-of-til-ltd-after-rs-120-cr-investment/1937918/"
                                    target="_blank" class="btn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>