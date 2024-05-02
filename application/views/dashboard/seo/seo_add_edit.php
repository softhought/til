
<!-- <script src="https://www.gangasagar.in/assets/seo/js/bootstrap-tagsinput.js"></script>
<link rel="stylesheet" href="https://www.gangasagar.in/assets/css/bootstrap-tagsinput.css"> -->

<script src="<?php echo(base_url());?>assets-admin/bootstraptag/bootstrap-tagsinput.js"></script> 
<link rel="stylesheet" href="<?php echo(base_url());?>assets-admin/bootstraptag/bootstrap-tagsinput.css">
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
           var seo_dtl_id = $('#seo_dtl_id').val();
           var mode = $('#mode').val();
           var page_url = $('#page_url').val();
            var page_title = $('#page_title').val();
            var seo_keyword = $('#seo_keyword').val();
            var meta_description = $('#meta_description').val();
            var canonical_url = $('#canonical_url').val();
   
   
           if (Validate()) {
   
               $("#savebtn").css('display', 'none');
               $("#loaderbtn").css('display', 'inline-block');
   
               $.ajax({
                   type: "POST",
                   url: basepath + 'seodata/seo_data_action',
                   dataType: "json",
                   contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                   data: {
                       seo_dtl_id: seo_dtl_id,
                       mode: mode,
                       page_url: page_url,
                       page_title: page_title,
                       seo_keyword: seo_keyword,
                       meta_description: meta_description,
                       canonical_url: canonical_url,
                   },
                   success: function(result) {
                       if (result.msg_status == 1) {
                           Toast.fire({
                               type: "success",
                               title: result.msg_data,
                           });
                           $("#savebtn").css('display', 'inline-block');
                           $("#loaderbtn").css('display', 'none');
                           window.location.href = basepath + 'seodata';
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


       $(document).on("input", "#page_url", function () {
		var page_url = $(this).val();
		var mode = $("#mode").val();
		var urlpath = basepath + "seodata/checkPageUrl";

        if(mode=="EDIT"){
            return false;
        }
		$("#page_url").removeClass("err-border");
		$("#page_url").text("");
		$.ajax({
			type: "POST",
			url: urlpath,
			data: { page_url: page_url },
			dataType: "json",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			success: function (result) {
				if (result.msg_status == 1) {
					$("#savebtn").hide();
					$("#page_url").focus().addClass("err-border");
                    Toast.fire({
                        type: "error",
                        title: "Enter page url already exist",
                    });
					//location.reload();
				} else {
					$("#savebtn").show();
				}
			},
			error: function (jqXHR, exception) {
				var msg = "";
				if (jqXHR.status === 0) {
					msg = "Not connect.\n Verify Network.";
				} else if (jqXHR.status == 404) {
					msg = "Requested page not found. [404]";
				} else if (jqXHR.status == 500) {
					msg = "Internal Server Error [500].";
				} else if (exception === "parsererror") {
					msg = "Requested JSON parse failed.";
				} else if (exception === "timeout") {
					msg = "Time out error.";
				} else if (exception === "abort") {
					msg = "Ajax request aborted.";
				} else {
					msg = "Uncaught Error.\n" + jqXHR.responseText;
				}
				alert(msg);
			},
		}); /*end ajax call*/
	});
   
   
   });/* end of document ready */

   function Validate() {
   
   var Toast = Swal.mixin({
       toast: true,
       position: "top-end",
       showConfirmButton: false,
       timer: 3000,
   });

   $(".err-border").removeClass("err-border");
   var page_url = $('#page_url').val();
   var page_title = $('#page_title').val();
   var meta_description = $('#meta_description').val();
   if (page_url == "") {
       $("#page_url").focus().addClass("err-border");
       Toast.fire({
           type: "error",
           title: "Enter page url",
       });
       return false;
   }

   if (page_title == "") {
       $("#page_title").focus().addClass("err-border");
       Toast.fire({
           type: "error",
           title: "Enter page title",
       });
       return false;
   }

   if (meta_description == "") {
       $("#meta_description").focus().addClass("err-border");
       Toast.fire({
           type: "error",
           title: "Enter page description",
       });
       return false;
   }

   return true;

}
   
</script>

<style type="text/css">
  

  /* .box{
    padding-left: 10%;
    padding-right: 10%;
  }
  .label-info {
    background-color: 
    #5bc0de;
 } */

 .bootstrap-tagsinput .tag {
    margin-right: 2px;
    color:#000;
    background-color: #ffcd11;
}

.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 2;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}

.bootstrap-tagsinput input{
  height: 35px !important;
}
</style>
<section class="layout-box-content-format1">
   <div class="card card-primary form-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">SEO Data</h3>
          <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" > 
          <a href="<?php echo base_url(); ?>seodata" class="btn btn-info btnpos">
            <i class="fas fa-clipboard-list"></i> List </a> 
       </div>            
      </div>
      <!-- /.card-header -->
      <form name="sectorFrom" id="sectorFrom" enctype="multipart/form-data">
         <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
         <input type="hidden" name="seo_dtl_id" id="seo_dtl_id" value="<?php echo $bodycontent['seodtlId']; ?>">
         <div class="card-body">
            <div class="formblock-box">
               <!-- <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Info</h3> -->
              
              <?php $jobType = array("PT"=>"Part Time","FT"=>"Full Time"); ?>
           
               <div class="row"> 
                <div class="col-md-2"></div>        
                  <div class="col-md-8">
                     <label for="groupname"> Page URL
                     <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="page_url" id="page_url"
                              placeholder="Enter Page URL" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['seoEditdata']->page_url;}?>" autocomplete="off">
                        </div>
                        <span></span>
                     </div>
                  </div>             
               </div>

               <div class="row"> 
                <div class="col-md-2"></div>        
                  <div class="col-md-8">
                     <label for="groupname"> Page Title
                     <span id="account_name_err" style="color:red;font-weight:bold;"></span></label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="page_title" id="page_title"
                              placeholder="Enter Page Title" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['seoEditdata']->page_title;}?>" autocomplete="off">
                        </div>
                     </div>
                  </div>             
               </div>

               <div class="row"> 
                <div class="col-md-2"></div>        
                  <div class="col-md-8">
                     <label for="groupname"> SEO keyword </label>
                     <div class="form-group">
                        <div class="input-group input-group-sm bs-example">
                           <input type="text" class="form-control taginputbox " name="seo_keyword" id="seo_keyword" data-role="tagsinput"
                              placeholder="Enter SEO keyword" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['seoEditdata']->seo_keyword;}?>" autocomplete="off">
                        </div>
                     </div>
                  </div>             
               </div>


               <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8"><label for="groupname"> Meta Description</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                <textarea  class="form-control" name="meta_description" id="meta_description" cols="30" rows="3" ><?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['seoEditdata']->meta_description;}?></textarea>                               
                                </div>
                            </div>
                    </div>
                </div>

                <div class="row"> 
                <div class="col-md-2"></div>        
                  <div class="col-md-8">
                     <label for="groupname"> Canonical URL</label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="canonical_url" id="canonical_url"
                              placeholder="Enter Page Title" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['seoEditdata']->canonical_url;}?>" autocomplete="off">
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
                  <button type="button" class="btn btn-sm action-button" id="savebtn"
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
