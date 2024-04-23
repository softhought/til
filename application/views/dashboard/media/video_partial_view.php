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
   <form id="videoForm" class="videoForm" method="post">
      <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>">
      <input type="hidden" name="videoId" id="videoId" value="<?php echo $videoId; ?>">
      <div class="row">
         <div class="col-md-3">
            <label for="title">Video Title <span style="color:red;font-size:15px;">*</span></label>
            <div class="form-group">
               <div class="input-group input-group-sm">
                  <input type="text" class="form-control forminputs typeahead" id="title" name="title"
                     placeholder="Enter Title" autocomplete="off"
                     value="">
               </div>
               <p id="error_title" class="error-msg"></p>
            </div>
         </div>
         <div class="col-md-3">
            <label for="link">Video ID <span style="color:red;font-size:15px;">*</span></label>
            <div class="form-group">
               <div class="input-group input-group-sm">
                  <input type="text" class="form-control forminputs typeahead" id="link" name="link"
                     placeholder="Enter video Id" autocomplete="off"
                     value="">
               </div>
               <p id="error_link" class="error-msg"></p>
            </div>
         </div>
         <div class="col-md-2">
            <label for=""></label>
               <br>
               <button type="submit" class="btn btn-sm action-button padbtn"
                  id="save_btn" style="margin-top: 4px;padding: 8px;">Save &nbsp;<i
                  class="fas fa-chevron-right"></i></button>
            </div>
         

      </div>
   </form>
   <!--- ---------------start hear listing ---------------------->
   <table id="video_partial_tbl" class="table customTbl table-bordered table-hover dataTable2">
      <thead>
         <tr>
            <th>Sl</th>
            <th style="width:150px;">Video Title</th>
            <th>Video ID</th>
            <th>Thumbnail Image</th>
            <th>Up/Down</th>
            <th>Set Precedence</th>
            <th>Status</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $i=1;
            $rowslno=$videolist;
            $media_tag = '';
            $table_name = '';
            $ref_id = '';
            foreach($videolist as $list){ 
               
            ?>
            <tr>
               <td><?php echo $i++; ?></td>
               <td><?php echo $list->title; ?></td>
               <td><?php echo $list->video_id; ?></td>
               <td>
                  <?php 
                  $image_url ="https://img.youtube.com/vi/".$list->video_id."/default.jpg";
                  $youtube_link= "https://www.youtube.com/watch?v=".$list->video_id;
                  ?>
                  <a href="<?php echo $youtube_link;?>" target="_blank"><img src="<?php echo $image_url; ?>" alt="" width="50"></a>
                  
               </td>
               <td>	
                  <img src="<?php echo base_url(); ?>assets-admin/img/up.png" alt="Active" title="up arrow" id="active" onclick="changeSerial(<?php echo($list->id);?>,<?php echo $list->precedence;?>,'U','<?php echo $media_tag; ?>','<?php echo $table_name;?>','<?php echo $ref_id;?>')"/ style="cursor:pointer;">
                  <img src="<?php echo base_url(); ?>assets-admin/img/down.png" alt="Active" title="down arrow" id="active" onclick="changeSerial(<?php echo($list->id);?>,<?php echo $list->precedence;?>,'D','<?php echo $media_tag; ?>','<?php echo $table_name;?>','<?php echo $ref_id;?>')"/ style="cursor:pointer;">


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
                        <button type="button" class="btn tbl-action-btn padbtn" onclick="changeSerial(<?php echo($list->id);?>,<?php echo $list->precedence;?>,'P','<?php echo $media_tag; ?>','<?php echo $table_name;?>','<?php echo $ref_id;?>')" style="margin: 3px -6px;"><i class="fas fa-sync-alt" aria-hidden="true" title="click for set precedence" ></i>    </button>   
                     </div> 
                  </div>                  
					</td>
               <td align="center"> <?php if($list->is_disabled == 0){ ?>
                  <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active" title="Active" id="<?php echo($list->id); ?>"  class="status" data-setstatus=1></a>
                  <?php } else{ ?>
                     <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive" title="Inactive" id="<?php echo($list->id); ?>" class="status" data-setstatus=0> </a>   
               <?php } ?>
               </td>
               <td style="text-align:center;">
                  <a href="javascript:void(0);" class="btn tbl-action-btn padbtn update_btn" 
                  data-id="<?php echo $list->id;?>"
                  data-title="<?php echo $list->title;?>"
                  data-videoid="<?php echo $list->video_id;?>"
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
