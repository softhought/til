<script type="text/javascript">
$(document).ready(function() {


var basepath = $("#basepath").val();

   





   }); // end of document ready 
  



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

              <h3 class="card-title">Verification List</h3>



              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

              



              </div>

      <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
      <a href="<?php echo base_url(); ?>verification/addVerification" class="btn btn-default <?php echo accesspermission('Add');?>"><i class="fas fa-plus"></i> Add </a>
      </div>

            </div><!-- /.card-header -->



            <div class="card-body">

              <div class="formblock-box">

              <div id="response_msg"></div>
              <div id ="studentlist">
              <table class="table customTbl table-bordered table-striped dataTable <?php echo accesspermission('View');?>">

                <thead>

                    <tr>

                    <th width="5%">Sl No</th>


                   
                    <th width="20%">Table</th>
                    <th width="40%">Column</th>
                    <th width="50%">Error Message</th>

                    <th width="5%">Action</th>

                                        

                    </tr>

                </thead>

                <tbody>



                <?php $i=1;

                foreach ($bodycontent['verificationList'] as $verificationlist) { 

                   


                  ?>

                   <tr>

                   <td><?php echo $i++; ?></td>

                 
                   <td><?php echo $verificationlist->table_name; ?></td>
                   <td><?php echo $verificationlist->column; ?></td>
                   <td><?php echo $verificationlist->error_msg; ?></td>
              
                   
                 
                 
                  <td>
                   
                    
                     <a href="<?php echo base_url(); ?>verification/addVerification/<?php echo $verificationlist->ver_id; ?>" class="btn tbl-action-btn padbtn">

                   <i class="fas fa-edit"></i> 

                  </a>
                
                    
              
                  </td>





                 </tr>

                <?php } ?>                       

                         

                </tbody>

              </table>

              </div>




              </div>



            </div><!-- /.card-body -->

        </div><!-- /.card -->

  </section>