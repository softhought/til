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
                                    <?php $index = 1; foreach ($bodycontent["teamList"] as $key => $value) {
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
                                                            <span style="padding-left:8px; font-size:17px"><?php echo $value->designation ?></span>
                                                        </p>
                                                        <p id="elipse<?php echo $index; ?>" class="text-elipse" style="padding:12px 0"><?php echo $value->about; ?>

                                                            <br><br>
                                                            <b>Address:</b> &nbsp; <?php echo $value->address; ?>
                                                            <br>
                                                            <b>DIN No:</b> &nbsp; <?php echo $value->din_no; ?>
                                                        </p>
                                                        <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn6"
                                                                data-target="elipse<?php echo $index++; ?>">Read
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
                                    <div class="col-lg-12 col-12">
                                        <div class="product-item board-showcase">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/pinaki_niyogy.jpg"
                                                    alt="pinaki_niyogy" />
                                            </figure>
                                            <div class="text-content">
                                                <h3>Pinaki Niyogy</h3>
                                                <p><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                                                    </svg>
                                                    <span style="padding-left:8px; font-size:17px">Chief Operating
                                                        Officer & Chief Technology Officer</span>
                                                </p>
                                                <p id="elipse16" class="text-elipse" style="padding:12px 0">Pinaki
                                                    Niyogy, has been a senior executive in the manufacturing industry
                                                    with over 31 years of dedicated service at TIL Limited, where he
                                                    began as a Management Trainee in 1992. With a profound journey
                                                    spanning various key roles, Pinaki's expertise evolved from 15 years
                                                    of impactful Product Development to a decade of steering
                                                    Manufacturing and Operations for TILs plants. For the past six
                                                    years, he has been the visionary Chief Technology Officer,
                                                    concurrently spearheading the Defence Business, and earned the title
                                                    of Vice President since 2014.
                                                    <br><br>
                                                    Pinaki has played a pivotal role in numerous product launches,
                                                    contributing to TIL's success in Defence and Civilian applications.
                                                    His strategic acumen was instrumental in introducing Grove and
                                                    Hyster products to the Indian market. His illustrious career
                                                    underscores a commitment to innovation, operational excellence, and
                                                    fostering international collaborations, making Pinaki a driving
                                                    force in TIL's continued growth.
                                                    <br><br>
                                                    Pinaki holds a Bachelor's in Engineering (Mechanical) from Bengal
                                                    Engineering College and has received numerous awards, including the
                                                    Chairman's Award for Leadership in 2010. Pinaki is an active member
                                                    of industry committees and holds management development credentials
                                                    from IIM Kolkata and IIM Bangalore.
                                                </p>
                                                <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn7"
                                                        data-target="elipse16">Read
                                                        more</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="product-item board-showcase">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/KanhaiyaGupta.png"
                                                    alt="KanhaiyaGupta" />
                                            </figure>
                                            <div class="text-content">
                                                <h3>Mr. Kanhaiya Gupta</h3>
                                                <p><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                                                    </svg>
                                                    <span style="padding-left:8px; font-size:17px">Chief Financial
                                                        Officer </span>
                                                </p>
                                                <p id="elipse17" class="text-elipse" style="padding:12px 0">
                                                    Kanhaiya Gupta is a seasoned CFO with a diverse skill set, extensive
                                                    experience in blue-chip companies, and a history of driving
                                                    financial excellence, business growth, and operational efficiency
                                                    with a proven track record spanning over 23 years.
                                                    <br><br>
                                                    An academically driven BCom. Hons. holder he is also a Fellow
                                                    Chartered Accountant (FCA), Fellow Company Secretary (FCS), and
                                                    Fellow Cost and Works Accountant (FICWA). In the past he has been
                                                    Chief Financial Officer (CFO) at Rashmi Metaullics Limited (RML),
                                                    Deputy CFO (Finance Controller) at ACC Cements (Lafarge-Holcim
                                                    Group) and has held key positions at IFB Industries Limited and ITC
                                                    Limited.
                                                    <br><br>
                                                    Over the year, Kanhaiya has been pivotal in formulating business
                                                    strategies, managing fund flow, and enhancing the company's bottom
                                                    line. He has experience is managing a large treasury function,
                                                    directing annual business plans, and e In this role, he piloted
                                                    financial and accounting functions, driving strategic planning,
                                                    financial effectiveness, and operational metrics. From managing
                                                    accounts for 20+ manufacturing locations and strategic business
                                                    units to implementing robust SAP environments, and handling M&A and
                                                    regulatory compliance, Kanhaiya has had been critical to the growth
                                                    of several large scale businesses, project implementations and
                                                    mega-expansions.
                                                    <br><br>
                                                    He is a result-oriented leader with strong analytical skills,
                                                    effective communication, and inter-personal capabilities and is
                                                    known for his proactive approach, strong business acumen, and
                                                    ability to identify potential risks and develop mitigation plans.
                                                </p>
                                                <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn10"
                                                        data-target="elipse17">Read
                                                        more</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="product-item board-showcase">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/SumitBiswas.png"
                                                    alt="SumitBiswas" />
                                            </figure>
                                            <div class="text-content">
                                                <h3>Mr. Sumit Biswas</h3>
                                                <p><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                                                    </svg>
                                                    <span style="padding-left:8px; font-size:17px">Associate Vice
                                                        President - Sales</span>
                                                </p>
                                                <p id="elipse18" class="text-elipse" style="padding:12px 0">
                                                    Sumit Biswas, currently the Associate Vice President – Sales at TIL
                                                    Limited, brings decades of expertise to the forefront of the
                                                    organization. In his dynamic role, Sumit has spearheaded strategic
                                                    initiatives, playing a pivotal role in the success and growth of
                                                    TIL. His leadership has been instrumental in elevating TIL's
                                                    position in the market, particularly in the Material Handling
                                                    Solutions (MHS) sector. He has handled various products, covered
                                                    multiple industries and worked across different parts of the country
                                                    through his professional journey.
                                                    <br><br>
                                                    A graduate in Metallurgical Engineering from the prestigious
                                                    National Institute of Technology, Surathkal, Sumit's educational
                                                    foundation laid the groundwork for his illustrious career.
                                                    Complementing his academic achievements, he completed the Middle
                                                    Management Programme at IIM Ahmedabad in 1996, showcasing a
                                                    commitment to continuous professional development.
                                                    <br><br>
                                                    Sumit's professional journey commenced at Vankos & Company, where he
                                                    began as a Jr. Sales Engineer, and progressed through pivotal roles
                                                    at renowned companies like Fenner (India) Limited, Carborundum
                                                    Universal Limited, and ITW Signode India Limited. His expansive
                                                    experience and strategic prowess have positioned him as a key figure
                                                    in the industry, culminating in his current leadership role at TIL
                                                    Limited.
                                                </p>
                                                <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn9"
                                                        data-target="elipse18">Read
                                                        more</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="product-item board-showcase">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/ShamitaNandi.png"
                                                    alt="ShamitaNandi" />
                                            </figure>
                                            <div class="text-content">
                                                <h3>Ms. Shamita Nandi</h3>
                                                <p><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                                                    </svg>
                                                    <span style="padding-left:8px; font-size:17px">Chief Human Resource
                                                        Officer</span>
                                                </p>
                                                <p id="elipse19" class="text-elipse" style="padding:12px 0">
                                                    Shamita Nandi is a seasoned Chief HR Officer known for translating
                                                    business visions into strategic HR initiatives. Shamita comes with
                                                    more than two decades of experience in building and translating the
                                                    people agenda across various industries, including manufacturing,
                                                    e-commerce, shared services, consulting and financial services. She
                                                    excels in creating Employee Value Proposition, building sustainable
                                                    Organization Culture, Capability Building, strong Business
                                                    Partnership, Employee Relations and Compensation & Rewards
                                                    <br><br>
                                                    She has played a pivotal role in human capital management and has
                                                    held key positions such as General Manager HR at Texmaco Rail &
                                                    Engineering Ltd., Kolkata, where she spearheaded the HR function,
                                                    focusing on efficiency and building a high-performance organisation.
                                                    <br><br>
                                                    Similarly, as the Head of HR at mjunction services ltd., Shamita
                                                    contributed significantly to drive employee engagement and
                                                    innovation while in her role at Barclays Shared Service, Chennai, as
                                                    HR Business Partner – Vice President, helped her showcase global
                                                    expertise in driving business strategies as trusted partner of
                                                    global leaders and enhancing the employer brand.
                                                    <br><br>
                                                    Apart from these she has also significantly contributed in her other
                                                    stints with E&Y Kolkata, Timken – Jamshedpur or Hewlett Packard -
                                                    Bangalore.
                                                    <br><br>
                                                    With a PG Diploma in Personnel Management from XISS, Shamita
                                                    possesses a strong foundation in strategic HR planning, leadership,
                                                    and diversity & wellness initiatives. Her differential competencies
                                                    include being a diversity and inclusion champion, executive coach,
                                                    and an empathetic and intuitive leader. Shamita’s career reflects
                                                    her dedication to building high-performing organizations through
                                                    innovative HR strategies and transformative leadership.
                                                </p>
                                                <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn11"
                                                        data-target="elipse19">Read
                                                        more</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="product-item board-showcase">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/RisabhNair.png"
                                                    alt="RisabhNair" />
                                            </figure>
                                            <div class="text-content">
                                                <h3>Rishabh P Nair</h3>
                                                <p><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                                                    </svg>
                                                    <span style="padding-left:8px; font-size:17px">Head Of Brand,
                                                        Content & PR </span>
                                                </p>
                                                <p id="elipse20" class="text-elipse" style="padding:12px 0">
                                                    Rishabh P Nair, is a seasoned brand and marketing professional, with
                                                    a diverse career spanning creative roles across marketing, branding,
                                                    and content management functions for brands like Citrus Pay (Now
                                                    PayU), Ratan Tata backed CashKaro.com, Cube Wealth and Grip Invest.
                                                    With a robust creative marketing and branding background, he has
                                                    consistently excelled in helping establishing new brands, leaving an
                                                    indelible mark on the identities of brands he has helped build.
                                                    <br><br>
                                                    Starting his journey in the world of journalism, Rishabh over time
                                                    transitioned into advertising, marketing and branding. Notably, he
                                                    has served as AVP Creative Marketing, Head of Brand Content, and
                                                    Creative Director for Fintech and e-commerce start-ups in India,
                                                    contributing to creation and establishment of renowned start-up
                                                    brands.
                                                    <br><br>
                                                    Rishabh has spearheaded PR & Branding initiatives across companies,
                                                    focusing on diverse ecommerce, wealth management and alternative
                                                    investment products. He has led teams across SEO, Design, Public
                                                    Relations and Marketing. He holds a Post Graduate Certification in
                                                    Marketing & Brand Management from MICA and a Bachelor's degree in
                                                    Journalism and Mass Communication from Guru Gobind Singh
                                                    Indraprastha University, (GGSIPU) New Delhi. He demonstrates strong
                                                    work ethic, creative prowess, and brings with him keen insights in
                                                    terms of branding and marketing strategies.
                                                </p>
                                                <span><a href="javascript:void(0)" class="more-read" id="readMoreBtn8"
                                                        data-target="elipse20">Read
                                                        more</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>