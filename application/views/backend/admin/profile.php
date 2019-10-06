 <!-- <link href="<?=base_url() . 'assets/admin/assets/'?>pages/css/profile.min.css" rel="stylesheet" type="text/css" />
     -->

 <!-- END PAGE TITLE-->
 <!-- END PAGE HEADER-->
 <div class="row">
     <div class="col-md-3">
         <!-- BEGIN PROFILE SIDEBAR -->
         <div class="profile-sidebar">
             <!-- PORTLET MAIN -->
             <div class="portlet light profile-sidebar-portlet ">
                 <!-- SIDEBAR USERPIC -->
                 <div class="profile-userpic">
                     <img src="<?='https://s3.ap-south-1.amazonaws.com/metroplusapp/image/400x200/'.$change_profile['ProfilePic']?>"
                         class="img-responsive" alt=""> </div>

                 <!-- END SIDEBAR USERPIC -->
                 <!-- SIDEBAR USER TITLE -->
                 <div class="profile-usertitle">
                     <div class="profile-usertitle-name"> <?=$personal_info_updation['FirstName']?></div>
                     <div class="profile-usertitle-job"> <?=$userinfo['HeaderName']?> </div>
                 </div>
                 <!-- END SIDEBAR USER TITLE -->
                 <!-- SIDEBAR BUTTONS -->
                 <!-- <div class="profile-userbuttons">
                                            <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                                            <button type="button" class="btn btn-circle red btn-sm">Message</button>
                                        </div> -->
                 <!-- END SIDEBAR BUTTONS -->
                 <!-- SIDEBAR MENU -->

                 <!-- END MENU -->
             </div>
             <!-- END PORTLET MAIN -->
             <!-- PORTLET MAIN -->

             <!-- END PORTLET MAIN -->
         </div>
     </div>

     <!-- END BEGIN PROFILE SIDEBAR -->
     <!-- BEGIN PROFILE CONTENT -->
     <div class="col-md-9">
         <div class="profile-content">
             <div class="row">
                 <div class="col-md-12">
                     <div class="portlet light ">
                         <div class="portlet-title tabbable-line">
                             <div class="caption caption-md">
                                 <i class="icon-globe theme-font hide"></i>
                                 <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                             </div>
                             <ul class="nav nav-tabs">
                                 <li class="active">
                                     <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                 </li>
                                 <li>
                                     <a href="#tab_1_2" data-toggle="tab">Change Profile</a>
                                 </li>
                                 <li>
                                     <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                 </li>
                                 <li>
                                     <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                 </li>

                                 <?php
                                                        if($AdminPrivilege)
                                                        {
                                                        ?>
                                 <li>
                                     <a href="#tab_1_5" data-toggle="tab">config</a>
                                 </li>
                                 <?php
                                                        }
                                                        ?>
                         </div>
                         <div class="portlet-body">
                             <div class="tab-content">
                                 <!-- PERSONAL INFO TAB -->
                                 <div class="tab-pane active" id="tab_1_1">
                                     <form action="<?=base_url('backend/admin/profile/personal_info_updation')?>"
                                         id="formpersonalinfochange">
                                         <div class="form-group" id="validation_FirstName_update">
                                             <label class="control-label">First Name</label>
                                             <input type="text" name="FirstName"
                                                 value="<?php if(!empty($personal_info_updation['FirstName'])) echo $personal_info_updation['FirstName'];?>"
                                                 placeholder="First Name" class="form-control" /> </div>
                                                 
                                         <div class="form-group" id="validation_LastName_update">
                                             <label class="control-label">Last Name</label>
                                             <input type="text" name="LastName"
                                                 value="<?php if(!empty($personal_info_updation['LastName'])) echo $personal_info_updation['LastName'];?>"
                                                 placeholder="Last Name" class="form-control" /> </div>
                                         <div class="form-group" id="validation_MobileNumber_update">
                                             <label class="control-label">Mobile Number</label>
                                             <input type="text" name="MobileNumber"
                                                 value="<?php if(!empty($personal_info_updation['MobileNumber'])) echo $personal_info_updation['MobileNumber'];?>"
                                                 placeholder="Mobile Number" class="form-control" /> </div>
                                         <div class="form-group" id="validation_Interests_update">
                                             <label class="control-label">Interests</label>
                                             <input type="text" name="Interests"
                                                 value="<?php if(!empty($personal_info_updation['Interests'])) echo $personal_info_updation['Interests'];?>"
                                                 placeholder="Design, Web etc." class="form-control" /> </div>
                                         <div class="form-group" id="validation_Occupation_update">
                                             <label class="control-label">Occupation</label>
                                             <input type="text" name="Occupation"
                                                 value="<?php if(!empty($personal_info_updation['Occupation'])) echo $personal_info_updation['Occupation'];?>"
                                                 placeholder="Occupation" class="form-control" /> </div>
                                         <div class="form-group" id="validation_About_update">
                                             <label class="control-label">About</label>
                                             <input type="text" class="form-control" name="About"
                                                 value="<?php if(!empty($personal_info_updation['About'])) echo $personal_info_updation['About'];?>"
                                                 rows="3" placeholder="About"></textarea>
                                         </div>
                                         <div class="form-group" id="validation_WebsiteUrl_update">
                                             <label class="control-label">Website Url</label>
                                             <input type="text" name="WebsiteUrl"
                                                 value="<?php if(!empty($personal_info_updation['WebsiteUrl'])) echo $personal_info_updation['WebsiteUrl'];?>"
                                                 placeholder="Website Url" class="form-control" /> </div>
                                         <div class="margiv-top-10">
                                             <a href="javascript:;" class="btn green" id="personalinfoBtn"> Save Changes
                                             </a>

                                             <a href="javascript:;" class="btn default"> Cancel </a>
                                         </div>
                                     </form>
                                 </div>

                                 <!-- END PERSONAL INFO TAB -->

                                 <!-- CHANGE AVATAR TAB -->
                                 <div class="tab-pane" id="tab_1_2">
                                     <!-- <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                                eiusmod. </p> -->
                                     <form action="<?=base_url('backend/admin/profile/change_profile')?>"
                                         id="change_profile" enctype="multipart/form-data">
                                         <div class="form-group">
                                             <div class="fileinput fileinput-new" data-provides="fileinput">
                                                 <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 150px;">
                                                     <img src="<?=($config_update['is_FileManager'])?$config_update['ImageLocation']:base_url($config_update['ImageLocation'])?><?='400x200/'.$change_profile['ProfilePic']?>"
                                                         alt="" /> </div>
                                                 <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px;">
                                                 </div>
                                                 <div>
                                                     <span class="btn default btn-file">
                                                         <span class="fileinput-new"> Select image </span>
                                                         <span class="fileinput-exists"> Change </span>

                                                         <input type="hidden" value="" name="..."><input type="file"
                                                             name="profilepic" accept="image/*"> </span> </span>
                                                     <a href="javascript:;" class="btn default fileinput-exists"
                                                         data-dismiss="fileinput"> Remove </a>
                                                 </div>


                                             </div>

                                             <!-- <div class="clearfix margin-top-10">
                                                                                                        <span class="label label-danger">NOTE! </span>
                                                                                                        <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                                                                    </div> -->
                                         </div>
                                         <div class="margin-top-10">
                                             <input type="submit" class="btn green" value="Save Changes"
                                                 id="profileBtn">
                                             <a href="javascript:;" class="btn default"> Cancel </a>
                                         </div>
                                     </form>
                                 </div>
                                 <!-- END CHANGE AVATAR TAB -->

                                 <?php
if($AdminPrivilege)
{

?>
                                 <!-- CHANGE PASSWORD TAB -->
                                 <div class="tab-pane" id="tab_1_5">
                                     <form action="<?=base_url('backend/admin/profile/config')?>" id="config"
                                         enctype="multipart/form-data">
                                         <div class="form-group">
                                             <div class="row">

                                                 <label class="control-label">Height</label>
                                                 <input type="text" placeholder="100px"
                                                     value="<?php if(!empty($config['DashboardHeight'])) echo $config['DashboardHeight'];?>"
                                                     name='DashboardHeight' class="form-control" /> </div>

                                         </div>
                                         <div class="form-group">
                                             <div class="row">

                                                 <label class="control-label">Width</label>
                                                 <input type="text" placeholder="100px"
                                                     value="<?php if(!empty($config['DashboardWidth'])) echo $config['DashboardWidth'];?>"
                                                     name='DashboardWidth' class="form-control" /> </div>

                                         </div>
                                         <div class="form-group">
                                             <div class="row">

                                                 <label class="control-label">Padding</label>
                                                 <input type="text" placeholder="100px"
                                                     value="<?php if(!empty($config['DashboardPadding'])) echo $config['DashboardPadding'];?>"
                                                     name='DashboardPadding' class="form-control" /> </div>

                                         </div>
                                         <br>
                                         <div class="form-group">
                                             <div class="fileinput fileinput-new" data-provides="fileinput">
                                                 <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 150px;">
                                                     <img src="<?=($config['is_FileManager'])?$config['ImageLocation']:base_url($config['ImageLocation'])?><?='400x200/'. $config['DashboardImagePath']?>" height="<?=$config['DashboardHeight']?>"
                                                         alt="" /> </div>

                                                 <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px;">
                                                 </div>
                                                 <div>
                                                     <span class="btn default btn-file">
                                                         <span class="fileinput-new"> Select image </span>
                                                         <span class="fileinput-exists"> Change </span>

                                                         <input type="hidden" value="" name="..."><input type="file"
                                                             name="DashboardImage" accept="image/*"> </span> </span>
                                                     <a href="javascript:;" class="btn default fileinput-exists"
                                                         data-dismiss="fileinput"> Remove </a>
                                                 </div>
                                             </div>



                                         </div>
                                         <div class="margin-top-10">
                                             <input type="submit" class="btn green" value="Save Changes" id="configBtn">
                                             <a href="javascript:;" class="btn default"> Cancel </a>
                                         </div>
                                     </form>
                                 </div>
                                 <?php

}
?>

                                 <!-- END CHANGE PASSWORD TAB -->




                                 <!-- CHANGE PASSWORD TAB -->
                                 <div class="tab-pane" id="tab_1_3">
                                     <form action="<?=base_url('backend/admin/profile/change_password')?>"
                                         id="formpasswordchange">
                                         <div class="form-group" id="validation_current_password_update">

                                             <label class="control-label">Current Password</label>
                                             <input type="password" name='current_password' class="form-control" />
                                         </div>

                                         <div class="form-group" id="validation_new_password_update">
                                             <label class="control-label">New Password</label>
                                             <input type="password" name='new_password' class="form-control" /> </div>


                                         <div class="form-group" id="validation_confirm_password_update">
                                             <label class="control-label">Re-type New Password</label>
                                             <input type="password" name='re_type_password' class="form-control" />
                                         </div>

                                         <div class="margin-top-10">
                                             <a href="javascript:;" class="btn green" id="passwordChangeBtn"> Change
                                                 Password </a>
                                             <a href="javascript:;" class="btn default"> Cancel </a>
                                         </div>
                                     </form>
                                 </div>

                                 <!-- END CHANGE PASSWORD TAB -->

                                 <!-- PRIVACY SETTINGS TAB -->
                                 <div class="tab-pane" id="tab_1_4">
                                   
                                 </div>
                                 <!-- END PRIVACY SETTINGS TAB -->

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- END PROFILE CONTENT -->

 </div>
 <a href="javascript:;" class="page-quick-sidebar-toggler">
     <i class="icon-login"></i>
 </a>


 <script>
     $(document).ready(function () {

         $('#passwordChangeBtn').click(function (e) {
             e.preventDefault();

             $.ajax({
                 type: "post",
                 url: "<?=base_url('backend/admin/profile/change_password')?>",
                 data: $('#formpasswordchange').serialize(),
                 success: function (response) {
                     //console.log(response);

                     if (response.statusCode == 400) {

                         var json = response.data;


                         if (typeof json.current_password != 'undefined') {

                             $("#validation_current_password_update").addClass("has-error");

                             $('#error_current_password_update').remove();

                             $('#validation_current_password_update').append(
                                 "<span class='help-block' id='error_current_password_update'>" +
                                 json.current_password + "</span>");
                         } else {
                             $("#validation_current_password_update").removeClass(
                                 "has-error");

                             $('#error_current_password_update').remove();

                             $("#validation_current_password_update").addClass(
                                 "has-success");


                         }

                         if (typeof json.new_password != 'undefined') {

                             $("#validation_new_password_update").addClass("has-error");

                             $('#error_new_password_update').remove();

                             $('#validation_new_password_update').append(
                                 "<span class='help-block' id='error_new_password_update'>" +
                                 json.new_password + "</span>");
                         } else {
                             $("#validation_new_password_update").removeClass("has-error");

                             $('#error_new_password_update').remove();

                             $("#validation_new_password_update").addClass("has-success");


                         }

                         if (typeof json.re_type_password != 'undefined') {

                             $("#validation_confirm_password_update").addClass("has-error");

                             $('#error_confirm_password_update').remove();

                             $('#validation_confirm_password_update').append(
                                 "<span class='help-block' id='error_confirm_password_update'>" +
                                 json.re_type_password + "</span>");
                         } else {
                             $("#validation_confirm_password_update").removeClass("has-error");

                             $('#error_confirm_password_update').remove();

                             $("#validation_confirm_password_update").addClass("has-success");


                         }




                     } else if (response.statusCode == 500) {

                     } else {
                         location.reload();
                     }
                 }
             });

         });



         $('#change_profile').submit(function (e) {
             e.preventDefault();

             $.ajax({
                 type: "post",
                 url: "<?=base_url('backend/admin/profile/change_profile')?>",
                 enctype: 'multipart/form-data',
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                 cache: false,
                 async: false,
                 success: function (response) {

                     console.log(response);
                     location.reload();

                     $.ajax({
                         type: "post",
                         url: "<?=base_url('backend/admin/profile/personal_info_updation')?>",
                         data: $('#formpersonalinfochange').serialize(),

                         success: function (response) {

                         },
                         error: function (jqXhr) {



                         }
                     });

                 }

             });

         });


         $('#config').submit(function (e) {
             e.preventDefault();


             $.ajax({
                 type: "post",
                 url: "<?=base_url('backend/admin/profile/config_Update')?>",
                 enctype: 'multipart/form-data',
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                 cache: false,
                 async: false,
                 success: function (response) {

                     console.log(response);
                     location.reload();




                 }
             });

         });


         $(document).ready(function () {



             $('#personalinfoBtn').click(function (e) {
                 e.preventDefault();

                 $.ajax({
                     type: "post",
                     url: "<?=base_url('backend/admin/profile/personal_info_updation')?>",
                     data: $('#formpersonalinfochange').serialize(),

                     success: function (response) {


                         if (response.statusCode == 400) {


                             var json = response.data;


                             if (typeof json.FirstName != 'undefined') {

                                 $("#validation_FirstName_update").addClass(
                                     "has-error");

                                 $('#error_FirstName_update').remove();

                                 $('#validation_FirstName_update').append(
                                     "<span class='help-block' id='error_FirstName_update'>" +
                                     json.FirstName + "</span>");
                             } else {
                                 $("#validation_FirstName_update").removeClass(
                                     "has-error");

                                 $('#error_FirstName_update').remove();

                                 $("#validation_FirstName_update").addClass(
                                     "has-success");


                             }
                             if (typeof json.LastName != 'undefined') {

                                 $("#validation_LastName_update").addClass(
                                     "has-error");

                                 $('#error_LastName_update').remove();

                                 $('#validation_LastName_update').append(
                                     "<span class='help-block' id='error_LastName_update'>" +
                                     json.LastName + "</span>");
                             } else {
                                 $("#validation_LastName_update").removeClass(
                                     "has-error");

                                 $('#error_LastName_update').remove();

                                 $("#validation_LastName_update").addClass(
                                     "has-success");


                             }
                             if (typeof json.MobileNumber != 'undefined') {

                                 $("#validation_MobileNumber_update").addClass(
                                     "has-error");

                                 $('#error_MobileNumber_update').remove();

                                 $('#validation_MobileNumber_update')
                                     .append(
                                         "<span class='help-block' id='error_MobileNumber_update'>" +
                                         json.MobileNumber + "</span>");
                             } else {
                                 $("#validation_MobileNumber_update").removeClass(
                                     "has-error");

                                 $('#error_MobileNumber_update').remove();

                                 $("#validation_MobileNumber_update").addClass(
                                     "has-success");


                             }
                             if (typeof json.Interests != 'undefined') {

                                 $("#validation_Interests_update").addClass(
                                     "has-error");

                                 $('#error_Interests_update').remove();

                                 $('#validation_Interests_update').append(
                                     "<span class='help-block' id='error_Interests_update'>" +
                                     json.Interests + "</span>");
                             } else {
                                 $("#validation_Interests_update").removeClass(
                                     "has-error");

                                 $('#error_Interests_update').remove();

                                 $("#validation_Interests_update").addClass(
                                     "has-success");


                             }
                             if (typeof json.Occupation != 'undefined') {

                                 $("#validation_Occupation_update").addClass(
                                     "has-error");

                                 $('#error_Occupation_update').remove();

                                 $('#validation_Occupation_update')
                                     .append(
                                         "<span class='help-block' id='error_Occupation_update'>" +
                                         json.Occupation + "</span>");
                             } else {
                                 $("#validation_Occupation_update").removeClass(
                                     "has-error");

                                 $('#error_Occupation_update').remove();

                                 $("#validation_Occupation_update").addClass(
                                     "has-success");


                             }
                             if (typeof json.About != 'undefined') {

                                 $("#validation_About_update").addClass(
                                     "has-error");

                                 $('#error_About_update').remove();

                                 $('#validation_About_update').append(
                                     "<span class='help-block' id='error_About_update'>" +
                                     json.About + "</span>");
                             } else {
                                 $("#validation_About_update").removeClass(
                                     "has-error");

                                 $('#error_About_update').remove();

                                 $("#validation_About_update").addClass(
                                     "has-success");


                             }

                             if (typeof json.WebsiteUrl != 'undefined') {

                                 $("#validation_WebsiteUrl_update").addClass(
                                     "has-error");

                                 $('#error_WebsiteUrl_update').remove();

                                 $('#validation_WebsiteUrl_update')
                                     .append(
                                         "<span class='help-block' id='error_WebsiteUrl_update'>" +
                                         json.WebsiteUrl + "</span>");
                             } else {
                                 $("#validation_WebsiteUrl_update").removeClass(
                                     "has-error");

                                 $('#error_WebsiteUrl_update').remove();

                                 $("#validation_WebsiteUrl_update").addClass(
                                     "has-success");


                             }
                         } else if (response.statusCode == 200) {
                             location.reload();
                         }

                     },
                     error: function (jqXhr) {


                     }

                 });

             });

         });

     });
 </script>