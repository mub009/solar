<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Add Currency</span>
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

 foreach($country as $row)
    {
   ?>



                                <option value="<?=$row['Id']?>">
                                    <?=$row['CountryName'].'('.$row['CountryCode'].')'?>
                                </option>

                                <?php
    }
  ?>


                            </select>



                        </div>
                    </div>



                    <div class="form-group" id="validation_currency_number_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">Currency Name <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="currency_number" name="currency_number"
                                placeholder="Enter currency Name" autocomplete="off">
                        </div>
                    </div>



                    <div class="form-group" id="validation_currency_code_insert">
                        <label class="control-label col-md-5" style=" text-align:left;">Currency Symbol <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="currency_code" name="currency_code" placeholder="Enter Currency Symbol"
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
    $("#insert").click(function (e) {

        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#InsertForm").serialize();

        //       console.log(post_data);

        //has-error

        $.ajax({
            url: base_url + 'backend/admin/general/currency/currency/insert',
            type: 'POST',
            dataType: "json",
            async: false,
            data: post_data + "&submit=true",
            success: function (data) {

                location.reload();

            },
            error: function (jqXhr) {

                var json = $.parseJSON(jqXhr.responseText);

                console.log(json);


                if (typeof json.currency_code != 'undefined') {

                    $("#validation_currency_code_insert").addClass("has-error");

                    $('#error_currency_code_insert').remove();

                    $('#validation_currency_code_insert .col-md-7').append(
                        "<span class='help-block' id='error_currency_code_insert'>" + json.currency_code +
                        "</span>");
                } else {
                    $("#validation_currency_code_insert").removeClass("has-error");

                    $('#error_currency_code_insert').remove();

                    $("#validation_currency_code_insert").addClass("has-success");


                }

                if (typeof json.currency_number != 'undefined') {

                    $("#validation_currency_number_insert").addClass("has-error");

                    $('#error_currency_number_insert').remove();

                    $('#validation_currency_number_insert .col-md-7').append(
                        "<span class='help-block' id='error_currency_number_insert'>" + json.currency_number +
                        "</span>");


                } else {
                    $("#validation_currency_number_insert").removeClass("has-error");

                    $('#error_currency_number_insert').remove();

                    $("#validation_currency_number_insert").addClass("has-success");


                }

                if (typeof json.country_id != 'undefined') {

                    $("#validation_country_id_insert").addClass("has-error");

                    $('#error_country_id_insert').remove();

                    $('#validation_country_id_insert .col-md-7').append(
                        "<span class='help-block' id='error_country_id_insert'>" + json.country_id +
                        "</span>");


                } else {
                    $("#validation_country_id_insert").removeClass("has-error");

                    $('#error_country_id_insert').remove();

                    $("#validation_country_id_insert").addClass("has-success");


                }




            }
        });


    });
</script>