<style>
    .review-rating .rating {
        font-size: 14px;
        color: #dba717;
        margin-right: 10px;
    }

    .review-rating .rating {
        font-size: 14px;
        color: #dba717;
        margin-right: 10px;
    }

    .error-msg {
        color: red;
        font-size: 16px;
        font-family: Arial, sans-serif;
        font-weight: bold;
        margin-top: 10px;
    }

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

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

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
