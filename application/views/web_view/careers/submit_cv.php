<section class="about_header about-banner-section"
  style="background-image:url(<?php echo base_url(); ?>assets/images/inner_page_banners/careers_awards.jpg)">
  <div class="container">
    <h1></h1>
  </div>
</section>
<section class="content_section">
  <div class="container">
    <div class="header-section">
      <div class="container">
        <h3 class="m-0 fc-black">Submit Your CV</h3>
        <div class="icon-container">
          <hr>
          <img src="<?php echo base_url(); ?>tilindia/assets/images/Rectangle.png" alt="Rectangle" srcset="">
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-12" id="leftCol">

      <div class="homepix">
        <img src="<?php echo base_url(); ?>tilindia/assets/images/submit-cv.png" alt="" srcset="">
      </div>
    </div>

    <div class="col-md-8" id="mainCol">
      <div>
        <article class="status-publish hentry" style="margin-bottom: 40px;">
          <div class="entry-content">
            <form enctype="multipart/form-data" class="submit_your_cv" id="submit_your_cv" method="POST">
              <input type="hidden" name="current_opening_id"
                value="<?php echo isset($bodycontent["current_openings"]) ? $bodycontent["current_openings"]->current_opening_id : 0; ?>">
              <?php if (isset($bodycontent["current_openings"])) { ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="candidte_name">Application For </label>
                      <input type="text" value="<?php echo $bodycontent["current_openings"]->opening_title; ?>"
                        autocomplete="off" id="candidte_name" class="form-control" readonly />

                    </div>
                  </div>
                </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="candidte_name" class="required">Full Name </label>
                    <input type="text" name="candidte_name" value="" autocomplete="off" id="candidte_name"
                      required="required" placeholder="Full Name" class="form-control" />

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="function_id" class="required">Function </label>
                    <select name="function_id" name="function_id" autocomplete="off" id="function_id"
                      required="required" placeholder="Function" class="form-control">
                      <option value="" label="--select--">--select--</option>
                      <?php foreach ($bodycontent["functions_career"] as $key => $value) { ?>
                        <option value="<?php echo $value->id; ?>" label="<?php echo $value->name ?>">
                          <?php echo $value->name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label for="technical_qualification" class="required">Qualification </label>
                    <textarea name="technical_qualification" autocomplete="off" id="technical_qualification"
                      required="required" maxlength="500" rows="5" placeholder="Qualification" class="form-control"
                      cols="40"></textarea>
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label for="linkedIn_profile" class="">LinkedIn Profile </label>
                    <input type="text" name="linkedIn_profile" value="" autocomplete="off" id="linkedIn_profile"
                      placeholder="LinkedIn Profile" class="form-control" />
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label for="massage" class="">Message </label>
                    <textarea name="massage" autocomplete="off" id="massage" maxlength="500" rows="5"
                      placeholder="Message" class="form-control" cols="40"></textarea>
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="form-group" class="">
                    <label for="resume" class="required">CV Upload </label>
                    <input type="file" name="resume" value="" placeholder="CV Upload" autocomplete="off" id="resume"
                      required="required" onchange="validate_size(this)" accept=".odt,.doc,.docx,.pdf"
                      class="form-control document_upload" />
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>