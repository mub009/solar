<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Add Country Admin</span>
            </div>
            <div class="actions">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" method="post" class="form-horizontal form-bordered" id="InsertForm" enctype="multipart/form-data">
                <div class="form-body">




                    <div class="form-group" id="validation_country_name_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Name <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7 ">

                            <select class="form-control" name='country_name'>
                                <option value="">
                                    <?='Select Country'?>
                                </option>
                                <?php

foreach ($country as $row) {
    ?>



                                <option value="<?=$row['Id']?>">
                                    <?=$row['CountryName'] . '(' . $row['CountryCode'] . ')'?>
                                </option>

                                <?php

}
?>


                            </select>



                        </div>
                    </div>






                    <div class="form-group" id="validation_Admin_number_insert">
                        <label class="control-label col-md-5 " style=" text-align:left;">Admin Mobile Number <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="Admin_number" name="Admin_number" placeholder="Enter Admin Mobile Number"
                                autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group" id="validation_password_insert">
                        <label class="control-label col-md-5 " style=" text-align:left;">Password <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password"
                                autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group" id="validation_confirm_password_insert">
                        <label class="control-label col-md-5 " style=" text-align:left;">Confirm Password <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Enter Confirm Password" autocomplete="off">
                        </div>

                    </div>

                </div>

        </div>
    </div>



</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
    <input type="submit" class="btn green" name='submit' id="insert" value="Save changes">
</div>
</form>




<script>
var flag;
    $("#insert").click(function (e) {

        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#InsertForm").serialize();

        var me = $(this);

        if (me.data('requestRunning')) {
            alert('Please Wait Your request is processing');
            return;
        }
        me.data('requestRunning', true);



        $.ajax({
            url: base_url + 'backend/admin/user/admin/admin/insert',
            type: 'POST',
            dataType: "json",
            async: false,
            data: post_data + "&submit=true",
            success: function (data) {

                window.location.href = base_url + 'backend/admin/user/admin/admin ';
                flag = false;
                //location.reload();

            },
            error: function (jqXhr) {

                var json = $.parseJSON(jqXhr.responseText);

                flag = true;
                me.data('requestRunning', false);


                if (typeof json.Admin_number != 'undefined') {

                    $("#validation_Admin_number_insert").addClass("has-error");

                    $('#error_Admin_number_insert').remove();

                    $('#validation_Admin_number_insert .col-md-7').append(
                        "<span class='help-block' id='error_Admin_number_insert'>" + json.Admin_number +
                        "</span>");
                } else {
                    $("#validation_Admin_number_insert").removeClass("has-error");

                    $('#error_Admin_number_insert').remove();

                    $("#validation_Admin_number_insert").addClass("has-success");


                }



                if (typeof json.country_name != 'undefined') {

                    $("#validation_country_name_insert").addClass("has-error");

                    $('#error_country_name_insert').remove();

                    $('#validation_country_name_insert .col-md-7').append(
                        "<span class='help-block' id='error_country_name_insert'>" + json.country_name +
                        "</span>");


                } else {
                    $("#validation_country_name_insert").removeClass("has-error");

                    $('#error_country_name_insert').remove();

                    $("#validation_country_name_insert").addClass("has-success");


                }

                if (typeof json.password != 'undefined') {

                    $("#validation_password_insert").addClass("has-error");

                    $('#error_password_insert').remove();

                    $('#validation_password_insert .col-md-7').append(
                        "<span class='help-block' id='error_password_insert'>" + json.password +
                        "</span>");


                } else {
                    $("#validation_password_insert").removeClass("has-error");

                    $('#error_password_insert').remove();

                    $("#validation_password_insert").addClass("has-success");


                }


                if (typeof json.confirm_password != 'undefined') {

                    $("#validation_confirm_password_insert").addClass("has-error");

                    $('#error_confirm_password_insert').remove();

                    $('#validation_confirm_password_insert .col-md-7').append(
                        "<span class='help-block' id='error_confirm_password_insert'>" + json.confirm_password +
                        "</span>");


                } else {
                    $("#validation_confirm_password_insert").removeClass("has-error");

                    $('#error_confirm_password_insert').remove();

                    $("#validation_confirm_password_insert").addClass("has-success");
                }
            },
            complete: function () {

                if (flag) {
                    me.data('requestRunning', false);
                } else {
                    me.data('requestRunning', true);
                }

            }


        });


    });
</script>