
<style>


.select2-container--default .select2-selection--multiple .select2-selection__choice {
    padding: 2px;
}

.select2 {
    width: 50% !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    box-sizing: border-box;
    list-style: none;
    margin: 0;
    padding: 1px 14px;
    width: 100%;
}



.tree {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #fbfbfb;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)
}

.tree li {
    list-style-type: none;
    margin: 0;
    padding: 10px 5px 0 5px;
    position: relative
}

.tree li::before,
.tree li::after {
    content: '';
    left: -20px;
    position: absolute;
    right: auto
}

.tree li::before {
    /* border-left: 1px solid #999; */
    border-left: 1px dashed #1f14a6;
    bottom: 50px;
    height: 100%;
    top: 0;
    width: 1px
}

.tree li::after {
    /* border-top: 1px solid #999; */
    border-top: 1px dashed #1f14a6;
    height: 20px;
    top: 30px;
    width: 25px
}

.tree li>span {
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border: 1px solid #b1b2f4;
    border-radius: 5px;
    display: inline-block;
    padding: 3px 8px;
    text-decoration: none;
    background: #ececec;
    color: #2e3094;
    font-size: 12px;
}

.tree li.parent_li>span {
    cursor: pointer
}

.tree>ul>li::before,
.tree>ul>li::after {
    border: 0
}

.tree li:last-child::before {
    height: 30px
}

/* .tree li.parent_li>span:hover,
.tree li.parent_li>span:hover+ul li span {
    background: #eee;
    border: 1px solid #94a0b4;
    color: #000
} */

.select2 select2-container select2-container--default {
    border: 0px !important;
}

.tree li select span.selection {
    border: 0px !important;
}

.tree li.select2-search:last-child::before {
    border-left: 0 !important;
}

.tree .select2-selection__rendered li::before {
    border-left: 0 !important;
}



.tree li.select2-search:last-child::after {
    border-top: 0px solid #999;

}

.tree .select2-selection__rendered li::after {
    border-top: 0px solid #999;
}

.tree li>span.select2 {
    border: 0px !important;
}

.tree .select2-selection__rendered li>span {
    border: 0px !important;
    padding-left: 5px !important;
}

.select2-container--default .select2-selection--multiple {
    margin-left: -8px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fffbfb;
    padding-top: 0px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #fffbfb;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    list-style: none;

    /* padding: 9px; */
    padding-bottom: 0px;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    box-sizing: border-box;
    list-style: none;
    margin: 0;
    padding: -1px 24px;
    width: 100%;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    padding: 6px;
}


.select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-search.select2-search--inline .select2-search__field {
    display: none;
}

.bootstrap-select.show-tick .dropdown-menu .selected span.check-mark {
    position: absolute;
    display: inline-block;
    right: 32px;
    top: 6px;
}

.bootstrap-select .dropdown-menu li a {
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin-top: -14px;
    font-size: 14px;
}

.check-mark {
    color: #2c14a2 !important;
}

.bootstrap-select.show-tick .dropdown-menu li a span.text {
    margin-right: 32px;
    color: #2e3094;
}

.urlbtn {
    color: var(--theme-blue-color);
    font-family: 'Montserrat', sans-serif;
    text-transform: uppercase;
    letter-spacing: 0;
    font-weight: 900;
    background: white;
    border-radius: 40px;
    padding: 4px 16px;
    margin-left: 10px;
    margin-right: 10px;
    border-color: #2e3094;
    opacity: 1.05;
}

.urlbtn:disabled {
    opacity: 1.05;
    cursor: pointer;
}

.urlbtn:hover {
    color: #2e3094;
}
</style>


<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">User Url Permission</h3>
            <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">
                <a href="#" class="btn btn-info btnpos">
                    <?php  echo $bodycontent['userDetail']->name; ?>
                </a>
            </div>
        </div><!-- /.card-header -->
        <div class="<?php echo accesspermission('View');?>">
            <div class="card-body">

                <p class="badge text-center"></p>
                <div class="formblock-box">
                    <div class="row">
                        <div class="col-md-10">
                            <!-- <div class="sidebar"> -->
                            <form id="Createuserurlprm">

                                <?php
                                                    $access_permission = array('ADD','EDIT','DELETE','VIEW');

                                                    ?>

                                <input type="hidden" name="mode" value="<?php echo $bodycontent['mode']; ?>">
                                <!-- Mode of ADD Edit -->
                                <input type="hidden" name="user_id" value="<?php echo $bodycontent['user_id']; ?>">
                                <!-- User id -->

                                <div id="collapseDVR3" class="panel-collapse in">
                                    <div class="tree">
                                        <ul>
                                            <li><span><i class="fa fa-folder-open"></i> Menu</span>
                                                <?php 
                             $i=1;
                            if(sizeof($bodycontent['menulist'])>0)
                            { ?>

                                                <ul>

                                                    <?php
                                    foreach($bodycontent['menulist'] as $firstlevel)
                                    {
                                        if(sizeof($firstlevel['secondLevelMenu'])>0)   /**check parent menu has any child or not*/
                                        {
                                        ?>
                                                    <li><span><i class="fa fa-folder-open"></i>
                                                            <?php echo $firstlevel['menu_name']; ?></span>

                                                        <!-- first level menu name if this menu has a child menu -->
                                                        <ul>
                                                            <?php
                                    foreach($firstlevel['secondLevelMenu'] as $second_lvl) 
                                    { 
                                         if(sizeof($second_lvl['thirdLevelMenu'])>0)    
                                          /**Check second level menu has any child menu*/
                                    {	          
                                ?>
                                                            <li class="collapse"><span> <i
                                                                        class="fa fa-folder-open"></i><?php echo $second_lvl['second_menu_name']; ?></span>


                                                                <!-- if second level menu name if this menu has child menu  -->
                                                                <ul>
                                                                    <?php 
                                        foreach($second_lvl['thirdLevelMenu'] as $third_lvl){ 
                                    ?>


                                                                    <li class="collapse"><span><i
                                                                                class="fa fa-plus-square"></i><?php echo $third_lvl['third_menu_name']; ?></span>
                                                                        <!-- Third level menu name-->

                                                                        <ul>
                                                                            <?php 
                                 if(!empty($third_lvl['menu_url']))
                                 /**check menu url has or not */
                                 {
                                    foreach($third_lvl['menu_url'] as $menu_url ) 

                                    { ?>

                                                                            <li><span> <i
                                                                                        class="fa fa-plus-square"></i><?php echo $menu_url['lebel']; ?></span>

                                                                                <ul>

                                                                                    <input type="hidden"
                                                                                        name="menu_id[]"
                                                                                        value="<?php echo $menu_url['menu_id']; ?>">
                                                                                    <!-- url menu id -->
                                                                                    <input type="hidden" name="url_id[]"
                                                                                        value="<?php echo $menu_url['url_id'];  ?>">
                                                                                    <!-- url id  -->

                                                                                    <li style="width: 30% !important;">
                                                                                        <select
                                                                                            class="form-control selectpicker abc url_selectM "
                                                                                            name="access_permission<?php echo $menu_url['url_id'];  ?>[]"
                                                                                            id="access_permission<?php echo $i++;?>"
                                                                                            data-actions-box="true"
                                                                                            multiple="multiple">
                                                                                            <?php foreach ($access_permission as $value) { ?>
                                                                                            <option
                                                                                                value="<?php echo $value; ?>" <?php if($bodycontent['mode'] == 'EDIT')
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
                                                                                        <!-- text  -->
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                            <?php } ?>
                                                                            <?php
                                                        
                                    }   /**end of Check third level menu*/
                                    
                                    ?>
                                                                        </ul>
                                                                    </li>

                                                                    <?php }
                                    ?>
                                                                </ul>
                                                            </li>

                                                            <?php 
                                                    /**end of Check second level menu has any child menu*/
                            }else{
                            ?>

                                                            <li class="collapse"><span><i class="fa fa-plus-square"></i>
                                                                    <?php echo $second_lvl['second_menu_name']; ?></span>

                                                                <!--print second level menu name if second level menu has no child menu -->

                                                                <?php 
                                            if(!empty($second_lvl['menu_url']))
                                            { ?>
                                                                <ul>
                                                                    <?php
                                   
                                                 foreach($second_lvl['menu_url'] as $menu_url )
                                             { ?>


                                                                    <li class="collapse"><span><i
                                                                                class="fa fa-plus-square"></i>
                                                                            <?php echo $menu_url['lebel']; ?></span>


                                                                        <input type="hidden" name="menu_id[]"
                                                                            value="<?php echo $menu_url['menu_id']; ?>">
                                                                        <!-- url menu id -->
                                                                        <input type="hidden" name="url_id[]"
                                                                            value="<?php echo $menu_url['url_id'];  ?>">
                                                                        <!-- url id  -->

                                                                        <?php
                                                    // $access_permission2 = array('ADD','EDIT','DELETE','VIEW'); 
                                                    ?>
                                                                        <ul>
                                                                            <li style="width: 30% !important;">
                                                                                <select
                                                                                    class="form-control selectpicker abc url_selectM"
                                                                                    name="access_permission<?php echo $menu_url['url_id'];  ?>[]"
                                                                                    id="access_permission<?php echo $i++;?>"
                                                                                    data-actions-box="true"
                                                                                    multiple="multiple">
                                                                                    <?php foreach ($access_permission as $value) { ?>
                                                                                    <option
                                                                                        value="<?php echo $value; ?>" <?php if($bodycontent['mode'] == 'EDIT')
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
                                                                                <!-- text -->
                                                                            </li>
                                                                        </ul>

                                                                    </li>
                                                                    <?php 
                                     } ?>
                                                                </ul>
                                                                <?php }
                                    ?>
                                                            </li>


                                                            <?php }?>

                                                            <?php
                                }
                                    ?>
                                                        </ul>
                                                    </li>
                                                    <?php            } /**end of check parent menu has any child or not*/
                                    } ?>
                                                </ul>
                                                <?php
                            } ?>
                                            </li>
                                        </ul>


                                    </div>
                                </div>

                                <div id="btnusersaveDiv" style="margin: 50px auto;text-align: center;">
                                    <input type="submit" id="btnusersave" class="btn formBtn  bg-vio" value="Save" />
                                </div>
                            </form>
                        </div>
                        <!-- </div> -->

                        <!-- End of col-md-10 -->
                        <div class="col-md-2">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <button class="btn urlbtn float-right" disabled> <span>Url -</span> <span
                                            id="u_count"></span>
                                    </button>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <button class="btn urlbtn float-right " disabled> <span>Add -</span> <span
                                            id="acount"></span>
                                    </button>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <button class="btn urlbtn float-right " disabled> <span>Edit -</span>
                                        <span id="ecount"></span>
                                    </button>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <button class="btn urlbtn float-right" disabled> <span>Delete -</span>
                                        <span id="dcount"></span>
                                    </button>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <button class="btn urlbtn float-right" disabled> <span>View -</span> <span
                                            id="vcount"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.card -->

</section>

<script>
$(document).ready(function() {
    $("#u_count").text("");

   gettotalpermissioncount();

    $(document).on('change', '.abc', function(event) {
        event.stopImmediatePropagation();
        gettotalpermissioncount();
    });

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



    $(".tree li:has(ul)")
        .addClass("parent_li")
        .find(" > span")
        .attr("title", "Collapse this branch");
    $(".tree li.parent_li > span").on("click", function(e) {
        var children = $(this).parent("li.parent_li").find(" > ul > li");
        if (children.is(":visible")) {
            children.hide("fast");
            $(this)
                .attr("title", "Expand this branch")
                .find(" > i")
                .addClass("fa-plus-square")
                .removeClass("fa-minus-square");
        } else {
            children.show("fast");
            $(this)
                .attr("title", "Collapse this branch")
                .find(" > i")
                .addClass("fa-minus-square")
                .removeClass("fa-plus-square");
        }
        e.stopPropagation();
    });


});




function gettotalpermissioncount() {
    
    var select_url = [];
    var addcount = 0;
    var editcount = 0;
    var deletecount = 0;
    var viewcount = 0;
    
    var url_count = 0;
    $.each($('select.url_selectM'), function(index, value) {
    // $(".url_selectM").each(function() {

     url_count++;
        var url_value = $(this).val();
        if ($.trim(url_value)) {
            select_url.push(url_value);
        }

    }); 
    
    $("#u_count").text(url_count);


    for (var i = 0; i < select_url.length; i++) {
        for (var j = 0; j < select_url[i].length; j++) {
            if (select_url[i][j] == 'ADD') {
                addcount++;
            } else if (select_url[i][j] == 'EDIT') {
                editcount++;
            } else if (select_url[i][j] == 'DELETE') {
                deletecount++;
            } else if (select_url[i][j] == 'VIEW') {
                viewcount++;
            }
        }
    }

    $("#acount").text(addcount);
    $("#ecount").text(editcount);
    $("#dcount").text(deletecount);
    $("#vcount").text(viewcount);

}
</script>