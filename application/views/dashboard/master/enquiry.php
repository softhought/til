<style>
   .text-elipse {
  overflow: hidden;
  display: -webkit-box !important;
  -webkit-line-clamp: 3;
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

</style>
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Enquiry List</h3>
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
                     <th>Organization</th>
                     <th>Full Name</th>
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Nature of Query</th>
                     <th> Query</th>
                     <th> Country</th>
                     <th> State</th>
                   
                  </tr>
               </thead>
               <tbody>
                  <?php 
                    $sl=1;
                     foreach ($bodycontent['contactusList'] as $list) { ?>
                  <tr>
                     <td><?php echo $sl++; ?> </td>
                     <td><?php echo $list->organization; ?> </td>
                     <td><?php echo $list->name; ?> </td>
                     <td><?php echo $list->phone; ?> </td>
                     <td><?php echo $list->email; ?> </td>
                     <td><?php echo $list->nature_of_query; ?> </td>
                     <td>
                     <p id="elipse<?php echo $sl;?>" class="text-elipse" style="padding:12px 0">
                        <?php echo $list->query; ?> 
                        </p>
                        <?php if(strlen($list->query)>130){ ?>
                        <span><a href="javascript:void(0)" class="more-read" 
                                                        data-target="elipse<?php echo $sl;?>">Read
                                                        more</a></span><?php } ?>

                     </td>
                     <td><?php echo $list->country_name; ?> </td>
                     <td><?php echo $list->state_name; ?> </td>
                    

                   
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>