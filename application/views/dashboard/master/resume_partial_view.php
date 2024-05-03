<table id="example2" class="table customTbl table-bordered table-hover dataTable">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Functions Name</th>
            <th>Candidte Name</th>
            <th>Technical_Qualification</th>
            <th>Date</th>
            <th>Docs</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sl = 1;
        foreach ($resumeList as $list) { ?>
            <tr>
                <td><?php echo $sl++; ?> </td>
                <td><?php echo $list->functions_name; ?> </td>
                <td><?php echo $list->candidte_name; ?> </td>
                <td><?php echo $list->technical_qualification; ?> </td>
                <td><?php echo date("d-m-Y", strtotime($list->time)); ?> </td>
                <td>
                    <a href="<?php echo base_url() . $list->resume; ?>" class="btn btn-xs" data-title="download"
                        target="_blank" style="background:#f8bb06; color:#000;"><i class="fa fa-link"
                            aria-hidden="true"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>