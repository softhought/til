<!DOCTYPE html> 
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mumbai Anegls </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/dist/css/adminlte.min.css">
   <link rel="stylesheet" href="<?php echo(base_url());?>assets/css/softhought_style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page bimg1">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="../../index2.html"><b>Mumbai</b> Anegls</a> -->
    <img src="<?php echo(base_url());?>assets/img/logo_mumbai_angel.png" width="355px" height="50px" alt=" Mumbai Angles Logo" class="brand-image " style="opacity: .8">
  </div>

  <!-- /.login-logo -->

  <div class="card" id="card_block_forgot_pass">
    <div class="card-body login-card-body">
      <center><h2 style="color: #174080;">Forgot password?</h2></center>
      <p class="login-box-msg">Please enter your email address</p>
      <?php echo $this->session->flashdata('msg'); ?>
      <form class="login-form"  name="sendpasskey" id="sendpasskey" method="post" action="<?php echo(base_url());?>Login/check_login">
        <div class="form-group  mb-3">
            <label for="username" class="">Email</label> 
            <div class="input-group">
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your email" autocomplete="off" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope-square"></span>
                </div>
            </div>
            </div> 
        </div>
          <div class="form-group  mb-3" id="passkey_block" style="display: none;">
            <label for="username" class="">Enter Passkey</label> 
            <div class="input-group">
            <input type="text" name="otp" id="otp" class="form-control" placeholder="" onKeyUp="numericFilter(this);" maxlength="6" style="font-weight: bold;">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-key"></span>
                </div>
            </div>
            </div> 
        </div>
        <p class="error" id="error_msg" style="color: red;"></p>
        <p id="res_msg" style="color: color: #09502f;;"></p>
        <div class="row">
          <div class="col-12">
            <button type="button" id="Passkey" class="btn btn-info btn-block">Send Passkey</button>
          </div>

          <div class="col-12" id="passkey_verify" style="display: none;">
            <button type="button" id="verifyPasskey" class="btn btn-success btn-block">Verify Passkey</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>


  <div class="card" id="card_block_reset_pass" style="display:none;">
    <div class="card-body login-card-body">
      <center><h2 style="color: #248017;">Reset your password</h2></center>
  
      <?php echo $this->session->flashdata('msg'); ?>
      <form class="login-form"  name="resetPass" id="resetPass" method="post" action="<?php echo(base_url());?>Login/check_login">
        <div class="form-group  mb-3">
          <input type="hidden" name="user_email" id="user_email">
            <label for="username" class="">New Password *</label> 
            <div class="input-group">
            <input type="text" name="new_password" id="new_password" class="form-control" placeholder="">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-key"></span>
                </div>
            </div>
            </div> 
        </div>

        <div class="form-group  mb-3">
            <label for="username" class="">Confirm Password *</label> 
            <div class="input-group">
            <input type="text" name="cpassword" id="cpassword" class="form-control" placeholder="">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-key"></span>
                </div>
            </div>
            </div> 
        </div>
      
        <p class="error" id="error_msg2" style="color: red;"></p>
        <p id="res_msg2" style="color: color: #09502f;;"></p>
        <div class="row">
          <div class="col-12">
            <button type="button" id="resetpassword" class="btn btn-info btn-block">Reset</button>
          </div>

          
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>



</div>

 <input type="hidden" value="<?php echo base_url();?>" id="basepath" readonly />
<!-- /.login-box -->



<!-- jQuery -->

<script src="<?php echo(base_url());?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->

<script src="<?php echo(base_url());?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->

<script src="<?php echo(base_url());?>assets/dist/js/adminlte.min.js"></script>



</body>

</html>

<script type="text/javascript">
  $(document).ready(function(){

  var basepath =$('#basepath').val();

     $(document).on("click", "#Passkey", function() {



      if (validate()) {
             $('#Passkey').prop('disabled', true);
             $("#Passkey").html('Sending mail...'); 
             $("#res_msg").text(''); 
            var formDataserialize = $("#sendpasskey").serialize();
            formDataserialize = decodeURI(formDataserialize);
            var formData = { formDatas: formDataserialize };
           

        $.ajax({
                type: "POST",
                url: basepath+'password/sendpasskey',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                success: function (result) {
                    $("#loaderbtn").css('display', 'none');
                    if (result.msg_status == 1) {
                         $("#res_msg").text(result.msg_data); 
                         $("#passkey_block,#passkey_verify").show(); 
                         $("#Passkey").hide(); 
                         $('#username').prop('readonly', true);
                    } 
                    else {
                        $("#error_msg").text(result.msg_data); 
                         $('#Passkey').prop('disabled', false);
                    }

                }, 
                error: function (jqXHR, exception) {
                   var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }

                   console.log(msg); 
                }

            }); /*end ajax call*/

      }

    });



/* validate passkey */

     $(document).on("click", "#verifyPasskey", function() {




          var otp = $("#otp").val();

          $("#error_msg").text("");
          $("#otp").removeClass("form_error");
       
          if(otp=="")
          {
              $("#otp").focus().addClass("form_error");
              $("#error_msg").text("Error : Enter Email");
              return false;
          }


             $('#verifyPasskey').prop('disabled', true);
             $("#res_msg").text(''); 
            var formDataserialize = $("#sendpasskey").serialize();
            formDataserialize = decodeURI(formDataserialize);
            var formData = { formDatas: formDataserialize };
           
           

        $.ajax({
                type: "POST",
                url: basepath+'password/verifypasskey',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                success: function (result) {
                    $("#loaderbtn").css('display', 'none');
                    if (result.STATUS == 200) {
                          $("#res_msg").text(result.STATUS_MSG); 
                          $("#user_email").val($("#username").val());                   
                          $("#card_block_reset_pass").show(); 
                          $("#card_block_forgot_pass").hide(); 
                         // $('#username').prop('readonly', true);
                    } 
                    else {
                        $("#error_msg").text(result.STATUS_MSG); 
                         $('#verifyPasskey').prop('disabled', false);
                    }

                }, 
                error: function (jqXHR, exception) {
                   var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }

                   console.log(msg); 
                }

            }); /*end ajax call*/

      

    });

/* set new password */

     $(document).on("click", "#resetpassword", function() {



      if (ValidateNewPass()) {
             $('#resetpassword').prop('disabled', true);
             $("#res_msg").text(''); 
            var formDataserialize = $("#resetPass").serialize();
            formDataserialize = decodeURI(formDataserialize);
            var formData = { formDatas: formDataserialize };
           

        $.ajax({
                type: "POST",
                url: basepath+'password/resetPassword',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                success: function (result) {
                    $("#loaderbtn").css('display', 'none');
                    if (result.msg_status == 1) {
                         $("#res_msg2").text(result.msg_data); 
                          window.location.href = basepath+'login';
                         // $("#passkey_block,#passkey_verify").show(); 
                         // $("#Passkey").hide(); 
                         // $('#username').prop('readonly', true);
                    } 
                    else {
                        $("#error_msg2").text(result.msg_data); 
                         $('#resetpassword').prop('disabled', false);
                    }

                }, 
                error: function (jqXHR, exception) {
                   var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }

                   console.log(msg); 
                }

            }); /*end ajax call*/

      }

    });




});/* end of document ready */

function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}


  function validate()
{
      
 
    var username = $("#username").val();

    $("#error_msg").text("");
    $("#username").removeClass("form_error");
 
    if(username=="")
    {
        $("#username").focus().addClass("form_error");
        $("#error_msg").text("Error : Enter Email");
        return false;
    }

    if(username!="")
    {
        var email= $("#username").val();  
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
        if(!emailReg.test(email)) {  
             $("#username").focus().addClass("form_error");
             $("#error_msg").text("Error : Enter a valid email");
             return false;
        }
    }
    

     return true;
}



function ValidateNewPass() {

  var password = $("#new_password").val();

  var cpassword = $("#cpassword").val();

  if (password == "") {
    $("#new_password").focus().addClass("form_error");
    $("#error_msg2").text("Error : Enter new password");
    return false;
  }

  if (cpassword == "") {

    $("#cpassword").focus().addClass("form_error");
    $("#error_msg2").text("Error : Enter Confirm password");
    return false;
  }

  if (password != cpassword) {

     $("#cpassword").focus().addClass("form_error");
    $("#error_msg2").text("Error : Confirm password is not matching");
    return false;

  }

  return true;
}



</script>

