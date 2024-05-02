
<section class="layout-box-content-format1">
<table  class="table customTbl table-bordered table-striped dataTable" style="width: 100%">
   <thead>
      <tr>
         <th>Sl</th>
         <th style="width:65%;">Title</th>
         <th>View</th>
         <th>Download</th>
         <th>Up/Down</th>
         <th>Set Precedence</th>
         <th style="width:5%;">Status</th>
       
      </tr>
   </thead>
   <tbody>
      <?php
         $sl = 1;
         $rowslno=$documenDtl;
         $dir_path = base_url().'assets/docs/pdf'; //local
         foreach ($documenDtl as $key => $value) {        
             ?>
      <tr id="docrow_<?php echo $value->doc_id; ?>">
         <td><?php echo $sl++; ?></td>
         <td><?php echo $value->uploaded_file_desc; ?></td>
         <td align="center"><a href="<?php echo $dir_path."/".$value->random_file_name;?>"
            class="btn btn-xs" data-title="download" target="_blank" style="background: #f8bb06; color:#000;"><i
            class="fa fa-link" aria-hidden="true"></i></a></td>
         <td align="center"><a href="<?php echo $dir_path."/".$value->random_file_name;?>"
            class="btn btn-xs" data-title="download" style="background: #f8bb06; color:#000;" download><i
             class="fa fa-download" aria-hidden="true"></i></a> </td>
         <td>
         <img src="<?php echo base_url(); ?>assets-admin/img/up.png" alt="Active" title="up arrow" id="active" onclick="changeSerialDoc(<?php echo($value->doc_id);?>,<?php echo $value->precedence;?>,'U')" style="cursor:pointer;">
         <img src="<?php echo base_url(); ?>assets-admin/img/down.png" alt="Active" title="down arrow" id="active" onclick="changeSerialDoc(<?php echo($value->doc_id);?>,<?php echo $value->precedence;?>,'D')" style="cursor:pointer;">
         </td>
         <td>
         <div class="row">
         <div class="col-md-8">
           <select class="form-control select2" id="otherslno_<?= $value->precedence; ?>">  
             <?php foreach($rowslno as $row_slno){
                if($value->precedence != $row_slno->precedence ){
                  ?>
           <option value="<?php echo $row_slno->precedence ?>"><?php echo $row_slno->precedence ?></option>
                           <?php } } ?>                       
                        </select>
                     </div>                 
         <div class="col-md-2">
         <button type="button" class="btn tbl-action-btn padbtn" onclick="changeSerialDoc(<?php echo($value->doc_id);?>,<?php echo $value->precedence;?>,'P')" style="margin: 3px -6px;"><i class="fas fa-sync-alt" aria-hidden="true" title="click for set precedence" ></i>    </button>   
         </div> 
         </div>
         </td>
        <td align="center"> <?php if ($value->is_disabled == 0) { ?>
                     <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/active-icon.png"
                           alt="Active" title="Active" id="<?php echo ($value->doc_id); ?>" class="reldocstatus"
                           data-setstatus=1 ></a>
                  <?php } else { ?>
                     <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/inactive2.png"
                           alt="Inactive" title="Inactive" id="<?php echo ($value->doc_id); ?>" class="reldocstatus"
                           data-setstatus=0> </a>
                  <?php } ?>
         </td>
      <?php } ?>
   </tbody>
</table>
</div>
<section>

<input type="hidden" name="doc" id="doc_relations_master_id"  value="<?php echo $relations_master_id;?>">
<input type="hidden" name="doc" id="doc_relations_dtl_id"  value="<?php echo $relations_dtl_id;?>">
