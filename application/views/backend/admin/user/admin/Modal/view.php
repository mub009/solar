

<div class="modal-body">
                        <div class="portlet light form-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-green"></i>
                                    <span class="caption-subject font-green bold uppercase"><?=$view['FirstName']?></span>
                                </div>
                                <div class="actions">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?=base_url() . 'backend/admin/user/admin/admin/insert'?>" class="form-horizontal form-bordered"
                                    method="post" id="addprodutform" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <!-- <div class="form-group">
                                            <div class="col-md-12">


                                                <center>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                            style="width: 200px; height: 150px; line-height: 150px;"><img
                                                                src="<?=($config_update['is_FileManager'])?$config_update['ImageLocation']:base_url($config_update['ImageLocation'])?><?=$view['ProfilePic']?>" id="ProductImage" alt="image" style="width: 200px; height: 143px; line-height: 150px;"></div>

                                                    </div>

                                                </center>

                                            </div>
                                        </div> -->
                                   
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Country Admin Name</label>
                                        <div class="col-md-7">

                                            <div id="country_Name"><?=$view['FirstName']?> <?=$view['LastName']?> </div>

                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Mobile Number </label>
                                        <div class="col-md-7">

                                            <div id="Admin_number"><?=$view['MobileNumber']?> </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Interests</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$view['Interests']?> </div>


                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Occupation</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$view['Occupation']?> </div>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">About</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$view['About']?> </div>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Website Url</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$view['WebsiteUrl']?> </div>

                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Status</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?if ($view['StatusId']==4)
                                                 {
                                                     echo"BLOCK";
                                                 }
                                                 else if($view['StatusId']==1)
                                                 {
                                                    echo"ACTIVE";

                                                 }
                                                 else if($view['StatusId']==5)
                                                 {
                                                    echo"APPROVED";
                                                 }
                                                 ?> </div>

                                        
                                        </div>
                                    </div>
                                   

                                    <!-- END FORM-->
                            </div>
                        </div>



                    </div>

                    </form>

                </div>

                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>