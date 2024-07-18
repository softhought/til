
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Current Openings </h3>
         <div class="btn-group btn-group-sm float-right " role="group" aria-label="MoreActionButtons">
            <a href="<?php echo base_url(); ?>master/current_opening_create" class="btn btn-info btnpos link_tab">
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
                     <th>Title</th>
                     <th>Opening Description</th>
                     <th>Publish Date</th>
                     <th>Status</th>
                     <th>Action</th>
                   
                  </tr>
               </thead>
               <tbody>
                  <?php 
                    $sl=1;
                     foreach ($bodycontent['openingsList'] as $list) { ?>
                  <tr>
                     <td><?php echo $sl++; ?> </td>
                     <td><?php echo $list->opening_title; ?> </td>
                     <td><?php echo $list->opening_description; ?> </td>
                     <td><?php echo date("d-m-Y",strtotime($list->entry_date)); ?> </td>
                     <td align="left"> <?php if ($list->is_disabled == 0) { ?>
                                        <a
                                            href="<?php echo base_url() . "master/activeInactiveCurrentOpening/" . $list->current_opening_id . "/1" ?>"><img
                                                src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active"
                                                title="Active" class="relstatus">
                                        </a>
                                    <?php } else { ?>
                                        <a
                                            href="<?php echo base_url() . "master/activeInactiveCurrentOpening/" . $list->current_opening_id . "/0" ?>"><img
                                                src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive"
                                                title="Inactive" class="relstatus">
                                        </a>
                                    <?php } ?>
                                </td>
                     <td>
                     <a href="<?php echo base_url(); ?>master/current_opening_create/<?php echo $list->current_opening_id; ?>"
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