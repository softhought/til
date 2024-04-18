
<section class="layout-box-content-format1">
<table  class="table customTbl table-bordered table-striped dataTable" style="width: 100%">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Title</th>
         <th>Action</th>
       
      </tr>
   </thead>
   <tbody>
      <?php
         $sl = 1;
         
         foreach ($relationsDetailsList as $key => $value) {
         
             ?>
      <tr>
         <td><?php echo $sl++; ?></td>
         <td><?php echo $value->title; ?></td>
         <td><?php ?></td>
      
      </tr>
      <?php } ?>
   </tbody>
</table>
</div>
<section>
