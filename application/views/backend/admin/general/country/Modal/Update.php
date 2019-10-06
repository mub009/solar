<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Update Country</span>
            </div>
            <div class="actions">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" id="UpdateForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <input type="hidden" class="form-control" name="id" id="edit_Country_id">
                <div class="form-body">
                    <div class="form-group" id="validation_country_number_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Name</label>
                        <div class="col-md-7 ">

                            <input type="text" class="form-control" id="edit_country_number" name="country_number"
                                placeholder="Enter Country Number" autocomplete="off">




                        </div>
                    </div>



                    <div class="form-group" id="validation_country_code_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Code</label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="edit_country_code" name="country_code"
                                placeholder="Enter Country Code" autocomplete="off">

                        </div>
                    </div>
                    <div class="form-group" id="validation_mobile_number_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Total Mobile Number Digits</label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="edit_mobile_number" name="mobile_number"
                                placeholder="Enter Total Mobile Number Digits" autocomplete="off">

                            <center>
                                <p>(Not Include Country Code)</p>
                            </center>
                        </div>

                    </div>


                    <div class="form-group" id="validation_country_status_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Status</label>
                        <div class="col-md-7">

                            <select name='country_status' id="editStatusList" class="form-control">

                                <?php

foreach ($status as $row) {
    ?>
                                <option value="<?=$row['Id']?>">
                                    <?=$row['Name']?>
                                </option>
                                <?php
}

?>
                            </select>
                        </div>
                    </div>






                </div>








                <!-- END FORM-->
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
    <input type="submit" id="update" class="btn green" name='update' value="Save changes">
</div>
</form>


<script>
    editFunc("<?=$id?>");

    function editFunc(id) {

        var base_url = '<?=base_url()?>';

        $.ajax({
            url: base_url + 'backend/admin/general/country/country/details/' + id,
            type: 'get',
            async: false,
            dataType: 'json',
            success: function (response) {


                $("#edit_country_number").val(response[0].CountryName);

                $("#edit_country_code").val(response[0].CountryCode);

                $("#edit_mobile_number").val(response[0].TotalMobileNumberDigits);


                $("#edit_Country_id").val(response[0].Id);
                

                //edit_Country_id

                $("#editStatusList").children('[value="' + response[0].StatusId + '"]').attr('selected',
                    true);

                // $("#edit_Country_status").val(response.txt_attribute_notice);
            }

        });


    }




    // update


    $("#update").click(function (e) {

        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#UpdateForm").serialize();

        //console.log(post_data);

        //has-error

        $.ajax({
            url: base_url + 'backend/admin/general/country/country/update',
            type: 'POST',
            dataType: "json",
            data: post_data + "&update=true",
            success: function (data) {

                location.reload();

            },
            error: function (jqXhr) {

                var json = $.parseJSON(jqXhr.responseText);

                console.log(jqXhr);


                if (json.country_status == 'undefined') {

                    $("#validation_country_status_update").addClass("has-error");

                    $('#error_country_status_update').remove();

                    $('#validation_country_status_update .col-md-7').append(
                        "<span class='help-block' id='error_country_status_update'>" + json.country_status +
                        "</span>");
                } else {
                    $("#validation_country_status_update").removeClass("has-error");

                    $('#error_country_status_update').remove();

                    $("#validation_country_status_update").addClass("has-success");


                }

                if (typeof json.country_code != 'undefined') {

                    $("#validation_country_code_update").addClass("has-error");

                    $('#error_country_code_update').remove();

                    $('#validation_country_code_update .col-md-7').append(
                        "<span class='help-block' id='error_country_code_update'>" + json.country_code +
                        "</span>");
                } else {
                    $("#validation_country_code_update").removeClass("has-error");

                    $('#error_country_code_update').remove();

                    $("#validation_country_code_update").addClass("has-success");


                }



                if (typeof json.country_number != 'undefined') {


                    $("#validation_country_number_update").addClass("has-error");

                    $('#error_country_number_update').remove();

                    $('#validation_country_number_update .col-md-7').append(
                        "<span class='help-block' id='error_country_number_update'>" + json.country_number +
                        "</span>");

                } else {
                    $("#validation_country_number_update").removeClass("has-error");

                    $('#error_country_number_update').remove();

                    $("#validation_country_number_update").addClass("has-success");


                }
                if (typeof json.mobile_number != 'undefined') {


                    $("#validation_mobile_number_update").addClass("has-error");

                    $('#error_mobile_number_update').remove();

                    $('#validation_mobile_number_update .col-md-7').append(
                        "<span class='help-block' id='error_mobile_number_update'>" + json.mobile_number +
                        "</span>");

                } else {
                    $("#validation_mobile_number_update").removeClass("has-error");

                    $('#error_mobile_number_update').remove();

                    $("#validation_mobile_number_update").addClass("has-success");


                }




            }
        });


    });
</script>