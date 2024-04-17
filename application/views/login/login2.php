<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>TIL India | Log in</title>
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon_icon.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url();?>/assets-admin/css/login_style.css">
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script> -->
   </head>
   <body>
      <section class="myform-area">
         <div class="container-fluid">
            <div class="row justify-content-center login-detail">
               <div class="col-md-8">
                  <div class="row" style="margin-top:6%;">
                     <div class="col-md-3 text-center">
                        <!-- <img src="<?php echo base_url(); ?>assets-admin/img/logo.png" alt="logo" class="img-fluid"
                           style="width: 100px;"> -->
                        <img src="<?php echo base_url(); ?>assets-admin/img/logo_new.png" alt="logo" class="img-fluid"
                           style="width: 100%;">
                     </div>
                  </div>
                  <div class="row">
                     <!-- <div class="col-md-2 text-center">
                        <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" class="img-fluid" style="width: 100px;">
                        </div> -->
                     <div class="col-md-3 "></div>
                     <div class="col-md-7 text-white">
                        <h1>𝙒𝙚𝙡𝙘𝙤𝙢𝙚 𝙩𝙤 </h1>
                        <!-- <h3>𝘾𝙝𝙞𝙡𝙙 𝙄𝙣 𝙉𝙚𝙚𝙙 𝙄𝙣𝙨𝙩𝙞𝙩𝙪𝙩𝙚</h3> -->
                        <h3>Tractors India Limited - TIL</h3>
                        <hr style="border: 1px dashed #a9a0a0;color:#fff">
                        <!-- <div class="cini_info">
                           <h4 style="color: #ece918;">It works with the mission to ensure children and adolescents
                              achieve their rights to education
                           </h4>
                          
                           <br>
                           <h6>
                              - Data collection of all childen
                           </h6>
                           <h6>
                              - Attendance tracking in school / community center
                           </h6>
                           <h6>
                              - Follow up each child for better care
                           </h6>
                           <h6>
                              - Examination procedure for all children to evaluate their level properly
                           </h6>
                           <h6>
                              - Analytics
                           </h6>
                        </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-md-4 text-center login-section">
                  <div class="text-area">
                     <h2 class="text-left">Already have an account?</h2>
                     <p class="text-left">Enter your sign in details</p>
                  </div>
                  <div class="form-area login-form">
                     <div class="form-input">
                        <h2 class="text-center">Login</h2>
                        <?php
                           $attr = array("id"=>"admiLoginForm","name"=>"admiLoginForm");
                           echo form_open('login/check_login',$attr); ?>
                        <input type="hidden" id="baseurl" value="<?php echo base_url(); ?>" />
                        <div class="form-group">
                           <input type="text" name="user_name" id="user_name" required>
                           <label>User Name</label>
                        </div>
                        <div class="form-group">
                           <input type="password" name="password" id="password" autocomplete="off" required>
                           <label>password</label>                                     
                        </div>
                        <div class="captcha-row">
                           <div class="form-group captcha-column">
                              <label for="name"></label>
                              <div class="captcha_container">
                                 <div><?php echo $captcha_data['number1']; ?></div>
                                 <div>+</div>
                                 <div><?php echo $captcha_data['number2']; ?></div>
                              </div>
                           </div>
                           <div class="form-group text-center equalto captcha-column">
                              <label for="name"></label>
                              <div>=</div>
                           </div>
                           <div class="form-group captcha-column">
                              
                              <input type="text" class="form-control form-control-sm jb-fr-fld" id="captchavalue"
                                 name="captchavalue" placeholder="" autocomplete="off" maxlength="4"
                                 style="height: 20px;padding: 17px 0;border: 1px solid aquamarine;"
                                 onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                 required />
                              
                           </div>
                        </div>
                        <p id="error_msg" class="text-danger text-left"></p>
                        <div class="row">
                           <div class="col-xs-12">
                              <div class="form-group has-feedback" style="margin-bottom: 0;">
                                 <?php echo $this->session->flashdata('msg'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="myform-button mb-4">
                           <div id="verifying-account" style="width: 100%; clear: both; display:none;">
                              <img src="<?php echo base_url();?>/assets-admin/img/verify_logo.gif"
                                 style="margin-left:auto;margin-right:auto;display:block;">
                              <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait...</p>
                           </div>
                           <button type="button" id="loginBtn" class="myform-btn">Login</button>
                        </div>
                        <p class="text-danger text-left"> &nbsp;</p>
                        <div class="row">
                           <p style="text-align:center;color: rgb(248, 6, 6);padding: 17px;margin-top: -5px;display: block;font-size: 1rem;display:none;"
                              id="login_err"></p>
                        </div>
                        <?php echo form_close();?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- jQuery 3 -->
      <script src="<?php echo base_url();?>/assets-admin/plugins/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url();?>/assets-admin/js/customJs/login.js"></script>
   </body>
</html>
