<script type="text/javascript">
$(document).ready(function() {

var basepath = $("#basepath").val();

$(document).on('click','#verificationsavebtn',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
       
          var column_name = $('#column_name').val();
          var table_name = $('#table_name').val();
          var error_msg = $('#error_msg').val();
          var mode = $('#mode').val();
          var verificationId = $('#verificationId').val();
          $("#column_nameerr,#table_nameerr,#error_msg").removeClass('form_error');
          if(table_name == ''){
               $("#table_nameerr").addClass('form_error');
                $("#table_name").focus();
               return false;    
            }
            if(column_name == '0'){
               $("#column_nameerr").addClass('form_error');
                $("#column_name").focus();
               return false;    
            }

             if(error_msg == ''){
               $("#error_msg").addClass('form_error');
                $("#error_msg").focus();
               return false;    
            }
                    
            $("#verificationsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
               
        $.ajax({
                type: "POST",
                url: basepath+'Verification/verification_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                data: {verificationId:verificationId,mode:mode,column_name:column_name,table_name:table_name,error_msg:error_msg},
                success: function (result) {

                if (result.msg_status == 1) {
                    
                      $("#sectorsavebtn").css('display', 'inline-block');
                      $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'Verification';
      
                } 
                  
                   
                }, 
                error: function (jqXHR, exception) {
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
        
 


        
    });

    $(document).on("change", "#table_name", function() {
        var table_name=$('select[name=table_name]').val();

      
    $.ajax({
    type: "POST",
    url: basepath+'verification/getTableColumns',
    data: {table_name:table_name},
    
    success: function(data){
        $("#column_nameerr").html(data);
        $('#column_name').select2();
    },
    error: function (jqXHR, exception) {
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



    });/*end ajax call*/

    });


});


</script>


<section class="layout-box-content-format1">

        <div class="card card-primary">

                      <div class="card-header box-shdw">
                        <h3 class="card-title">Data Verification</h3>
                        <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                        <a href="<?php echo base_url(); ?>verification" class="btn btn-info btnpos">
                        <i class="fas fa-clipboard-list"></i> List </a>
                          </div>           
                      </div><!-- /.card-header -->

                       <div class="<?php echo accesspermission('View');?>">

                    <form name="sectorFrom" id="sectorFrom" enctype="multipart/form-data">
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
                       <input type="hidden" name="verificationId" id="verificationId" value="<?php echo $bodycontent['verificationId']; ?>">  
                  <div class="card-body">



                    <div class="formblock-box">
                        <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Verification Info</h3>   
                            <div class="row">
                              <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                      <label for="groupname">Table  *
                                      <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                                        <div class="form-group">
                                        <div class="input-group input-group-sm" id="table_nameerr">
                                        <select class="form-control select2" data-show-subtext="true" name="table_name" id="table_name"  data-live-search="true" >
                                         <option  value="">Select</option>
                                        <?php foreach ($bodycontent['tableList'] as $value) { ?>
                                            <option  value="<?php echo $value; ?>" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['verificationEditdata']->table_name==$value)
                                            {echo "selected";}?> ><?php echo $value; ?></option>   
                                        <?php  }  ?>                                        
                                    </select>
                                      </div>
                                    </div>                        
                                    </div> 
                                         
                                </div> 
                         <div class="row">
                              <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                      <label for="groupname">Table Column *
                                      <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                                        <div class="form-group">
                                        <div class="input-group input-group-sm" id="column_nameerr">
                                        <select class="form-control select2" data-show-subtext="true" name="column_name" id="column_name"  data-live-search="true" >
                                         <option  value="0">Select</option>
                                        <?php foreach ($bodycontent['tableColumn'] as $value) { ?>
                                            <option  value="<?php echo $value; ?>" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['verificationEditdata']->column==$value)
                                            {echo "selected";}?> ><?php echo $value; ?></option>   
                                        <?php  }  ?>                                        
                                    </select>
                                      </div>
                                    </div>                        
                                    </div> 
                                         
                                </div>                       
                              <div class="row">
                              <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                      <label for="groupname">Error Message *
                                      <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                                        <div class="form-group">
                                        <div class="input-group input-group-sm">
                                          <input type="text" class="form-control" name="error_msg" id="error_msg" placeholder="Enter message" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['verificationEditdata']->error_msg; } ?>" autocomplete="off">
                                      </div>
                                    </div>                        
                                    </div> 
                                         
                                </div>
  

                      </div>



                    </div>  <!-- /.card-body -->



               <div class="formblock-box">
                   <div class="row <?php if($bodycontent['mode']=='EDIT'){echo accesspermission('Edit');}?>">
                          <div class="col-md-10">                    
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="verificationsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>
                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>

                           </div>               
                   </div>                 
                 </div>





             </form>

       </div>

         

        </div><!-- /.card -->


  </section>

  



