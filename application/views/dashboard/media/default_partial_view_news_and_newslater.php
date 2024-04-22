<!-- <script src="<?php echo base_url();?>assets-admin/js/customJs/media.js"></script> -->
<style type="text/css">

.file {
    visibility: hidden;
    position: absolute;
}


.table td,
.table th {
    vertical-align: middle !important;
}

/* .tablepad th,
td {
    padding: 0px 0px !important;
} */

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
<form id="newsandnewslaterForm" class="newsandnewslaterForm" method="post" enctype="multipart/form-data">
   <input type="hidden" name="media_tag" id="media_tag" value="<?php echo $list->menu_tag; ?>"><br>
   <input type="hidden" name="mediaMasterId" id="mediaMasterId" value="<?php echo $list->media_master_id; ?>"><br>
   <input type="hidden" name="mode" id="mode" class="mode" value="ADD"><br>
   <input type="hidden" name="docID" id="docID" value="<?php echo $doc_id; ?>"><br>
   <!-- <div class="row">
      <div class="col-md-3">
         <label for="title_desc">Title Description <span style="color:red;font-size:15px;">*</span></label>
         <div class="form-group">
            <div class="input-group input-group-sm">
               <input type="text" class="form-control forminputs typeahead" id="title_desc" name="title_desc" placeholder="Enter Description" autocomplete="off" value="">
                 
            </div>
            <p id="error_title_desc" class="error-msg"></p>
         </div>
      </div>
      
      <div class="col-md-3">
         <label for="upload_document">&nbsp;</label>
         <div class="custom-file">
            <input type="file" name="file" id="file" class="custom-file-input" onchange="displayFileName()">
            <label class="custom-file-label" for="file" id="file-label">Choose file</label>
            <input type="hidden" name="isdocument" id="isdocument" value="N">
            <input type="hidden" class="isdocumentname" name="isdocumentname" id="isdocumentname" value="">
         </div>
      </div>
      
      
      <div class="col-md-2">
         <label for=""></label>
            <br>
            <button type="submit" class="btn btn-sm action-button padbtn save_btn"
               id="save_btn" style="margin-top: 4px;padding: 8px;">Save &nbsp;<i
               class="fas fa-chevron-right"></i></button>
         </div>
      
      
      </div> -->
         <div class="row">
            <!-- <div class="col-md-4">
              
               <div class="input-group input-group-sm">
                 
                  <input type="text" class="form-control forminputs typeahead title_desc" id="title_desc" name="title_desc"  placeholder="Enter Description" autocomplete="off" value="">
                  
                  
               </div>
               <p id="error_title" class="error-msg"></p>
               
            </div> -->

            <div class="col-md-4">
               <label for="title_desc">Title Description <span style="color:red;font-size:15px;">*</span></label>
               <div class="form-group">
                  <div class="input-group input-group-sm">
                  <input type="text" class="form-control forminputs typeahead title_desc" id="title_desc" name="title_desc"  placeholder="Enter Description" autocomplete="off" value="">
                     
                  </div>
                  <p id="error_title" class="error-msg error_title"></p>
               </div>
            </div>



            <!--- for file upload start-->
            <div class="col-md-4">
               <div class="row">
                 
               
                  <div class="col-md-10">
                  <label for="upload_doc">Upload Document <span style="color:red;font-size:15px;">*</span></label>
                  <input type="file" name="fileName" class=" file fileName" id="fileName" accept="application/pdf">
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" name="userFileName" id="userFileName"
                              class="form-control input-xs userFileName" readonly placeholder="Upload Document" value=''>
                           <input type="hidden" name="isChangedFile" id="isChangedFile" class="isChangedFile"
                              value="N">
                              <input type="hidden" name="prvFilename" id="prvFilename"
                                 class="form-control prvFilename" value="" readonly>
                              <input type="hidden" name="randomFileName" id="randomFileName"
                                 class="form-control randomFileName" value="" readonly>   
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
                           margin-left: -50px !important;"
                           id="uploadBtn">
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
            <button type="submit" class="btn btn-sm action-button padbtn save_btn"
               id="save_btn" style="padding: 8px; margin-top:10px;">Save &nbsp;<i
               class="fas fa-chevron-right"></i></button>
            </div>
         </div>
         
         <!-- <input type="hidden" name="prvFilename" id="prvFilename"
            class="form-control prvFilename" value="" readonly>
         <input type="hidden" name="randomFileName" id="randomFileName"
            class="form-control randomFileName" value="" readonly>
         <input type="hidden" name="docDetailIDs" id="docDetailIDs"
            class="form-control randomFileName" value="0" readonly> -->
    
      
         
      
     
   
</form>
