

<div class="modal-body">
                        <div class="portlet light form-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-green"></i>
                                    <span class="caption-subject font-green bold uppercase"><?=$subcategory_details['SubcategoryName']?></span>
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
                                                                src="<?=($config_update['is_FileManager'])?$config_update['ImageLocation']:base_url($config_update['ImageLocation'])?><?='400x200/'.$subcategory_details['ImagePath']?>" id="ProductImage" alt="image" style="width: 200px; height: 143px; line-height: 150px;"></div>

                                                    </div>

                                                </center>

                                            </div>
                                        </div>
                                   
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Sub Category Name</label>
                                        <div class="col-md-7">

                                            <div id="country_Name"><?=$subcategory_details['SubcategoryName']?></div>

                                        </div>
                                        
                                    </div>
                                    

                                  
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Status</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?if ($subcategory_details['StatusId']==4)
                                                 {
                                                     echo"BLOCK";
                                                 }
                                                 else if($subcategory_details['StatusId']==1)
                                                 {
                                                    echo"ACTIVE";

                                                 }
                                                 else if($subcategory_details['StatusId']==5)
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