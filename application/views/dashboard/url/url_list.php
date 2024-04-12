<script>
$(document).ready(function() {
    var groupColumn = 2;
    var table = $('#urllist').DataTable({
        columnDefs: [{
            visible: false,
            targets: groupColumn
        }],
        order: [
            [groupColumn, 'asc']
        ],
        displayLength: 25,
        drawCallback: function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api
                .column(groupColumn, {
                    page: 'current'
                })
                .data()
                .each(function(group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="5" style="background: #e5e5fc; font-size: 16px;color: #2e3094;"><i class="fas fa-angle-double-right"></i>&nbsp;' +
                                group + '</td></tr>');

                        last = group;
                    }
                });
        },
    });

    // Order by the grouping
    $('#example tbody').on('click', 'tr.group', function() {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});
</script>
<?php accesspermissionMicro("page","urlpermission","view"); ?>

<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">URL LIST</h3>

            <div class="btn-group btn-group-sm float-right <?php echo accesspermissionMicro("button","urlpermission","add"); ?>"
                role="group" aria-label="MoreActionButtons">
                <a href="<?php echo base_url(); ?>urlpermission/create" class="btn btn-info btnpos link_tab">
                    <i class="fas fa-clipboard-list"></i> ADD </a>
            </div>

        </div><!-- /.card-header -->
        <div class="card-body">

            <div class="formblock-box">
                <div class="table-responsive">
                    <table id="urllist" class="table customTbl table-bordered table-hover dataTable no-footer ">
                        <thead>
                            <!-- <th>SL. NO</th> -->
                            <th width="40%">URL</th>
                            <th width="60%">Label</th>
                            <th width="40%">Menu</th>
                            <th width="40%">Url Type</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                        foreach($bodycontent['url_list'] as $url_list) {
                            ?>
                            <tr>
                                <!-- <td><?php echo $i; $i++; ?></td> -->
                                <td><?php echo $url_list->url; ?></td>
                                <td><?php echo $url_list->label; ?></td>
                                <th><?php echo $url_list->name; ?></th>
                                <td><?php echo $url_list->type; ?></td>
                                <td>
                                    <div class="<?php echo accesspermissionMicro("button","urlpermission","edit"); ?>">

                                    
                                    <a href="<?php echo base_url(); ?>urlpermission/create/<?php echo $url_list->url_id; ?>"
                                        class="btn tbl-action-btn padbtn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <section>