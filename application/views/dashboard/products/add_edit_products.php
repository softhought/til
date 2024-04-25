<style>
    .menu-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        cursor: pointer;
        border-bottom: 1px solid #dcdcdc;
        /* background: #f9f9f9; */
    }

    .menu-item:hover {
        background: #f0f0f0;
    }

    .menu-actions {
        display: flex;
        gap: 10px;
    }

    .menu-actions button {
        padding: 5px 10px;
    }

    .menu-icon {
        transition: transform 0.3s;
        cursor: pointer;
    }

    .submenu {
        padding-left: 20px;
        border-left: 2px solid #dcdcdc;
        display: none;
    }

    .submenu.show {
        display: block;
    }

    .menu-title {
        display: flex;
        align-items: center;
    }

    .menu-title i {
        margin-right: 10px;
    }
</style>

<div class="container mt-4">
    <h2 style="text-align: center; font-weight: bold; font-size: 30px;">Products Menu</h2>

    <ul class="list-unstyled mt-4">
        <?php foreach ($bodycontent["product_menu"] as $parentKey => $parentMenu) { ?>
            <li class="menu-item" data-target="#menu_<?php echo $parentKey; ?>">
                <span class="menu-title" style="font-weight: bold; font-size: 20px;">
                    <i class="menu-icon fa fa-chevron-right"></i> <?php echo $parentMenu["name"]; ?>
                    <span class="badge badge-primary" style="margin-left: 20px;">Parent</span>
                </span>
                <div class="menu-actions">
                    <a href="<?php echo base_url() . "product-menu-add-edit/" . $parentMenu["product_master_id"] . "/menu/add" ?>" class="btn btn-warning showaddbtn action-btn">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    <a href="<?php echo base_url() . "product-menu-add-edit/" . $parentMenu["product_master_id"] . "/menu/edit" ?>" class="btn btn-sm btn-secondary action-btn"><i class="fas fa-edit" style="color: white;"></i></a>
                </div>
            </li>

            <ul class="submenu show" id="menu_<?php echo $parentKey; ?>">
                <?php foreach ($parentMenu["children"] as $levelOneKey => $levelOneValue) { ?>
                    <li class="menu-item" data-target="#level_1_<?php echo $levelOneKey; ?>">
                        <span class="menu-title" style="font-weight: bold; font-size: 18px;">
                            <i class="menu-icon fa fa-chevron-right"></i> <?php echo $levelOneValue["name"]; ?>
                            <span class="badge badge-info" style="margin-left: 20px;">Level 1</span>
                        </span>
                        <div class="menu-actions">
                            <a href="<?php echo base_url() . "product-menu-add-edit/" . $levelOneValue["product_master_id"] . "/menu/add" ?>" class="btn btn-warning showaddbtn action-btn">
                                <i class="fas fa-plus"></i> Add
                            </a>
                            <a href="<?php echo base_url() . "product-menu-add-edit/" . $levelOneValue["product_master_id"] . "/menu/edit" ?>" class="btn btn-sm btn-secondary action-btn"><i class="fas fa-edit" style="color: white;"></i></a>
                        </div>
                    </li>

                    <ul class="submenu show" id="level_1_<?php echo $levelOneKey; ?>">
                        <?php foreach ($levelOneValue["children"] as $levelTwoKey => $levelTwoValue) { ?>
                            <li class="menu-item" data-target="#level_2_<?php echo $levelTwoKey; ?>">
                                <span class="menu-title" style="font-weight: bold; font-size: 16px;">
                                    <i class="menu-icon fa fa-chevron-right"></i> <?php echo $levelTwoValue["name"]; ?>
                                    <span class="badge badge-warning" style="margin-left: 20px;">Level 2</span>
                                </span>
                                <div class="menu-actions">
                                    <a href="<?php echo base_url() . "product-menu-add-edit/" . $levelTwoValue["product_master_id"] . "/product/add" ?>" class="btn btn-warning showaddbtn action-btn">
                                        <i class="fas fa-plus"></i> Add
                                    </a>
                                    <a href="<?php echo base_url() . "product-menu-add-edit/" . $levelTwoValue["product_master_id"] . "/menu/edit" ?>" class="btn btn-sm btn-secondary action-btn"><i class="fas fa-edit" style="color: white"
                                            style="color: white;"></i></a>
                                </div>
                            </li>

                            <ul class="submenu" id="level_2_<?php echo $levelTwoKey; ?>">
                                <?php foreach ($levelTwoValue["children"] as $levelThreeKey => $levelThreeValue) { ?>
                                    <li class="menu-item level-3">
                                        <span class="menu-title" style="font-weight: bold; font-size: 14px;">
                                            <?php echo $levelThreeValue["name"]; ?>
                                            <span class="badge badge-success" style="margin-left: 20px;">Level 3</span></span>
                                        <div class="menu-actions">
                                            <a href="<?php echo base_url() . "product-menu-add-edit/" . $levelThreeValue["product_master_id"] . "/product/edit" ?>" class="btn btn-sm btn-secondary action-btn"><i class="fas fa-edit"
                                                    style="color: white"></i></a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </ul>
        <?php } ?>
    </ul>
</div>


<script src="<?php echo (base_url()); ?>assets-admin/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('.menu-item').on('click', function () {
            var target = $(this).attr('data-target');
            var $icon = $(this).find('.menu-icon');

            if ($(target).hasClass('show')) {
                $icon.removeClass('fa-chevron-down').addClass('fa-chevron-right');
                $(target).removeClass('show');
            } else {
                $icon.removeClass('fa-chevron-right').addClass('fa-chevron-down');
                $(target).addClass('show');
            }
        });

        $('.action-btn').on('click', function (event) {
            event.stopPropagation();
        });
    });
</script>