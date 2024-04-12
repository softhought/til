<script>
$(document).ready(function() {

    var basepath = $("#basepath").val();
});
</script>
<section class="layout-box-content-format1">

    <div class="card card-primary form-view">

        <div class="card-header box-shdw">
            <h3 class="card-title">Create Url</h3>

            <div class="btn-group btn-group-sm float-right <?php echo accesspermissionMicro("button","urlpermission/create","view"); ?>" role="group" aria-label="MoreActionButtons">
                <a href="<?php echo base_url(); ?>urlpermission" class="btn btn-info btnpos">
                    <i class="fas fa-clipboard-list"></i> List </a>
            </div>
        </div><!-- /.card-header -->



        <div class="<?php echo accesspermission('View');?>">
            <form name="urlForm" id="urlFrom" action="<?php echo base_url(); ?>urlpermission/store"
                enctype="multipart/form-data" method="POST">
                <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
                <input type="hidden" name="url_id" id="url_id" value="<?php echo $bodycontent['url_id']; ?>">
                <div class="card-body">
                    <div class="formblock-box">
                        <!--  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Status Info</h3> -->
                        <div class="row">
                            <!-- <div class="col-md-1"></div> -->
                            <div class="col-md-4">
                                <label for="url">Url *</label>
                                <div id="sel_chaptererr" class="form-group">
                                    <div class="input-group input-group-sm" id="countryeerr">
                                        <input required type="text" class="form-control forminputs typeahead" id="url"
                                            name="url" placeholder="Enter Url" autocomplete="off" value="<?php 
                                            if($bodycontent['mode'] == 'EDIT')
                                            {
                                                echo $bodycontent['urlEditdata']->url;
                                            } ?>">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="url_label">Label *</label>
                                <div id="url_label" class="form-group">
                                    <div class="input-group input-group-sm" id="url_lebel">
                                        <input required type="text" class="form-control forminputs typeahead"
                                            id="url_label" name="url_label" placeholder="Enter Lebel" autocomplete="off"
                                            value="<?php 
                                            if($bodycontent['mode'] == 'EDIT')
                                            {
                                                echo $bodycontent['urlEditdata']->label;
                                            } ?>">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="menu_id">Menu *</label>
                                <div id="menu_div" class="form-group">
                                    <div class="input-group input-group-sm" id="access_permissionerr">


                                        <select class="form-control select2" data-show-subtext="true" name="menu_id"
                                            id="menu_id" data-show-subtext="true" data-actions-box="true"
                                            data-live-search="true" required style="height: calc(1.813rem + 9px);">

                                            <option value="0">Select</option>
                                            <?php foreach($bodycontent['menuList'] as $menulist){
                                                ?><option value="<?php echo $menulist['menuid']; ?>" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['urlEditdata']->menu_id  == $menulist['menuid']){
                                                echo "selected";
                                                } ?>>
                                                <?php echo $menulist['name']; ?>
                                            </option>

                                            <?php
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php

$access_permission = array('Entry','List');


?>
                            <div class="col-md-2">
                                <label for="url_type">Url Type*</label>
                                <div id="url_typeDiv" class="form-group">
                                    <div class="input-group input-group-sm" id="access_permissionerr">


                                        <select class="form-control select2" data-show-subtext="true" name="url_type"
                                            id="url_type" data-show-subtext="true" data-actions-box="true"
                                            data-live-search="true" required style="height: calc(1.813rem + 9px);">

                                            <option value="0">Select</option>
                                            <?php foreach ($access_permission as $value) { ?>
                                            <option value="<?php echo $value; ?>" <?php if($bodycontent['mode'] == 'EDIT')
                                                    {
                                            $accessIDs=explode(',',$bodycontent['urlEditdata']->type);
                                             if (in_array($value,$accessIDs))
                                                {
                                             echo "selected";
                                                }
                                                     }?>><?php echo $value; ?></option>
                                            <?php  }  ?>


                                        </select>
                                    </div>
                                </div>
                            </div>





                        </div>


                    </div>



                </div> <!-- /.card-body -->



                <div class="formblock-box">
                    <div class="row <?php if($bodycontent['mode']=='EDIT'){echo accesspermission('Edit');}?>">
                        <div class="col-md-10">
                            <p id="errormsg" class="errormsgcolor"></p>
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="savebtn"
                                style="width: 80%;"><?php echo $bodycontent['btnText']; ?>&nbsp;<i
                                    class="fas fa-chevron-right"></i></button>
                            <span class="btn btn-sm action-button loaderbtn" id="loaderbtn"
                                style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>

                        </div>
                    </div>
                </div>





            </form>

        </div>



    </div><!-- /.card -->


</section>