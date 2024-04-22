
<section class="layout-box-content-format1">
<table  class="table customTbl table-bordered table-striped dataTable" style="width: 100%">
   <thead>
      <tr>
         <th style="width:10%;">Sl</th>
         <th style="width:80%;">Title</th>
         <th style="width:5%;">Action</th>
         <th style="width:5%;">Docs</th>
         <th style="width:5%;">Status</th>
       
      </tr>
   </thead>
   <tbody>
      <?php
         $sl = 1;
         
         foreach ($relationsDetailsList as $key => $value) {
         
             ?>
      <tr>
         <td><?php echo $sl++; ?></td>
         <td><?php echo $value->title; ?></td>
         <td style="text-align:center;">
                  <a href="javascript:void(0);" class="btn tbl-action-btn padbtn showupdatebtn" 
                  data-relationsdtlid="<?php echo $value->relations_dtl_id;?>"
                  data-relationsmasterid="<?php echo $value->relations_master_id;?>"
                  data-toggle="modal" data-target="#investorRelationsDetails"
                  >
                  <i class="fas fa-edit"></i>
                  </a>
               </td>
      <td> 
         <?php if($value->fileupload_count!=""){ ?>
      <a href="javascript:void(0);" class="btn tbl-action-btn padbtn showDocs" 
                  data-relationsdtlid="<?php echo $value->relations_dtl_id;?>"
                  data-relationsmasterid="<?php echo $value->relations_master_id;?>"
                  data-dochead="<?php echo $value->title; ?>"
                  data-toggle="modal" data-target="#investorRelationsDocs"
                  >
                  <?php echo $value->fileupload_count; ?>
                  </a>
                  <?php } ?>
               
               </td>
               <td align="center"> <?php if($value->is_disabled == 0){ ?>
                  <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active" title="Active" id="<?php echo($value->relations_dtl_id); ?>"  class="relstatus" data-setstatus=1  data-relationsmasterid="<?php echo $value->relations_master_id;?>"></a>
                  <?php } else{ ?>
                     <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive" title="Inactive" id="<?php echo($value->relations_dtl_id); ?>" class="relstatus" data-setstatus=0  data-relationsmasterid="<?php echo $value->relations_master_id;?>"> </a>   
               <?php } ?>
               </td>
      </tr>
      <?php } ?>
   </tbody>
</table>
</div>
<section>
