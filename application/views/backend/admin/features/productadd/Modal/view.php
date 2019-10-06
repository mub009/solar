

<div class="modal-body">
                        <div class="portlet light form-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-green"></i>
                                    <span class="caption-subject font-green bold uppercase"><?=$productadd['Product']?></span>
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
                                        <div class="form-group">
                                            <div class="col-md-12">


                                                <center>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                            style="width: 200px; height: 150px; line-height: 150px;"><img
                                                                src="<?=($config_update['is_FileManager'])?$config_update['ImageLocation']:base_url($config_update['ImageLocation'])?><?='400x200/'.$productadd['ImagePath']?>" id="ProductImage" alt="image" style="width: 200px; height: 143px; line-height: 150px;"></div>

                                                    </div>

                                                </center>

                                            </div>
                                        </div>
                                   
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Product Name</label>
                                        <div class="col-md-7">

                                            <div id="country_Name"><?=$productadd['Product']?></div>

                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Description</label>
                                        <div class="col-md-7">

                                            <div id="Admin_number"><?=$productadd['Description']?> </div>

                                        </div>
                                    </div>
                                    
                                   

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Status</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?if ($productadd['StatusId']==4)
                                                 {
                                                     echo"BLOCK";
                                                 }
                                                 else if($productadd['StatusId']==1)
                                                 {
                                                    echo"ACTIVE";

                                                 }
                                                 else if($productadd['StatusId']==5)
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