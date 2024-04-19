
<section class="layout-box-content-format1">
<table  class="table customTbl table-bordered table-striped dataTable" style="width: 100%">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Title</th>
         <th>View</th>
         <th>Download</th>
       
      </tr>
   </thead>
   <tbody>
      <?php
         $sl = 1;
         $dir_path = base_url().'assets/test_doc'; //local
         foreach ($documenDtl as $key => $value) {
         
             ?>
      <tr>
         <td><?php echo $sl++; ?></td>
         <td><?php echo $value->uploaded_file_desc; ?></td>
         <td align="center"><a href="<?php echo $dir_path."/".$value->random_file_name;?>"
            class="btn btn-xs" data-title="download" target="_blank" style="background: #f8bb06; color:#000;"><i
            class="fa fa-link" aria-hidden="true"></i></a></td>
         <td align="center"><a href="<?php echo $dir_path."/".$value->random_file_name;?>"
            class="btn btn-xs" data-title="download" style="background: #f8bb06; color:#000;" download><i
             class="fa fa-download" aria-hidden="true"></i></a> </td>
      <?php } ?>
   </tbody>
</table>
</div>
<section>
