<style>
   /* Styles for modal and image zoom */
   .error-msg {
      color: red;
      font-size: 16px;
      font-family: Arial, sans-serif;
      font-weight: bold;
      margin-top: 10px;
   }

   /* The Modal (background) */
   .modal {
      display: none;
      position: fixed;
      z-index: 1;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.9);
   }

   /* Modal Content (image) */
   .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
   }

   /* Caption of Modal Image */
   /* .caption {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      text-align: center;
      color: #ccc;
      padding: 10px 0;
      height: 150px;
   } */

   /* Add Animation */
   .modal-content {
      animation-name: zoom;
      animation-duration: 0.6s;
   }

   @keyframes zoom {
      from {
         transform: scale(0);
      }

      to {
         transform: scale(1);
      }
   }

   /* The Close Button */
   .close {
      position: absolute;
      top: 10%;
      right: 22%;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
      cursor: pointer;
   }

   .close:hover,
   .close:focus {
      color: #bbb;
      text-decoration: none;
   }
</style>
<section class="layout-box-content-format1">
   <div class="partial_view_news">
      <?php include APPPATH . 'views/dashboard/media/default_partial_view_news.php' ?>
   </div>

   <table id="video_partial_tbl" class="table customTbl table-bordered table-hover dataTable2">
      <thead>
         <tr>
            <th>Sl</th>
            <th>Image</th>
            <th style="width: 150px;">Title Description</th>
            <th>URL</th>
            <th>Up/Down</th>
            <th>Set Precedence</th>
            <th>Status</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $i = 1;
         $media_tag = $media_tag_name;
         foreach ($newslist as $list) { ?>
            <tr>
               <td><?php echo $i++; ?></td>
               <td>
                  <img class="zoomImg" src="<?php echo base_url(); ?>assets/docs/pdf/<?php echo $list->random_file_name ?>"
                     style="width: 50px; height: 50px; border-radius: 50%; cursor: pointer;" alt="Image <?php echo $i; ?>"
                     data-imgsrc="<?php echo base_url(); ?>assets/docs/pdf/<?php echo $list->random_file_name ?>"
                     data-caption="<?php echo $list->uploaded_file_desc; ?>">
               </td>
               <td><?php echo $list->uploaded_file_desc; ?></td>
               <td><a href="<?php echo $list->url; ?>" target="_blank"><?php echo $list->url ? "View" : ""; ?></a></td>
               <td>
                  <img src="<?php echo base_url(); ?>assets-admin/img/up.png" alt="Up" title="Up"
                     onclick="changeSerial(<?php echo $list->doc_id; ?>, <?php echo $list->precedence; ?>, 'U', '<?php echo $media_tag; ?>', '<?php echo $list->table_name; ?>', '<?php echo $list->ref_id; ?>')"
                     style="cursor:pointer;">
                  <img src="<?php echo base_url(); ?>assets-admin/img/down.png" alt="Down" title="Down"
                     onclick="changeSerial(<?php echo $list->doc_id; ?>, <?php echo $list->precedence; ?>, 'D', '<?php echo $media_tag; ?>', '<?php echo $list->table_name; ?>', '<?php echo $list->ref_id; ?>')"
                     style="cursor:pointer;">
               </td>
               <td>
                  <div class="row">
                     <div class="col-md-8">
                        <select class="form-control select2" id="otherslno_<?php echo $list->precedence; ?>">
                           <?php foreach ($newslist as $row_slno) {
                              if ($list->precedence != $row_slno->precedence) { ?>
                                 <option value="<?php echo $row_slno->precedence; ?>"><?php echo $row_slno->precedence; ?>
                                 </option>
                              <?php }
                           } ?>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <button type="button" class="btn tbl-action-btn padbtn"
                           onclick="changeSerial(<?php echo $list->doc_id; ?>, <?php echo $list->precedence; ?>, 'P', '<?php echo $media_tag; ?>', '<?php echo $list->table_name; ?>', '<?php echo $list->ref_id; ?>')"
                           style="margin: 3px -6px;">
                           <i class="fas fa-sync-alt" aria-hidden="true" title="Set Precedence"></i>
                        </button>
                     </div>
                  </div>
               </td>
               <td align="center">
                  <?php if ($list->is_disabled == 0) { ?>
                     <a href="javascript:void(0);">
                        <img src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active" title="Active"
                           id="<?php echo $list->doc_id; ?>" class="news_newslater_status" data-setstatus="1"
                           data-mediatag="<?php echo $media_tag; ?>">
                     </a>
                  <?php } else { ?>
                     <a href="javascript:void(0);">
                        <img src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive" title="Inactive"
                           id="<?php echo $list->doc_id; ?>" class="news_newslater_status" data-setstatus="0"
                           data-mediatag="<?php echo $media_tag; ?>">
                     </a>
                  <?php } ?>
               </td>
               <td style="text-align:center;">
                  <a href="javascript:void(0);" class="btn tbl-action-btn padbtn update_news_newslater"
                     data-id="<?php echo $list->doc_id; ?>" data-title="<?php echo $list->uploaded_file_desc; ?>"
                     data-filename="<?php echo $list->user_file_name; ?>" data-url="<?php echo $list->url; ?>"
                     data-randomname="<?php echo $list->random_file_name; ?>">
                     <i class="fas fa-edit"></i>
                  </a>
               </td>
            </tr>
         <?php } ?>
      </tbody>
   </table>
</section>

<!-- The Modal -->
<div id="myModal" class="modal">
   <span class="close">&times;</span>
   <img class="modal-content" id="img01">
   <div id="caption" class="caption"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   // jQuery for modal functionality
   $(document).ready(function () {
      // Open modal when clicking on any image with class "zoomImg"
      $(".zoomImg").on("click", function () {
         var imgSrc = $(this).data("imgsrc");
         var caption = $(this).data("caption");

         $("#myModal").css("display", "block");
         $("#img01").attr("src", imgSrc);
         $("#caption").text(caption);
      });

      // Close modal when clicking the close button (span)
      $(".close").on("click", function () {
         $("#myModal").css("display", "none");
      });

      // Close modal when clicking outside the modal content
      $(window).on("click", function (event) {
         if (event.target == $("#myModal")[0]) {
            $("#myModal").css("display", "none");
         }
      });
   });
</script>