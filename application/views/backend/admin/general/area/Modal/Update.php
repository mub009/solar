<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Update Area</span>
            </div>
            <div class="actions">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" id="UpdateForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <input type="hidden" class="form-control" name="id" id="edit_area_id">
                <div class="form-body">
                    <div class="form-group" id="validation_edit_country_name_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Country Name</label>
                        <div class="col-md-7 ">

                            <select class="form-control" name='edit_country_name' id='edit_country_name' onChange="EditState(this.value);">
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

                            <select name="state_id" class="form-control" onChange="EditCity(this.value);" class="edit_state_list"
                                id="edit_state_list">

                                <option>Select State</option>



                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="validation_city_id_update">
                        <label class="control-label col-md-5" style=" text-align:left;">City Name</label>
                        <div class="col-md-7">

                            <select name="city_id" class="form-control" class="edit_city_list" id="edit_city_list">

                                <option>Select City</option>


                            </select> </div>
                    </div>
                    <div class="form-group" id="validation_area_number_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Area Name</label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="edit_area_number" name="area_number"
                                placeholder="Enter area Number" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group" id="validation_area_code_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Area Code</label>
                        <div class="col-md-7">

                            <input type="text" class="form-control" id="edit_area_code" name="area_code" placeholder="Enter area Number"
                                autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group" id="validation_area_status_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Area Status</label>
                        <div class="col-md-7">

                            <select name='area_status' id="editStatusList" class="form-control">

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
    $("#update").click(function (e) {

        e.preventDefault();

        var base_url = '<?=base_url()?>';

        var post_data = $("#UpdateForm").serialize();

        //console.log(post_data);

        //has-error

        $.ajax({
            url: base_url + 'backend/admin/general/area/area/update',
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


                if (json.area_status == 'undefined') {

                    $("#validation_area_status_update").addClass("has-error");

                    $('#error_area_status_update').remove();

                    $('#validation_area_status_update .col-md-7').append(
                        "<span class='help-block' id='error_area_status_update'>" + json.area_status +
                        "</span>");
                } else {
                    $("#validation_area_status_update").removeClass("has-error");

                    $('#error_area_status_update').remove();

                    $("#validation_area_status_update").addClass("has-success");


                }

                if (typeof json.area_code != 'undefined') {

                    $("#validation_area_code_update").addClass("has-error");

                    $('#error_area_code_update').remove();

                    $('#validation_area_code_update .col-md-7').append(
                        "<span class='help-block' id='error_area_code_update'>" + json.area_code +
                        "</span>");
                } else {
                    $("#validation_area_code_update").removeClass("has-error");

                    $('#error_area_code_update').remove();

                    $("#validation_area_code_update").addClass("has-success");


                }

                if (typeof json.area_number != 'undefined') {

                    $("#validation_area_number_update").addClass("has-error");

                    $('#error_area_number_update').remove();

                    $('#validation_area_number_update .col-md-7').append(
                        "<span class='help-block' id='error_area_number_update'>" + json.area_number +
                        "</span>");
                } else {
                    $("#validation_area_number_update").removeClass("has-error");

                    $('#error_area_number_update').remove();

                    $("#validation_area_number_update").addClass("has-success");


                }
                if (typeof json.city_id != 'undefined') {


                    $("#validation_city_id_update").addClass("has-error");

                    $('#error_city_id_update').remove();

                    $('#validation_city_id_update .col-md-7').append(
                        "<span class='help-block' id='error_city_id_update'>" + json.city_id +
                        "</span>");

                } else {
                    $("#validation_city_id_update").removeClass("has-error");

                    $('#error_city_id_update').remove();

                    $("#validation_city_id_update").addClass("has-success");


                }


                if (typeof json.state_id != 'undefined') {


                    $("#validation_state_id_update").addClass("has-error");

                    $('#error_state_id_update').remove();

                    $('#validation_state_id_update .col-md-7').append(
                        "<span class='help-block' id='error_state_id_update'>" + json.state_id +
                        "</span>");

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

    function State(val) {

        //alert('aa');

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


    function City(val) {

        $.ajax({
            type: "POST",
            async: false,
            url: "<?=base_url()?>backend/admin/general/city/city/ajax",
            data: 'state_id=' + val,
            success: function (data) {

                $("#city_list").html(data);
            }

        });
    }


    function editFunc(id) {

        var base_url = '<?=base_url()?>';

        $.ajax({
            url: base_url + 'backend/admin/general/area/area/details/' + id,
            type: 'get',
            async: false,
            dataType: 'json',
            success: function (response) {


                console.log(response);

                $.ajax({
                    type: "POST",
                    async: false,
                    url: "<?=base_url()?>backend/admin/general/state/state/ajax",
                    data: 'country_id=' + response[0].CountryId,
                    success: function (data) {

                        $("#edit_state_list").html(data);
                        $("#edit_state_list").children('[value="' + response[0].StateId + '"]')
                            .attr('selected', true);

                    }

                });



                $.ajax({
                    type: "POST",
                    async: false,
                    url: "<?=base_url()?>backend/admin/general/city/city/ajax",
                    data: 'state_id=' + response[0].StateId,
                    success: function (data) {

                        $("#edit_city_list").html(data);
                        $("#edit_city_list").children('[value="' + response[0].CityId + '"]').attr(
                            'selected', true);

                    }

                });



                //alert(response[0].txt_users_username);

                console.log(response);

                $("#edit_area_number").val(response[0].AreaName);

                $("#edit_area_code").val(response[0].AreaCode);

                $("#edit_area_id").val(response[0].Id);

                //edit_area_id

                $("#editStatusList").children('[value="' + response[0].StatusId + '"]').attr('selected',
                    true);

                $("#edit_country_name").children('[value="' + response[0].CountryId + '"]').attr('selected',
                    true);

                // $("#edit_area_status").val(response.txt_attribute_notice);
            }

        });


    }


    editFunc(<?=$id?>);


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



    function EditCity(val) {

        $.ajax({
            type: "POST",
            async: false,
            url: "<?=base_url()?>backend/admin/general/city/city/ajax",
            data: 'state_id=' + val,
            success: function (data) {

                $("#edit_city_list").html(data);
            }

        });
    }
</script>