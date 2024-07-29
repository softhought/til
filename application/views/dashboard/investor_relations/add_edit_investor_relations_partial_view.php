<style type="text/css">
    .ck.ck-editor {
        position: relative;
        width: 100% !important;
    }

    #cke_description {
        width: -moz-available;
    }

    .file {
        visibility: hidden;
        position: absolute;
    }

    .checkbox input[type="checkbox"] {
        position: relative;
        right: 0px;

    }

    .table td,
    .table th {
        vertical-align: middle !important;
    }

    /* .tablepad th,
td {
    padding: 0px 0px !important;
} */

    #detail_Document .form-group {
        margin-bottom: 0;
        padding: 4px;
    }

    .fa-trash-alt {
        color: #c01212;
        font-size: 15px;
        font-weight: bold;
    }

    .browse {
        margin-left: -20px !important;
    }
</style>

<!-- <script src="<?php echo (base_url()); ?>assets-admin/plugins/ckeditor5/build/ckeditor.js"></script> -->
<!-- ckeditor -->
<script src="<?php echo base_url(); ?>assets-admin/ckeditor/ckeditor.js?v=<?php echo date('YmdHis'); ?>"></script>
<script>
    CKEDITOR.replaceAll('ckeditor1');

    // let theEditor;

    // ClassicEditor
    //     .create(document.querySelector('.ckeditor'), {

    //         toolbar: {
    //             items: [
    //                 'Source',
    //                 'bold',
    //                 'italic',
    //                 'link',
    //                 'bulletedList',
    //                 'numberedList',
    //                 '|',
    //                 'outdent',
    //                 'indent',
    //                 '|',
    //                 'insertTable',
    //                 'undo',
    //                 'redo',
    //                 'heading',
    //                 'alignment',
    //                 'fontSize',
    //                 'highlight',
    //                 'htmlEmbed',
    //                 'subscript',
    //                 'superscript',
    //                 'underline',
    //                 'code',
    //                 'fontFamily',
    //                 'fontColor',
    //                 'fontBackgroundColor',
    //                 'findAndReplace',
    //                 'strikethrough',
    //                 'comment'
    //             ]
    //         },
    //         language: 'en',
    //         image: {
    //             toolbar: [
    //                 'imageTextAlternative',
    //                 'imageStyle:inline',
    //                 'imageStyle:block',
    //                 'imageStyle:side'
    //             ]
    //         },
    //         table: {
    //             contentToolbar: [
    //                 'tableColumn',
    //                 'tableRow',
    //                 'mergeTableCells'
    //             ]
    //         },
    //         licenseKey: '',



    //     })
    //     .then(editor => {
    //         window.editor = editor;




    //     })
    //     .catch(error => {
    //         console.error('Oops, something went wrong!');
    //         console.error(
    //             'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
    //             );
    //         console.warn('Build id: vjthmprneoky-icn3x2a9jequ');
    //         console.error(error);
    //     });
</script>

<form name="investorRelationFrom" id="investorRelationFrom" enctype="multipart/form-data">

    <input type="hidden" id="mode" name="mode" value="<?php echo $mode; ?>">
    <input type="hidden" id="relations_dtl_id" name="relations_dtl_id" value="<?php echo $relations_dtl_id; ?>">
    <input type="hidden" id="relations_master_id" name="relations_master_id" value="<?php echo $relations_master_id; ?>">
    <div class="row">
        <div class="col-md-12">
            <label for="groupname">Title</label>
            <div class="form-group">
                <div class="input-group input-group-sm" id="titleerr">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="<?php if ($mode == "EDIT") {
                        echo $relationEditdata->title;
                    } ?>" autocomplete="off">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label for="groupname">Page Url</label>
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="page_url" id="page_url" placeholder="" value="<?php if ($mode == "EDIT") {
                        echo $relationEditdata->page_url;
                    } ?>" autocomplete="off" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label for="groupname"> Description</label>
            <div class="form-group" id="mail_bodyerr">
                <div class="input-group input-group-sm">
                    <textarea class="form-control ckeditor1" style="width: 100%;" name="description" id="description"><?php if ($mode == "EDIT") {
                        echo $relationEditdata->description;
                    } ?></textarea>

                </div>
            </div>
        </div>
    </div>


    <!-- <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Documents</h3> -->


    <!-- Add document-->
    <div class="box-body">
        <!-- <div class="row">

                                <div class="col-md-6 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <button type="button" class="btn btn-sm btn-light addDocument"
                                        style="background: #f8bb06;color: #1f2d3d;">
                                        <span class="glyphicon glyphicon-plus"></span> Add Document
                                    </button>
                                </div>
                            </div> -->

        <br>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12" style="margin-top: 10px;">
                <button type="button" class="btn btn-sm btn-light addDocument"
                    style="background: #f8bb06;color: #1f2d3d;">
                    <span class="glyphicon glyphicon-plus"></span> Add Document
                </button>
            </div>
        </div>
        <div class="row">


            <div class="col-md-12" id="detail_Document">
                <div class="table-responsive">
                    <?php
                    $detailCount = 0;
                    if ($mode == "EDIT") {
                        $detailCount = sizeof($documenDtl);
                    }

                    // For Table style Purpose
                    if ($mode == "EDIT" && $detailCount > 0) {
                        $style_var = "width:100%;";
                    } else {
                        $style_var = "width:100%;";
                    }
                    ?>

                    <table class="table customTbl table-bordered table-striped" role="grid"
                        aria-describedby="datatable_info" style="<?php echo $style_var; ?> border: 1px solid #dee2e6;
    border-collapse: separate !important;
    border-spacing: 0;  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <thead>

                            <tr>
                                <th style="width:50%;">Doc Title</th>
                                <th style="width:35%;">Browse</th>
                                <th style="width:5%;">View</th>
                                <th style="width:5%;">Download</th>

                                <th style="width:5%;" style="text-align:right;">Del</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php



                            $dir_path = base_url() . 'assets/test_doc'; //local
                            
                            if ($detailCount > 0) {
                                foreach ($documenDtl as $key => $value) {

                                    ?>

                                    <tr id="rowDocument_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>">
                                        <td>

                                            <input type="hidden" name="precedence[]" id="precedence_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>" 
                                            class="precedenceData" value="<?php echo $value->precedence; ?>">
                                            <input type="text" name="docType[]"
                                                id="docType_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                class="form-control docType" value="<?php echo $value->uploaded_file_desc; ?>">

                                            <input type="hidden" name="prvFilename[]"
                                                id="prvFilename_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                class="form-control prvFilename" value="<?php echo $value->user_file_name; ?>"
                                                readonly>

                                            <input type="hidden" name="randomFileName[]"
                                                id="randomFileName_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                class="form-control randomFileName"
                                                value="<?php echo $value->random_file_name; ?>" readonly>

                                            <input type="hidden" name="docDetailIDs[]"
                                                id="docDetailIDs_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                class="form-control randomFileName" value="<?php echo $value->doc_id; ?>"
                                                readonly>
                                        </td>
                                        <td>

                                            <div class="row">

                                                <input type="file" name="fileName[]" class="file fileName"
                                                    id="fileName_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>">
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="userFileName[]"
                                                                id="userFileName_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                                class="form-control input-xs userFileName" readonly
                                                                placeholder="Upload Document"
                                                                value="<?php echo $value->user_file_name; ?>">

                                                            <input type="hidden" name="isChangedFile[]"
                                                                id="isChangedFile_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                                value="N">

                                                            <span class="input-group-btn">

                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <button class="browse btn input-xs btn-sm" type="button"
                                                            id="uploadBtn_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                            style="background: #f8bb06; color:#000;">
                                                            <i class="fa fa-folder-open" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>


                                            </div>

                                        </td>
                                        <td align="center"><a href="<?php echo $dir_path . "/" . $value->random_file_name; ?>"
                                                class="btn btn-xs" data-title="download" target="_blank"
                                                style="background: #f8bb06; color:#000;"><i class="fa fa-link"
                                                    aria-hidden="true"></i></a></td>
                                        <td align="center"><a href="<?php echo $dir_path . "/" . $value->random_file_name; ?>"
                                                class="btn btn-xs" data-title="download"
                                                style="background: #f8bb06; color:#000;" download><i class="fa fa-download"
                                                    aria-hidden="true"></i></a> </td>
                                        <td style="vertical-align: middle;text-align:center;">
                                            <a href="javascript:;" class="delDocType"
                                                id="delDocRow_<?php echo $value->doc_id; ?>_<?php echo $value->ref_id; ?>"
                                                title="Delete">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        

    </div><!-- end body box -->


    <!-- end of Add document-->


    <hr>
    <div class="formblock-box">
        <div class="row">
            <div class="col-md-10"><span id="msg" style="font-weight: bold;color: #1c1809;"><span> </div>
            <div class="col-md-2 text-right">
                <button type="submit" class="btn btn-sm action-button" id="savebtn"
                    style="width: 60%;"><?php echo $btnText; ?></button>
                <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                    style="display:none;width: 60%;"><?php echo $btnTextLoader; ?></span>
            </div>
        </div>
    </div>



</form>