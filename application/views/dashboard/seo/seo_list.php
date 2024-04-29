
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Seo Details </h3>
         <div class="btn-group btn-group-sm float-right " role="group" aria-label="MoreActionButtons">
            <a href="<?php echo base_url(); ?>seodata/seo_data_create" class="btn btn-info btnpos link_tab">
            <i class="fas fa-plus"></i> Add </a> 
         </div> 
       
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="formblock-box">
            <table id="example2" class="table customTbl table-bordered table-hover dataTable" >
               <thead>
                  <tr>
                     <th>Sl</th>
                     <th>Page URL</th>
                     <th>Page Title</th>
                     <!-- <th>Meta Tag</th> -->
                     <th>Meta Description</th>
                     <th>Action</th>
                   
                  </tr>
               </thead>
               <tbody>
                  <?php 
                    $sl=1;
                     foreach ($bodycontent['seodataList'] as $list) { ?>
                  <tr>
                     <td><?php echo $sl++; ?> </td>
                     <td><?php echo $list->page_url; ?> </td>
                     <td><?php echo $list->page_title; ?> </td>
                     <!-- <td><?php echo $list->meta_tag; ?> </td> -->
                     <td><?php echo $list->meta_description; ?> </td>
                     <td>
                     <a href="<?php echo base_url(); ?>seodata/seo_data_create/<?php echo $list->seo_dtl_id; ?>"
                              class="btn tbl-action-btn padbtn">
                           <i class="fas fa-edit"></i>
                           </a>
                     </td>
                   
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>