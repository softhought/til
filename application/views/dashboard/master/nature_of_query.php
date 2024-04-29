
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Nature of Query </h3>
        <div class="btn-group btn-group-sm float-right " role="group" aria-label="MoreActionButtons">
            <a href="<?php echo base_url(); ?>master/nature_of_query_add_edit" class="btn btn-info btnpos link_tab">
            <i class="fas fa-plus"></i> Add </a> 
         </div>
       
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="formblock-box">
            <table id="example2" class="table customTbl table-bordered table-hover dataTable">
               <thead>
                  <tr>
                     <th>Sl</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>CC</th>
                     <th>Action</th>
                   
                  </tr>
               </thead>
               <tbody>
                  <?php 
                    $sl=1;
                     foreach ($bodycontent['nature_of_queryList'] as $list) { ?>
                  <tr>
                     <td><?php echo $sl++; ?> </td>
                     <td><?php echo $list->name; ?> </td>
                     <td><?php echo $list->email; ?> </td>
                     <td><?php echo $list->cc_to; ?> </td>
                     <td>
                     <a href="<?php echo base_url(); ?>master/nature_of_query_add_edit/<?php echo $list->id; ?>"
                              class="btn tbl-action-btn padbtn">
                           <i class="fas fa-edit"></i>
                           </a>
                     </td>
                   
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