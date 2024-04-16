<script src="<?php echo base_url();?>assets-admin/js/customJs/media.js"></script>
<style>
   .nav-tabs { border-bottom: 2px solid #DDD; }

   .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }

   /* .nav-tabs > li > a { border: none; color: #ffffff;background: #5a4080; } */
   .nav-tabs > li > a { border: none; color: #ffffff;background: #ffc72c; }

   /* .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #5a4080 !important; background: #fff; } */
   .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #ffc72c !important; background: #fff; }

   /* .nav-tabs > li > a::after { content: ""; background: #5a4080; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); } */
   .nav-tabs > li > a::after { content: ""; background: #ffc72c; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }

   .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }

   /* .tab-nav > li > a::after { background: #5a4080 none repeat scroll 0% 0%; color: #fff; } */
   .tab-nav > li > a::after { background: #ffc72c none repeat scroll 0% 0%; color: #fff; }
   .tab-pane { padding: 15px 0; }

   .tab-content{padding:20px}

   .nav-tabs > li  {width:20%; text-align:center;}
   /* .card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }
   body{ background: #EDECEC; padding:50px} */
   @media all and (max-width:724px){
   .nav-tabs > li > a > span {display:none;}	
   .nav-tabs > li > a {padding: 5px 5px;}
   }
   .card.card-tabs.card-outline .nav-item {
   border-bottom: 0;
   padding: 2px;
   }
   .card-primary.card-outline {
  border-top: 3px solid #ffc72c;
}
</style>
<div class="card card-primary card-outline card-tabs">
   <div class="card-header p-0 pt-1 border-bottom-0">
      <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" id="tab_one-tab" data-toggle="pill" href="#tab_one" role="tab" aria-controls="tab_one" aria-selected="true">Video</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="tab_two-tab" data-toggle="pill" href="#tab_two" role="tab" aria-controls="tab_two" aria-selected="false">News</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="tab_three-tab" data-toggle="pill" href="#tab_three" role="tab" aria-controls="tab_three" aria-selected="false">Events & Happenings</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="tab_four-tab" data-toggle="pill" href="#tab_four" role="tab" aria-controls="tab_four" aria-selected="false">Newsletter</a>
         </li>
      </ul>
   </div>
   <div class="card-body">
      <div class="tab-content" id="custom-tabs-three-tabContent">
         <div class="tab-pane fade active show" id="tab_one" role="tabpanel" aria-labelledby="tab_one-tab">
            <div id="tab_one_data">

            </div>
         </div>
         <div class="tab-pane fade" id="tab_two" role="tabpanel" aria-labelledby="tab_two-tab">
            <div id="tab_two_data">

            </div>
         </div>
         <div class="tab-pane fade" id="tab_three" role="tabpanel" aria-labelledby="tab_three-tab">
            <div id="tab_three_data">

            </div>
         </div>
         <div class="tab-pane fade" id="tab_four" role="tabpanel" aria-labelledby="tab_four-tab">
            <div id="tab_four_data">
                
            </div>
         </div>
      </div>
   </div>
</div>
