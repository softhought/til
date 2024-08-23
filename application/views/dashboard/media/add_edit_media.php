<script src="<?php echo base_url(); ?>assets-admin/js/customJs/media.js"></script>

<div class="card card-primary card-outline card-tabs">
   <div class="card-header p-0 pt-1 border-bottom-0">
      <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
         <li class="nav-item" style="width: 12.5%;">
            <a class="nav-link active" id="tab_one-tab" data-toggle="pill" href="#tab_one" role="tab"
               aria-controls="tab_one" aria-selected="true">Video</a>
         </li>
         <li class="nav-item" style="width: 12.5%;">
            <a class="nav-link" id="tab_two-tab" data-toggle="pill" href="#tab_two" role="tab" aria-controls="tab_two"
               aria-selected="false" data-mediatag="NEWS">News</a>
         </li>
         <li class="nav-item" style="width: 25%;">
            <a class="nav-link" id="tab_three-tab" data-toggle="pill" href="#tab_three" role="tab"
               aria-controls="tab_three" aria-selected="false">Events & Happenings</a>
         </li>
         <li class="nav-item" style="width: 25%;">
            <a class="nav-link" id="tab_four-tab" data-toggle="pill" href="#tab_four" role="tab"
               aria-controls="tab_four" aria-selected="false" data-mediatag="TIL_TALK">Newsletter (TIL TALK)</a>
         </li>
         <li class="nav-item" style="width: 25%;">
            <a class="nav-link" id="tab_five-tab" data-toggle="pill" href="#tab_five" role="tab"
               aria-controls="tab_five" aria-selected="false" data-mediatag="TIL_TOUCH">Newsletter (TIL TOUCH)</a>
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

<section class="layout-box-content-format1">
   <table class="table customTbl table-bordered table-striped" style="width: 100%">
      <thead>
         <tr style="border: 1px solid #f0f8ff00;">
            <th class="text-center" width="60%" style="border-radius: 30px 0 0 30px;"><span
                  style="font-size: 26px;">Press Release</span></th>
            <th class="text-center">
               <a href="javascript:void(0);" style="padding: 3px 11px 3px 6px; font-size: 22px;"
                  class="btn padbtn showupdatebtn" data-toggle="modal" data-target="#investorRelationsDetails">
                  <i class="fas fa-edit"></i>
               </a>
            </th>
            <th class="text-center" style="border-radius: 0 30px 30px 0;">
               <a href="javascript:void(0);" style="padding: 3px 11px 3px 6px; font-size: 22px; font-weight: bold;"
                  class="btn padbtn showDocs" style="width: 37px; height: 25px;" data-toggle="modal"
                  data-target="#investorRelationsDocs">Docs <?php echo $bodycontent['pressCount'] ?>
               </a>
            </th>
         </tr>
      </thead>
   </table>
</section>


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

            <div id="document_view_data"></div>

         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function () {
      var basepath = $("#basepath").val();
      var rowNoUpload = 0;
      var Toast = Swal.mixin({
         toast: true,
         position: "top-end",
         showConfirmButton: false,
         timer: 500,
      });

      $(document).on('click', ".showupdatebtn", function (e) {
         e.preventDefault();
         e.stopImmediatePropagation()
         let mode = "EDIT";
         let relations_master_id = 5;
         var relations_dtl_id = 44;

         loadAddEditView(basepath, relations_master_id, relations_dtl_id);
      });

      $(document).on("click", ".addDocument", function () {
         rowNoUpload++;
         var precedence = 2;
         $('.precedenceData').each(function () {
            $(this).val(precedence++);
         });
         $.ajax({
            type: "POST",
            url: basepath + "investor/adddetaildocument",
            dataType: "html",
            data: { rowNo: rowNoUpload },
            success: function (result) {
               $("#detail_Document table tbody").prepend(result);
               $(".select2").select2();
            },
            error: function (jqXHR, exception) {

            },
         });
      });

      $(document).on("click", ".delDocType", function () {
         var currRowID = $(this).attr("id");
         var rowDtlNo = currRowID.split("_");
         $("tr#rowDocument_" + rowDtlNo[1] + "_" + rowDtlNo[2]).remove();
      });

      $(document).on("change", ".fileName", function () {
         var currRowID = $(this).attr("id");
         var rowDtlNo = currRowID.split("_");
         var IDSNo = rowDtlNo[1] + "_" + rowDtlNo[2];

         var newfileName = $("#fileName_" + IDSNo)[0].files[0].name;
         var prvVal = $("#prvFilename_" + IDSNo).val();

         if (newfileName != prvVal) {
            $("#isChangedFile_" + IDSNo).val("Y");
         }
      });

      $(document).on("click", ".browse", function () {
         var file = $(this).parent().parent().parent().find(".file");
         file.trigger("click");
      });

      $(document).on("change", ".file", function () {
         $(this).parent().find(".form-control").val($(this).val().replace(/C:\\fakepath\\/i, "")
         );
      });

      $(document).on('click', ".showDocs", function (e) {
         e.preventDefault();
         let mode = "EDIT";
         let relations_master_id = 5;
         var relations_dtl_id = 44;

         loadDocumentView(basepath, relations_master_id, relations_dtl_id);
      });

      $(document).on("submit", "#investorRelationFrom", function (event) {
         event.preventDefault();
         var mode = $("#mode").val();
         var formData = new FormData($(this)[0]);

         if (1) {
            if (detailDocumentValidation()) {
               $("#savebtn").css("display", "none");
               $("#loaderbtn").css("display", "inline");
               $.ajax({
                  url: basepath + "media/investor_relation_action",
                  type: "POST",
                  dataType: "json",
                  processData: false,
                  contentType: false,
                  data: formData,
                  success: function (data) {
                     if (data.msg_status == 1) {
                        $("#msg").text(data.msg_data);
                        $("#loaderbtn").css("display", "none");
                        if (mode == "EDIT") { $("#savebtn").css("display", "inline"); }
                     } else {
                        $("#msg").text(data.msg_data);
                        $("#savebtn").css("display", "inline");
                        $("#loaderbtn").css("display", "none");
                     }

                  },
                  error: function (jqXHR, exception) {

                  },
               });
            }
         }

      });

   });

   function valiadteMaster() {
      var title = $("#title").val();

      $("#titleerr").css("border", "unset");

      if (title == "") {
         $("#titleerr").css("border", "1px solid red");
         $("#title").focus();
         return false;
      }

      return true;
   }

   function loadDocumentView(basepath, relations_master_id, relations_dtl_id) {

      $("#document_view_data").html("Loading....");

      $.ajax({
         url: basepath + "investor/investor_relations_docs_partial_view",
         type: 'POST',
         data: { relations_master_id: relations_master_id, relations_dtl_id: relations_dtl_id },
         success: function (data) {
            $("#document_view_data").html(data);
         },
         error: function (xhr, status, error) {
            console.error("Error loading partial view:", error);
         }
      });
   }


   function detailDocumentValidation() {
      var isValid = true;
      $(".docType").each(function () {
         var doctype_id = $(this).attr("id");
         var docTypeIDS = doctype_id.split("_");
         var docTypeVal = $(this).val();



         var tdIDS = "#docType_" + docTypeIDS[1] + "_" + docTypeIDS[2];
         var tdIDS2 = "#userFileName_" + docTypeIDS[1] + "_" + docTypeIDS[2];

         var filename = $(tdIDS2).val();

         $(tdIDS).removeAttr("title");
         $(tdIDS).css("background", "inherit");

         if (docTypeVal == "") {
            $(tdIDS).attr("title", "Enter Title");
            $(tdIDS).css("background", "#FFD2D2");

            isValid = false;
         }

         if (filename == "") {
            $(tdIDS2).attr("title", "Select Document");
            $(tdIDS2).css("background", "#FFD2D2");

            isValid = false;
         }
      });

      return isValid;
   }

   function loadAddEditView(basepath, relations_master_id, relations_dtl_id) {

      $("#add_edit_view_data").html("Loading....");

      if (relations_master_id && relations_dtl_id) {
         $.ajax({
            url: basepath + "media/add_edit_investor_relations_partial_view",
            type: 'POST',
            data: { relations_master_id: relations_master_id, relations_dtl_id: relations_dtl_id },
            success: function (data) {
               $("#add_edit_view_data").html(data);
            },
            error: function (xhr, status, error) {
               console.error("Error loading partial view:", error);
            }
         });
      }
   }

   function changeSerialDoc(id, slno, action) {
      var slectedvalue = $("#otherslno_" + slno).val();
      var basepath = $("#basepath").val();

      let relations_master_id = $("#doc_relations_master_id").val();
      let relations_dtl_id = $("#doc_relations_dtl_id").val();
      $(".actrow").removeClass("actrow");
      $.ajax({
         url: basepath + 'investor/DocSerialchange',
         dataType: 'json',
         type: 'post',
         data: { id: id, slno: slno, action: action, relations_dtl_id: relations_dtl_id, slectedvalue: slectedvalue },
         success: function (result) {

            if (result.msg_status == 1) {
               loadDocumentView(basepath, relations_master_id, relations_dtl_id);
            }
         }
      });
   }
</script>