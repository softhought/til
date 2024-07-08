<script src="<?php echo base_url(); ?>assets-admin/js/customJs/investor_relations.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo (base_url()); ?>assets-admin/plugins/ckeditor5/styles.css"> -->

<style>
   #example th:nth-child(1),
#example td:nth-child(1) {
    width: 10%; /* Set width of first column */
}

#example th:nth-child(2),
#example td:nth-child(2) {
    width: 80%; /* Set width of second column */
}
</style>

<div class="card card-primary card-outline card-tabs">
   <div class="card-header p-0 pt-1 border-bottom-0">
      <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
         <li class="nav-item">
            <a class="nav-link" id="tab_one-tab" data-toggle="pill" href="#tab_one" role="tab"
               aria-controls="tab_one" aria-selected="true">Corporate Governance</a>
         </li>

         <li class="nav-item">
            <a class="nav-link" id="tab_two-tab" data-toggle="pill" href="#tab_two" role="tab" aria-controls="tab_two"
               aria-selected="false" data-mediatag="gdf">Shareholders Information</a>
         </li>

         <li class="nav-item">
            <a class="nav-link" id="tab_three-tab" data-toggle="pill" href="#tab_three" role="tab"
               aria-controls="tab_three" aria-selected="false">Financials</a>
         </li>

         <li class="nav-item">
            <a class="nav-link" id="tab_four-tab" data-toggle="pill" href="#tab_four" role="tab"
               aria-controls="tab_four" aria-selected="false">Notice</a>
         </li>

      </ul>
   </div>
   <div class="card-body">
      <a href="javascript:;" class="btn btn-warning btnpos showaddbtn" data-toggle="modal"
         data-target="#investorRelationsDetails" style="margin-right:10px;"><i class="fas fa-plus"></i> Add </a>
      <!-- <a href="javascript:;" class="btn btn-warning btnpos hideaddbtn" style="margin-right:10px;"><i class="fas fa-eye-slash"></i> Add </a> -->
      <div class="tab-content" id="custom-tabs-three-tabContent">


         <div class="tab-pane fade active show" id="tab_one" role="tabpanel" aria-labelledby="tab_one-tab">
            <div id="tab_one_data"></div>
         </div>
         <div class="tab-pane fade" id="tab_two" role="tabpanel" aria-labelledby="tab_two-tab">
            <div id="tab_two_data"></div>
         </div>
         <div class="tab-pane fade" id="tab_three" role="tabpanel" aria-labelledby="tab_three-tab">
            <div id="tab_three_data"></div>
         </div>
         <div class="tab-pane fade" id="tab_four" role="tabpanel" aria-labelledby="tab_four-tab">
            <div id="tab_four_data"></div>
         </div>
      </div>
   </div>
</div>




<div id="investorRelationsDetails" class="modal fade customModal format1 right" data-keyboard="false"
   data-backdrop="false">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header" style="background:#323232;; color:#ffffff;padding: 5px;color: #fff;">
            <h4 class="frm_header"></h4>
            <button type="button" class="close" style="color: white; opacity: 1;" data-dismiss="modal">&times;<span
                  class="sr-only">Close</span></button>
         </div>
         <div class="modal-body" style="min-height: 350px;height: 650px overflow-y: auto;">
            <input type="hidden" id="relations_master_id" name="relations_master_id" value="1">
            <input type="hidden" id="investor_relation_head" name="investor_relation_head" value="Corporate Governance"
               readonly>
            <div id="add_edit_view_data" style="display:none1;"></div>

         </div>
      </div>
   </div>
</div>


<div id="investorRelationsDocs" class="modal fade customModal format1 right" data-keyboard="false"
   data-backdrop="false">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header" style="background:#323232;; color:#ffffff;padding: 5px;color: #fff;">
            <h4 class="frm_header"></h4>
            <button type="button" class="close" style="color: white; opacity: 1;" data-dismiss="modal">&times;<span
                  class="sr-only">Close</span></button>
         </div>
         <div class="modal-body" style="min-height: 350px;height: 650px overflow-y: auto;">

            <div id="document_view_data" ></div>

         </div>
      </div>
   </div>
</div>