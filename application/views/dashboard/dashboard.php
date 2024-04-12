<!-- Resources -->
<script src="<?php echo base_url(); ?>assets/js/customjs/dasbordchart/index.js"></script>
<script src="<?php echo base_url(); ?>assets/js/customjs/dasbordchart/xy.js"></script>
<script src="<?php echo base_url(); ?>assets/js/customjs/dasbordchart/Animated.js"></script>
<script src="<?php echo base_url(); ?>assets/js/customjs/dasbordchart/dashbord.js"></script>


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

.card2 {
    background: #414d0b;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to left, #727a17, #414d0b);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #727a17, #414d0b);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */



}

.card3 {
    background: #F09819;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to left, #EDDE5D, #F09819);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #EDDE5D, #F09819);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */




}

.card4 {
    background: #AA076B;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #61045F, #AA076B);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #61045F, #AA076B);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */




}

.card5 {
    background: #136a8a;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to left, #267871, #136a8a);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #267871, #136a8a);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}

#mclick {
    cursor: pointer;
}

a:hover {
  color: white;
}
</style>




<div style="text-align: center;">

    <h2>Welcome to Mumbai Angels</h2>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

        <div class="col">
            <div class="card radius-10">
                <div class="card-body card2 bg-primary text-light">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 text-light"><?php echo $bodycontent['totalinvestor']; ?></h4>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-success'></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="<?php echo base_url(); ?>investor/" target="_blank"> <B
                                class="mb-0 text-light">Total Investors</B></a>
                    </div>
                    <div class="float-right fa fa-users-large">
                        <i class="" aria-hidden="true"></i>
                    </div>

                </div>

            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body card3 bg-warning">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 text-light"><?php echo $bodycontent['totalstartup']; ?></h4>
                        <div class="ms-auto">
                            <i class='bx bx-group fs-3 text-danger'></i>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                    <a href="<?php echo base_url(); ?>startup/" target="_blank">  <B
                                class="mb-0 text-light">Total Portfolio</B></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body card4 bg-success">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 text-light"><?php echo $bodycontent['totalconvertedlist'];  ?></h4>
                        <div class="ms-auto">
                            <i class='bx bx-envelope fs-3 text-warning'></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="<?php echo base_url();?>dashboard/getConversion" target="_blank"> <B class="mb-0 text-light">This Month Conversion</B></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body card5 bg-primary text-light">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 text-light"><i class="fas fa-rupee-sign"></i>
                            &nbsp;&nbsp;<?php
                            $amount = $bodycontent['total_payment']->payment_amount;
                            echo number_format($amount,2); ?></h4>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-success'></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                    <a href="<?php echo base_url();?>dashboard/getMonthPayment" target="_blank"> <B class="mb-0 text-light"><B
                                class="mb-0">This Month Payment Received</B></a>
                    </div>
                    <div class="float-right fa fa-users-large">
                        <i class="" aria-hidden="true"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--end row-->
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="chart1">
                <div class="text-center">
                    Potential Investor To Converted 
                </div>
                <!-- HTML -->
                <div id="chartdiv" style="font-size: 12px; height: 300px;"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart2">
                <div class="text-center">
                    Month Wise Renewal List
                </div>
                <!-- HTML -->
                <div id="renewalchart" style="font-size: 12px; height: 300px;"></div>
            </div>
        </div>
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