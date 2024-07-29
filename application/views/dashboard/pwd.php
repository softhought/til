<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
  <style>

    @font-face {
    font-family: "Calibri";
    src: url("<?php echo base_url(); ?>application/assets/fonts/Calibri Regular.ttf");
    
    }
  body{
    font-family: Calibri;
  }


@page {
    margin: 10mm;
}
.page-container {
  /* position: relative; */
  /* border:2px solid black; */
  height:100%;
}
#footer {
    position: fixed;
    bottom: 6%;
    width: 100%;
    /* height: 50px; */
    font-size: 12px;
    /* color: #777; */
    /* For testing */
   
  }
 
    .demo {
    border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:5px;
    width: 100%;
  }
    .demo th {
    border:1px solid #C0C0C0;
    padding:2px;
    background:#F0F0F0;
    text-align: center;
    font-weight:bold;
  }
  .demo td {
    border:1px solid #C0C0C0;
    padding:2px;  
    
  }
</style>

<body >
<div style="text-align: center;font-weight: bold;font-size: 25px;">PWD QR Code</div>
<div class="page-container" style="padding: 0px;border:1px solid black;">

    <table class="demo">

    <tr>
    	<th>Sl</th>
    	<th>District</th>
    	<th>Category</th>
    	<th>Link</th>
    	<th>QR Code</th>
    </tr>
    <?php $sl=1;
    		foreach ($tableData as $key => $value) {
    		
    ?>
    <tr>
    	<td><?php echo $sl++;?></td>
    	<td><?php echo $value['district_name'];?></td>
    	<td><?php echo $value['category'];?></td>
    	<td><?php echo $value['link'];?></td>

    	<td> <img src="<?php echo base_url().'assets/img/qrCodes/'.$value['qrcode']; ?>"  style="width:120px;"/> 
    	<?php //echo $value['qrcode'];?>
    	</td>
    </tr>
    <?php
    		}
    ?>





  
  </table>







 
</div>


    </body>
    </html>