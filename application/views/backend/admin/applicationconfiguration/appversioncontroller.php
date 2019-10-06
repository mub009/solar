<div class="row">
    <div class="col-md-6 ">
        <div class="portlet box green ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-android"></i> Android </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" id="apkform" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">App Version Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="apk_app_version_code"
                                    placeholder="App Version Code"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">App Version Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="apk_app_version"
                                    placeholder="App Version Name"> </div>
                        </div>
                    </div>
                    <center>
                        <div class="form-actions">
                            <button type="submit" name="AndroidApp" id="AndroidAppbtn" class="btn green">Submit</button>
                        </div>
                    </center>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="portlet box green ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-apple"></i> IOS </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" id="iosform">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">App Version Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="ios_app_version_code"
                                    placeholder="App Version Code"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">App Version Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="ios_app_version"
                                    placeholder="App Version Name"> </div>
                        </div>
                    </div>
                    <center>
                        <div class="form-actions">
                            <button type="submit" name="IosAPP" id="IosAPPbtn" class="btn green">Submit</button>
                        </div>
                    </center>

                </form>
            </div>
        </div>
    </div>
</div>

<?=$datatable?>

<script>
    $('#AndroidAppbtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=base_url('backend/admin/applicationconfiguration/appversioncontroller/apk_insert')?>",
            data: $('#apkform').serialize(),
            dataType: "json",
            success: function (response) {


                if (response.statusCode == 400) {



                } else {

                    swal({
                        title: "Successfully Add New Android Version ",
                        text: "",
                        type: "success",
                    });


                }

            }
        });

    });


    $('#IosAPPbtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=base_url('backend/admin/applicationconfiguration/appversioncontroller/ios_insert')?>",
            data: $('#iosform').serialize(),
            dataType: "json",
            success: function (response) {

  
                if (response.statusCode == 400) {



                } else {

                    swal({
                        title: "Successfully Add New IOS Version ",
                        text: "",
                        type: "success",
                    });


                }



            }
        });

    });
</script>