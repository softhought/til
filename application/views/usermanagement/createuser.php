<script src="<?php echo base_url();?>assets-admin/js/customJs/user.js"></script>
<style>
   .select2-container--default .select2-selection--multiple .select2-selection__choice {
   background-color: #7a2386;
   border: 1px solid #fff;
   }
</style>
<section class="layout-box-content-format1">
   <div class="card card-primary form-view">
      <div class="card-header box-shdw">
         <h3 class="card-title">Create User</h3>
      
         <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">
            <a href="<?php echo base_url(); ?>user" class="btn btn-info btnpos link_tab">
            <i class="fas fa-clipboard-list"></i> List </a>
         </div>
       
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="formblock-box">
            <form onsubmit="return CreateUserFrmValidate();" action="<?php echo base_url();?>user/store"
               id="CreateUserFrm" method="post">
               <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
               <input type="hidden" name="userId" id="userId" value="<?php echo $bodycontent['userId']; ?>">
               <div class="row">
                  <div class="col-md-3">
                     <label for="name">Full Name *</label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control forminputs typeahead" id="name" name="name"
                              placeholder="Enter Name" autocomplete="off"
                              value="<?php if($bodycontent['mode']=='EDIT'){echo $bodycontent['userEditdata']->name;} ?>">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <label for="mobile_no">Mobile No.</label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control forminputs typeahead" id="mobile_no"
                              name="mobile_no" placeholder="Enter Mobile No." autocomplete="off"
                              value="<?php if($bodycontent['mode']=='EDIT'){echo $bodycontent['userEditdata']->mobile_no;} ?>">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <label for="user_name">Username(Email) *
                     <span id="username_err" style="color:red;font-weight:bold;"></span>
                     </label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control forminputs typeahead" id="user_name"
                              name="user_name" placeholder="Enter Email" autocomplete="off"
                              <?php if($bodycontent['mode']=='EDIT'){echo "readonly";} ?>
                              value="<?php if($bodycontent['mode']=='EDIT'){echo $bodycontent['userEditdata']->user_name;} ?>">
                        </div>
                     </div>
                  </div>
                 
                  <div class="col-md-3">
                     <label for="user_role_id">User Role*</label>
                     <div id="user_role_idDiv" class="form-group">
                        <div class="input-group input-group-sm">
                           <select class="form-control select2" data-show-subtext="true" name="user_role_id"
                              id="user_role_id" data-live-search="true"
                              style="height: calc(1.8125rem + 9px);">
                              <option value="0">Select</option>
                              <?php foreach ($bodycontent['userRoleList'] as $value) { ?>
                              <option value="<?php echo $value->id; ?>" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['userEditdata']->user_role_id==$value->id)
                                 {echo "selected";}?>><?php echo $value->role; ?></option>
                              <?php  }  ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <label for="password">Password *</label>
                     <div class="form-group">
                        <div class="input-group input-group-sm">
                           <input type="password" class="form-control forminputs typeahead" id="password"
                              name="password" placeholder="Enter Password." autocomplete="off"
                              value="<?php if($bodycontent['mode']=='EDIT'){echo 'XXXXXXX';} ?>"
                              <?php if($bodycontent['mode']=='EDIT'){echo "readonly";} ?>>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="cpassword">Confirm Password *</label>
                        <div class="input-group input-group-sm">
                           <input type="password" class="form-control forminputs typeahead" id="cpassword"
                              name="cpassword" placeholder="Enter Confirm Password." autocomplete="off"
                              value="<?php if($bodycontent['mode']=='EDIT'){echo 'XXXXXXX';} ?>"
                              <?php if($bodycontent['mode']=='EDIT'){echo "readonly";} ?>>
                        </div>
                     </div>
                  </div>
             
               </div>
               <div class="formblock-box ">
                  <div class="row">
                     <div class="col-md-10"></div>
                     <div class="col-md-2">
                        <button type="submit" class="btn btn-sm action-button padbtn"
                        id="create_btn"><?php echo $bodycontent['btnText'];?> &nbsp;<i
                        class="fas fa-chevron-right"></i></button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>
