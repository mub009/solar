<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Add City</span>
            </div>
            <div class="actions">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" id="InsertForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <div class="form-body">
                    <div class="form-group" id="validation_country_id_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Name <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7 ">

                            <select class="form-control" name='country_id' onChange="State(this.value);">
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



                    <div class="form-group" id="validation_state_id_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">State Name <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">

                            <select name="state_id" class="form-control" id="state_list" onChange="state(this.value);"
                                name="state">

                                <option>Select State</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="validation_city_number_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">City Name <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="city_number" name="city_number" placeholder="Enter city Name"
                                autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group" id="validation_city_code_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">City Code <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="city_code" name="city_code" placeholder="Enter city Code"
                                autocomplete="off">
                        </div>
                    </div>
                </div>








                <!-- END FORM-->
        </div>
    </div>





</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
    <input type="submit" id="insert" class="btn green" name='submit' value="Save changes">
</div>
</form>

<script>
    function State(val) {



        $.ajax({
            type: "POST",
            async: false,
            url: "<?=base_url()?>backend/admin/general/state/state/ajax",
            data: 'country_id=' + val,
            success: function (data) {

                $("#state_list").html(data);
            }

        });
    }



    $("#insert").click(function (e) {

        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#InsertForm").serialize();

        //console.log(post_data);
        var flag;
        //has-errorvar me = $(this);
        var me = $(this);

if (me.data('requestRunning')) {
    alert('Please Wait Your request is processing');
    return;
}
me.data('requestRunning', true);



        $.ajax({
            url: base_url + 'backend/admin/general/city/city/insert',
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




                if (typeof json.city_code != 'undefined') {

                    $("#validation_city_code_insert").addClass("has-error");

                    $('#error_city_code_insert').remove();

                    $('#validation_city_code_insert .col-md-7').append(
                        "<span class='help-block' id='error_city_code_insert'>" +
                        json.city_code + "</span>");
                } else {
                    $("#validation_city_code_insert").removeClass("has-error");

                    $('#error_city_code_insert').remove();

                    $("#validation_city_code_insert").addClass("has-success");


                }


                if (typeof json.city_number != 'undefined') {

                    $("#validation_city_number_insert").addClass("has-error");

                    $('#error_city_number_insert').remove();

                    $('#validation_city_number_insert .col-md-7').append(
                        "<span class='help-block' id='error_city_number_insert'>" + json.city_number +
                        "</span>");
                } else {
                    $("#validation_city_number_insert").removeClass("has-error");

                    $('#error_city_number_insert').remove();

                    $("#validation_city_number_insert").addClass("has-success");


                }

                if (typeof json.state_id != 'undefined') {

                    $("#validation_state_id_insert").addClass("has-error");

                    $('#error_state_id_insert').remove();

                    $('#validation_state_id_insert .col-md-7').append(
                        "<span class='help-block' id='error_state_id_insert'>" +
                        json.state_id + "</span>");


                } else {
                    $("#validation_state_id_insert").removeClass("has-error");

                    $('#error_state_id_insert').remove();

                    $("#validation_state_id_insert").addClass("has-success");


                }

                if (typeof json.country_id != 'undefined') {

                    $("#validation_country_id_insert").addClass("has-error");

                    $('#error_country_id_insert').remove();

                    $('#validation_country_id_insert .col-md-7').append(
                        "<span class='help-block' id='error_country_id_insert'>" +
                        json.country_id + "</span>");


                } else {
                    $("#validation_country_id_insert").removeClass("has-error");

                    $('#error_country_id_insert').remove();

                    $("#validation_country_id_insert").addClass("has-success");


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