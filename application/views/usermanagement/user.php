<script src="<?php echo base_url();?>assets/js/customJs/user.js"></script>

<?php if($this->session->flashdata('success')){ ?>

<div class="alert alert-success alert-dismissible">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

    <h5><i class="icon fas fa-check"></i> Success!</h5>

    <?php echo $this->session->flashdata('success'); ?>

</div>

<?php }?>

<?php if($this->session->flashdata('error')){ ?>

<div class="alert alert-success alert-dismissible">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

    <h5><i class="icon fas fa-check"></i> Success!</h5>

    <?php echo $this->session->flashdata('error'); ?>

</div>

<?php }?>


<?php accesspermissionMicro("page","user","view"); ?>
<section class="layout-box-content-format1">

    <div class="card card-primary list-view">

        <div class="card-header box-shdw">

            <h3 class="card-title">User List</h3>

            <div class="btn-group btn-group-sm float-right <?php echo accesspermissionMicro("button","user","add"); ?>" role="group" aria-label="MoreActionButtons">

                <a href="<?php echo base_url(); ?>user/create" class="btn btn-info btnpos link_tab">

                    <i class="fas fa-plus"></i> Add </a>

            </div>

            <!--  <a href="<?php echo base_url();?>user/create" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a> -->

        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="formblock-box">
                <table id="example2" class="table customTbl table-bordered table-hover dataTable">
                    <thead>
                        <tr>

                            <th>Name</th>

                            <th>User Name</th>

                            <th>Mobile No.</th>
                            <!-- <th>Access</th> -->

                            <th>Role</th>
                            <!--  <th>IR Person</th> -->

                            <th>Status</th>
                            <th>Deal Manger</th>

                            <th>is Active</th>

                            <th>Action</th>
                            <th>Permission</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php 

                    // pre($bodycontent['userslist']);

                    foreach ($bodycontent['userslist'] as $user) { ?>

                        <tr>

                            <td><?php echo $user->name; ?> </td>

                            <td><?php echo $user->user_name; ?></td>

                            <td><?php echo $user->mobile_no; ?></td>
                            <!-- <td><?php echo $user->access_permission; ?></td> -->

                            <td><?php echo $user->role; ?></td>
                            <!-- <td><?php if($user->is_ir_person=='Y'){
                          echo '<b style="color:green">Yes</b>';
                        }else{
                           echo '<b style="color:#e12828">No</b>';
                        } ?></td> -->

                            <td style="text-align: center;">



                                <?php  if ($user->is_online=='Y') { ?>

                                <a onclick="openUserloginLogoutDetailModal(<?php echo $user->id; ?>);" href="#">

                                    <img src="<?php echo(base_url());?>assets/img/online.png"
                                        style="width: 23px;height: 23px;" alt="active icon">

                                </a>

                                <?php }else{ ?>

                                <a href="#">

                                    <img onclick="openUserloginLogoutDetailModal(<?php echo $user->id; ?>);"
                                        src="<?php echo(base_url());?>assets/img/offline.png"
                                        style="width: 23px;height: 23px;" alt="inactive icon">

                                </a>

                                <?php } ?>

                            </td>
                            <td><?php  if($user->is_deal_manger=='Y') {  echo "Yes";}else{ echo "No"; } ?></td>
                            <td style="text-align: center;">
                                <div class="<?php echo accesspermissionMicro("button","user","edit"); ?>">
                                    <?php  if ($user->is_active=='Y') { ?>

                                    <a href="<?php echo base_url();?>user/InactiveUser/<?php echo $user->id; ?>">

                                        <img src="<?php echo(base_url());?>assets/img/active.png"
                                            style="width: 23px;height: 23px;" alt="active icon">

                                    </a>

                                    <?php }else{ ?>

                                    <a href="<?php echo base_url();?>user/ActiveUser/<?php echo $user->id; ?>">

                                        <img src="<?php echo(base_url());?>assets/img/inactive.png"
                                            style="width: 23px;height: 23px;" alt="inactive icon">

                                    </a>

                                    <?php } ?>
                                </div>
                            </td>


                            <td style="text-align:center;">
                                <div class="<?php echo accesspermissionMicro("button","user","edit"); ?>">

                                    <a href="<?php echo base_url(); ?>user/create/<?php echo $user->id; ?>"
                                        class="btn tbl-action-btn padbtn">

                                        <i class="fas fa-edit"></i>

                                    </a>
                                </div>
                            </td>
                            <td style="text-align:center;">
                                <div class="<?php //echo accesspermissionMicro("button","user","edit"); ?>">
                                    <a id="user_prm"
                                        href="<?php echo base_url(); ?>urlpermission/userUrlPermission/<?php echo $user->id; ?>">
                                        <i class="fas fa-user-lock" style="font-size: 21px;
                                    color: #252b86;"></i></a>
                            </td>

            </div>

            </tr>



            <?php } ?>

            </tbody>

            </table>

        </div>

    </div><!-- /.card-body -->

    </div><!-- /.card -->

</section>



<!-- Modal -->

<section class="layout-box-content-format1">

    <div class="modal fade" id="myModal" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header card-header box-shdw" style="color: white;">

                    <h5 class="modal-title">Login & Logout Details</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">

                        <span aria-hidden="true">×</span>

                    </button>

                </div>



                <div id="ModalBody" class="modal-body">



                </div>



                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-sm action-button" data-dismiss="modal">Close</button>

                </div>

            </div>

            <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

    </div>

</section>