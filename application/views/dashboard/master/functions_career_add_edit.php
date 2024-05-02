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
           var functions_id = $('#functions_id').val();
           var mode = $('#mode').val();
           var functions_name = $('#functions_name').val();
          
   
   
           if (Validate()) {
   
               $("#savebtn").css('display', 'none');
               $("#loaderbtn").css('display', 'inline-block');
   
               $.ajax({
                   type: "POST",
                   url: basepath + 'master/functions_career_action',
                   dataType: "json",
                   contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                   data: {
                      functions_id: functions_id,
                       mode: mode,
                       functions_name: functions_name
                   },
                   success: function(result) {
                       if (result.msg_status == 1) {
                           Toast.fire({
                               type: "success",
                               title: result.msg_data,
                           });
                           $("#savebtn").css('display', 'inline-block');
                           $("#loaderbtn").css('display', 'none');
                           window.location.href = basepath + 'master/functions_career';
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
   var functions_name = $('#functions_name').val();
   if (functions_name == "") {
       $("#functions_name").focus().addClass("err-border");
       Toast.fire({
           type: "error",
           title: "Enter functions name",
       });
       return false;
   }



   return true;

}
  
  
function validateEmail(email) {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }
</script>
<section class="layout-box-content-format1">
   <div class="card card-primary form-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Careers Functions </h3>
          <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" > 
          <a href="<?php echo base_url(); ?>master/functions_career" class="btn btn-info btnpos">
            <i class="fas fa-clipboard-list"></i> List </a> 
       </div>            
      </div>
      <!-- /.card-header -->
      <form name="sectorFrom" id="sectorFrom" enctype="multipart/form-data">
         <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
         <input type="hidden" name="functions_id" id="functions_id" value="<?php echo $bodycontent['functionsid']; ?>">
         <div class="card-body">
            <div class="formblock-box">
       
           
               <div class="row">    
               <div class="col-md-2">   </div>
                  <div class="col-md-8">
                     <label for="groupname"> Functions Name
                     <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="functions_name" id="functions_name"
                              placeholder="Enter Functions Name" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['functionEditdata']->name;}?>" autocomplete="off">
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
