<section class="about_header about-banner-section"
    style="background-image:url(<?php echo base_url(); ?>assets/images/inner_page_banners/contact.jpg)">
    <!-- <img src="/assets/images/inner_page_banners/contact.jpg" class="img-responsive" height="400"  alt="Get in Touch TIL"> -->
    <!-- <h1 class="m-0"></h1> -->
    <h1 class="m-0">Reach Out To Us</h1>

</section>
<section class="content_section">
    <div class="wrapper clearfix">
        <section>
            <div class="header-section">
                <div class="container">
                    <h3 class="m-0 fc-black"></h3>
                </div>
            </div>
            <div class="container">
                <div class="row curvebg pl-0 mt-0">
                    <div class="col-lg-4 col-12 ">
                        <div class="homepix">
                            <img src="<?php echo base_url(); ?>tilindia/assets/images/inquiry_img.jpg" alt="inquiry_img"
                                srcset="">
                        </div>
                    </div>
                    <div class="col-lg-8 col-12" id="mainCol">
                        <div class="training-form ">
                            <!-- <h1></h1> -->
                            <p>Please fill up the form below:</p>
                            <!--start contact form box-->
                            <script src='<?php echo base_url(); ?>www.google.com/recaptcha/api.js'></script>
                            <form  enctype="multipart/form-data" class="contact_form inquiry_form" id="contact_us_form" method="POST"
                                accept-charset="utf-8">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="organization">Organization </label>
                                            <input type="text" name="organization" value="" placeholder="Organization"
                                                autocomplete="off" id="organization" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Full Name<span>*</span></label>
                                            <input type="text" name="name" value="" placeholder="Name"
                                                autocomplete="off" id="name" required="required" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">

                                            <label for="phone">Phone Number <span>*</span></label>
                                            <input type="tel" name="phone" value="" placeholder="Phone no."
                                                autocomplete="off" id="phone" required="required"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email Address <span>*</span></label>
                                            <input type="email" name="email" value="" placeholder="E-mail"
                                                autocomplete="off" id="email" required="required"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">

                                            <label for="phone">Country <span>*</span></label>
                                            <select name="country_id" id="country_id" required="required"
                                                class="form-control">
                                                <option value="">Select Country</option>
                                                <?php foreach ($menu["country"] as $key => $value) {
                                                    echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group" id="state_div">
                                            <label for="email">State <span>*</span></label>
                                            <select name="state_id" id="state_id" required="required"
                                                class="form-control">
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Contact Address <span>*</span></label>
                                            <textarea name="address" cols="40" rows="2" type="textarea"
                                                placeholder="Address" autocomplete="off" id="address"
                                                required="required" value="" class="form-control markitup"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nature_of_query_id">Nature of Query <span
                                                    style="color:#f00">*</span></label>
                                            <select name="nature_of_query_id" autocomplete="off" id="nature_of_query_id"
                                                required="required" class="form-control">
                                                <option value="" selected="selected">Please Select</option>
                                                <?php foreach ($menu["nature_of_query"] as $key => $value) {
                                                    echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="query">Your Query<span style="color:#f00">*</span></label>
                                            <textarea name="query" cols="40" rows="2" type="textarea"
                                                placeholder="Your Query" autocomplete="off" id="query"
                                                required="required" value="" class="form-control markitup"></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <div class="g-recaptcha"
                                                data-sitekey="6Lde5c0pAAAAADzsbxrjkLT8VfetD8R-j6Hy-OV8"></div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 col-12">
                                        <button type="submit" class="btn btn_contact" id="contact_us_button">Submit</button>
                                    </div>
                                </div>

                            </form>

                            <!-- end contact box -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
