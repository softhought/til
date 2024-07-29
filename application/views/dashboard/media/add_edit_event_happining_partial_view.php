<style type="text/css">
    .file {
        visibility: hidden;
        position: absolute;
    }

    .browse {
        margin-left: -20px !important;
    }

    #upload-asset-image {
        background-color: #f8f9fa;
        /* padding: 80px;  */
        padding: 20px;

        border-radius: 10px;
    }

    #upload-asset-image .fw-semibold {
        font-size: 16px;
    }

    .custom-file-container {
        margin-bottom: 15px;
    }

    .custom-file-upload {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ffc72c;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    .upload-text {
        margin-left: 10px;
    }

    .image-preview-item {
        margin-right: 10px;
        margin-bottom: 10px;
        text-align: center;
        border-radius: 14px;
        border: 3px solid #ffc72c;
        padding: 3px;
        background: beige;
    }

    .image-preview-item img {
        width: 115px;
        height: 115px;
        border-radius: 5px;
    }

    .image-delete {
        color: #a40202;
        font-size: 20px;
        cursor: pointer;
        display: grid;
        margin-top: 9px;
        margin-bottom: 5px;
    }

    .image-delete:hover {
        opacity: 0.8;
    }

    .error-msg {
        color: red;
        font-size: 16px;
        font-family: Arial, sans-serif;
        font-weight: bold;
        margin-top: 10px;
    }
</style>
<form name="eventsHappiningForm" id="eventsHappiningForm" enctype="multipart/form-data">
    <input type="hidden" id="mode" name="mode" value="<?php echo $mode; ?>">
    <input type="hidden" id="eventHappiningId" name="eventHappiningId" value="<?php echo $eventHappiningId; ?>">
    <div class="row">
        <div class="col-md-4">
            <label for="groupname">Event Title</label>
            <div class="form-group">
                <div class="input-group input-group-sm" id="titleerr">
                    <input type="text" class="form-control event_title" name="event_title" id="event_title"
                        placeholder="Enter Title" value="<?php if ($mode == 'EDIT') {
                            echo $happiningEditdata->name;
                        } ?>" autocomplete="off">
                </div>
                <p id="error_event_title" class="error-msg error_event_title"></p>
                <p id="error_image" class="error-msg error_image"></p>
            </div>
        </div>

        <div class="col-md-4">
            <label for=""></label>
            <br>
            <button type="submit" class="btn btn-sm action-button padbtn" id="save_btn"
                style="margin-top: 8px;padding: 5px;"><?php echo $btnText; ?> &nbsp;<i
                    class="fas fa-chevron-right"></i></button>
            <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                style="display:none;width: 60%;"><?php echo $btnTextLoader; ?></span>

        </div>
        <!-- 
        <div class="col-md-4">
            <label for=""></label>
            <br>
            <div class="custom-file-container">
                <label class="custom-file-upload">
                    <input type="file" id="fileName" class="file fileName" name="fileName[]" multiple
                        accept=".png,.jpeg,.jpg" />
                    <i class="bx bx-plus"></i>
                    <span class="upload-text">Upload Images</span>
                </label>
            </div>
            <p id="error_image" class="error-msg error_image"></p>
        </div> -->

    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="upload-asset-image">
                <div class="row">
                    <div class="col-md mb-12 mb-md-0">
                        <div id="imageAsset">
                            <div class="row">
                                <!-- <div class="col-12">
                                <div class="custom-file-container">
                                    <label class="custom-file-upload">
                                        <input type="file" id="fileName" class="file fileName" name="fileName[]" multiple accept=".png,.jpeg,.jpg" />
                                        <i class="bx bx-plus"></i>
                                        <span class="upload-text">Upload Images</span>
                                    </label>
                                </div>
                                <p id="error_image" class="error-msg error_image"></p>
                            </div> -->
                                <div class="col-12 d-flex">

                                    <div class="d-flex flex-wrap" id="image-asset-preview-container">
                                        <!-- For edit mode -->
                                        <?php if ($mode == 'EDIT'):
                                            $i = 1;
                                            ?>
                                            <?php foreach ($images_name as $image):

                                                ?>
                                                <div class="image-preview-item" id="event_<?php echo $i; ?>">
                                                    <img src="<?php echo base_url('assets/images/') . $image->banner_image; ?>"
                                                        alt="<?php echo $image->banner_alt; ?>">
                                                    <i class="fas fa-trash image-delete delete-icon"
                                                        data-mode="<?php echo $mode; ?>"
                                                        data-eventid="<?php echo $happiningEditdata->id; ?>"
                                                        data-srl="<?php echo $i; ?>"
                                                        data-imagename="<?php echo $image->banner_image; ?>"></i>

                                                    <input type="hidden" class="form-control" name="prev_img_name[]"
                                                        id="prev_img_name" class="prev_img_name" placeholder="Enter Title"
                                                        value="<?php if ($mode == 'EDIT') {
                                                            echo $image->banner_image;
                                                        } ?>" autocomplete="off">
                                                </div>
                                                <?php $i++; endforeach; ?>
                                        <?php endif; ?>
                                        <div class="image-preview-item" id="browse-div">
                                            <img src="https://png.pngtree.com/png-vector/20191129/ourmid/pngtree-image-upload-icon-photo-upload-icon-png-image_2047546.jpg"
                                                style="cursor: pointer;" id="browseImage">
                                            <input type="file" id="fileName" class="file fileName" name="fileName[]"
                                                multiple accept=".png,.jpeg,.jpg" />
                                            <span
                                                style="color: #a40202; font-size: 15px; cursor: pointer; display: grid; margin-top: 9px; margin-bottom: 5px; font-weight: bold;">Upload+</span>
                                        </div>
                                        <!-- For edit mode end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>