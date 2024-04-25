<!-- <script src="<?php echo base_url();?>assets-admin/js/customJs/media.js"></script> -->
<style>
   .select2-container--default .select2-selection--multiple .select2-selection__choice {
   background-color: #7a2386;
   border: 1px solid #fff;
   }
   .error-msg {
    color: red; 
    font-size: 16px; 
    font-family: Arial, sans-serif; 
    font-weight: bold; 
    margin-top: 10px; 
}
</style>
<section class="layout-box-content-format1">
<!-- <div class="partial_view_news_and_newslater">

</div> -->
<div id="partial_view_news_and_newslater">

</div>
   <!--- ---------------start hear listing ---------------------->
<table id="video_partial_tbl" class="table customTbl table-bordered table-hover dataTable2">
      <thead>
         <tr>
            <th>Sl</th>
            <th style="width:150px;">Title Description</th>
            <th>Document Name</th>
            <th>Up/Down</th>
            <th>Set Precedence</th>
            <th>Status</th>
            <th>Action</th>
         </tr>
      </thead>
      <tobody>
         <?php 
            $i=1;
            $media_tag = $media_tag_name;
            $rowslno = $newslist;
            foreach($newslist as $list){ ?>
            <tr>
               <td><?php echo $i++; ?></td>
               <td><?php echo $list->uploaded_file_desc; ?></td>
               <td><?php echo $list->user_file_name; ?></td>
               <td>						
                  <img src="<?php echo base_url(); ?>assets-admin/img/up.png" alt="Active" title="up arrow" id="active" onclick="changeSerial(<?php echo($list->doc_id);?>,<?php echo $list->precedence;?>,'U','<?php echo $media_tag; ?>','<?php echo($list->table_name);?>','<?php echo($list->ref_id);?>')"/ style="cursor:pointer;">
                  <img src="<?php echo base_url(); ?>assets-admin/img/down.png" alt="Active" title="down arrow" id="active" onclick="changeSerial(<?php echo($list->doc_id);?>,<?php echo $list->precedence;?>,'D','<?php echo $media_tag; ?>','<?php echo($list->table_name);?>','<?php echo($list->ref_id);?>')"/ style="cursor:pointer;">
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
                        <button type="button" class="btn tbl-action-btn padbtn" onclick="changeSerial(<?php echo($list->doc_id);?>,<?php echo $list->precedence;?>,'P','<?php echo $media_tag; ?>','<?php echo($list->table_name);?>','<?php echo($list->ref_id);?>')" style="margin: 3px -6px;"><i class="fas fa-sync-alt" aria-hidden="true" title="click for set precedence" ></i>    </button>   
                     </div> 
                  </div>                  
					</td>
               <td align="center"> <?php if($list->is_disabled == 0){ ?>
                  <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active" title="Active" id="<?php echo($list->doc_id); ?>"  class="news_newslater_status" data-setstatus="1" data-mediatag="<?php echo $media_tag; ?>" ></a>
                  
                  <?php } else{ ?>
                     <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive" title="Inactive" id="<?php echo($list->doc_id); ?>" class="news_newslater_status" data-setstatus="0" data-mediatag="<?php echo $media_tag; ?>" > </a> 
               <?php } ?>
               </td>
               <td style="text-align:center;">
                  <a href="javascript:void(0);" class="btn tbl-action-btn padbtn update_news_newslater" 
                  data-id="<?php echo $list->doc_id;?>"
                  data-title="<?php echo $list->uploaded_file_desc;?>"
                  data-filename="<?php echo $list->user_file_name;?>"
                  data-randomname="<?php echo $list->random_file_name;?>"
                  >
                  <i class="fas fa-edit"></i>
                  </a>
               </td>
            </tr>

         <?php } ?>
         
      </tobody>
      
              
   </table>

   <!--- ----------------end hear listing ----------------------->
  
</section>
