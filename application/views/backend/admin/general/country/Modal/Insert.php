<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Add Country</span>
            </div>
            <div class="actions">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" id="InsertForm" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group" id="validation_country_number_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Name <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7 ">
                            <input type="text" class="form-control" id="country_number" name="country_number"
                                placeholder="Enter Country Name" autocomplete="off">
                        </div>
                    </div>



                    <div class="form-group" id="validation_country_code_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Code <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="country_code" name="country_code" placeholder="Enter Country Code"
                                autocomplete="off">


                        </div>
                    </div>
                    <div class="form-group" id="validation_mobile_number_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">Total Mobile Number Digits <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Total Mobile Number Digits"
                                autocomplete="off">

                            <center>
                                <p>(Not Include Country Code)</p>
                            </center>
                        </div>

                    </div>
                </div>
                <!-- END FORM-->
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
    <input type="submit" class="btn green" id="insert" name='submit' value="Save changes">
</div>
</form>






<script>
    $("#insert").click(function (e) {


        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#InsertForm").serialize();

        //console.log(post_data);
        var flag;
        //has-error  var me = $(this);

        var me = $(this);

if (me.data('requestRunning')) {
    alert('Please Wait Your request is processing');
    return;
}
me.data('requestRunning', true);


        $.ajax({
            url: base_url + 'backend/admin/general/country/country/insert',
            type: 'POST',
            async: false,
            dataType: "json",
            data: post_data + "&submit=true",
            success: function (data) {
                flag=false;
                location.reload();

            },
            error: function (jqXhr) {

                var json = $.parseJSON(jqXhr.responseText);

                console.log(json);
                flag=true;
                      me.data('requestRunning', false);




                if (typeof json.country_code != 'undefined') {

                    $("#validation_country_code_insert").addClass("has-error");

                    $('#error_country_code_insert').remove();

                    $('#validation_country_code_insert .col-md-7').append(
                        "<span class='help-block' id='error_country_code_insert'>" + json.country_code +
                        "</span>");
                } else {
                    $("#validation_country_code_insert").removeClass("has-error");

                    $('#error_country_code_insert').remove();

                    $("#validation_country_code_insert").addClass("has-success");


                }

                if (typeof json.country_number != 'undefined') {


                    $("#validation_country_number_insert").addClass("has-error");

                    $('#error_country_number_insert').remove();

                    $('#validation_country_number_insert .col-md-7').append(
                        "<span class='help-block' id='error_country_number_insert'>" + json.country_number +
                        "</span>");

                } else {
                    $("#validation_country_number_insert").removeClass("has-error");

                    $('#error_country_number_insert').remove();

                    $("#validation_country_number_insert").addClass("has-success");


                }
                if (typeof json.mobile_number != 'undefined') {


                    $("#validation_mobile_number_insert").addClass("has-error");

                    $('#error_mobile_number_insert').remove();

                    $('#validation_mobile_number_insert .col-md-7').append(
                        "<span class='help-block' id='error_mobile_number_insert'>" + json.mobile_number +
                        "</span>");

                } else {
                    $("#validation_mobile_number_insert").removeClass("has-error");

                    $('#error_mobile_number_insert').remove();

                    $("#validation_mobile_number_insert").addClass("has-success");


                }


           

            },
             complete: function() {

if(flag)
{
    me.data('requestRunning', false);
}
else
{
    me.data('requestRunning', true);
}


     }
        });


    });
</script>