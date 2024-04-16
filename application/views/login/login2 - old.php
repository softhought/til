<!DOCTYPE html>
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>TIL | Login</title>
    <link rel="apple-touch-icon" href="<?php echo base_url();?>app-assets/images/favicon/apple-touch-icon-152x152.png">
    <!-- <link rel="shortcut icon" type="image/x-icon"
        href="<?php echo base_url();?>app-assets/images/favicon/favicon-32x32.png"> -->
        <link rel="icon" type="image/x-icon" href="<?php echo(base_url());?>assets/img/MA2.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>app-assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>app-assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/pages/login.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/custom/custom.css"> -->
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="login-bg form-login-body">



      <div class="container">
      <div class="row">
          <div class="col s8 offset-s2 center-align login-desk p-0">
             <div class="row">
                  <div class="col s6 detail-box">
                     
                      <!-- <img class="logo" src="<?php echo(base_url());?>assets/img/logo_mumbai_angel.jpg" class="w-100" alt="">  -->
                      <!-- <img class="logo" src="<?php echo(base_url());?>assets/img/Ma_Trix_Logo_2.png" class="w-100" alt="">  -->
                      <!-- <span style="font-size: 25px;font-weight: bold;color: #582ea1;">Vote Pal</span> -->
                      <div class="detailsh">
                           <img class="help" src="<?php echo(base_url());?>assets-admin/img/logo.png" alt="">
                          <h3>Welcome Back</h3>
                          <!-- <img class="logo" src="<?php echo(base_url());?>assets/img/logo_mumbai_angel.jpg" class="w-100" alt=""> -->
                          <!-- <p>blow off well pardon me old lurgy absolutely bladdered bodge</p> -->
                      </div>
                  </div>
                  <div class="col s6 loginform">
                       <h4>Getting Started</h4>                   
                       <p>Signin to your Account</p>
                       <?php echo $this->session->flashdata('msg'); ?>
                       <div class="login-det">
                          <form class="custome-form" name="loginfrm" method="post" action="<?php echo(base_url());?>Login/check_login" >
                          <div class="form-row">
                               <label class="left-align" for="">Username</label>
                                   <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                          <i class="far fa-user"></i>
                                      </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter Username" name="username" aria-label="Username" aria-describedby="basic-addon1">
                               </div>
                          </div>
                           <div class="form-row">
                               <label for="" class="left-align">Password</label>
                                   <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                          <i class="fas fa-lock"></i>
                                      </span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password" aria-label="" aria-describedby="basic-addon1">
                               </div>
                          </div>

                          <div class="form-row">
                              <!-- <label for="" class="left-align">Year</label>
                                <select class="select2 browser-default" name="yearid" id="yearid">
                                <?php 
                                      foreach ($financilayear as $financilayear) { ?>
                                        <option value="<?php echo $financilayear->year_id; ?>"><?php echo $financilayear->year; ?></option>
                                        <?php } ?>   
                                </select> -->
                          </div>

                          <div class="row">
                            <div class="col s6"></div>
                            <div class="col s6"><button type="submit" class="btn btn-sm btn-danger float-right mt-10">Login</button></div>
                          </div>
                          <br><br><br>

         <!-- <a href="<?php echo base_url();?>password">Forgot Password</a> -->
                          <div class="row">
                            <label style="color:#FFF;">
                                <?php 
                          
                                
                               // echo $this->session->flashdata('msg');
                                 ?>
                            </label>
                          </div>
                          </form>

                        </div>
                  </div>
             </div>
            
          </div>
      </div>
      </div> <!-- End of Container -->
   


    <script src="<?php echo base_url();?>app-assets/js/vendors.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/plugins.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/search.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/custom/custom-script.js"></script>
</body>
</html>