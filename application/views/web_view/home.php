<section class="video-banner ">
  <video autoplay muted loop>
    <source src="<?php echo base_url(); ?>tilindia/assets/images/video_banner_new.mp4" type="video/mp4">
  </video>
  <div class="container">
    <div class="bannerText">
      <h1>Partnering India's Infrastructure <br><span>Build Since 1944</span></h1>
    </div>
  </div>
</section>

<section class="content_section">
  <div class="wraper clearfix">
    <div class="container">
      <div class="row curvebg pl-0">
        <div class="col-lg-4 col-12">
          <div class="homepix ml-0">
            <div class="box-behind"></div>
            <img src="<?php echo base_url(); ?>assets/images/technology.jpg" class="img-responsive"
              alt="Crane Manufacturer in India" />
          </div>
        </div>
        <div class="col-lg-8 col-12 p-responsive">
          <div class="aboutText">
            <h1>Technology. <span>Innovation.</span> <span>Leadership.</span></h1>
            <h2>Customer at its core ... since 1944.</h2>
            <figure>
              <img src="<?php echo base_url(); ?>assets/images/Rectangle.png" alt="rectangle" />
              <hr />
            </figure>
            <p class="truncate">TIL’s trusted reputation and market expertise of over seven decades as one of India’s
              leading infra equipment manufacturers sets new standards in design and manufacturing excellence. With a
              customer centric vision since 1944, TIL manufactures and markets high performance products - rugged and
              versatile to meet every challenge - coupled with ready parts and unmatched customer support. The product
              portfolio comprises the latest in Mobile Cranes (Rough Terrain, Truck Cranes, Industrial, Pick n Carry)
              Crawler Cranes, Reach Stackers, Container Handlers, representing some of the finest in global technology.
              <br><br>
              <strong>Empowering Progress One Machine at a Time </strong>
              <br>
              Manufacturing top-quality infrastructure equipment in the pursuit of national development. At TIL
              precision engineering, stringent quality control, and innovative technologies converge to create durable
              and efficient machinery that forms the cornerstone of robust infrastructure.
            </p>
            <span><a href="javascript:void(0)" class="read-more-btn" style="color: #337ab7;"
                onclick="toggleReadMore()">Read more</a></span>
            <a class="read-btn" href="<?php echo base_url(); ?>about-us/corporate-profile">
              READ MORE
            </a>
          </div>
        </div>
      </div>
    </div>
</section>
<section>
  <div class="">
    <div class="">
      <div class="">
        <div class="greybg remp-greybg clearfix">
          <div class="container">
            <div class="header-section" style="padding:0">
              <h5 style="color:#dfdfdd">Customer at its core ... since 1944.</h5>
              <h3 class="mt-0">
                Our Global Associates
              </h3>
            </div>
            <div class="icon-container">
              <hr />
              <img src="<?php echo base_url(); ?>assets/images/white-rectangle.png" alt="rectangle" />
              <hr />
            </div>
            <p>We strive to uphold excellence in design and manufacturing by partnering with internationally renowned
              associates, enabling us to elevate our infra-equipment manufacturing capabilities to a global scale. With
              our steadfast commitment to quality and customer centricity, we aim to deliver exceptional solutions that
              meet the demands of the global market.</p>
            <div class="display-logo">
              <a href="https://www.manitowoccranes.com/" target="_blank">
                <img class="gray-image" src="assets/images/grove-clr.png" alt="Grove range Cranes" />
              </a>
              <a href="http://www.hyster.com/" target="_blank">
                <img class="gray-image" src="assets/images/hyster-clr.png" alt="Hyster" />

              </a>
              <a href="https://www.manitowoccranes.com/" target="_blank">
                <img class="gray-image" src="assets/images/manitowoc-clr.png" alt="Manitowoc" />

              </a>
              <a href="https://snorkellifts.com" target="_blank">
                <img class="gray-image" src="assets/images/snorkel.png" alt="snorkel" />

              </a>
            </div>
          </div>
        </div>


      </div>

    </div>
  </div>
</section>
<section class="product-section">
  <div class="container">

    <div class="header-section" style="padding:0">
      <h5>Our Products</h5>
      <a href="<?php echo base_url(); ?>products/material-handling-solutions">
        <h3 class="m-0">Material <span>Handling Solutions</span></h3>
      </a>
      <div class="icon-container">
        <hr />
        <img src="<?php echo base_url(); ?>assets/images/Rectangle.png" alt="rectangle" />
        <hr />
      </div>
    </div>

    <div class="row product-list">
      <?php foreach ($bodycontent["product"] as $key => $value) {
        if ($value['level'] < 3 && $value['product_master_id'] != 14) { ?>
          <div class="col-lg-3 col-md-6 col-12">
            <div class="product-item">
              <a href="<?php echo base_url() . $value["url"]; ?>">
                <figure>
                  <img src="<?php echo base_url(); ?>assets/images/<?php echo $value["banner_image"] ?>"
                    style="width: 260px; height: 139px;" alt="rectangle" />
                </figure>
                <h5><?php echo $value["name"]; ?></h5>
              </a>
              <button class="request-quote-btn" data-toggle="modal" data-target="#myModal"
                data-product-master-id="<?php echo $value['product_master_id']; ?>">
                Request for a quote
              </button>
            </div>
          </div>
        <?php }
      } ?>


      <div class="card">
        <div class="col-lg-3 col-md-6 col-12">
          <div class="product-item no-product-item">
            <figure>
              <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="rectangle" />
            </figure>
            <a href="<?php echo base_url() ?>products" style="width:100%">
              <button>More Products</button>
            </a>
          </div>
        </div>
      </div>
    </div>
</section>
<section class="video-upload-section">
  <!--</div>-->
  <div class="container">
    <div class="header-section" style="padding:0">
      <h5>Explore our products</h5>
      <h3 class="m-0">Our <span>Media</span></h3>
      <div class="icon-container">
        <hr />
        <img src="<?php echo base_url(); ?>assets/images/Rectangle.png" alt="rectangle" />
        <hr />
      </div>
    </div>
    <div class="row curvebg pl-0 mt-0 mb-0">
      <!-- start slider-->
      <div class="home_video_wraper">
        <ul class="home_video">
          <?php foreach ($bodycontent["video"] as $key => $value) { ?>
            <li>
              <div class="embed-responsive embed-responsive-16by9"><iframe width="409" height="226"
                  data-src="https://www.youtube.com/embed/<?php echo $value->video_id ?>?rel=0" frameborder="0"
                  allowfullscreen="allowfullscreen"></iframe></div>
              <p style="padding-top: 10px;"><?php echo $value->title ?></p>
            </li>
          <?php } ?>
          <li>
            <div class="embed-responsive embed-responsive-16by9"><iframe width="409" height="226"
                data-src="https://www.youtube.com/embed/t5-J9H_a89A?rel=0" frameborder="0"
                allowfullscreen="allowfullscreen"></iframe></div>
            <p style="padding-top: 10px;">How to install 6400 luffing jib &ndash; Manitowoc Cranes</p>
          </li>
          <li>
            <div class="embed-responsive embed-responsive-16by9"><iframe width="409" height="226"
                data-src="https://www.youtube.com/embed/BijI-dwlACg?rel=0" frameborder="0"
                allowfullscreen="allowfullscreen"></iframe></div>
            <p style="padding-top: 10px;">Hyster-TIL&reg; ReachStacker rolling out of TIL's State-of-the-Art Kharagpur
              Plant</p>
          </li>
          <li>
            <div class="embed-responsive embed-responsive-16by9"><iframe width="409" height="226"
                data-src="https://www.youtube.com/embed/FyMYrik-4yM?rel=0" frameborder="0"
                allowfullscreen="allowfullscreen"></iframe></div>
            <p style="padding-top: 10px;">GMK5250L with VIAB Turbo Retarder clutch &ndash; Manitowoc Crane</p>
          </li>
          <li>
            <div class="embed-responsive embed-responsive-16by9"><iframe width="409" height="226"
                data-src="https://www.youtube.com/embed/eCdmzCjtwcs?rel=0" frameborder="0"
                allowfullscreen="allowfullscreen"></iframe></div>
            <p style="padding-top: 10px;">Advance Carrier operation All terrain &ndash; Manitowoc Crane</p>
          </li>
          <li>
            <div class="embed-responsive embed-responsive-16by9"><iframe width="409" height="226"
                data-src="https://www.youtube.com/embed/A2mADONgwgM?rel=0" frameborder="0"
                allowfullscreen="allowfullscreen"></iframe></div>
            <p style="padding-top: 10px;">How Boom Technology Works in Manitowoc Cranes</p>
          </li>

        </ul>
      </div>
      <!-- end slider-->
    </div>
  </div>

  <!-- end row-->
</section>
<!-- Bootstrap 5 JS (with Popper.js included) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js?c=-62170003270" type="text/javascript"></script>

<script>
  $(document).ready(function () {
    $(document).on('click', '.request-quote-btn', function () {
      var productMasterId = $(this).data('product-master-id');

      var base_url = $("#basepath").val();
      $.ajax({
        url: `${base_url}home/fetchproduct`,
        type: 'POST',
        data: { productMasterId: productMasterId },
        success: function (response) {
          $("#produt_id_drp").html(response);
        },
        error: function (jqXHR, exception) {
          console.log(jqXHR);
          console.log(exception);
        }
      });
    });
  })

</script>