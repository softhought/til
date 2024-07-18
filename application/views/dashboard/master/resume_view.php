<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Resume List </h3>
      </div>
      <div class="card-body">
         <div class="formblock-box">
            <div class="row mb-4">
               <div class="col-md-1"></div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="groupname">Function name</label>
                     <select class="form-select select2" name="function_id" id="function_id">
                        <option value="">Select</option>
                        <?php foreach ($bodycontent["function"] as $key => $functionValue) { ?>
                           <option value="<?php echo $functionValue->id; ?>"><?php echo $functionValue->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="groupname">From date</label>
                     <input type="text" class="form-control datepickermonth" data-inputmask-alias="datetime"
                        data-inputmask-inputformat="dd/mm/yyyy" data-mask name="from_date" id="from_date" value="" autocomplete="off"
                        readonly>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="groupname">To date</label>
                     <input type="text" class="form-control datepickermonth" data-inputmask-alias="datetime"
                        data-inputmask-inputformat="dd/mm/yyyy" data-mask name="to_date" id="to_date" value="" autocomplete="off"
                        readonly>
                  </div>
               </div>
            </div>
            <div id="tableData"></div>
         </div>
      </div>
   </div>
</section>

<script>
   $(document).ready(function () {
      $(".datepickermonth").datepicker({
         format: "dd/mm/yyyy",
         startView: "days",
         minViewMode: "days",
         autoclose: true,
         orientation: "bottom",
      });

      fetchtable();

      $("#function_id").change(function () {
         fetchtable($("#function_id").val(), $("#from_date").val(), $("#to_date").val());
      });

      $("#from_date").change(function () {
         fetchtable($("#function_id").val(), $("#from_date").val(), $("#to_date").val());
      });

      $("#to_date").change(function () {
         fetchtable($("#function_id").val(), $("#from_date").val(), $("#to_date").val());
      });
   });

   function fetchtable(function_id = "", from_date = "", to_date = "") {
      $("#tableData").html(`Loading.....`);
      $.ajax({
         url: "<?php echo base_url(); ?>master/resume_partial_view",
         type: 'POST',
         data: {
            function_id: function_id,
            from_date: from_date,
            to_date: to_date
         },
         success: function (data) {
            $("#tableData").html(data);
            $(".dataTable").dataTable();
         },
         error: function (xhr, status, error) {
            console.error("Error loading partial view:", error);
         }
      });
   }
</script>