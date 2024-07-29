
<script type="text/javascript">
  $(document ).ready(function() {
    var basepath = $("#basepath").val();
       $(document).on("click", ".status", function() {
        
    var uid = $(this).data("restrictedid");
        var status = $(this).data("setstatus");
        var url = basepath + 'development/setrestrictedURLStatus';
        setActiveStatus(uid, status, url);

    });

        $("#myInput1").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable1 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


     $("#myInput2").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    $("#myInput3").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable3 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  $("#myInput4").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable4 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
   });
</script>   
<style>
#contralist td{
vertical-align: inherit;
}

.passrest{
    color: #b742a2;
    font-weight: bold;

}
</style>
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">restricted URL</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">restricted URL List</h3>&nbsp;
              <a href="<?php echo base_url();?>development/addRestrictedURL" class="link_tab <?php echo $bodycontent['editable'];?>"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
     

              <div class="datatalberes table-responsive" >
              <table id="example" class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th >URL</th>
                
                 
                  <th style="width:10%;">Restricted </th>
                   <th style="width:5%;">Blocked</th> 
                   <th style="width:5%;" class="<?php echo $bodycontent['editable'];?>">Edit</th> 
                   <th style="width:10%;" class="<?php echo $bodycontent['editable'];?>">Action</th> 
               
               
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				          
                      $i = 1;
                      $row=1;
                      foreach ($bodycontent['restrictedUrlList'] as $value) {
                         $status = "";
                        if($value->is_active=="Y")
                        {
                          $status = '<div class="status_dv "><span class="label label-success status_tag status" data-setstatus="N" data-restrictedid="'.$value->restricted_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                        }
                        else
                        {
                          $status = '<div class="status_dv"><span class="label label-danger status_tag status" data-setstatus="Y" 
                          data-restrictedid="'.$value->restricted_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                        }   
                     
                        
                       
              	?>

					          <tr>
						            <td ><?php echo $i; ?></td>
                        
            
                        <td style="font-weight: bold;color: #c41f1f;"><?php echo $value->url; ?></td>                                              
                                                                     
                                                   
                        <td>
                          <?php
                  
                  
                    ?>
          <span class="label label-warning"><?php 

                    if ($value->user_role=='SADM') {
                      echo "Super Admin";
                    }else if($value->user_role=='ADM'){
                       echo "Admin";
                    }else if($value->user_role=='RIC'){
                       echo "Regional In-Charge";
                    }else if($value->user_role=='BM'){
                       echo "Site In-Charge";
                    }else{
                       echo "Developer";
                    }

           ?></span>
                     
                   
                
                          </td> 
                        <td style="text-align: center;"><?php

                          if ($value->is_active=="Y") {?>
                           <b style="color: red;">Yes</b>
                         <?php }else{?>
                           <b style="color: green;">No</b>
                        <?php  }
                        ?></td>                            
                           <td class="<?php echo $bodycontent['editable'];?>">
                          <a href="<?php echo base_url(); ?>development/addRestrictedURL/<?php echo $value->restricted_id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
                            <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                        </td> 
                        <td class="<?php echo $bodycontent['editable'];?>"><?php echo $status; ?></td>                       
                       
                    </tr>              			
              	<?php
                    $i++;$row++;
              		}

              	?>
                </tbody>
               
              </table>

              </div>
<!--  super admin memu    -->
<span class="btn bg-maroon btn-flat btn-xs">Super Admin Menu</span><br><br>

                <div class="datatalberes table-responsive" >
                  <input id="myInput1" type="text" class="form-control" placeholder="Search.." style="border: 1px solid #3284a4;color: #601054;">
              <table id="myTable1" class="table table-bordered table-striped" style="border-collapse: collapse !important;">
                <thead>
               <tr style="color: #fff;background-color: #3284a4">
                  <th style="width:5%;">Sl</th>                
                  <th style="width:15%;">Parent Menu </th>
                  <th style="width:15%;">Child Menu</th>   
                  <th style="width:6%;">Menu Sl</th>  
                   
                  <th >Link </th>
                  <th style="width:6%;">Status </th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  
                      $i = 1;
                      $row=1;
                      foreach ($bodycontent['superAdminMenu'] as $value) {
                       
                        
                       
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td style="font-weight: bold;color: #a63b9a; "><?php echo $value->adm_menu_name;?></td>
                    <td></td>
                    <td></td>
                     <td><?php echo $value->adm_menu_link;?></td>
                    <td><?php

                          if ($value->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                   
                    
                  </tr>
                  <?php
                  $childMenu=$this->method_call_view->getChildMenu($value->adm_menu_id,'administartor_menu_master');

                    foreach ($childMenu as $child_menu) {
                    
                  ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold;color: #3b4a9f; "><?php echo $child_menu->adm_menu_name;?></td>
                   <td><?php echo $child_menu->menu_srl;?></td>
                       <td><?php echo $child_menu->adm_menu_link;?></td>
                    <td><?php

                          if ($child_menu->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                  </tr>
                                       
                       
                                
                <?php
                  }
                    $i++;$row++;
                  }

                ?>
                </tbody>
               
              </table>

              </div>
<!--  end super admin memu    -->


<!--  Region In-charge   memu    -->
<span class="btn bg-maroon btn-flat btn-xs">Admin Menu</span><br><br>
                <div class="datatalberes table-responsive" >
               <input id="myInput2" type="text" class="form-control" placeholder="Search.." style="border: 1px solid #3284a4;color: #601054;">
              <table id="myTable2" class="table table-bordered table-striped" style="border-collapse: collapse !important;">
                <thead>
               <tr style="color: #fff;background-color: #3284a4">
                  <th style="width:5%;">Sl</th>                
                  <th style="width:15%;">Parent Menu </th>
                  <th style="width:15%;">Child Menu</th>   
                  <th style="width:6%;">Menu Sl</th>  
                   
                  <th >Link </th>
                  <th style="width:6%;">Status </th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  
                      $i = 1;
                      $row=1;
                      foreach ($bodycontent['adminMenu'] as $value) {
                       
                        
                       
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td style="font-weight: bold;color: #a63b9a; "><?php echo $value->adm_menu_name;?></td>
                    <td></td>
                    <td></td>
                     <td><?php echo $value->adm_menu_link;?></td>
                    <td><?php

                          if ($value->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                   
                    
                  </tr>
                  <?php
                  $childMenu=$this->method_call_view->getChildMenu($value->adm_menu_id,'user_menu_master');

                    foreach ($childMenu as $child_menu) {
                    
                  ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold;color: #3b4a9f; "><?php echo $child_menu->adm_menu_name;?></td>
                   <td><?php echo $child_menu->menu_srl;?></td>
                       <td><?php echo $child_menu->adm_menu_link;?></td>
                    <td><?php

                          if ($child_menu->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                  </tr>
                                       
                       
                                
                <?php
                  }
                    $i++;$row++;
                  }

                ?>
                </tbody>
               
              </table>

              </div>
<!--  end admin memu    -->



<!--  Region In-charge   memu    -->
<span class="btn bg-maroon btn-flat btn-xs">Region In-charge Menu</span><br><br>
                <div class="datatalberes table-responsive" >
               <input id="myInput3" type="text" class="form-control" placeholder="Search.." style="border: 1px solid #3284a4;color: #601054;">
              <table id="myTable3" class="table table-bordered table-striped" style="border-collapse: collapse !important;">
                <thead>
               <tr style="color: #fff;background-color: #3284a4">
                  <th style="width:5%;">Sl</th>                
                  <th style="width:15%;">Parent Menu </th>
                  <th style="width:15%;">Child Menu</th>   
                  <th style="width:6%;">Menu Sl</th>  
                   
                  <th >Link </th>
                  <th style="width:6%;">Status </th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  
                      $i = 1;
                      $row=1;
                      foreach ($bodycontent['regionMenu'] as $value) {
                       
                        
                       
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td style="font-weight: bold;color: #a63b9a; "><?php echo $value->adm_menu_name;?></td>
                    <td></td>
                    <td></td>
                     <td><?php echo $value->adm_menu_link;?></td>
                    <td><?php

                          if ($value->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                   
                    
                  </tr>
                  <?php
                  $childMenu=$this->method_call_view->getChildMenu($value->adm_menu_id,'regional_menu_master');

                    foreach ($childMenu as $child_menu) {
                    
                  ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold;color: #3b4a9f; "><?php echo $child_menu->adm_menu_name;?></td>
                   <td><?php echo $child_menu->menu_srl;?></td>
                       <td><?php echo $child_menu->adm_menu_link;?></td>
                    <td><?php

                          if ($child_menu->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                  </tr>
                                       
                       
                                
                <?php
                  }
                    $i++;$row++;
                  }

                ?>
                </tbody>
               
              </table>

              </div>
<!--  end Region In-charge  memu    -->





<!--  Region In-charge   memu    -->
<span class="btn bg-maroon btn-flat btn-xs">Site In-charge Menu</span><br><br>
                <div class="datatalberes table-responsive" >
               <input id="myInput4" type="text" class="form-control" placeholder="Search.." style="border: 1px solid #3284a4;color: #601054;">
              <table id="myTable4" class="table table-bordered table-striped" style="border-collapse: collapse !important;">
                <thead>
               <tr style="color: #fff;background-color: #3284a4">
                  <th style="width:5%;">Sl</th>                
                  <th style="width:15%;">Parent Menu </th>
                  <th style="width:15%;">Child Menu</th>   
                  <th style="width:6%;">Menu Sl</th>  
                   
                  <th >Link </th>
                  <th style="width:6%;">Status </th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  
                      $i = 1;
                      $row=1;
                      foreach ($bodycontent['siteMenu'] as $value) {
                       
                        
                       
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td style="font-weight: bold;color: #a63b9a; "><?php echo $value->adm_menu_name;?></td>
                    <td></td>
                    <td></td>
                     <td><?php echo $value->adm_menu_link;?></td>
                    <td><?php

                          if ($value->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                   
                    
                  </tr>
                  <?php
                  $childMenu=$this->method_call_view->getChildMenu($value->adm_menu_id,'bm_menu_master');

                    foreach ($childMenu as $child_menu) {
                    
                  ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold;color: #3b4a9f; "><?php echo $child_menu->adm_menu_name;?></td>
                   <td><?php echo $child_menu->menu_srl;?></td>
                       <td><?php echo $child_menu->adm_menu_link;?></td>
                    <td><?php

                          if ($child_menu->is_active=="Y") {?>
                           <b style="color: green;">Yes</b>
                         <?php }else{?>
                           <b style="color: red;">No</b>
                        <?php  }
                        ?></td>
                  </tr>
                                       
                       
                                
                <?php
                  }
                    $i++;$row++;
                  }

                ?>
                </tbody>
               
              </table>

              </div>
<!--  end Site In-charge  memu    -->














            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->