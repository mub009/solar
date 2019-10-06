

<div class="modal-body">
                        <div class="portlet light form-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-green"></i>
                                    <span class="caption-subject font-green bold uppercase"><?=$view['AreaName']?></span>
                                </div>
                                <div class="actions">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?=base_url() . 'backend/admin/user/admin/admin/insert'?>" class="form-horizontal form-bordered"
                                    method="post" id="addprodutform" enctype="multipart/form-data">
                                   
                                
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Area Name</label>
                                        <div class="col-md-7">

                                            <div id="country_Name"><?=$view['AreaName']?>  </div>

                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:left;">Area Code </label>
                                        <div class="col-md-7">

                                            <div id="Admin_number"><?=$view['AreaCode']?> </div>

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