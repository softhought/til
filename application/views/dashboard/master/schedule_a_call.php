<style>
   .text-elipse {
  overflow: hidden;
  display: -webkit-box !important;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;

  transition: -webkit-line-clamp 0.3s ease;
  text-align: left;
}
.expands {
  -webkit-line-clamp: unset;
}

 .table_wrapper{
    display: block;
    overflow-x: auto;

}
p{
   padding: 0px!important;
   margin-bottom: -2px;
}

</style>
<section class="layout-box-content-format1">
   <div class="card card-primary list-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Schedule a call with an expert</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="formblock-box table_wrapper">
            <table id="example2" class="table customTbl table-bordered table-hover dataTable">
               <thead>
                  <tr>
                     <th>Sl</th>
                     <th>Customer Name</th>
                     <th>Phone Number</th>
                     <th>Email Address</th>
                     <th>Organization</th>
                     <th>Country</th>
                     <th>State</th>
                     <th>Query</th>
                     <th>Product</th>
                     <th>Model</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $sl=1; foreach ($bodycontent['callRequestList'] as $list) { ?>
                  <tr>
                     <td><?php echo $sl++; ?> </td>
                     <td><?php echo $list->name; ?> </td>
                     <td><?php echo $list->phone; ?> </td>
                     <td><?php echo $list->email; ?> </td>
                     <td><?php echo $list->organization; ?> </td>
                     <td><?php echo $list->country; ?> </td>
                     <td><?php echo $list->state; ?> </td>
                     <td><?php echo $list->query; ?> </td>
                     <td><?php echo $list->product; ?> </td>
                     <td><?php echo $list->model; ?> </td>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>