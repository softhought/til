<tr id="rowDocument_0_<?php echo $rowno; ?>">
    <td>
        <div id=" id=" docTypeEr_0_<?php echo $rowno; ?>">

            <input type="text" name="docType[]" id="docType_0_<?php echo $rowno; ?>" class="form-control docType"
                value="">
                <input type="text" name="precedence[]" id="precedence_0_<?php echo $rowno; ?>" class="form-control precedenceData"
                value="1">
        </div>
        <input type="hidden" name="prvFilename[]" id="prvFilename_0_<?php echo $rowno; ?>"
            class="form-control prvFilename" value="" readonly>

        <input type="hidden" name="randomFileName[]" id="randomFileName_0_<?php echo $rowno; ?>"
            class="form-control randomFileName" value="" readonly>

        <input type="hidden" name="docDetailIDs[]" id="docDetailIDs_0_<?php echo $rowno; ?>"
            class="form-control randomFileName" value="0" readonly>
    </td>
    <td>
        <div class="row">
            <input type="file" name="fileName[]" class=" file fileName" id="fileName_0_<?php echo $rowno; ?>"
                accept="application/pdf">
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <input type="hidden" name="userFileName[]" id="userFileName_0_<?php echo $rowno; ?>"
                            class="form-control input-xs userFileName" readonly placeholder="Upload Document">

                        <input type="hidden" name="isChangedFile[]" id="isChangedFile_0_<?php echo $rowno; ?>"
                            value="Y">
                        <span class="input-group-btn">

                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <button class="browse btn input-xs btn-sm" type="button" style="background: #f8bb06; color:#000; padding-top: 4px; margin-top: 0px; margin-left: -23px !important;" id="uploadBtn_0_<?php echo $rowno; ?>">
                        <i class="fa fa-folder-open" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </td>
    <td align="center"><a href="javascript:;" class="btn btn-xs" data-title="download" target="_blank"
            style="background:#f8bb06; color:#000;"><i class="fa fa-link" aria-hidden="true"></i></a></td>
    <td align="center"><a href="javascript:;" class="btn btn-xs" data-title="download"
            style="background:#f8bb06; color:#000;" download><i class="fa fa-download" aria-hidden="true"></i></a> </td>
    <td style="vertical-align: middle;text-align:center;">
        <a href="javascript:;" class="delDocType" id="delDocRow_0_<?php echo $rowno; ?>" title="Delete">
            <i class="far fa-trash-alt"></i>
        </a>
    </td>
</tr>