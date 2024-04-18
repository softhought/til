<!-- <script src="<?php echo base_url();?>assets-admin/js/customJs/media.js"></script> -->
<form id="newsandnewslaterForm" class="newsandnewslaterForm" method="post" enctype="multipart/form-data">
    <input type="text" name="media_tag" id="media_tag" value="<?php echo $list->menu_tag; ?>"><br>
    <input type="text" name="mediaMasterId" id="mediaMasterId" value="<?php echo $list->media_master_id; ?>"><br>
    <input type="text" name="mode" id="mode" class="mode" value="ADD"><br>
    <input type="text" name="docID" id="docID" value="<?php echo $doc_id; ?>"><br>
      <div class="row">
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
               <input type="file" name="file" id="file" class="custom-file-input">
               <label class="custom-file-label" for="exampleInputFile">Choose file</label>
               <input type="hidden" name="isdocument" id="isdocument" value="N">
            </div>
         </div>
         
         <div class="col-md-2">
            <label for=""></label>
               <br>
               <button type="submit" class="btn btn-sm action-button padbtn save_btn"
                  id="save_btn" style="margin-top: 4px;padding: 8px;">Save &nbsp;<i
                  class="fas fa-chevron-right"></i></button>
            </div>
         

      </div>
   </form>