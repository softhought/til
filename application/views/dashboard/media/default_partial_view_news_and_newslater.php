<style type="text/css">
   .file {
      visibility: hidden;
      position: absolute;
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
<form id="newsandnewslaterForm" class="newsandnewslaterForm" method="post" enctype="multipart/form-data">
   <input type="hidden" name="media_tag" id="media_tag" value="">
   <input type="hidden" name="mediaMasterId" id="mediaMasterId" value="">
   <input type="hidden" name="mode" id="mode" class="mode" value="ADD">
   <input type="hidden" name="docID" id="docID" value="">
   <div class="row">
      <div class="col-md-4">
         <label for="title_desc">Title Description <span style="color:red;font-size:15px;">*</span></label>
         <div class="form-group">
            <div class="input-group input-group-sm">
               <input type="text" class="form-control forminputs typeahead title_desc" id="title_desc" name="title_desc"
                  placeholder="Enter Description" autocomplete="off" value="">

            </div>
            <p id="error_title" class="error-msg error_title"></p>
         </div>
      </div>
      <div class="col-md-4">
         <div class="row">
            <div class="col-md-10">
               <label for="upload_doc">Upload Document <span style="color:red;font-size:15px;">*</span></label>
               <input type="file" name="fileName" class=" file fileName" id="fileName" accept="application/pdf">
               <div class="form-group">
                  <div class="input-group input-group-sm">
                     <input type="text" name="userFileName" id="userFileName" class="form-control input-xs userFileName"
                        readonly placeholder="Upload Document" value=''>
                     <input type="hidden" name="isChangedFile" id="isChangedFile" class="isChangedFile" value="N">
                     <input type="hidden" name="prvFilename" id="prvFilename" class="form-control prvFilename" value=""
                        readonly>
                     <input type="hidden" name="randomFileName" id="randomFileName" class="form-control randomFileName"
                        value="" readonly>
                     <span class="input-group-btn">
                     </span>
                  </div>
               </div>
               <p id="error_file" class="error-msg error_file"></p>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <button class="browse btn input-xs btn-sm" type="button" style="background: #f8bb06; color:#000; padding-top: 10px;
                           margin-top: 32px;
                           margin-left: -50px !important;" id="uploadBtn">
                     <i class="fa fa-folder-open" aria-hidden="true"></i>
                  </button>
               </div>
            </div>
         </div>
      </div>
      <!--- for file upload end-->
      <div class="col-md-4">
         <label for=""></label>
         <br>
         <button type="submit" class="btn btn-sm action-button padbtn save_btn" id="save_btn"
            style="padding: 8px; margin-top:10px;">Save &nbsp;<i class="fas fa-chevron-right"></i></button>
         <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
            style="display:none;width: 60%;">Updating...</span>
      </div>
   </div>
</form>