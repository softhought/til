<script src="<?php echo base_url();?>assets-admin/js/customJs/media.js"></script>
<style>
   .select2-container--default .select2-selection--multiple .select2-selection__choice {
   background-color: #7a2386;
   border: 1px solid #fff;
   }
</style>
<section class="layout-box-content-format1">
   <form id="videoForm" class="videoForm" method="post">
      <input type="text" name="mode" id="mode" value="<?php echo $mode; ?>">
      <input type="text" name="videoId" id="videoId" value="<?php echo $videoId; ?>">
      <div class="row">
         <div class="col-md-3">
            <label for="title">Video Title *</label>
            <div class="form-group">
               <div class="input-group input-group-sm">
                  <input type="text" class="form-control forminputs typeahead" id="title" name="title"
                     placeholder="Enter Title" autocomplete="off"
                     value="">
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <label for="link">Video Link *</label>
            <div class="form-group">
               <div class="input-group input-group-sm">
                  <input type="text" class="form-control forminputs typeahead" id="link" name="link"
                     placeholder="Enter Link" autocomplete="off"
                     value="">
               </div>
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
   <table id="example2" class="table customTbl table-bordered table-hover dataTable2">
      <thead>
         <tr>
            <th>Sl</th>
            <th>Video Title</th>
            <th>Video Link</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $i=1;
            foreach($videolist as $list){ ?>
            <tr>
               <td><?php echo $i++; ?></td>
               <td><?php echo $list->title; ?></td>
               <td><?php echo $list->video_id; ?></td>
               <td style="text-align:center;">
                  <a href="javascript:void(0)" class="btn tbl-action-btn padbtn update_btn" 
                  data-id=<?php echo $list->id;?>
                  data-title=<?php echo $list->title;?>
                  data-videoid=<?php echo $list->video_id;?>
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
