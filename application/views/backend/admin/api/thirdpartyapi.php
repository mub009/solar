<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Add Thirdparty Api</span>
                </div>

            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form id="form_sample_1" method='post' class="form-horizontal" novalidate="novalidate">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check
                            below. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful!
                        </div>


                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">Name
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="key" class="col-md-2 control-label">Key
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="Key" name="Key" placeholder="Key">
                                </div>
                            </div>

                        </form>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">ADD</button>
                                    <!-- <button type="button" class="btn grey-salsa btn-outline">Cancel</button> -->
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <!-- END FORM-->
        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Thirdparty Api Key</span>
                </div>

            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form id="UpdateForm" action='<?=base_url(' backend/admin/api/thirdpartyapi/update')?>' method='post'
                    class="form-horizontal" novalidate="novalidate">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check
                            below. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful!
                        </div>

                        <form class="form-horizontal" role="form" id="UpdateForm">

                            <?php


foreach($thirdpartylist as $row)
{
?>
                            <input type="hidden" class="form-control" value="<?=$row['Id']?>" id="googleapi" name="APIKeysId[]"
                                placeholder="Google API">


                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">
                                    <?=$row['Name']?>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-4">

                                    <input type="text" class="form-control" value="<?=$row['Key']?>" name="APIKeys[]"
                                        placeholder="Google API"> </div>
                            </div>

                            <?php
 
 
}

?>

                        </form>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green" id='update'>Update</button>
                                    <!-- <button type="button" class="btn grey-salsa btn-outline">Cancel</button> -->
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <!-- END FORM-->
        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>

<script>
    $(document).ready(function () {

        $('#form_sample_1').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?=base_url('backend/admin/api/thirdpartyapi/insert')?>",
                data: $('#form_sample_1').serialize(),
                success: function (response) {
                    console.log(response);
                },
                error: function (jqXhr) {

                    var json = $.parseJSON(jqXhr.responseText);


                }

            });
        });

    });

    $("#update").click(function (e) {

        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#UpdateForm").serialize();


        $.ajax({
            url: base_url + 'backend/admin/api/thirdpartyapi/update',
            type: 'POST',
            async: false,
            data: post_data,
            success: function (data) {
                console.log(data);


                location.reload();

            },
            error: function (jqXhr) {

                var json = $.parseJSON(jqXhr.responseText);

                console.log(jqXhr);




            }
        });


    });
</script>