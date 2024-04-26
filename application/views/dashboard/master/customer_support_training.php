<style>
   .text-elipse {
  overflow: hidden;
  display: -webkit-box !important;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;

  transition: -webkit-line-clamp 0.3s ease;
  text-align: left;
}
.expands {
  -webkit-line-clamp: unset;
}

 .table_wrapper{
    display: block;
    overflow-x: auto;

}
p{
   padding: 0px!important;
   margin-bottom: -2px;
}

</style>
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Customer Support Training </h3>
         <!-- <div class="btn-group btn-group-sm float-right " role="group" aria-label="MoreActionButtons">
            <a href="<?php echo base_url(); ?>user/create" class="btn btn-info btnpos link_tab">
            <i class="fas fa-plus"></i> Add </a> 
         </div> -->
       
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="formblock-box table_wrapper">
            <table id="example2" class="table customTbl table-bordered table-hover dataTable">
               <thead>
                  <tr>
                     <th>Sl</th>
                     <th>Customer Name</th>
                     <th>Company Name</th>
                     <th>Phone Number</th>
                     <th>Email Address</th>
                     <th>Address </th>
                     <th>Module Interested for Training </th>
                     <th>Training Month Year  </th>
                     <th>Preferred Location  </th>
               
                   
                  </tr>
               </thead>
               <tbody>
                  <?php 
                    $sl=1;
                     foreach ($bodycontent['tranningList'] as $list) { ?>
                  <tr>
                     <td><?php echo $sl++; ?> </td>
                     <td><?php echo $list->customer_name; ?> </td>
                     <td><?php echo $list->company_name; ?> </td>
                     <td><?php echo $list->phone; ?> </td>
                     <td><?php echo $list->email; ?> </td>
                     <td><?php echo $list->address; ?> </td>
                     <td>
                        <?php
                               $trainingID[0]="";    
                               $trainingID[1]="Operators Training Module";    
                               $trainingID[2]="Basic Module";    
                               $trainingID[3]="Advanced Training Module";    
                               echo $trainingID[$list->training_id];
                        ?>
                     </td>
                     <td><?php echo date("M", mktime(0, 0, 0, $list->training_month, 1))."-".$list->training_year; ?></td>                   
                     <td>
                        <?php
                                $location[0]="";
                                $location[1]="TIL Premise";
                                $location[2]="TIL Premise";
                                echo $location[$list->location_id];
                        ?>
                     </td>
                
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>