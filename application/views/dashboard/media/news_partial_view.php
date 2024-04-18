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
<div class="partial_view_news_and_newslater">

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
            foreach($srl_no as $list){ ?>
            <tr>
               <td><?php echo $i++; ?></td>
               <td><?php echo $list->title; ?></td>
               <td><?php echo $list->file_name; ?></td>
               <td>Up/Down</td>
               <td><?php echo $list->precedence; ?></td>
               <td align="center"> <?php if($list->is_disabled == 0){ ?>
                  <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active" title="Active" id="<?php echo($list->doc_id); ?>"  class="status" data-setstatus=1></a>
                  <?php } else{ ?>
                     <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive" title="Inactive" id="<?php echo($list->doc_id); ?>" class="status" data-setstatus=0> </a>   
               <?php } ?>
               </td>
               <td style="text-align:center;">
                  <a href="javascript:void(0);" class="btn tbl-action-btn padbtn update_news_newslater" 
                  data-id="<?php echo $list->doc_id;?>"
                  data-title="<?php echo $list->title;?>"
                  data-filename="<?php echo $list->file_name;?>"
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
