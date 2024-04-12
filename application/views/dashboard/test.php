<!-- Resources -->
<script src="<?php echo base_url(); ?>assets/js/customJs/dasbordchart/index.js"></script>
<script src="<?php echo base_url(); ?>assets/js/customJs/dasbordchart/xy.js"></script>
<script src="<?php echo base_url(); ?>assets/js/customJs/dasbordchart/Animated.js"></script>
<script src="<?php echo base_url(); ?>assets/js/customJs/dasbordchart/dashbord.js"></script>
<!-- Styles -->
<style>
#chartdiv {
    width: 100%;
    height: 500px;
}

.chart1,
.chart2 {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    /* border: 1px solid blue; */
}

.card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    /* border:1px solid blue; */
}

#link:hover {
    color: red;
    background-color: transparent;
}

#mclick {
    cursor: pointer;
}

a:hover {
    color: white;
}

blink {
  animation: 0.5s linear infinite condemned_blink_effect;
}



</style>

<div class="container">
    <div class="row dashboard-block-1">
        <div class="col-md-4">
            <div class="card welcome-card timer-card">
                <div class="card-body">
                    <div class="welcome-text"><span style="color: #006ed9">Welcome to </span><span
                            style="color:#e8057d;"><br>Mumbai Angels</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card timer-card">
                <div class="card-body">
                    <!-- <div class="today-date" style="color: #444341">12<sup>th</sup> May 2022</div> -->
                    <div class="today-date" style="color: #444341"><?php echo date('dS M, Y');?>
</div>
                    <div class="timer" style="color: #04af42">
                        <span><?php echo date("h"); ?><span> : <span><?php echo date("i"); ?></span> 
                                <!-- :<span><?php echo date("s"); ?></span>  -->
                                <span><?php echo date("A"); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card about-info">
                <div class="card-body">
                    <h6 style="color: #e8057d;font-weight: bold;;">Error Notification(s)- <?php echo date("M-Y"); ?> </h6>
                   <a href="<?php echo base_url(); ?>cygnettest/einvoice"> <h6 style="color: green;">Total Invoice Raised: <?php echo $bodycontent['totalMonthlyIncoice']; ?></h6 ></a>

                    <?php
                    if ($bodycontent['totalMonthlyErrorIncoice']!=0) {
                       echo "<blink>";
                    }
                    ?>
                    
                    <h6 style="color: red;">Error Invoice GST Portal : <?php echo $bodycontent['totalMonthlyErrorIncoice']; ?></h6 >
                     <?php
                    if ($bodycontent['totalMonthlyErrorIncoice']!=0) {
                       echo "</blink>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 dashboard-block-2 mt-3">
        <div class="col">
            <div class="card card-gradient-bg1 radius-10">
                <div class="card-body text-light">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 bold-counter-number"><?php echo $bodycontent['totalinvestor']; ?></h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>Total Investors</p>
                    </div>
                    <div class="card-icon-action float-right">
                        <a href="<?php echo base_url();?>investor/" target="_blank">
                            <i class="fas fa-arrow-right" style="color:#05b03a"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-gradient-bg2 radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 bold-counter-number"><?php echo $bodycontent['totalstartup']; ?></h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>Total Portfolio</p>
                    </div>
                    <div class="card-icon-action float-right">
                        <a href="<?php echo base_url();?>startup" target="_blank">
                            <i class="fas fa-arrow-right" style="color:#c50784"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-gradient-bg3 radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 bold-counter-number"><?php echo $bodycontent['totalconvertedlist'];  ?></h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>This Month Conversion</p>
                    </div>
                    <div class="card-icon-action float-right">
                        <a href="<?php echo base_url();?>dashboard/getConversion" target="_blank">
                            <i class="fas fa-arrow-right" style="color:#e7ae17"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-gradient-bg4 radius-10">
                <div class="card-body text-light">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 bold-counter-number" style="font-size:17px;"><i class="fas fa-rupee-sign"></i>
                            <?php
                        $amount = $bodycontent['total_payment']->payment_amount;
                        // echo $amount;
                        echo number_format($amount,2); ?>
                        </h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>This Month Payment Received</p>
                    </div>
                    <div class="card-icon-action float-right">
                        <a href="<?php echo base_url();?>dashboard/getMonthPayment" target="_blank">
                            <i class="fas fa-arrow-right" style="color:#006cd8"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-gradient-bg5 radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 bold-counter-number" style="font-size:17px;"><i class="fas fa-rupee-sign"></i><?php
                        $amount = $bodycontent['mants_payment']->payment_amount;
                        // echo $amount;
                        echo number_format($amount,2); ?></h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>This Month Payment Adjst'd Thru MANTs</p>
                    </div>
                    <div class="card-icon-action float-right">
                        <a href="<?php echo base_url();?>dashboard/getMantsAmount" target="_blank">
                            <i class="fas fa-arrow-right" style="color:#41403e"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            <div class="chart1">
                <div class="text-left chart-header">
                    <i class="fas fa-arrow-square-right"></i>
                    <h6> Potential Investor To Converted </h6>
                </div>
                <!-- HTML -->
                <div id="chartdiv" style="font-size: 12px; height: 300px;"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart2">
                <div class="text-left chart-header">
                    <i class="fas fa-arrow-square-right"></i>
                    <h6>Month Wise Renewal List</h6>
                </div>
                <!-- HTML -->
                <div id="renewalchart" style="font-size: 12px; height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
<!-- Row Block 3 -->

<div class="container mt-3 dashboard-block-3">

    <div class="row">
        <h1 class="top5-tittle">Top 5 </h1>
    </div>
    <div class="row">
        <div class="col-md-8" style="display:none;">
            <div class="card dashboard-blck-3-card-1">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Top 5 Investor List</h3>
                </div>
                <div class="card-body p-0">
                    <div class="dashboard-table-style-1 table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Investor Code</th>
                                    <th>Member Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Next Renewal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            for($i=0;$i<5;$i++){
                      ?>
                                <tr>
                                    <td>MA01500</a></td>
                                    <td>A. Rama Kotaiah</td>
                                    <td><span class="badge badge-success">9949497734</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">ramu.ak@gmail.com
                                        </div>
                                    </td>
                                    <td>01-06-2023</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm cutom-btn-1 button-bg-2 float-left"><i
                            class="fa fa-plus"></i> Add New Investor</a>
                    <a href="javascript:void(0)" class="btn btn-sm cutom-btn-1 button-bg-1 float-right">View All
                        Investors <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end of col-md-8 -->
        <div class="col-md-4">
            <div class="card card-list dashboard-blck-3-card-2">
                <div class="card-header">
                    <h3 class="card-title">Startup</h3>
                </div>
                <div class="card-body p-0" style="height: 436px;">
                    <ul class="pl-2 pr-2">
                        <?php 
                foreach($bodycontent['startups'] as $startup){
                      ?>
                        <li class="item">
                            <div class="card-item-icon">
                                <img src="<?php echo base_url();?>assets/img/startup.png" alt="Card Item Icon"
                                    class="img-size-20 float-left">
                            </div>
                            <div class="card-item-info">
                                <p class="card-item-info-title m-0"><?php echo $startup->registered_name; ?></p>
                                <span class="card-item-info-span card-item-info-line1">
                                    Industry Group : <?php echo $startup->industry_group;?>
                                </span>
                                <span class="card-item-info-span card-item-info-line2">
                                    Total Investment : <?php $ammount = $startup->ammount; ?>
                                    <i class="fas fa-rupee-sign"></i>
                                    <?php echo " ";
                                    echo number_format($ammount,2);
                                    ?>
                                </span>
                            </div>
                        </li>
                        <?php } ?>

                    </ul>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url();?>startup/addStartup" target="_blank"
                        class="btn btn-sm cutom-btn-1 button-bg-2 float-left"><i class="fa fa-plus"></i> Add New</a>
                    <a href="<?php echo base_url();?>startup" target="_blank"
                        class="btn btn-sm cutom-btn-1 button-bg-1 float-right">View All <i
                            class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <!-- End of col-md-4 -->
        <div class="col-md-4" style="">
            <div class="card card-list dashboard-blck-3-card-3">
                <div class="card-header">
                    <h3 class="card-title"> <i class="fa fa-hexagon-plus"></i> Sector</h3>
                </div>
                <div class="card-body p-0" style="height: 436px;">
                    <ul class="pl-2 pr-2">
                        <?php 
                foreach($bodycontent['sectors'] as $sectors)
                {
                      ?>
                        <li class="item">
                            <div class="card-item-icon">
                                <img src="<?php echo base_url();?>assets/img/technology.png" alt="Card Item Icon"
                                    class="img-size-20 float-left">
                            </div>
                            <div class="card-item-info">
                                <p class="card-item-info-title m-0"><?php echo $sectors->sector_name; ?> </p>
                                <span class="card-item-info-span card-item-info-line1">
                                    No. of investors : <?php echo $sectors->total_investor; ?>
                                </span>
                                <span class="card-item-info-span card-item-info-line2">
                                    Total Investment : <i class="fas fa-rupee-sign"></i><?php echo " "; ?>
                                    <?php $amount = $sectors->total_alloted_amount;  echo number_format($amount,2); ?>
                                    /-
                                </span>
                            </div>
                        </li>
                        <?php } ?>

                    </ul>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url(); ?>sector/addSector" target="_blank"
                        class="btn btn-sm cutom-btn-1 button-bg-3 float-left"><i class="fa fa-plus"></i> Add New</a>
                    <a href="<?php echo base_url(); ?>sector" target="_blank"
                        class="btn btn-sm cutom-btn-1 button-bg-4 float-right">View All <i
                            class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <!-- End of col-md-4 -->
        <div class="col-md-4">
            <div class="card card-list dashboard-blck-3-card-4">
                <div class="card-header">
                    <h3 class="card-title">Investors</h3>
                </div>
                <div class="card-body p-0" style="height: 436px;">
                    <ul class="pl-2 pr-2">
                        <?php 
                foreach($bodycontent['topinvestor'] as $topinvestors){
                ?>
                        <li class="item">
                            <div class="card-item-icon">
                                <img src="<?php echo base_url();?>assets/img/investor.png" alt="Card Item Icon"
                                    class="img-size-20 float-left">
                            </div>
                            <div class="card-item-info">
                                <p class="card-item-info-title m-0"><?php echo $topinvestors->member_name; ?></p>
                                <span class="card-item-info-span card-item-info-line1">
                                    Investment : <i class="fas fa-rupee-sign"></i><?php echo " "; ?>
                                    <?php $ammount = $topinvestors->ammount; echo number_format($ammount,2); echo "  <br>"; ?>
                                </span>
                                <span class="card-item-info-span card-item-info-line2">
                                    <?php echo $topinvestors->email_primary; echo " ";  ?>
                                </span>
                            </div>
                        </li>

                        <?php } ?>

                    </ul>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url(); ?>investor/addInvestor" target="_blank"
                        class="btn btn-sm cutom-btn-1 button-bg-6 float-left"><i class="fa fa-plus"></i> Add New</a>
                    <a href="<?php echo base_url(); ?>investor" target="_blank"
                        class="btn btn-sm cutom-btn-1 button-bg-5 float-right">View All <i
                            class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <!-- End of col-md-4 -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tt"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="lodar">
                    <img src="<?php echo base_url(); ?>assets/img/loader_gif.gif" width="100px" alt="">
                </div>
                <div id="month_conversion_list">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

