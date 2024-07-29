<script src="<?php echo base_url();?>assets-admin/js/customJs/media.js"></script>

<div class="card card-primary card-outline card-tabs">
   <div class="card-header p-0 pt-1 border-bottom-0">
      <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
         <li class="nav-item" style="width: 12.5%;">
            <a class="nav-link active" id="tab_one-tab" data-toggle="pill" href="#tab_one" role="tab" aria-controls="tab_one" aria-selected="true">Video</a>
         </li>
         <li class="nav-item" style="width: 12.5%;">
            <a class="nav-link" id="tab_two-tab" data-toggle="pill" href="#tab_two" role="tab" aria-controls="tab_two" aria-selected="false" data-mediatag="NEWS">News</a>
         </li>
         <li class="nav-item" style="width: 25%;">
            <a class="nav-link" id="tab_three-tab" data-toggle="pill" href="#tab_three" role="tab" aria-controls="tab_three" aria-selected="false">Events & Happenings</a>
         </li>
         <li class="nav-item" style="width: 25%;">
            <a class="nav-link" id="tab_four-tab" data-toggle="pill" href="#tab_four" role="tab" aria-controls="tab_four" aria-selected="false" data-mediatag="TIL_TALK">Newsletter (TIL TALK)</a>
         </li>
         <li class="nav-item" style="width: 25%;">
            <a class="nav-link" id="tab_five-tab" data-toggle="pill" href="#tab_five" role="tab" aria-controls="tab_five" aria-selected="false" data-mediatag="TIL_TOUCH">Newsletter (TIL TOUCH)</a>
         </li>
      </ul>
   </div>
   <div class="card-body">
      <div class="tab-content" id="custom-tabs-three-tabContent">
         <div class="tab-pane fade active show" id="tab_one" role="tabpanel" aria-labelledby="tab_one-tab">
            <div id="tab_one_data"> </div>
         </div>
         <div class="tab-pane fade" id="tab_two" role="tabpanel" aria-labelledby="tab_two-tab">
            <div id="tab_two_data"> </div>
         </div>
         <div class="tab-pane fade" id="tab_three" role="tabpanel" aria-labelledby="tab_three-tab">
            <div id="tab_three_data"></div>
         </div>
         <div class="tab-pane fade" id="tab_four" role="tabpanel" aria-labelledby="tab_four-tab">
            <div id="tab_four_data"> </div>
         </div>
         <div class="tab-pane fade" id="tab_five" role="tabpanel" aria-labelledby="tab_five-tab">
            <div id="tab_five_data"> </div>
         </div>
      </div>
   </div>
</div>
