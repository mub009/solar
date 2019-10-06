
<div class="modal-body">
                        <div class="portlet light form-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-green"></i>
                                    <span class="caption-subject font-green bold uppercase"><?=$customerview['CustomerName']?></span>
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
                                        <label class="control-label col-md-5" style=" text-align:center;">Customer Name</label>
                                        <div class="col-md-7">

                                            <div id="country_Name"><?=$customerview['CustomerName']?> </div>

                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Mobile Number </label>
                                        <div class="col-md-7">

                                            <div id="Admin_number"><?=$customerview['Contact1']?></div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Email</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$customerview['Email']?></div>


                                        </div>
                                    </div>
                                   
                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">isTaxInclude</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$customerview['isTaxInclude']?> </div>


                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="control-label col-md-5" style=" text-align:center;">Registerd Date</label>
                                        <div class="col-md-7">

                                            <div id="intrest"><?=$customerview['RegisterdDate']?> </div>


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