  <style type="text/css">
  	.layout-box-content-format1 .formblock-box {
  box-shadow: 0px 0px 6px 0px #fff!important;
}

th {
    white-space: nowrap !important;
}
  </style>     
          <section class="layout-box-content-format1">

        <div class="card card-primary"> 

          <div class="card-body">
          <div class="formblock-box table-responsive">

       <table class="table customTbl table-bordered table-striped dataTable <?php echo accesspermission('View');?>">
                <thead>
                    <tr>
                    <th >Sl No</th>
                    <th >Log Date</th>
                    <th >Action</th>
                    <th >User</th>    
                    <?php
                    	foreach ($tableColumnData as $key => $value) {
                    	
                    ?>           
                    <th><?php echo $value;?></th>  
                    <?php } ?>             
                    </tr>
                </thead>
                <tbody>
                <?php $i=1;
                foreach ($logData as $logdata) { 
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>  
                   <td><?php echo date("d-m-Y h:i A", strtotime($logdata->log_date)); ?></td>
                   <td><?php echo $logdata->action; ?></td>
                   <td><?php echo $logdata->executive_name; ?></td>
                    <?php
                    $tableArray = (array)json_decode($logdata->data_array);
                   // pre($tableArray);
                    	foreach ($tableColumnData as $key => $value) {
                    	
                    ?>           
                    <td><?php 
                    	if (array_key_exists($value,$tableArray))
						  {
						  echo $tableArray[$value];
						  }

                   // echo $value;?></td>  
                    <?php } ?> 
                 
                 </tr>
                <?php } ?>                       
                </tbody>
              </table>

          </div>
      </div>
      </div>
  </section>