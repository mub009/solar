

<div class="modal-body">
                        <div class="portlet light form-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-green"></i>
                                    <span class="caption-subject font-green bold uppercase"><?=$view['CountryName']?></span>
                                </div>
                                <div class="actions">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?=base_url() . 'backend/admin/user/admin/admin/insert'?>" class="form-horizontal form-bordered"
                                    method="post" id="addprodutform" enctype="multipart/form-data">
                                    <!-- <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-md-12">


                                                <center>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                            style="width: 200px; height: 150px; line-height: 150px;"><img
                                                                src="<?=base_url($view['ImagePath'])?>" id="ProductImage" alt="image" style="width: 200px; height: 143px; line-height: 150px;"></div>

                                                    </div>

                                                </center>

                                            </div>
                                        </div> -->
                                    
                                   
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Country Name</label>
                                        <div class="col-md-7">

                                            <div id="country_Name"><?=$view['CountryName']?>  </div>

                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Country Code </label>
                                        <div class="col-md-7">

                                            <div id="Admin_number"><?=$view['CountryCode']?> </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Total Mobile Number Digits</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$view['TotalMobileNumberDigits']?> </div>


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