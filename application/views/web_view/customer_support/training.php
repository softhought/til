<?php include APPPATH . 'views/web_view/header-banner.php' ?>
<script>setBreadcrumbAndBackground('<?php echo base_url(); ?>assets/images/inner_page_banners/customer_support_.jpg', "Skilled Manpower For Optimal Machine Performance");</script>
<section class="content_section">
    <div class="wrapper clearfix">
        <div class="">
            <div class="header-section">
                <div class="container">
                    <h3 class="m-0 fc-black">Training</h3>
                    <div class="icon-container">
                        <hr>
                        <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png" alt="rectangle"
                            srcset="">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="bodycont" id="mainCol">
                    <article class="status-publish hentry">
                        <div class="entry-content">
                            <div class="container">
                                <div class="row curvebg mt-0 pl-0">
                                    <div class="col-md-12 col-12">
                                        <div class="conduct-content" style="display:grid">
                                            <p class="facility-text mb-0">A trained and skilled operator is critical for
                                                maximizing the performance of your machines reducing costly downtime,
                                                increasing your ROI, improving safety. A trained operator is able to
                                                capture your machine&rsquo;s full potential.
                                                <br>
                                                We offer training on basic machine operation and scheduled maintenance
                                                to customer&rsquo;s operator and maintenance staff . There are various
                                                modules of training available that will not only enhance knowledge and
                                                skills but provide the competitive advantage.
                                            </p>
                                            <br>
                                            <!-- <a href="" target="blank">Training Calendar 2021-2022</a> -->
                                            <!-- <a href="">Training Calendar 2024</a> -->
                                            <a id="openModalBtn" data-toggle="modal" data-target="#myModal"
                                                style="cursor:pointer">Training Calendar 2024</a>
                                            <div class="modal fade  training-modal calendar-modal" id="myModal"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content form-modal-show">
                                                        <!-- <div class="modal-header">
                                                                <a class="close closebtn" data-dismiss="modal" aria-hidden="true" style="padding:0;background: none"><i class="fa fa-times-circle" style="font-size:22px" aria-hidden="true"></i></a>
                                                                <h4 class="modal-title" id="myModalLabel">Training Calendar 2024</h4>
                                                            </div> -->
                                                        <div class="modal-body">
                                                            <div class="calendar-popup-style">
                                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/logo.png"
                                                                    style="width:auto" alt="logo" srcset="">
                                                                <h3 class="m-0 py-010">Training Calendar of 2024 is
                                                                    coming soon.</h3>
                                                                <a class="close closebtn read-btn" data-dismiss="modal"
                                                                    aria-hidden="true"
                                                                    style="padding:15px;border-radius: 4px;">ok</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <section
                                style="background: url(<?php echo base_url(); ?>tilindia/assets/images/banner2.png) center/cover no-repeat;">
                                <div class="header-section">
                                    <div class="container">
                                        <h3 class="m-0 fc-black">Training Request Form / Nomination Form </h3>
                                        <div class="icon-container">
                                            <hr />
                                            <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png"
                                                alt="rectangle" />
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row curvebg pl-0 mt-0">
                                        <div class="col-lg-4 col-12">
                                            <div class="homepix">
                                                <img src="<?php echo base_url(); ?>tilindia/assets/images/Training-form.jpg"
                                                    alt="Training-form" srcset="">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-12 ">
                                            <div class="training-form ">
                                                <p>(All Fields will be <span style="color:#f00">*</span>marked
                                                    mandatory) </p><br>
                                                <form enctype="multipart/form-data" class="training_form"
                                                    id="training_form" data-toggle="validator" role="form" method="POST"
                                                    accept-charset="utf-8">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="customer_name">Customer Name <span
                                                                        style="color:#f00">*</span></label>
                                                                <input type="text" name="customer_name" value=""
                                                                    placeholder="Customer Name" autocomplete="off"
                                                                    tabindex="1" id="customer_name" required="required"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="company_name">Company Name <span
                                                                        style="color:#f00">*</span></label>
                                                                <input type="text" name="company_name" value=""
                                                                    placeholder="Company Name " autocomplete="off"
                                                                    id="company_name" tabindex="2" required="required"
                                                                    class="form-control" />

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="phone">Phone Number <span
                                                                        style="color:#f00">*</span></label>
                                                                <input type="tel" name="phone" value=""
                                                                    placeholder="Phone Number" autocomplete="off"
                                                                    id="phone" tabindex="3" required="required"
                                                                    maxlength="10" class="form-control" />

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="email">Email Address <span
                                                                        style="color:#f00">*</span></label>
                                                                <input type="email" name="email" value=""
                                                                    placeholder="Email Address" autocomplete="off"
                                                                    id="email"
                                                                    data-error="That email address is invalid"
                                                                    tabindex="4" required="required"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="address">Address <span
                                                                        style="color:#f00">*</span></label>
                                                                <textarea name="address" cols="40" rows="2"
                                                                    type="textarea" placeholder="Address"
                                                                    autocomplete="off" id="address" required="required"
                                                                    tabindex="5" value=""
                                                                    class="form-control markitup"></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="training_id">Module Interested for Training
                                                                    <span style="color:#f00">*</span></label>
                                                                <select name="training_id"
                                                                    placeholder="Please Select Module" id="training_id"
                                                                    required="required" tabindex="6"
                                                                    class="form-control">
                                                                    <option value="" label="Please Select Module">Please
                                                                        Select Module</option>
                                                                    <?php foreach ($bodycontent["interested_for_training"] as $key => $value) { ?>
                                                                        <option value="<?php echo $value->id ?>"
                                                                            label="<?php echo $value->name ?>">
                                                                            <?php echo $value->name ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">


                                                                <label for="training_month">Training Month <span
                                                                        style="color:#f00">*</span></label>

                                                                <select name="training_month"
                                                                    placeholder="Please Select Month"
                                                                    id="training_month" required="required" tabindex="7"
                                                                    class="form-control">
                                                                    <option value="" label="Please Select Month">Please
                                                                        Select Month</option>
                                                                    <option value="1" label="January">January</option>
                                                                    <option value="2" label="February">February</option>
                                                                    <option value="3" label="March">March</option>
                                                                    <option value="4" label="April">April</option>
                                                                    <option value="5" label="May">May</option>
                                                                    <option value="6" label="June">June</option>
                                                                    <option value="7" label="July">July</option>
                                                                    <option value="8" label="August">August</option>
                                                                    <option value="9" label="September">September
                                                                    </option>
                                                                    <option value="10" label="October">October</option>
                                                                    <option value="11" label="November">November
                                                                    </option>
                                                                    <option value="12" label="December">December
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="training_year">Training Year <span
                                                                        style="color:#f00">*</span></label>
                                                                <select name="training_year"
                                                                    placeholder="Please Select Year" id="training_year"
                                                                    required="required" tabindex="8"
                                                                    class="form-control">
                                                                    <option value="" label="Please Select Year">Please
                                                                        Select Year</option>
                                                                    <option value="2024" label="2024">2024</option>
                                                                    <option value="2025" label="2025">2025</option>
                                                                    <option value="2026" label="2026">2026</option>
                                                                    <option value="2027" label="2027">2027</option>
                                                                    <option value="2028" label="2028">2028</option>
                                                                    <option value="2029" label="2029">2029</option>
                                                                    <option value="2030" label="2030">2030</option>
                                                                    <option value="2031" label="2031">2031</option>
                                                                    <option value="2032" label="2032">2032</option>
                                                                    <option value="2033" label="2033">2033</option>
                                                                    <option value="2034" label="2034">2034</option>
                                                                    <option value="2035" label="2035">2035</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="location_id">Preferred Location <span
                                                                        style="color:#f00">*</span></label>
                                                                <select name="location_id"
                                                                    placeholder="Please Select Year" id="location_id"
                                                                    autocomplete="off" required="required" tabindex="9"
                                                                    class="form-control">
                                                                    <option value="" label="Please Select Location">
                                                                        Please Select Location</option>
                                                                    <?php foreach ($bodycontent["location"] as $key => $value) { ?>
                                                                        <option value="<?php echo $value->id ?>"
                                                                            label="<?php echo $value->name ?>">
                                                                            <?php echo $value->name ?>
                                                                        </option>
                                                                    <?php } ?>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <div class="g-recaptcha"
                                                                    data-sitekey="6LcTb0cUAAAAAJwzhpLZQblK6Aud4iGFr9dJZkfg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="col-md-12 col-12">
                                                            <input type="submit" name="" id="training_form_button"
                                                                value="Submit" type="submit" tabindex="10"
                                                                class="btn btn_contact" />
                                                        </div>
                                                        <!--<button type="submit" class="btn btn_contact">Submit</button>-->

                                                    </div>
                                                </form>
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
    </div>
</section>