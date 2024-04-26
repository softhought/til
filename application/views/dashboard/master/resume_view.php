
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Resume List </h3>
         <!-- <div class="btn-group btn-group-sm float-right " role="group" aria-label="MoreActionButtons">
            <a href="<?php echo base_url(); ?>user/create" class="btn btn-info btnpos link_tab">
            <i class="fas fa-plus"></i> Add </a> 
         </div> -->
       
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="formblock-box">
            <table id="example2" class="table customTbl table-bordered table-hover dataTable">
               <thead>
                  <tr>
                     <th>Sl</th>
                     <th>Functions Name</th>
                     <th>Candidte Name</th>
                     <th>Technical_Qualification</th>
                     <th>Date</th>
                     <th>Docs</th>
                     <!-- <th>LinkedIn Profile</th> -->
                   
                  </tr>
               </thead>
               <tbody>
                  <?php 
                    $sl=1;
                     foreach ($bodycontent['resumeList'] as $list) { ?>
                  <tr>
                     <td><?php echo $sl++; ?> </td>
                     <td><?php echo $list->functions_name; ?> </td>
                     <td><?php echo $list->candidte_name; ?> </td>
                     <td><?php echo $list->technical_qualification; ?> </td>
                     <td><?php echo date("d-m-Y",strtotime($list->time)); ?> </td>
                     <td>
                     <a href="<?php echo base_url().$list->resume;?>" class="btn btn-xs" data-title="download" target="_blank"
            style="background:#f8bb06; color:#000;"><i class="fa fa-link" aria-hidden="true"></i></a>
                     </td>
                   <td>
                     <?php 
                     $substring = "www.linkedin.com";
                     if(strpos($list->linkedIn_profile, $substring) !== false){?>
                     <!-- <a href="<?php echo $list->linkedIn_profile;?>" class="btn btn-xs"  target="_blank"
            style="background:#f8bb06; color:#000;font-weight:bold;">In</a> -->
            <?php } ?>
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