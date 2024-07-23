<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">Review</h3>
            <div class="btn-group btn-group-sm float-right " role="group" aria-label="MoreActionButtons">
                <a href="<?php echo base_url(); ?>master/review_add_edit" class="btn btn-info btnpos link_tab">
                    <i class="fas fa-plus"></i> Add </a>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="formblock-box">

                <table id="example2" class="table customTbl table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Occupation</th>
                            <th>Review</th>
                            <th style="width: 100px;">Rating</th>
                            <th style="width: 80px;">Product</th>
                            <th style="width: 80px;">Model</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sl = 1;
                        foreach ($bodycontent['reviewList'] as $list) { ?>
                            <tr>
                                <td><?php echo $sl++; ?> </td>
                                <td>
                                    <img class="zoomImg"
                                        src="<?php echo base_url(); ?>assets/docs/review/<?php echo $list->image ?>"
                                        style="width: 50px; height: 50px; border-radius: 50%; cursor: pointer;"
                                        alt="Image <?php echo $i; ?>"
                                        data-imgsrc="<?php echo base_url(); ?>assets/docs/review/<?php echo $list->image ?>"
                                        data-caption="<?php echo $list->image; ?>">
                                </td>
                                <td><?php echo $list->name; ?> </td>
                                <td><?php echo $list->occupation; ?> </td>
                                <td><?php echo $list->review; ?> </td>
                                <td>
                                    <div class="review-rating" data-rating="<?php echo $list->rating; ?>">
                                        <span class="rating"></span>
                                    </div>
                                </td>
                                <td><?php echo $list->product; ?> </td>
                                <td><?php echo $list->model; ?> </td>
                                <td align="left"> <?php if ($list->is_disabled == 0) { ?>
                                        <a
                                            href="<?php echo base_url() . "master/activeInactiveReview/" . $list->id . "/1" ?>"><img
                                                src="<?php echo base_url(); ?>assets-admin/img/active-icon.png" alt="Active"
                                                title="Active" class="relstatus">
                                        </a>
                                    <?php } else { ?>
                                        <a
                                            href="<?php echo base_url() . "master/activeInactiveReview/" . $list->id . "/0" ?>"><img
                                                src="<?php echo base_url(); ?>assets-admin/img/inactive2.png" alt="Inactive"
                                                title="Inactive" class="relstatus">
                                        </a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url(); ?>master/review_add_edit/<?php echo $list->id; ?>"
                                        class="btn tbl-action-btn padbtn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
