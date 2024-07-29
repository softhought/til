<script>
$(document).ready(function() {

    var Toast = Swal.mixin({

        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000

    });

    var basepath = $("#basepath").val();

    $(document).on('submit', '#Createuserurlprm', function(event) {
        event.preventDefault();

        var formDataserialize = $("#Createuserurlprm").serialize();
        formDataserialize = decodeURI(formDataserialize);

        var formData = {
            formDatas: formDataserialize
        };


        $.ajax({
            type: "POST",
            url: basepath + 'urlpermission/getmenupermission',
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: formData,

            success: function(result) {

                if (result.status == 1) {

                    Toast.fire({

                        type: 'success',

                        title: result.msg

                    });

                }


            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                // alert(msg);  
            }
        }); /*end ajax call*/


    });

});
</script>
<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">User Url Permission</h3>
            <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons"> -->
            <!-- ------------end of show log------------- -->
            <!-- <a href="<?php echo base_url(); ?>urlpermission" class="btn btn-info btnpos">
                    <i class="fas fa-clipboard-list"></i> List </a>
            </div> -->
            <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">
                <a href="<?php echo base_url(); ?>urlpermission/create" class="btn btn-info btnpos link_tab">
                    <i class="fas fa-clipboard-list"></i> ADD </a>
            </div> -->
            <div class="btn-group btn-group-sm float-right"
                role="group" aria-label="MoreActionButtons">
                <a href="#" class="btn btn-info btnpos">
                <?php  echo $bodycontent['userDetail']->name; ?>
                     </a>
            </div>
        </div><!-- /.card-header -->
        <div class="<?php echo accesspermission('View');?>">
            <div class="card-body">
                <!-- <p class="badge text-center"><?php  //echo $bodycontent['userDetail']->name; ?></p> -->
                <div class="formblock-box">
                    <div class="sidebar">
                        <form id="Createuserurlprm">

                            <input type="hidden" name="mode" value="<?php echo $bodycontent['mode']; ?>">
                            <!-- Mode of ADD Edit -->
                            <input type="hidden" name="user_id" value="<?php echo $bodycontent['user_id']; ?>">
                            <!-- User id -->
                            <table class=" table-bordered">
                                <?php 
                             $i=1;
                            if(sizeof($bodycontent['menulist'])>0)
                            { 
                                    foreach($bodycontent['menulist'] as $firstlevel)
                                    {
                                        if(sizeof($firstlevel['secondLevelMenu'])>0)   /**check parent menu has any child or not*/
                                        {
                                        ?>
                                <tr>
                                    <td colspan=2 class="badge bg-pp spft">
                                        <?php echo $firstlevel['menu_name']; ?>
                                        <!-- first level menu name if this menu has a child menu -->
                                    </td>
                                    <td colpans=2>&nbsp;</td>
                                    <td colpans=2>&nbsp;</td>
                                    <td colpans=3>&nbsp;</td>
                                </tr>
                                <?php
                                    foreach($firstlevel['secondLevelMenu'] as $second_lvl) 
                                    { 
                                         if(sizeof($second_lvl['thirdLevelMenu'])>0)    
                                          /**Check second level menu has any child menu*/
                                    {	          
                                ?>
                                <tr>
                                    <td colspan=1>&nbsp;</td>
                                    <td colspan=4 class="badge bg-vio spft" style="float: right;">
                                        <?php echo $second_lvl['second_menu_name']; ?>
                                        <!-- if second level menu name if this menu has child menu  -->
                                    </td>
                                    <td colspan=2>
                                        &nbsp;
                                    </td>
                                    <td colspan=1>&nbsp;</td>
                                </tr>
                                <?php 
                             
                                foreach($second_lvl['thirdLevelMenu'] as $third_lvl){ 
                            ?>
                                <tr>
                                    <td colspan=1>&nbsp;</td>
                                    <td colspan=1>&nbsp;</td>
                                    <!-- <td colspan=1>&nbsp;</td> -->
                                    <td colspan=4 class="badge bg-purple"><?php echo $third_lvl['third_menu_name']; ?>
                                        <!-- Third level menu name-->

                                    </td>
                                    <td colspan=1>&nbsp;</td>
                                </tr>
                                <?php //} ?>
                                <?php 
                                 if(!empty($third_lvl['menu_url']))
                                 /**check menu url has or not */
                                 {
                                    foreach($third_lvl['menu_url'] as $menu_url ) 

                                    { ?>
                                <tr>
                                    <td colspan=1>&nbsp;</td>
                                    <td colspan=1>&nbsp;</td>
                                    <td colspan=1>&nbsp;</td>
                                    <!-- <td colspan=1></td> -->
                                    <td colspan=3 style="float: right;background: #045b86;color: white;" class="badge">
                                        <?php echo $menu_url['lebel']; ?>
                                    </td>
                                    <input type="hidden" name="menu_id[]" value="<?php echo $menu_url['menu_id']; ?>">
                                    <!-- url menu id -->
                                    <input type="hidden" name="url_id[]" value="<?php echo $menu_url['url_id'];  ?>">
                                    <!-- url id  -->
                                    <td>
                                        <?php
                                                    $access_permission = array('ADD','EDIT','DELETE','VIEW');

                                                    ?>
                                        <select class="form-control select2" data-show-subtext="true"
                                            name="access_permission<?php echo $menu_url['url_id'];  ?>[]"
                                            id="access_permission<?php echo $i++;?>" data-show-subtext="true"
                                            data-actions-box="true" data-live-search="true" multiple="multiple">
                                            <?php foreach ($access_permission as $value) { ?>
                                            <option value="<?php echo $value; ?>" <?php if($bodycontent['mode'] == 'EDIT')
                                                        {
                                                                if(in_array($menu_url['url_id'],$bodycontent['url'])) 
                                                                /**Check url id is match or not */
                                                                {
                                                            if (in_array($value,$bodycontent['permission_access'][$menu_url['url_id']])) 
                                                            /**check permission access field and select in edit mode */
                                                            {
                                                                echo "selected";
                                                            }
                                                        }
                                                    }?>>
                                                <?php echo $value; ?>
                                            </option>
                                            <?php  }  ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php
                                    }               /**end of Check third level menu*/
                                }
                                    ?>
                                <?php 
                                                    /**end of Check second level menu has any child menu*/
                            }else{
                            ?>
                                <tr>
                                    <td colspan=1>&nbsp;</td>
                                    <td colspan=6 class="badge bg-purple" style="float: left;">
                                        <?php echo $second_lvl['second_menu_name']; ?>
                                        <!--print second level menu name if second level menu has no child menu -->

                                    </td>
                                    <td colspan=1>&nbsp;</td>
                                </tr>
                                <?php 
                                if(!empty($second_lvl['menu_url']))
                                {
                                   
                                     foreach($second_lvl['menu_url'] as $menu_url )
                                     { ?>
                                <tr>
                                    <td colspan=1></td>
                                    <td colspan=1></td>
                                    <td colspan=4 class="badge" style="background: #045b86;color: white;">
                                        <?php echo $menu_url['lebel']; ?></td>
                                    <input type="hidden" name="menu_id[]" value="<?php echo $menu_url['menu_id']; ?>">
                                    <!-- url menu id -->
                                    <input type="hidden" name="url_id[]" value="<?php echo $menu_url['url_id'];  ?>">
                                    <!-- url id  -->

                                    <td>
                                        <?php
                                             $access_permission2 = array('ADD','EDIT','DELETE','VIEW'); 
                                        ?>
                                        <select class="form-control select2" data-show-subtext="true"
                                            name="access_permission<?php echo $menu_url['url_id'];  ?>[]"
                                            id="access_permission<?php echo $i++;?>" data-show-subtext="true"
                                            data-actions-box="true" data-live-search="true" multiple="multiple">
                                            <?php foreach ($access_permission2 as $value) { ?>
                                            <option value="<?php echo $value; ?>" <?php if($bodycontent['mode'] == 'EDIT')
                                                        {
                                                                if(in_array($menu_url['url_id'],$bodycontent['url']))
                                                                 /**Check url id is match or not */
                                                                {
                                                            if (in_array($value,$bodycontent['permission_access'][$menu_url['url_id']]))
                                                            {
                                                                /**check permission access field and select in edit mode */
                                                                echo "selected";
                                                            }
                                                        }
                                                    }?>>

                                                <?php echo $value; ?>
                                            </option>
                                            <?php  }  ?>
                                        </select>
                                    </td>
                                    <td colspan=1>&nbsp;</td>
                                </tr>
                                <?php 
                                     }     
                                }
                                    ?>
                                <?php }
                                }
                                    ?>
                                <?php            } /**end of check parent menu has any child or not*/
                                    }
                            } else{ ?>
                                <tr>
                                    <td coolspan="1">
                                        <?php echo $firstlevel['menu_name']; ?>
                                        <!--print parent level menu name if parent level menu has no child menu -->
                                    </td>
                                    <td colpans=2>&nbsp;</td>
                                    <td colpans=2>&nbsp;</td>
                                    <td colpans=3>&nbsp;</td>
                                    <td colpans=1>&nbsp;</td>
                                </tr>
                                <?php } ?>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.card -->
    <div id="btnusersaveDiv" style="margin: 50px auto;text-align: center;">
        <input type="submit" id="btnusersave" class="btn formBtn  bg-vio" value="Save" />
    </div>
    </form>
</section>