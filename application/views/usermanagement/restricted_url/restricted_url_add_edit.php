<script type="text/javascript">
  $(document ).ready(function() {
    var basepath = $("#basepath").val();
    $(document).on('submit','#restrictedForm',function(e){
    e.preventDefault();


    if(validate())
    {

          
            var formDataserialize = $("#restrictedForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'user/restricted_action';
            $("#savebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
          if (result.msg_status == 1) {
              
         

                          window.location.href=basepath+'user/restrictedURL';

                    } 
          else {
                        $("#lho_response_msg").text(result.msg_data);
                    }
          
                    $("#loaderbtn").css('display', 'none');
          
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
            
            
            
      
    }

    });




  });/* end of document ready */

  function validate()
{
    
    var restricted_url = $("#restricted_url").val();
    var sel_users = $("#sel_users").val();
   

    $("#error_msg").text("").css("dispaly", "none").removeClass("form_error");

    if(restricted_url=="")
    {
        $("#restricted_url").focus();
        $("#error_msg")
        .text("Error : Enter Restricted URL")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
      if(sel_users=="")
    {
        $("#sel_users").focus();
        $("#error_msg")
        .text("Error : Select user type")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }





  return true;
}
</script>   
<style type="text/css">
   .check-mark{
  color:#5bce5b;
}
</style>

<section class="layout-box-content-format1">

        <div class="card card-primary">

                      <div class="card-header box-shdw">
                        <h3 class="card-title">Restricted URL</h3>
                        <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                        <a href="<?php echo base_url(); ?>user/restrictedURL" class="btn btn-info btnpos">
                        <i class="fas fa-clipboard-list"></i> List </a>
                          </div>           
                      </div><!-- /.card-header -->


<div class="<?php echo accesspermission('View');?>">
                    <form name="restrictedForm" id="restrictedForm" enctype="multipart/form-data">
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
                       <input type="hidden" name="restrictedID" id="restrictedID" value="<?php echo $bodycontent['restrictedID']; ?>">  
                  <div class="card-body">



                    <div class="formblock-box">
                        <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Info</h3>                          
                              <div class="row">
                              <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                      <label for="groupname">Restricted URL *
                                      <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                                        <div class="form-group">
                                        <div class="input-group input-group-sm">
                                          <input type="text" class="form-control" name="restricted_url" id="restricted_url" placeholder="Enter URL" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['restrictedEditdata']->url; } ?>" autocomplete="off">
                                      </div>
                                    </div>                        
                                    </div> 
                                         
                                </div>

                                     <div class="row">
                              <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                      <label for="groupname">Restricted For User Type *
                                      <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                                        <div class="form-group">
                                        <div class="input-group input-group-sm">
                                          <select id="sel_users" name="sel_users[]" class="form-control selectpicker"
                        data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple" >
                        
                          <?php 
                            if($bodycontent['userTypeList'])
                            {
                              foreach($bodycontent['userTypeList'] as $value)
                              { ?>
                    <option value="<?php echo $value->role; ?>"
                      <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['restrictedEditdata']->user_role==$value->role){echo "selected";}else{echo "";}  ?>
                      ><?php echo $value->role ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                                      </div>
                                    </div>                        
                                    </div> 
                                         
                                </div>
  

                      </div>



                    </div>  <!-- /.card-body -->



               <div class="formblock-box">
                   <div class="row ">
                          <div class="col-md-10">                    
                          <p id="error_msg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="savebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>
                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>

                           </div>               
                   </div>                 
                 </div>





             </form>

       </div>

         

        </div><!-- /.card -->


  </section>

  



