
  
  
  <?php
// $CI =& get_instance();
// $CI->load->model('menumodel','',TRUE);


$currentURL = current_url();
$baseurl = base_url();
$baseurllen=strlen($baseurl);
$mainurl=substr($currentURL, $baseurllen); 
$slug = explode('/',$mainurl);

$parameter = $slug[0];
if(isset($slug[1])){
$parameter = $slug[0]."/".$slug[1];
}
$session = $this->session->userdata('user_detail');
$where = array('user_role'=>$session['role'],'url'=>$parameter,'is_active'=>'Y');
$check = $this->commondatamodel->getSingleRowByWhereCls('restricted_url_master',$where);
 //pre($check);exit;
if(!empty($check)){
  redirect('login/restricted','refresh');
  exit;
}
?>



<!DOCTYPE html>

<!--

This is a starter template page. Use this page to start your new project from

scratch. This page gets rid of all links and provides the needed markup only.

-->

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="x-ua-compatible" content="ie=edge">



  <title>Mumbai Angels</title>

 <!-- Font Awesome -->

 <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- DataTables -->

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">



  <!-- Theme style -->

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/dist/css/adminlte.min.css">

  <!-- Bootstrap Select -->

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/css/bootstrap-select.css">



  <!--  -->

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/sweetalert2/sweetalert2.min.css">







  <!-- Bootstrap4 Duallistbox -->

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">



 <!-- custome css  -->

  <!-- <link rel="stylesheet" href="<?php echo(base_url());?>assets/css/softhought_style.css"> -->



    <!-- Select2 -->

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/select2/css/select2.min.css">

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Date Picker -->

  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">



  <!-- jQuery -->

<script src="<?php echo(base_url());?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->

<script src="<?php echo(base_url());?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Select -->

<script src="<?php echo(base_url());?>assets/js/bootstrap-select.js"></script>

<!-- Bootstrap Select -->

<script src="<?php echo(base_url());?>assets/plugins/sweetalert2/sweetalert2.js"></script>

<!-- Select2 -->

<script src="<?php echo(base_url());?>assets/plugins/select2/js/select2.full.min.js"></script>

<!-- InputMask -->

<script src="<?php echo(base_url());?>assets/plugins/moment/moment.min.js"></script>

<script src="<?php echo(base_url());?>assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>



<!-- datepicker -->

<script src="<?php echo(base_url());?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- DataTables -->

<script src="<?php echo(base_url());?>assets/plugins/datatables/jquery.dataTables.js"></script>

<script src="<?php echo(base_url());?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script src="<?php echo(base_url());?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>

<!-- AdminLTE App -->

<script src="<?php echo(base_url());?>assets/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="<?php echo(base_url());?>assets/dist/js/demo.js"></script>





<script src="<?php echo(base_url());?>assets/js/jquery.nicescroll.min.js"></script>



<!-- input date checker jquery -->

<script src="<?php echo base_url(); ?>assets/js/customJs/datecheck.js"></script>



<!-- comman js by anil on 24-02-2020 -->

<script src="<?php echo base_url(); ?>assets/js/customJs/comman.js"></script>


<script src="<?php echo(base_url());?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- datatables additional files for pdf and print-->



<!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script> 

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>  -->



<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.flash.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables/pdfmake.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables/vfs_fonts.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.print.min.js"></script>



  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet"> 



  <style>

  .err-border{

    border: 2px solid red !important;

  }

  .displaynone{
  display: none !important;
}

  </style>

   <!-- custome css  -->

   <link rel="stylesheet" href="<?php echo(base_url());?>assets/css/softhought_style.css">

</head>

<body class="hold-transition layout-top-nav">

<div class="wrapper">



  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white topNav">

      <div class="container">

          <a href="#" class="navbar-brand">

            <img src="<?php echo(base_url());?>assets/img/logo_mumbai_angel.png" alt="Mumbai Anegls" class="brand-image " style="opacity: 1">

          </a>

            <h3>Mumbai  &nbsp;&nbsp;Angels&nbsp;&nbsp; </h3>

           <!-- Right navbar links -->

            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ">

              <!-- <li class="nav-item">

                <a class="nav-link"  href="<?php echo base_url(); ?>logout">

                  <?php echo $user; ?> &nbsp;<img src="<?php echo base_url(); ?>assets/img/power.png" title="logout" alt="logout" hight="30px" width="30px">

                </a>

              </li> -->

              <li>

                <form class="form-inline my-2 my-lg-0 searchForm">

                  <input class="form-control custom-fm-input-sm" type="search" placeholder="Search" aria-label="Search">

                  <button class="btn btn-outline-success my-2 my-sm-0" type="button"><i class="fas fa-search"></i></button>

                </form>

              </li>

                <li class="nav-item dropdown ml-auto useloggedinOpt">

                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-tie"></i> <?php
                 $user= explode(" ",$activeuser);
                   echo $user[0];?> </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                      <a class="dropdown-item" href="#"><i class="fas fa-user-edit"></i> Profile</a>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>user/change_password"><i class="fas fa-edit"></i> Change Password</a>

                      <a class="dropdown-item" href="<?php echo base_url(); ?>logout"><i class="fas fa-sign-out-alt"></i> Logout</a>

                  </div>

                </li>

                  <li>

                    <h6 id="ac_year_title"> <?php echo date('d-m-Y');?></h6> 

                 </li>

            </ul>

      </div>

  </nav>

  



  <!-- Navbar -->

  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white topMainNav">

    <div class="container">

      <!-- <a href="#" class="navbar-brand">

        <img src="<?php echo(base_url());?>assets/img/logo-dks.png" alt=" Dakshin Kalikata Sansad Logo" class="brand-image " style="opacity: 1">

      </a> -->

      

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

      </button>



      <div class="collapse navbar-collapse order-3" id="navbarCollapse">

        <!-- Left navbar links -->

        <ul class="navbar-nav">

          <?php if(sizeof($menu)>0){ 

            foreach($menu as $firstlevel)

            {

              if(sizeof($firstlevel['secondLevelMenu'])>0){

          ?>

          <li class="nav-item dropdown">

            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?php echo $firstlevel['menu_name']; ?></a>

            <!-- Level two dropdown-->

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">              

              <?php 

                foreach($firstlevel['secondLevelMenu'] as $second_lvl){

                if(sizeof($second_lvl['thirdLevelMenu'])>0){	

					  	?>

              <li class="dropdown-submenu dropdown-hover">

                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"><i class="fas fa-caret-right"></i> <?php echo $second_lvl['second_menu_name']; ?></a>



                <!-- Level three dropdown-->

                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">                  

                  <?php foreach($second_lvl['thirdLevelMenu'] as $third_lvl){?>

                  <li class="dropdown-submenu">

                    <a id="dropdownSubMenu3" href="<?php echo base_url().$third_lvl['third_menu_link']; ?>"  class="dropdown-item "><i class="fas fa-angle-double-right"></i> <?php echo $third_lvl['third_menu_name']; ?></a>

                    <!-- <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">

                      <li><a href="#" class="dropdown-item">3rd level</a></li>

                    </ul> -->

                  </li>

                  <?php } ?>                  

                </ul>

                <!-- End Level three -->



              </li>

                <?php }else { ?>

                  <li><a href="<?php echo base_url().$second_lvl['second_menu_link']; ?>" class="dropdown-item"><i class="fas fa-caret-right"></i> <?php echo $second_lvl['second_menu_name']; ?></a></li>

                <?php }}?>              

            </ul>

            <!-- End Level two -->



          </li>



          <?php }else {?>

            <li class="nav-item"><a href="<?php echo base_url().$firstlevel['menu_link'];?>" class="nav-link"><i class="fas fa-home"></i> <?php echo $firstlevel['menu_name']; ?></a></li> 

          <?php  } }} ?>





          <!-- <li class="nav-item dropdown">

            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

              <li><a href="#" class="dropdown-item">Some action </a></li>

              <li><a href="#" class="dropdown-item">Some other action</a></li> -->



              <!-- Level two dropdown-->

              <!-- <li class="dropdown-submenu dropdown-hover">

                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>

                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

                  <li>

                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>

                  </li> -->



                  <!-- Level three dropdown-->

                  <!-- <li class="dropdown-submenu">

                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>

                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">

                      <li><a href="#" class="dropdown-item">3rd level</a></li>

                      <li><a href="#" class="dropdown-item">3rd level</a></li>

                    </ul>

                  </li> -->

                  <!-- End Level three -->



                  <!-- <li><a href="#" class="dropdown-item">level 2</a></li>

                  <li><a href="#" class="dropdown-item">level 2</a></li>

                </ul>

              </li> -->

              <!-- End Level two -->

            <!-- </ul>

          </li> -->

        </ul>

      </div>



      <!-- Right navbar links -->

      <!-- <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

        <li class="nav-item">

          <a class="nav-link"  href="<?php echo base_url(); ?>logout">

            <?php echo $user; ?> &nbsp;<img src="<?php echo base_url(); ?>assets/img/power.png" title="logout" alt="logout" hight="30px" width="30px">

          </a>

        </li>

      </ul> -->



    </div>

  </nav>

  <!-- /.navbar -->



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <!-- Commented on 08/01/2020 If needed will reopen later

      <div class="content-header">

      <div class="container">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h6 class="m-0 text-dark">You are here <small></small></h6>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item"><a href="#">Layout</a></li>

              <li class="breadcrumb-item active">Top Navigation</li>

            </ol>

          </div>

        </div>

      </div>

    </div> -->

    <!-- /.content-header -->



    <!-- Main content -->

    <div class="content layout-body-container">

      <div class="container" id="maincontainer">

<?php //pre($menu); ?>





      <?php 

			if($bodyview)  :

			$this->load->view($bodyview);

			endif; 

		?>







 <input type="hidden" value="<?php echo base_url();?>" id="basepath" readonly />



     

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->

  <aside class="control-sidebar control-sidebar-dark">

    <!-- Control sidebar content goes here -->

    <div class="p-3">

      <h5>Title</h5>

      <p>Sidebar content</p>

    </div>

  </aside>

  <!-- /.control-sidebar -->



  <!-- Main Footer -->

  <!-- <footer class="main-footer">

    <div class="float-right d-none d-sm-inline">

    </div>

  </footer> -->

</div>

<!-- ./wrapper -->





<script>

  $(document).ready(function() {


    $(document).on("click", ".logHistory", function () {

    var tablename = $(this).attr("data-tablename");
    var rowid = $(this).attr("data-rowid");
    var basepath = $("#basepath").val();

  
     $("#log_details").html('Please wait loading...');
    $.ajax({
      url: basepath + "dashboard/viewLogHisory",
      method: "POST",
      dataType: "html",
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      data: { rowid: rowid,tablename:tablename },
      success: function (data) {
       
        $("#log_details").html(data);
        //$('.dataTable').DataTable();
         $(".dataTable").DataTable({
           dom: 'Bfrtip',
                        buttons: [
                        {
                            extend: 'copyHtml5',
                            
                            
                        },
                        {
                            extend: 'csvHtml5',
                            
                        },
                        {
                            extend: 'excelHtml5',
                        }         
                    ]
        });
       
      },
    });


 });




    $('.selectpicker').selectpicker();

    $('.dataTable').DataTable();

     //Initialize Select2 Elements

    $('.select2').select2();

      //Initialize Select2 Elements

    $('.select2bs4').select2({

      theme: 'bootstrap4'

    });

    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $(".customscrollbar").niceScroll({

        cursorborder:"",

        cursorwidth:"7px",

        autohidemode: false,

        cursorcolor:"#F4AFD9",

        boxzoom:false,

        smoothscroll:true,

       // boxzoom:true

      

        }); 





        

// $('.btn-number').click(function(e){

//     e.preventDefault();

    

//     fieldName = $(this).attr('data-field');

//     type      = $(this).attr('data-type');

//     var input = $("input[name='"+fieldName+"']");

//     var currentVal = parseInt(input.val());

//     if (!isNaN(currentVal)) {

//         if(type == 'minus') {

            

//             if(currentVal > input.attr('min')) {

//                 input.val(currentVal - 1).change();

//             } 

//             if(parseInt(input.val()) == input.attr('min')) {

//                 $(this).attr('disabled', true);

//             }



//         } else if(type == 'plus') {



//             if(currentVal < input.attr('max')) {

//                 input.val(currentVal + 1).change();

//             }

//             if(parseInt(input.val()) == input.attr('max')) {

//                 $(this).attr('disabled', true);

//             }



//         }

//     } else {

//         input.val(0);

//     }

// });

// $('.input-number').focusin(function(){

//    $(this).data('oldValue', $(this).val());

// });

// $('.input-number').change(function() {

    

//     minValue =  parseInt($(this).attr('min'));

//     maxValue =  parseInt($(this).attr('max'));

//     valueCurrent = parseInt($(this).val());

    

//     name = $(this).attr('name');

//     if(valueCurrent >= minValue) {

//         $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')

//     } else {

//         alert('Sorry, the minimum value was reached');

//         $(this).val($(this).data('oldValue'));

//     }

//     if(valueCurrent <= maxValue) {

//         $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')

//     } else {

//         alert('Sorry, the maximum value was reached');

//         $(this).val($(this).data('oldValue'));

//     }

    

    

// });



$(".input-number").keydown(function (e) {

        // Allow: backspace, delete, tab, escape, enter and .

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||

             // Allow: Ctrl+A

            (e.keyCode == 65 && e.ctrlKey === true) || 

             // Allow: home, end, left, right

            (e.keyCode >= 35 && e.keyCode <= 39)) {

                 // let it happen, don't do anything

                 return;

        }

        // Ensure that it is a number and stop the keypress

        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {

            e.preventDefault();

        }

    });



});

function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}


</script>

</body>

</html>

  <!-- Modal -->
  <div class="modal fade" id="logHistoryModal" role="dialog">
    <div class="modal-dialog modal-xl">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Log History</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body" style="overflow-y: scroll;">
         <div id="log_details"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

