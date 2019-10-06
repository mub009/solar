<div class="modal-body">

    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Update City</span>
            </div>
            <div class="actions">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" id="UpdateForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <input type="hidden" class="form-control" name="id" id="edit_city_id">
                <div class="form-body">
                    <div class="form-group" id="validation_edit_country_name_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Name</label>
                        <div class="col-md-7 ">

                            <select class="form-control" name='edit_country_name' id='edit_country_name' onchange="State(this.value)">
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



                    <div class="form-group" id="validation_state_id_update">
                        <label class="control-label col-md-5" style=" text-align:left;">State Name</label>
                        <div class="col-md-7">

                            <select name="state_id" class="form-control" class="edit_state_list" id="state_list" name="state">

                                <option>Select State</option>



                                <?php

foreach ($state_details as $row) {
    ?>



                                <option value="<?=$row['Id']?>">
                                    <?=$row['StateName'] . '(' . $row['StateCode'] . ')'?>
                                </option>

                                <?php

}
?>





                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="validation_city_number_update">
                        <label class="control-label col-md-5" style=" text-align:left;">City Name</label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="edit_city_number" name="city_number"
                                placeholder="Enter city Number" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group" id="validation_city_code_update">
                        <label class="control-label col-md-5" style=" text-align:left;">City Code</label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="edit_city_code" name="city_code" placeholder="Enter city Number"
                                autocomplete="off"> </div>
                    </div>



                    <div class="form-group" id="validation_city_status_update">
                        <label class="control-label col-md-5" style=" text-align:left;">City Status</label>
                        <div class="col-md-7">

                            <select name='city_status' id="editStatusList" class="form-control">

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
    <input type="submit" id="update" class="btn btn-danger" name='update' value="Save changes">
</div>
</form>

<script>
    editFunc("<?=$id?>");


    $("#update").click(function (e) {

        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#UpdateForm").serialize();

        //console.log(post_data);

        //has-error

        $.ajax({
            url: base_url + 'backend/admin/general/city/city/update',
            type: 'POST',
            async: false,
            dataType: "json",
            data: post_data + "&update=true",
            success: function (data) {

                location.reload();

            },
            error: function (jqXhr) {

                var json = $.parseJSON(jqXhr.responseText);

                console.log(jqXhr);


                if (json.city_status == 'undefined') {

                    $("#validation_city_status_update").addClass("has-error");

                    $('#error_city_status_update').remove();

                    $('#validation_city_status_update .col-md-7').append(
                        "<span class='help-block' id='error_city_status_update'>" + json.city_status +
                        "</span>");
                } else {
                    $("#validation_city_status_update").removeClass("has-error");

                    $('#error_city_status_update').remove();

                    $("#validation_city_status_update").addClass("has-success");


                }

                if (typeof json.city_code != 'undefined') {

                    $("#validation_city_code_update").addClass("has-error");

                    $('#error_city_code_update').remove();

                    $('#validation_city_code_update .col-md-7').append(
                        "<span class='help-block' id='error_city_code_update'>" +
                        json.city_code + "</span>");
                } else {
                    $("#validation_city_code_update").removeClass("has-error");

                    $('#error_city_code_update').remove();

                    $("#validation_city_code_update").addClass("has-success");


                }

                if (typeof json.city_number != 'undefined') {

                    $("#validation_city_number_update").addClass("has-error");

                    $('#error_city_number_update').remove();

                    $('#validation_city_number_update .col-md-7').append(
                        "<span class='help-block' id='error_city_number_update'>" + json.city_number +
                        "</span>");
                } else {
                    $("#validation_city_number_update").removeClass("has-error");

                    $('#error_city_number_update').remove();

                    $("#validation_city_number_update").addClass("has-success");


                }

                if (typeof json.state_id != 'undefined') {


                    $("#validation_state_id_update").addClass("has-error");

                    $('#error_state_id_update').remove();

                    $('#validation_state_id_update .col-md-7').append(
                        "<span class='help-block' id='error_state_id_update'>" +
                        json.state_id + "</span>");

                } else {
                    $("#validation_state_id_update").removeClass("has-error");

                    $('#error_state_id_update').remove();

                    $("#validation_state_id_update").addClass("has-success");


                }


                if (typeof json.edit_country_name != 'undefined') {


                    $("#validation_edit_country_name_update").addClass("has-error");

                    $('#error_edit_country_name_update').remove();

                    $('#validation_edit_country_name_update .col-md-7').append(
                        "<span class='help-block' id='error_edit_country_name_update'>" + json.edit_country_name +
                        "</span>");

                } else {
                    $("#validation_edit_country_name_update").removeClass("has-error");

                    $('#error_edit_country_name_update').remove();

                    $("#validation_edit_country_name_update").addClass("has-success");


                }




            }
        });


    });

    editFunc("<?=$id?>");

    function editFunc(id) {

        var base_url = '<?=base_url()?>';

        $.ajax({
            url: base_url + 'backend/admin/general/city/city/details/' + id,
            type: 'get',
            async: false,
            dataType: 'json',
            success: function (response) {





                //alert(response[0].txt_users_username);

                console.log(response);

                $("#edit_city_number").val(response[0].CityName);

                $("#edit_city_code").val(response[0].CityCode);

                $("#edit_city_id").val(response[0].Id);

                //edit_city_id

                $("#state_list").children('[value="' + response[0].StateId + '"]').attr('selected',
                    true);


                $("#editStatusList").children('[value="' + response[0].StatusId + '"]').attr('selected',
                    true);

                $("#edit_country_name").children('[value="' + response[0].CountryId + '"]').attr('selected',
                    true);

                // $("#edit_city_status").val(response.txt_attribute_notice);
            }

        });


    }

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

    function EditState(val) {

        $.ajax({
            type: "POST",
            async: false,
            url: "<?=base_url()?>backend/admin/general/state/state/ajax",
            data: 'country_id=' + val,
            success: function (data) {

                $("#edit_state_list").html(data);
            }

        });
    }
</script>