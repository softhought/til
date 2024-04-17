<script src="<?php echo base_url();?>assets-admin/js/customJs/user.js"></script>
<?php if($this->session->flashdata('success')){ ?>
<div class="alert alert-success alert-dismissible">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   <h5><i class="icon fas fa-check"></i> Success!</h5>
   <?php echo $this->session->flashdata('success'); ?>
</div>
<?php }?>
<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-success alert-dismissible">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   <h5><i class="icon fas fa-check"></i> Success!</h5>
   <?php echo $this->session->flashdata('error'); ?>
</div>
<?php }?>
<?php accesspermissionMicro("page","user","view"); ?>
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Media List</h3>
         <div class="btn-group btn-group-sm float-right <?php echo accesspermissionMicro("button","user","add"); ?>" role="group" aria-label="MoreActionButtons">
            <a href="<?php echo base_url(); ?>media/add_edit_media" class="btn btn-info btnpos link_tab">
            <i class="fas fa-plus"></i> Add </a>
         </div>
         <!--  <a href="<?php echo base_url();?>user/create" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a> -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="formblock-box">
            <table id="example2" class="table customTbl table-bordered table-hover dataTable">
               <thead>
                  <tr>
                     <th>Sl</th>
                     <th>Banner Image</th>
                     <th>Video Title</th>
                     <th>Video Link</th>
                     <th>Action</th>
                  </tr>
               </thead>
              
            </table>
         </div>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>

