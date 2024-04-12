<script type="text/javascript">
$(document).ready(function() {


var basepath = $("#basepath").val();

   

       $(document).on("click", ".status", function() {
        
    var uid = $(this).data("restrictedid");
        var status = $(this).data("setstatus");
        var url = basepath + 'user/setrestrictedURLStatus';
        setActiveStatus(uid, status, url);

    });



   }); // end of document ready 
  

function setActiveStatus(uid,status,path)
{
  
  $.ajax({
      type: "POST",
      url:  path,
      data: {uid:uid,setstatus:status},
      dataType: 'json',
      contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
      success: function (result) {
        if(result.msg_status=1)
        {
          location.reload();
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
        alert(msg);  
        }
    }); /*end ajax call*/
}

</script>

<style type="text/css">
  .activebtn {
    background: linear-gradient(90deg, #4EEB38 0%, #527e56 100%) !important;
}
.inactivebtn {
    background:linear-gradient(90deg, #EB4038 0%, #6f5748 100%) !important;


}
</style>

  <section class="layout-box-content-format1">

        <div class="card card-primary">

            



            <div class="card-header box-shdw">

              <h3 class="card-title">Restricted URL List</h3>



              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

              



              </div>

      <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
      <a href="<?php echo base_url(); ?>user/addRestrictedURL" class="btn btn-default <?php echo accesspermission('Add');?>"><i class="fas fa-plus"></i> Add </a>
      </div>

            </div><!-- /.card-header -->



            <div class="card-body">

              <div class="formblock-box">

              <div id="response_msg"></div>
              <div id ="studentlist">
              <table class="table customTbl table-bordered table-striped dataTable <?php echo accesspermission('View');?>">

                <thead>
  <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th >URL</th>
                
                 
                  <th style="width:10%;">Restricted </th>
                   <th style="width:5%;">Blocked</th> 
                   <th style="width:5%;" >Edit</th> 
                   <th style="width:10%;" >Action</th> 
               
               
                </tr>

                </thead>

               <tbody>
               
                <?php 
                  
                      $i = 1;
                      $row=1;
                      foreach ($bodycontent['restrictedUrlList'] as $value) {
                         $status = "";
                        if($value->is_active=="Y")
                        {
                          $status = '<div class="status_dv "><span class="badge badge-success status_tag status" data-setstatus="N" data-restrictedid="'.$value->restricted_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                        }
                        else
                        {
                          $status = '<div class="status_dv"><span class="badge badge-danger status_tag status" data-setstatus="Y" 
                          data-restrictedid="'.$value->restricted_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                        }   
                     
                        
                       
                ?>

                    <tr>
                        <td ><?php echo $i; ?></td>
                        
            
                        <td style="font-weight: bold;color: #c41f1f;"><?php echo $value->url; ?></td>                                              
                                                                     
                                                   
                        <td>
                          <?php
                  
                  
                    ?>
          <span class="badge badge-warning"><?php 

                    if ($value->user_role=='SADM') {
                      echo "Super Admin";
                    }else if($value->user_role=='ADM'){
                       echo "Admin";
                    }else if($value->user_role=='RIC'){
                       echo "Regional In-Charge";
                    }else if($value->user_role=='BM'){
                       echo "Site In-Charge";
                    }else{
                       echo "Developer";
                    }

           ?></span>
                     
                   
                
                          </td> 
                        <td style="text-align: center;"><?php

                          if ($value->is_active=="Y") {?>
                           <b style="color: red;">Yes</b>
                         <?php }else{?>
                           <b style="color: green;">No</b>
                        <?php  }
                        ?></td>                            
                           <td >
                          <a href="<?php echo base_url(); ?>user/addRestrictedURL/<?php echo $value->restricted_id; ?>" class="btn tbl-action-btn padbtn" data-title="Edit">
                             <i class="fas fa-edit"></i> 
                          </a>
                        </td> 
                        <td ><?php echo $status; ?></td>                       
                       
                    </tr>                   
                <?php
                    $i++;$row++;
                  }

                ?>
                </tbody>

              </table>

              </div>




              </div>



            </div><!-- /.card-body -->

        </div><!-- /.card -->

  </section>