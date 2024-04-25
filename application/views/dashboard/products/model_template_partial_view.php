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
</style>

<div class="container mt-4">
    <div class="box box-solid">
        <div class="box-group" id="accordion">
            <?php foreach ($product_model_details as $key => $value) { ?>
                <div class="panel box box-primary">
                    <div class="box-header with-border" data-toggle="collapse" data-target="#collapse<?php echo $key ?>">
                        <h4 class="box-title"><?php echo $value->title ?></h4>
                        <button class="btn product-model-edit-btn"
                            data-template_master_id="<?php echo $value->template_master_id; ?>" title="Edit"
                            type="button"><i class="fas fa-edit"></i>
                            Edit</button>
                    </div>
                    <div id="collapse<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="false"
                        style="height: 0px;">
                        <div class="box-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                            coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                            anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                            occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                            heard of them accusamus labore sustainable VHS.
                        </div>
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
            var template_master_id = $(this).attr('data-template_master_id');
            editModelTemplate(template_master_id);
        });
    });
</script>