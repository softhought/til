<!-- <script src="<?php echo base_url();?>assets-admin/js/customJs/media.js"></script> -->
<style type="text/css">
   
   .file {
    visibility: hidden;
    position: absolute;
}

#detail_Document .form-group {
    margin-bottom: 0;
    padding: 4px;
}

.fa-trash-alt {
    color: #c01212;
    font-size: 15px;
    font-weight: bold;
}

.browse {
    margin-left: -20px !important;
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
   <form id="eventsHappiningForm" class="eventsHappiningForm" method="post">
      <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>">
      <input type="hidden" name="eventHappiningId" id="eventHappiningId" value="<?php echo $eventHappiningId; ?>">
      <div class="row">
         <div class="col-md-4">
            <label for="event_title">Event Title <span style="color:red;font-size:15px;">*</span></label>
            <div class="form-group">
               <div class="input-group input-group-sm">
                  <input type="text" class="form-control forminputs typeahead event_title" id="event_title" name="event_title"  placeholder="Enter Event Title" autocomplete="off" value="">
               </div>
               <p id="error_title" class="error-msg error_title"></p>
            </div>
         </div>
        
         <div class="col-md-4">
            <label for=""></label>
            <br>
            <button type="button" class="btn btn-sm action-button padbtn mutiple_img_btn"
               id="mutiple_img_btn" style="margin-top: 4px;padding: 8px;">Add Images &nbsp;<i
               class="fas fa-plus"></i></button>
         </div>
        
        
      </div>
    <!---- for mutiple images start ---->
      <div class="row">
         <div class="col-md-6 file-upload-section">
            <div class="row">
               <div id="mutiple_image_upload"></div>
            </div>
            
         </div>
        
      </div>
    <!---- for mutiple images end ---->
    <div class="row">
    <div class="col-md-2">
            <label for=""></label>
            <br>
            <button type="submit" class="btn btn-sm action-button padbtn"
               id="save_btn" style="margin-top: 4px;padding: 8px;">Save &nbsp;<i
               class="fas fa-chevron-right"></i></button>
         </div>
    </div>
   </form>
</section>
