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
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TIL</title>
    <!-- <link rel="icon" type="image/x-icon" href="<?php echo(base_url());?>assets-admin/img/MA2.ico"> -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo(base_url());?>assets-admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/dist/css/adminlte.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo(base_url());?>assets-admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">


    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">





    <!-- DataTables -->

    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">





    <!-- Bootstrap Select -->

    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/css/bootstrap-select.css">



    <!--  -->

    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/plugins/sweetalert2/sweetalert2.min.css">







    <!-- Bootstrap4 Duallistbox -->

    <link rel="stylesheet"
        href="<?php echo(base_url());?>assets-admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">



    <!-- custome css  -->

    <!-- <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/css/softhought_style.css"> -->



    <!-- Select2 -->

    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/plugins/select2/css/select2.min.css">

    <link rel="stylesheet"
        href="<?php echo(base_url());?>assets-admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Date Picker -->

    <link rel="stylesheet"
        href="<?php echo(base_url());?>assets-admin/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">





    <!-- jQuery -->

    <script src="<?php echo(base_url());?>assets-admin/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->

    <script src="<?php echo(base_url());?>assets-admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Select -->

    <script src="<?php echo(base_url());?>assets-admin/js/bootstrap-select.js"></script>

    <!-- Bootstrap Select -->

    <script src="<?php echo(base_url());?>assets-admin/plugins/sweetalert2/sweetalert2.js"></script>

    <!-- Select2 -->

    <script src="<?php echo(base_url());?>assets-admin/plugins/select2/js/select2.full.min.js"></script>

    <!-- InputMask -->

    <script src="<?php echo(base_url());?>assets-admin/plugins/moment/moment.min.js"></script>

    <script src="<?php echo(base_url());?>assets-admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>



    <!-- datepicker -->

    <script src="<?php echo(base_url());?>assets-admin/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>

    <!-- DataTables -->

    <script src="<?php echo(base_url());?>assets-admin/plugins/datatables/jquery.dataTables.js"></script>

    <script src="<?php echo(base_url());?>assets-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <script src="<?php echo(base_url());?>assets-admin/plugins/datatables/dataTables.keyTable.min.js"></script>

    <!-- overlayScrollbars -->
    <script src="<?php echo(base_url());?>assets-admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <!-- AdminLTE App -->

    <script src="<?php echo(base_url());?>assets-admin/dist/js/adminlte.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <!-- <script src="<?php echo(base_url());?>assets-admin/dist/js/demo.js"></script> -->





    <script src="<?php echo(base_url());?>assets-admin/js/jquery.nicescroll.min.js"></script>



    <!-- input date checker jquery -->

    <script src="<?php echo base_url(); ?>assets-admin/js/customJs/datecheck.js"></script>


    <script src="<?php echo base_url(); ?>assets-admin/js/customJs/comman.js"></script>


    <script src="<?php echo(base_url());?>assets-admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- datatables additional files for pdf and print-->



    <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script> 

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>  -->



    <script src="<?php echo base_url(); ?>assets-admin/js/datatables/dataTables.buttons.min.js"></script>

    <script src="<?php echo base_url(); ?>assets-admin/js/datatables/buttons.flash.min.js"></script>

    <script src="<?php echo base_url(); ?>assets-admin/js/datatables/jszip.min.js"></script>

    <script src="<?php echo base_url(); ?>assets-admin/js/datatables/pdfmake.min.js"></script>

    <script src="<?php echo base_url(); ?>assets-admin/js/datatables/vfs_fonts.js"></script>

    <script src="<?php echo base_url(); ?>assets-admin/js/datatables/buttons.html5.min.js"></script>

    <script src="<?php echo base_url(); ?>assets-admin/js/datatables/buttons.print.min.js"></script>



    <!-- Google Font: Source Sans Pro -->


    <style>
    .err-border {

        border: 2px solid red !important;

    }

    .displaynone {
        display: none !important;
    }
    </style>

    <!-- custome css  -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;800;900&family=Poppins:wght@100;300;400;500;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/css/softhought_style.css">
    <link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/css/latest.design.css">



</head>

<body class="hold-transition sidebar-mini layout-fixed modern-layout-ui ">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light " style="background-color: #323232;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" style="color:white;"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url(); ?>dashboard" class="nav-link">Home</a>
                </li> -->
                <li class="nav-item d-none d-sm-inline-block">
                    <!-- <a href="#" class="nav-link">Contact</a> -->
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <!-- <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> -->

            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>logout" style="color: white;">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Left Menu Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-1" style="background-color: #323232 !important;">

            <!-- Brand Logo -->
            <a href="<?php echo base_url(); ?>dashboard" class="brand-link" style="background: rgb(255, 199, 44);!importan">
                <!-- <img src="<?php echo(base_url());?>assets-admin/img/MA2.png" alt="TIL INDIA" class="brand-image"
           style="opacity: .8"> -->
                <!-- <span class="brand-text"><span class="brand-text-start">TIL</span><span class="brand-text-end"> INDIA</span></span> -->
                <img src="<?php echo(base_url());?>assets-admin/img/logo.png" alt="TIL INDIA" height="15%"
                    width="75%" >
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">Hi, <?php
                 $user= explode(" ",$activeuser);
                   echo $user[0];?> &nbsp;
                   &nbsp;
                  </a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



                        <?php 
            if(sizeof($menu)>0){ 

                foreach($menu as $firstlevel){
    
                  if(sizeof($firstlevel['secondLevelMenu'])>0){
                    // print label for first menu drop icon and label    
                    ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas <?php echo $firstlevel['menu_icon']; ?> "></i>
                                <p>
                                    <?php echo $firstlevel['menu_name']; ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <?php
                    foreach($firstlevel['secondLevelMenu'] as $second_lvl){

                        if(sizeof($second_lvl['thirdLevelMenu'])>0){	
                            // print label of second label menu for third label
                            ?>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            <?php echo $second_lvl['second_menu_name']; ?>
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <?php 
                             
                             foreach($second_lvl['thirdLevelMenu'] as $third_lvl){ ?>

                                        <li class="nav-item">
                                            <a href="<?php echo base_url().$third_lvl['third_menu_link']; ?>"
                                                class="nav-link">
                                                <i class="nav-icon far fa-dot-circle"></i>
                                                <p><?php echo $third_lvl['third_menu_name']; ?></p>
                                            </a>
                                        </li>

                                        <?php
                             } ?>



                                    </ul>
                                </li>
                                <?php     


                        }
                        else{ ?>

                                <li class="nav-item">
                                    <a href="<?php echo base_url().$second_lvl['second_menu_link']; ?>"
                                        class="nav-link">
                                        <i class="nav-icon far fa-dot-circle ?>"></i>
                                        <p><?php echo $second_lvl['second_menu_name']; ?></p>
                                    </a>
                                </li>

                                <?php }

                    } ?>
                            </ul>
                        </li>

                        <?php    

                  }
                  else{ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url().$firstlevel['menu_link'];?>" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    <?php echo $firstlevel['menu_name']; ?>
                                </p>
                            </a>
                        </li>
                        <?php
                     
                  }
                }
            }
            ?>

                        <div class="hr-seperator-line mt-3"></div>

                        <!-- <li class="nav-header pt-1" style="color: #75777b;">User Profile</li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>user/change_password" class="nav-link">
                                <i class="nav-icon fas fa-file-signature"></i>
                                <p>Change Password</p>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a href="<?php echo base_url(); ?>logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li> -->


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper mb-5">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">

                    <div class="row mb-2" style="display:none;">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <?php 

        if($bodyview)  :

        $this->load->view($bodyview);

        endif; 

        ?>

         <input type="hidden" value="<?php echo base_url();?>" id="basepath" readonly />

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?php echo date('Y'); ?> <a href=#"></a></strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
    $(document).ready(function() {

        $(".more-read").click(function () {
                var elipseId = $(this).attr("data-target");
                var buttonText = $(this).text();

                if (buttonText === "Read more") {
                  $("#" + elipseId).addClass("expands");
                  $(this).text("Read less");
                } else {
                  $(this).text("Read more");
                  $("#" + elipseId).removeClass("expands");
                }
              });


        $(document).on("click", ".logHistory", function() {

            var tablename = $(this).attr("data-tablename");
            var rowid = $(this).attr("data-rowid");
            var basepath = $("#basepath").val();


            $("#log_details").html('Please wait loading...');
            $.ajax({
                url: basepath + "dashboard/viewLogHisory",
                method: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {
                    rowid: rowid,
                    tablename: tablename
                },
                success: function(data) {

                    $("#log_details").html(data);
                    //$('.dataTable').DataTable();
                    $(".dataTable").DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
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

        $('.datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })

        $(".customscrollbar").niceScroll({

            cursorborder: "",

            cursorwidth: "7px",

            autohidemode: false,

            cursorcolor: "#F4AFD9",

            boxzoom: false,

            smoothscroll: true,

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



        $(".input-number").keydown(function(e) {

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

            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                    105)) {

                e.preventDefault();

            }

        });




        /* onclick menu selected*/
        // var url = window.location;

        //  // for sidebar menu entirely but not cover treeview
        //  $('ul.nav-sidebar a').filter(function() {
        //    console.log("HREF MENU : ",this.href);
        //    return this.href == url;
        //  }).parent().addClass('active');

        //  // for treeview
        //  $('ul.nav-treeview a').filter(function() {
        //    console.log("HREF SUB MENU : ",this.href);
        //    return this.href == url;
        //  }).parentsUntil(".nav-sidebar > .has-treeview a").addClass('active');



        // $("nav-item.has-treeview").removeClass("menu-open");
        // $("nav-item.has-treeview.active").addClass("menu-open");



        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

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
                <h6 class="modal-title">Log History</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body" style="overflow-y: scroll;min-height:350px;">
                <div id="log_details"></div>
            </div>
            <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
        </div>

    </div>
</div>