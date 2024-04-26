<script type="text/javascript">
   $(document).ready(function() {
   

       var Toast = Swal.mixin({  
           toast: true,
           position: "top-end",
           showConfirmButton: false,
           timer: 3000,
       });
   
       var basepath = $("#basepath").val();
   

       $(document).on('click', '#savebtn', function(event) {
           event.preventDefault();
           $("#errormsg").text('');
           var current_opening_id = $('#current_opening_id').val();
           var mode = $('#mode').val();
           var opening_type = $('#opening_type').val();
           var opening_title = $('#opening_title').val();
           var opening_description = $('#opening_description').val();
   
   
           if (Validate()) {
   
               $("#savebtn").css('display', 'none');
               $("#loaderbtn").css('display', 'inline-block');
   
               $.ajax({
                   type: "POST",
                   url: basepath + 'master/current_opening_action',
                   dataType: "json",
                   contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                   data: {
                     current_opening_id: current_opening_id,
                       mode: mode,
                       opening_type: opening_type,
                       opening_title: opening_title,
                       opening_description: opening_description,
                   },
                   success: function(result) {
                       if (result.msg_status == 1) {
                           Toast.fire({
                               type: "success",
                               title: result.msg_data,
                           });
                           $("#savebtn").css('display', 'inline-block');
                           $("#loaderbtn").css('display', 'none');
                           window.location.href = basepath + 'master/current_openings';
                       } else {
                           Toast.fire({
                               type: "error",
                               title: result.msg_data,
                           });
                       }
                   },
   
                   error: function(jqXHR, exception) {
                       var msg = '';
                       if (jqXHR.status === 0) {
                           msg = 'Not connect.\n Verify Network.';
                       } else if (jqXHR.status == 404) {
                           msg = 'Requested page not found. [404]';
                       } else if (jqXHR.status == 500) {
                           msg = 'Internal Server Error [500].';
                       } else if (exception === 'parsererror') {
                           msg = 'Requested JSON parse failed.';
                       } else if (exception === 'timeout') {
                           msg = 'Time out error.';
                       } else if (exception === 'abort') {
                           msg = 'Ajax request aborted.';
                       } else {
                           msg = 'Uncaught Error.\n' + jqXHR.responseText;
                       }
                       // alert(msg);  
                   }
               }); /*end ajax call*/
   
           }
   
       });
   
   
   });

   function Validate() {
   
   var Toast = Swal.mixin({
       toast: true,
       position: "top-end",
       showConfirmButton: false,
       timer: 3000,
   });

   $(".err-border").removeClass("err-border");
   var opening_type = $('#opening_type').val();
   var opening_title = $('#opening_title').val();
   var opening_description = $('#opening_description').val();
   if (opening_type == "0") {
       $("#opening_typeerr").focus().addClass("err-border");
       Toast.fire({
           type: "error",
           title: "Select opening type",
       });
       return false;
   }

   if (opening_title == "") {
       $("#opening_title").focus().addClass("err-border");
       Toast.fire({
           type: "error",
           title: "Enter opening title",
       });
       return false;
   }

   if (opening_description == "") {
       $("#opening_description").focus().addClass("err-border");
       Toast.fire({
           type: "error",
           title: "Enter opening description",
       });
       return false;
   }

   return true;

}
   
</script>
<section class="layout-box-content-format1">
   <div class="card card-primary form-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Current Openings</h3>
          <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" > 
          <a href="<?php echo base_url(); ?>master/current_openings" class="btn btn-info btnpos">
            <i class="fas fa-clipboard-list"></i> List </a> 
       </div>            
      </div>
      <!-- /.card-header -->
      <form name="sectorFrom" id="sectorFrom" enctype="multipart/form-data">
         <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
         <input type="hidden" name="current_opening_id" id="current_opening_id" value="<?php echo $bodycontent['upeningId']; ?>">
         <div class="card-body">
            <div class="formblock-box">
               <!-- <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Info</h3> -->
              
              <?php $jobType = array("PT"=>"Part Time","FT"=>"Full Time"); ?>
           
               <div class="row"> <div class="col-md-2"></div>
               <div class="col-md-3">
                                <label for="user_role_id">Job Type *</label>
                                <div id="sel_chaptererr" class="form-group">
                                    <div class="input-group input-group-sm" id="opening_typeerr">
                                        <select class="form-control select2" data-show-subtext="true"
                                            name="opening_type" id="opening_type" data-live-search="true">
                                            <option value="0">Select</option>
                                             <?php foreach ($jobType as $key => $value) {
                               
                                                 ?>
                                            <option value="<?php echo $key; ?>" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['openingEditdata']->opening_type==$key)
                                            {echo "selected";}?>><?php echo $value; ?></option>
                                            <?php  }  ?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                  <div class="col-md-5">
                     <label for="groupname"> Job Title
                     <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="opening_title" id="opening_title"
                              placeholder="Enter Job Title" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['openingEditdata']->opening_title;}?>" autocomplete="off">
                        </div>
                     </div>
                  </div>
              


               </div>
               <div class="row"><div class="col-md-2"></div>
               <div class="col-md-8">
                     <label for="groupname"> Job Description
                     <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <textarea  class="form-control" name="opening_description" id="opening_description" cols="30" rows="3" ><?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['openingEditdata']->opening_description;}?></textarea>
                         
                        </div>
                     </div>
                  </div>
                   </div>
            </div>
         </div>
         <!-- /.card-body -->
         <div class="formblock-box">
            <div class="row">
               <div class="col-md-10">
                  <p id="errormsg" class="errormsgcolor"></p>
               </div>
               <div class="col-md-2 text-right">
                  <button type="submit" class="btn btn-sm action-button" id="savebtn"
                     style="width: 80%;"><?php echo $bodycontent['btnText']; ?>&nbsp;<i class="fas fa-chevron-right"></i></button>
                  <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                     style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
            </div>
         </div>
      </form>
   </div>
   <!-- /.card -->
</section>
