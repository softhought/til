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
                        <h4 class="box-title"><?php echo $modelValue->title ?> - Product</h4>
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
                                                                    <th class="column-<?php echo $colNum++; ?>">
                                                                        <strong>Update</strong>
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
                                                                        <td valign="top" class="column-<?php echo $index++; ?>">
                                                                            <i class="editspec fas fa-edit" data-spec_sheet_dt_id="<?php echo $value->spec_sheet_dt_id ?>" style="cursor: pointer; font-size: 20px;" aria-hidden="true"></i>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                    <input type="hidden" name="spec_product_model_dt_id" id="spec_product_model_dt_id" value="<?php echo $modelValue->prodect_model_dt_id ?>">
                                                                    <input type="hidden" name="spec_product_master_id" id="spec_product_master_id" value="<?php echo $modelValue->product_master_id ?>">
                                                                    <input type="hidden" name="slug" id="model_slug" value="<?php echo $modelValue->slug ?>">
                                                                    <tr class="row-end">
                                                                        <?php foreach ($products->template_master as $key => $value) { 
                                                                            if ($key == "spec_sheet") { ?>
                                                                                <td><input type="file" class="input-model-table" style="padding: initial; border: 0px;" name="<?php echo $key; ?>" id="<?php echo $key; ?>" accept="application/pdf"></td>
                                                                            <?php } else { ?>
                                                                                <td><textarea type="text" class="input-model-table" name="<?php echo $key; ?>" id="<?php echo $key; ?>"></textarea></td>
                                                                        <?php } } ?>
                                                                        <td></td>
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


<!-- Model -->
<div id="editModel" class="modal fade customModal format1 right" data-keyboard="false"
    data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#ffcd11; padding: 10px; color: #fff;">
                <h4 class="frm_header"></h4>
                <button type="button" class="close" style="color: white; opacity: 1;" data-dismiss="modal">&times;<span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body" style="min-height: 350px;height: 650px overflow-y: auto;">
                <form name="editModelForm" id="editModelForm" class="p-4" enctype="multipart/form-data">
                    <input type="hidden" value="" name="spec_sheet_dt_id_modal" id="spec_sheet_dt_id_modal">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname">Title</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm" id="title_modalerr">
                                    <input type="text" class="form-control" name="title_modal" id="title_modal"
                                        placeholder="Enter Title"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <input type="file" name="specsheet_modalfile" class="file fileName" id="specsheet_modalfile" accept="application/pdf">


                        <div class="row">
                            <div class="col-md-10" style="margin-left: 4%;">
                                <div class="form-group">
                                    <label for="groupname">Upload Spec Sheet</label>
                                    <div class="input-group input-group-sm" id="specsheet_modalerr">
                                        <input type="text" name="specsheet_modal" id="specsheet_modal"
                                            class="form-control userFileName"
                                            style="border-radius: 5px;"
                                            readonly placeholder="PDF Only">
                                        <span class="input-group-btn" style="margin-left: 23px">
                                            <button class="btn btn-sm browse" type="button"
                                                style="background: #f8bb06; color: #000; padding: 7px;"
                                                id="specsheet_modalBtn">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="file" name="catagory_image_modal_file" class="file fileName" id="catagory_image_modal_file"
                            accept="image/*">

                        <div class="row">
                            <div class="col-md-10" style="margin-left: 4%;">
                                <div class="form-group">
                                    <label for="groupname">Upload Category image</label>
                                    <div class="input-group input-group-sm" id="category_image_modal_err">
                                        <input type="text" name="category_image_modal" id="category_image_modal"
                                            class="form-control userFileName"
                                            style="border-radius: 5px;"
                                            readonly placeholder="365 x 180">
                                        <span class="input-group-btn" style="margin-left: 23px">
                                            <button class="btn btn-sm browse" type="button"
                                                style="background: #f8bb06; color: #000; padding: 7px;"
                                                id="category_image_modalBtn">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="file" name="side_image_modalfile" class="file fileName" id="side_image_modalfile"
                            accept="image/*">

                        <div class="row">
                            <div class="col-md-10" style="margin-left: 4%;">
                                <div class="form-group">
                                    <label for="groupname">Upload left side image</label>
                                    <div class="input-group input-group-sm" id="side_image_modalerr">
                                        <input type="text" name="side_image_modal" id="side_image_modal"
                                            class="form-control userFileName"
                                            style="border-radius: 5px;"
                                            readonly placeholder="1800 x 1350">
                                        <span class="input-group-btn" style="margin-left: 23px">
                                            <button class="btn btn-sm browse" type="button"
                                                style="background: #f8bb06; color: #000; padding: 7px;"
                                                id="side_image_modalBtn">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> Short Description</label>
                            <div class="form-group" id="short_description_modalerr">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" style="width: 100%; height: 6rem;" name="short_description_modal"
                                        id="short_description_modal"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> Description</label>
                            <div class="form-group" id="mail_bodyerr">
                                <div class="input-group input-group-sm" id="model_description_modalerr">
                                    <textarea class="form-control ckeditor" style="width: 100%; height: 100px"
                                        name="model_description_modal" id="model_description_modal"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="groupname"> General Description</label>
                            <div class="form-group" id="mail_bodyerr">
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control ckeditor" style="width: 100%;" name="general_description_modal"
                                        id="general_description_modal"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="groupname" style="font-size: 15px;padding: 4px;border-radius: 0 35px;background: #ffc72c;align-content: center;text-align: center;display: block;margin-bottom: 1rem;">Features</label>
                    <div id="features-container"></div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <div class="form-group" id="mail_bodyerr">
                                <div class="input-group input-group-sm">
                                    <input type="button" class="form-control" name="appendfeatures" id="appendfeatures" value="Add +" style="background: #ffcd11;font-size: 16px;font-weight: bold !important;border-radius: 50px;" />
                                </div>
                            </div>
                        </div> 
                    </div>
                    <hr>
                    <label for="groupname" style="font-size: 15px;padding: 4px;border-radius: 0 35px;background: #ffc72c;align-content: center;text-align: center;display: block;margin-bottom: 1rem;">Specifications</label>
                    <div id="specifications-container"></div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <div class="form-group" id="mail_bodyerr">
                                <div class="input-group input-group-sm">
                                    <input type="button" class="form-control" name="appendspecifications" id="appendspecifications" value="Add +" style="background: #ffcd11;font-size: 16px;font-weight: bold !important;border-radius: 50px;" />
                                </div>
                            </div>
                        </div> 
                    </div>
                    <hr>
                    <label for="groupname" style="font-size: 15px;padding: 4px;border-radius: 0 35px;background: #ffc72c;align-content: center;text-align: center;display: block;margin-bottom: 1rem;">Videos</label>
                    <div id="videos-container"></div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <div class="form-group" id="mail_bodyerr">
                                <div class="input-group input-group-sm">
                                    <input type="button" class="form-control" name="appendvideos" id="appendvideos" value="Add +" style="background: #ffcd11;font-size: 16px;font-weight: bold !important;border-radius: 50px;" />
                                </div>
                            </div>
                        </div> 
                    </div>
                    <hr>
                    <div class="formblock-box">
                        <div class="row">
                            <div class="col-md-9"><span id="msg" style="font-weight: bold;color: #1c1809;"><span>
                            </div>
                            <div class="col-md-3 text-right">
                                <button type="submit" class="btn btn-sm action-button" id="modelsavebtn_btn"
                                    style="width: 200px;">Update</button>
                                <span class="btn btn-sm action-button loaderbtn" id="modelloaderbtn_btn"
                                    style="display:none;width: 200px;">Processing....</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('model_description_modal');
    CKEDITOR.replace('general_description_modal');
</script>

<script>
    $(document).ready(function () {

        $('#editModel').on('hidden.bs.modal', function () {
            $('#editModelForm')[0].reset();
        });

        $("#specsheet_modalBtn").on("click", function () {
            $("#specsheet_modalfile").click();
        });

        $("#specsheet_modalfile").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $("#specsheet_modal").val(fileName);
        });

        $("#category_image_modalBtn").on("click", function () {
            $("#catagory_image_modal_file").click();
        });

        $("#catagory_image_modal_file").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $("#category_image_modal").val(fileName);
        });

        $("#side_image_modalBtn").on("click", function () {
            $("#side_image_modalfile").click();
        });

        $("#side_image_modalfile").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $("#side_image_modal").val(fileName);
        });

        $('.product-model-edit-btn').on('click', function (event) {
            event.stopPropagation();
            var prodect_model_dt_id = $(this).attr('data-prodect_model_dt_id');
            editModelTemplate(prodect_model_dt_id);
        });

        $(document).on('input', "#model", function (e) {
            e.preventDefault();
            var title = $(this).val();
            var formattedText = title.toLowerCase().replace(/ /g, "-");
            $("#model_slug").val(formattedText);
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

        $(document).on('click', '.editspec', function() {
            var spec_sheet_dt_id = $(this).data("spec_sheet_dt_id");

            $.ajax({
                url: `<?php echo base_url(); ?>product/editspecsheet`,
                type: 'POST',
                dataType: "json",
                data: {
                    spec_sheet_dt_id, spec_sheet_dt_id
                },
                success: function (response) {
                    if (response.status) {
                        $("#spec_sheet_dt_id_modal").val(spec_sheet_dt_id);
                        $("#title_modal").val(response.data.model);
                        $("#video_id").val(response.data.video_id);
                        $("#specsheet_modal").val(response.data.spec_sheet);
                        $("#category_image_modal").val(response.data.image);
                        $("#side_image_modal").val(response.data.left_image);
                        $("#short_description_modal").val(response.data.short_description);
                        if (CKEDITOR.instances['model_description_modal']) {
                            CKEDITOR.instances['model_description_modal'].setData(response.data.about);
                        }
                        if (CKEDITOR.instances['general_description_modal']) {
                            CKEDITOR.instances['general_description_modal'].setData(response.data.general_description);
                        }
                        var specifications = response.data.specifications;

                        if (typeof specifications === 'string') {
                            specifications = JSON.parse(specifications);
                        }

                        $('#specifications-container').empty();

                        if (Array.isArray(specifications)) {
                            specifications.forEach(function(specification) {
                                var newSpecification = `
                                <div class="row specification-item">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="mail_bodyerr">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="feature[]" placeholder="Feature" id="feature" value="${specification.feature}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="mail_bodyerr">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="details[]" placeholder="Details" id="details" value="${specification.details}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" id="mail_bodyerr">
                                            <div class="input-group input-group-sm">
                                                <button type="button" class="form-control delete-specification" style="background: #fdfdfd;font-size: 16px;font-weight: bold !important;border-radius: 50px;height: 38px;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                                $('#specifications-container').append(newSpecification);
                            });
                        }

                        var features = response.data.features;

                        if (typeof features === 'string') {
                            features = JSON.parse(features);
                        }

                        $('#features-container').empty();

                        if (Array.isArray(features)) {
                            features.forEach(function(feature) {
                                var newFeatures = `
                                <div class="row features-item">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="mail_bodyerr">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="feature-dt[]" placeholder="Feature" id="feature" value="${feature.feature}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="mail_bodyerr">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="details-dt[]" placeholder="Details" id="details" value="${feature.details}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" id="mail_bodyerr">
                                            <div class="input-group input-group-sm">
                                                <button type="button" class="form-control delete-features" style="background: #fdfdfd;font-size: 16px;font-weight: bold !important;border-radius: 50px;height: 38px;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                                $('#features-container').append(newFeatures);
                            });
                        }


                        var videos = response.data.videos;
                        if (typeof videos === 'string') {
                            videos = JSON.parse(videos);
                        }

                        $('#videos-container').empty();

                        if (Array.isArray(videos)) {
                            videos.forEach(function(video) {
                                console.log(video);
                                var newVideos = `
                                <div class="row videos-item">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="mail_bodyerr">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="video_title[]" placeholder="Title" id="video_title" value="${video.video_title}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="mail_bodyerr">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="video_id[]" placeholder="Video Id" id="video_id" value="${video.video_id}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" id="mail_bodyerr">
                                            <div class="input-group input-group-sm">
                                                <button type="button" class="form-control delete-videos" style="background: #fdfdfd;font-size: 16px;font-weight: bold !important;border-radius: 50px;height: 38px;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                                $('#videos-container').append(newVideos);
                            });
                        }

                        $("#editModel").modal("show");
                        $("body").css("overflow-y", "scroll");
                    }
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                }
            });
        });

        $(document).on('click', '#appendspecifications', function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();

            var newSpecification = `
            <div class="row specification-item">
                <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group" id="mail_bodyerr">
                        <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="feature[]" placeholder="Feature" id="feature" />
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" id="mail_bodyerr">
                        <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="details[]" placeholder="Details" id="details" />
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group" id="mail_bodyerr">
                    <div class="input-group input-group-sm">
                    <button type="button" class="form-control delete-specification" style="background: #fdfdfd;font-size: 16px;font-weight: bold !important;border-radius: 50px;height: 38px;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            `;
            $('#specifications-container').append(newSpecification);
        });

        $(document).on('click', '.delete-specification', function() {
            $(this).closest('.specification-item').remove();
        });


        $(document).on('click', '#appendfeatures', function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();

            var newFeatures = `
            <div class="row features-item">
                <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group" id="mail_bodyerr">
                        <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="feature-dt[]" placeholder="Feature" id="feature-dt" />
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" id="mail_bodyerr">
                        <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="details-dt[]" placeholder="Details" id="details-dt" />
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group" id="mail_bodyerr">
                    <div class="input-group input-group-sm">
                    <button type="button" class="form-control delete-features" style="background: #fdfdfd;font-size: 16px;font-weight: bold !important;border-radius: 50px;height: 38px;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            `;
            $('#features-container').append(newFeatures);
        });

        $(document).on('click', '.delete-features', function() {
            $(this).closest('.features-item').remove();
        });

        $(document).on('click', '#appendvideos', function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();

            var newSpecification = `
            <div class="row videos-item">
                <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group" id="mail_bodyerr">
                        <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="video_title[]" placeholder="Title" id="video_title" />
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" id="mail_bodyerr">
                        <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="video_id[]" placeholder="Video Id" id="video_id" />
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group" id="mail_bodyerr">
                    <div class="input-group input-group-sm">
                    <button type="button" class="form-control delete-videos" style="background: #fdfdfd;font-size: 16px;font-weight: bold !important;border-radius: 50px;height: 38px;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            `;
            $('#videos-container').append(newSpecification);
        });

        $(document).on('click', '.delete-videos', function() {
            $(this).closest('.videos-item').remove();
        });

        
        $(document).on("submit", "#editModelForm", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var isValid = modalValidate();

            if (isValid) {
                $("#modelloaderbtn_btn").show();
                $("#modelsavebtn_btn").hide();
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: `<?php echo base_url(); ?>product/productmodeladdeditaction`,
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $("#modelloaderbtn_btn").hide();
                            $("#modelsavebtn_btn").show();
                            $("#editModelForm")[0].reset();
                            $("#editModel").modal("hide");
                        }
                        load_product_model_partial_view($("#product_master_id").val());
                    },
                    error: function (jqXHR, exception) {
                        console.log(jqXHR);
                        console.log(exception);
                    }
                });
            }
        });

        $(document).on("submit", "#specsheetform", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $(".modelspecsubmit").prop("disabled", true);
            var formData = new FormData();
            var myformData = new FormData($(this)[0]);
            $("#specsheetform textarea").each(function () {
                var textAreaName = $(this).attr("name");
                var textAreaValue = $(this).val();
                var formattedValue = textAreaValue.replace(/\n/g, '<br>');
                formData.append(textAreaName, formattedValue);
            });

            $("#specsheetform input").each(function () {
                var inputName = $(this).attr("name");
                var inputValue = $(this).val();
                formData.append(inputName, inputValue);
            });

            $("#specsheetform input[type='file']").each(function () {
                var fileName = $(this).attr("name");
                var file = $(this)[0].files[0];
                formData.append(fileName, file);
            });
            
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
                        $(`#table-${prodect_model_dt_id} tbody tr.row-end textarea`).val('');
                    }
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                }
            });   
        });
    });

    function modalValidate() {
        var valid = true;

        if ($("#title_modal").val().trim() === "") {
            $("#title_modalerr").css("border", "1px solid red");
            $("#title_modalerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#title_modalerr").css("border", "");
        }

        if ($("#specsheet_modal").val().trim() === "") {
            $("#specsheet_modalerr").css("border", "1px solid red");
            $("#specsheet_modalerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#specsheet_modalerr").css("border", "");
        }

        if ($("#category_image_modal").val().trim() === "") {
            $("#category_image_modal_err").css("border", "1px solid red");
            $("#category_image_modal_err").css("border-radius", "5px");
            valid = false;
        } else {
            $("#category_image_modal_err").css("border", "");
        }

        if ($("#side_image_modal").val().trim() === "") {
            $("#side_image_modalerr").css("border", "1px solid red");
            $("#side_image_modalerr").css("border-radius", "5px");
            valid = false;
        } else {
            $("#side_image_modalerr").css("border", "");
        }

        return valid;
    }
</script>