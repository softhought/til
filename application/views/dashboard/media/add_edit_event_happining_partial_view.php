<style type="text/css">
   .file {
   visibility: hidden;
   position: absolute;
   }
   .browse {
   margin-left: -20px !important;
   }
   #upload-asset-image {
   background-color: #f8f9fa; 
   padding: 20px; 
   border-radius: 10px; 
   }
   #upload-asset-image .fw-semibold {
   font-size: 16px; 
   }
   .custom-file-container {
   margin-bottom: 15px; 
   }
   .custom-file-upload {
   display: inline-block;
   padding: 10px 20px; 
   background-color: #ffc72c; 
   color: #fff; 
   border-radius: 5px; 
   cursor: pointer; 
   }
   .upload-text {
   margin-left: 10px;
   }
   .image-preview-item {
   margin-right: 10px;
   margin-bottom: 10px; 
   text-align: center; 
   }
   .image-preview-item img {
   width: 100px; 
   height: 100px; 
   border-radius: 5px; 
   margin-bottom: 5px; 
   }
   .image-delete {
    color: #323232;; 
    font-size: 16px; 
    margin-left: 5px; 
    cursor: pointer; 
}

.image-delete:hover {
    opacity: 0.8; 
}
</style>
<form name="eventsHappiningForm" id="eventsHappiningForm" enctype="multipart/form-data">
   <input type="text" id="mode" name="mode" value="<?php echo $mode; ?>">
   <input type="text" id="eventHappiningId" name="eventHappiningId" value="<?php echo $eventHappiningId; ?>">
   <div class="row">
      <div class="col-md-12">
         <label for="groupname">Title</label>
         <div class="form-group">
            <div class="input-group input-group-sm" id="titleerr">
               <input type="text" class="form-control" name="event_title" id="event_title" class="event_title" placeholder="Enter Title"
                  value="" autocomplete="off">
            </div>
         </div>
      </div>
   </div>

   <div class="row">
    <div class="col-md-12">
        <div id="upload-asset-image">
            <div class="row">
                <div class="col-md mb-12 mb-md-0">
                    <div id="imageAsset">
                        <div class="row">
                            <div class="col-12">
                                <div class="custom-file-container">
                                    <label class="custom-file-upload">
                                        <input type="file" id="fileName" class="file" name="fileName[]" multiple accept=".png,.jpeg,.jpg" />
                                        <i class="bx bx-plus"></i>
                                        <span class="upload-text">Upload Images</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 d-flex">
                                <div class="d-flex flex-wrap" id="image-asset-preview-container-edit"></div>
                                <div class="d-flex flex-wrap" id="image-asset-preview-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
