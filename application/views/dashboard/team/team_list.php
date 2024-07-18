<style>
    .text-elipse {
        overflow: hidden;
        display: -webkit-box !important;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;

        transition: -webkit-line-clamp 0.3s ease;
        text-align: left;
    }

    .expands {
        -webkit-line-clamp: unset;
    }

    .table_wrapper {
        display: block;
        overflow-x: auto;

    }

    p {
        padding: 0px !important;
        margin-bottom: -2px;
    }
</style>
<section class="layout-box-content-format1 p-4">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">Team</h3>
        </div>
        <div class="card-body">
            <a href="<?php echo base_url() . "team/addedit" ?>" class="btn btn-warning btnpos showaddbtn"
                style="margin-right:16px; margin-top: 10px; "><i class="fas fa-plus"></i> Add </a>
            <div class="formblock-box table_wrapper p-2" style="margin-top: 50px;">
                <h3 class="form-block-subtitle">Board of Directors</h3>

                <table id="example2" class="table customTbl table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th style="width: 150px;">Member Name</th>
                            <th style="width: 145px;">Designation</th>
                            <th>About</th>
                            <th style="width: 200px;">Address</th>
                            <th>Din No</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1;
                        foreach ($bodycontent["teamList"] as $key => $value) {
                            if ($value->team_member_type == "BOD") { ?>

                                <tr>
                                    <td><?php echo $index++; ?></td>
                                    <td><img src="<?php echo base_url() . "tilindia/assets/images/" . $value->member_pic ?>"
                                            style="border-radius: 50%; width: 50px;" alt=""></td>
                                    <td><?php echo $value->member_name ?></td>
                                    <td><?php echo $value->designation ?></td>
                                    <td>
                                        <p id="elipse<?php echo $index; ?>" class="text-elipse"> <?php echo $value->about; ?>
                                        </p>
                                        <?php if (strlen($value->about) > 130) { ?><span><a href="javascript:void(0)"
                                                    class="more-read" data-target="elipse<?php echo $index; ?>">Read
                                                    more</a></span><?php } ?>
                                    </td>
                                    <td><?php echo $value->address ?></td>
                                    <td><strong><?php echo $value->din_no ?></strong></td>
                                    <td><a href="<?php echo base_url() . "team/addedit/" . $value->team_member_id ?>"
                                            class="btn tbl-action-btn padbtn showupdatebtn">
                                            <i class="fas fa-edit" style="height: 19px;"></i>
                                        </a></td>
                                    <td align="center"> <?php if ($value->is_disabled == 0) { ?>
                                            <a
                                                href="<?php echo base_url() . "team/activeinactive/" . $value->team_member_id . "/1" ?>"><img
                                                    src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active"
                                                    title="Active" class="relstatus">
                                            </a>
                                        <?php } else { ?>
                                            <a
                                                href="<?php echo base_url() . "team/activeinactive/" . $value->team_member_id . "/0" ?>"><img
                                                    src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive"
                                                    title="Inactive" class="relstatus">
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="formblock-box table_wrapper p-2" style="margin-top: 50px;">
                <h3 class="form-block-subtitle">Management Team</h3>
                <table id="example2" class="table customTbl table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th style="width: 150px;">Member Name</th>
                            <th style="width: 145px;">Designation</th>
                            <th>About</th>
                            <th style="width: 200px;">Address</th>
                            <th>Din No</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1;
                        foreach ($bodycontent["teamList"] as $key => $value) {
                            if ($value->team_member_type == "MT") { ?>

                                <tr>
                                    <td><?php echo $index++; ?></td>
                                    <td><img src="<?php echo base_url() . "tilindia/assets/images/" . $value->member_pic ?>"
                                            style="border-radius: 50%; width: 50px;" alt=""></td>
                                    <td><?php echo $value->member_name ?></td>
                                    <td><?php echo $value->designation ?></td>
                                    <td>
                                        <p id="elipse<?php echo $index; ?>" class="text-elipse"> <?php echo $value->about; ?>
                                        </p>
                                        <?php if (strlen($value->about) > 130) { ?><span><a href="javascript:void(0)"
                                                    class="more-read" data-target="elipse<?php echo $index; ?>">Read
                                                    more</a></span><?php } ?>
                                    </td>
                                    <td><?php echo $value->address ?></td>
                                    <td><strong><?php echo $value->din_no ?></strong></td>
                                    <td><a href="<?php echo base_url() . "team/addedit/" . $value->team_member_id ?>"
                                            class="btn tbl-action-btn padbtn showupdatebtn">
                                            <i class="fas fa-edit" style="height: 19px;"></i>
                                        </a></td>
                                    <td align="center"> <?php if ($value->is_disabled == 0) { ?>
                                            <a
                                                href="<?php echo base_url() . "team/activeinactive/" . $value->team_member_id . "/1" ?>"><img
                                                    src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active"
                                                    title="Active" class="relstatus">
                                            </a>
                                        <?php } else { ?>
                                            <a
                                                href="<?php echo base_url() . "team/activeinactive/" . $value->team_member_id . "/0" ?>"><img
                                                    src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive"
                                                    title="Inactive" class="relstatus">
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>