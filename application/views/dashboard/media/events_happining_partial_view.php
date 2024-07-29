<section class="layout-box-content-format1">
<a href="javascript:;" class="btn btn-warning btnpos showaddbtn" 
   data-toggle="modal" data-target="#investorRelationsDetails"
   style="margin-right:10px;"><i class="fas fa-plus"></i> Add </a>
    <br>
    <br>
    <!--- ---------------start hear listing ---------------------->
    <table id="video_partial_tbl" class="table customTbl table-bordered table-hover dataTable2">
      <thead>
         <tr>
            <th>Sl</th>
            <th style="width:150px;">Event Title</th>
            <th>Up/Down</th>
            <th>Set Precedence</th>
            <th>Status</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $i=1;
            $rowslno=$happinig_list;
            $media_tag = '';
           
            
            foreach($happinig_list as $list){ 
               
            ?>
            <tr>
               <td><?php echo $i++; ?></td>
               <td><?php echo $list->name; ?></td>
               <td>	
                  <img src="<?php echo base_url(); ?>assets-admin/img/up.png" alt="Active" title="up arrow" id="active" onclick="changeSerialEvent(<?php echo($list->id);?>,<?php echo $list->precedence;?>,'U')"/ style="cursor:pointer;">
                  <img src="<?php echo base_url(); ?>assets-admin/img/down.png" alt="Active" title="down arrow" id="active" onclick="changeSerialEvent(<?php echo($list->id);?>,<?php echo $list->precedence;?>,'D')"/ style="cursor:pointer;">


               </td>
               <td>
                  <div class="row">
                     <div class="col-md-8">
                        <select class="form-control select2" id="otherslno_<?= $list->precedence; ?>">
                           
                           <?php foreach($rowslno as $row_slno){
                                    if($list->precedence != $row_slno->precedence ){
                           ?>
                              <option value="<?php echo $row_slno->precedence ?>"><?php echo $row_slno->precedence ?></option>

                           <?php } } ?>
                        
                        </select>
                     </div>
                  
                     <div class="col-md-4">
                        <button type="button" class="btn tbl-action-btn padbtn" onclick="changeSerialEvent(<?php echo($list->id);?>,<?php echo $list->precedence;?>,'P')" style="margin: 3px -6px;"><i class="fas fa-sync-alt" aria-hidden="true" title="click for set precedence" ></i>    </button>   
                     </div> 
                  </div>                  
				</td>
               <td align="center"> <?php if($list->published == 1){ ?>
                  <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active" title="Active" id="<?php echo($list->id); ?>"  class="eventstatus" data-setstatus=0></a>
                  <?php } else{ ?>
                     <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive" title="Inactive" id="<?php echo($list->id); ?>" class="eventstatus" data-setstatus=1> </a>   
               <?php } ?>
               </td>
               <td style="text-align:center;">
                  <a href="javascript:void(0);" class="btn tbl-action-btn padbtn showupdatebtn" 
                  data-eventid ="<?php echo $list->id;?>"
                  
                  data-toggle="modal" data-target="#investorRelationsDetails"
                  >
                  <i class="fas fa-edit"></i>
                  </a>
               </td>
            </tr>

         <?php } ?>
         
      </tbody>
              
   </table>

   <!--- ----------------end hear listing ----------------------->
</section>
<div id="investorRelationsDetails" class="modal fade customModal format1 right" data-keyboard="false"
      data-backdrop="false">
      <div class="modal-dialog modal-xl" >
          <div class="modal-content">
              <div class="modal-header" style="background:#323232;; color:#ffffff;padding: 5px;color: #fff;">
                  <h4 class="frm_header"></h4>
                  <button type="button" class="close" style="color: white; opacity: 1;"
                      data-dismiss="modal">&times;<span class="sr-only">Close</span></button>
              </div>
              <div class="modal-body" style="min-height: 350px;height: 650px overflow-y: auto;">
              <input type="hidden" id="relations_master_id" name="relations_master_id" value="1">
              <input type="hidden" id="investor_relation_head" name="investor_relation_head" value="" readonly>
              <div id="add_edit_view_data">
            
            
               </div>

              </div>
          </div>
      </div>
  </div>



