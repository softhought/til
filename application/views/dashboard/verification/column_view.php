<select class="form-control select2" data-show-subtext="true" name="column_name" id="column_name"  data-live-search="true" >
        <option  value="">Select</option>
         <?php foreach ($tableColumn as $value) { ?>
             <option  value="<?php echo $value; ?>"  ><?php echo $value; ?></option>   
                                        <?php  }  ?>                                        
                                    </select>