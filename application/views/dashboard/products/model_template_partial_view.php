<style>
    .panel {
        border: 1px solid #d1d1d1;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .box-header {
        background: #f8f9fa;
        padding: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        border-radius: 7px;
    }

    .box-title {
        font-size: 18px;
        color: #343a40;
        margin: 0;
    }

    .edit-btn {
        border: none;
        background: none;
        color: #007bff;
        cursor: pointer;
        padding: 5px;
        font-size: 16px;
    }

    .box-body {
        padding: 15px;
        background: #ffffff;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .input-model-table {
        padding: 2px;
        border-radius: 3px;
        border: 2px solid black;
        width: 90%;
        height: 25px;
        font-size: 14px;
        font-weight: 400;
    }
</style>

<div class="container mt-4">
    <div class="box box-solid">
        <div class="box-group" id="accordion">
            <?php foreach ($product_model_details as $key => $modelValue) { ?>
                <div class="panel box box-primary">
                    <div class="box-header with-border" data-toggle="collapse" data-target="#collapse<?php echo $key ?>">
                        <h4 class="box-title"><?php echo $modelValue->title ?></h4>
                        <button class="btn product-model-edit-btn"
                            data-prodect_model_dt_id="<?php echo $modelValue->prodect_model_dt_id; ?>" title="Edit"
                            type="button"><i class="fas fa-edit"></i>
                            Edit</button>
                    </div>
                    <div id="collapse<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="false"
                        style="height: 0px;">
                        <?php foreach ($product_model as $key => $products) {
                            if ($products->prodect_model_dt_id == $modelValue->prodect_model_dt_id) { ?>
                                <section class="gray-bg">
                                    <div class="container">
                                        <div class="row curvebg pl-0">
                                            <div class="col-md-12 col-12">
                                                <div class="table-content">
                                                    <div class="table-responsive mt-2">
                                                    <form name="specsheetform" id="specsheetform" class="p-4" enctype="multipart/form-data">
                                                        <table id="table-<?php echo $modelValue->prodect_model_dt_id ?>" class="table customTbl table-bordered table-hover">
                                                            <thead>
                                                                <tr class="row-1 odd">
                                                                    <?php $colNum = 1;
                                                                    foreach ($products->template_master as $key => $value) { ?>
                                                                        <th class="column-<?php echo $colNum++; ?>">
                                                                            <strong><?php echo $value ?></strong>
                                                                        </th>
                                                                    <?php } ?>
                                                                    <th class="column-<?php echo $colNum++; ?>">
                                                                        <strong>Status</strong>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <!-- Table Data -->
                                                            <tbody class="row-hover">
                                                                <?php foreach ($products->spec_sheet_details as $value) {
                                                                    $index = 1; ?>
                                                                    <tr class="row-2 even">
                                                                        <?php foreach ($products->template_master as $column => $columnName) {
                                                                            if ($column != "spec_sheet") { ?>
                                                                                <td valign="top" class="column-<?php echo $index++; ?>">
                                                                                    <?php echo $value->$column; ?>
                                                                                </td>
                                                                            <?php } else { ?>
                                                                                <td class="column-<?php echo $index; ?>">
                                                                                    <?php if (!empty($value->$column)) { ?>
                                                                                        <a href="<?php echo base_url(); ?>assets/pdf/<?php echo $value->$column; ?>"
                                                                                            target="_blank" style="color: #000;"><img
                                                                                                src="<?php echo base_url(); ?>tilindia/assets/images/pdf2.png"
                                                                                                alt="pdf2" width="22" height="22"> <?php echo $value->$column; ?>
                                                                                        </a>
                                                                                    <?php } ?>
                                                                                </td>
                                                                            <?php }
                                                                        } ?>
                                                                        <td valign="top" class="column-<?php echo $index++; ?>">
                                                                            <?php $color = $value->is_disabled != 0 ? "red" : "green" ?>
                                                                            <i class="activespec fa fa-toggle-<?php echo $color == "green" ? "on" : "off" ?>" data-spec_sheet_dt_id="<?php echo $value->spec_sheet_dt_id ?>" data-status="<?php echo $color == "green" ? 1 : 0 ?>" style="cursor: pointer; font-size: 20px; color: <?php echo $color ?>" aria-hidden="true"></i>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                    <input type="hidden" name="spec_product_model_dt_id" id="spec_product_model_dt_id" value="<?php echo $modelValue->prodect_model_dt_id ?>">
                                                                    <input type="hidden" name="spec_product_master_id" id="spec_product_master_id" value="<?php echo $modelValue->product_master_id ?>">
                                                                    <tr class="row-end">
                                                                        <?php foreach ($products->template_master as $key => $value) { 
                                                                            if ($key == "spec_sheet") { ?>
                                                                                <td><input type="file" class="input-model-table" style="padding: initial; border: 0px;" name="<?php echo $key; ?>" id="<?php echo $key; ?>" accept="application/pdf"></td>
                                                                            <?php } else { ?>
                                                                                <td><input type="text" class="input-model-table" name="<?php echo $key; ?>" id="<?php echo $key; ?>"></td>
                                                                        <?php } } ?>    
                                                                        <td><button type="submit" class="modelspecsubmit btn btn-sm action-button" style="margin-right: 7px;" data-prodectmodeldtid = <?php echo $modelValue->prodect_model_dt_id ?>>Save</button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.product-model-edit-btn').on('click', function (event) {
            event.stopPropagation();
            var prodect_model_dt_id = $(this).attr('data-prodect_model_dt_id');
            editModelTemplate(prodect_model_dt_id);
        });

        $(document).on('click', '.activespec', function() {
            var spec_sheet_dt_id = $(this).data("spec_sheet_dt_id");
            var status = $(this).data("status");
            $.ajax({
                url: `<?php echo base_url(); ?>product/activeinactivespecsheet`,
                type: 'POST',
                dataType: "json",
                data: {
                    spec_sheet_dt_id, spec_sheet_dt_id,
                    status: status
                },
                success: function (response) {
                    if (response.status) {
                        load_product_model_partial_view($("#product_master_id").val());
                    }
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                }
            });
        });

        $(document).on("submit", "#specsheetform", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $(".modelspecsubmit").prop("disabled", true);
            var formData = new FormData($(this)[0]);
            var prodect_model_dt_id = formData.get("spec_product_model_dt_id");
         
            $.ajax({
                url: `<?php echo base_url(); ?>product/addeditspecsheet`,
                type: 'POST',
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status) {
                        var newRow = `<tr class="row-2">`;
                        response.data.forEach((cellData, index) => {
                            if (cellData.type === 'text') {
                                newRow += `<td valign="top" class="column-${index}">${cellData.value}</td>`;
                            } else if (cellData.type === 'link') {
                                newRow += `<td class="column-${index}">`;
                                if (cellData.value) {
                                    newRow += `
                                        <a href="${cellData.value}" target="_blank" style="color: #000;">
                                            <img src="<?php echo base_url(); ?>/tilindia/assets/images/pdf2.png" alt="pdf2" width="22" height="22">
                                            ${cellData.value}
                                        </a>
                                    `;
                                }
                                newRow += `</td>`;
                            }
                        });
                        var color = response.is_disabled ? "red" : "green";
                        var dataStatus = (color === "green") ? 1 : 0;

                        newRow += `<td valign="top" class="column-${response.data.length}">
                                    <i class="activespec fa fa-toggle-${color == "green" ? "on" : "off"}" 
                                        data-spec_sheet_dt_id="${response.id}" data-status="${dataStatus}"
                                        style="cursor: pointer; font-size: 20px; color: ${color};" 
                                        aria-hidden="true">
                                    </i>
                                </td>`;
                        newRow += `</tr>`;
                        $(`#table-${prodect_model_dt_id} tbody tr.row-end`).before(newRow);
                        $(".modelspecsubmit").prop("disabled", false);
                        $(`#table-${prodect_model_dt_id} tbody tr.row-end input`).val('');
                    }
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                }
            });   
        });
    });
</script>