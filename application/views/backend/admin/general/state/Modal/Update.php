<div class="modal-body">
	<div class="portlet light form-fit bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-social-dribbble font-green"></i>

				<span class="caption-subject font-green bold uppercase">Update State</span>
			</div>
			<div class="actions">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="" id="UpdateForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
				<input type="hidden" class="form-control" name="id" id="edit_state_id">
				<div class="form-body">
					<div class="form-group" id="validation_edit_country_name_update">
						<label class="control-label col-md-5" style=" text-align:left;">Country Name</label>
						<div class="col-md-7 ">

							<select class="form-control" name='edit_country_name' id='edit_country_name'>
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



					<div class="form-group" id="validation_state_number_update">
						<label class="control-label col-md-5" style=" text-align:left;">State Name</label>
						<div class="col-md-7">

							<input type="text" class="form-control" id="edit_state_number" name="state_number" placeholder="Enter state Number"
							 autocomplete="off">
						</div>
					</div>
					<div class="form-group" id="validation_state_code_update">
						<label class="control-label col-md-5" style=" text-align:left;">State Code</label>
						<div class="col-md-7">

							<input type="text" class="form-control" id="edit_state_code" name="state_code" placeholder="Enter state Number"
							 autocomplete="off">
						</div>
					</div>



					<div class="form-group" id="validation_state_status_update">
						<label class="control-label col-md-5" style=" text-align:left;">State Status</label>
						<div class="col-md-7">

							<select name='state_status' id="editStatusList" class="form-control">

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
			url: base_url + 'backend/admin/general/state/state/details/'+id,
			type: 'get',
			dataType: 'json',
            async: false,
			success: function (response) {

				//alert(response[0].txt_users_username);


				$("#edit_state_number").val(response[0].StateName);

				$("#edit_state_code").val(response[0].StateCode);




				$("#edit_state_id").val(response[0].Id);

				//edit_state_id

				$("#editStatusList").children('[value="' + response[0].StatusId + '"]').attr('selected', true);

				$("#edit_country_name").children('[value="' + response[0].CountryId + '"]').attr('selected', true);


				// $("#edit_state_status").val(response.txt_attribute_notice);
			}

		});


	}




	$("#update").click(function (e) {

		e.preventDefault();

		var base_url = '<?=base_url()?>';

		var post_data = $("#UpdateForm").serialize();



		$.ajax({
			url: base_url + 'backend/admin/general/state/state/update',
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


				if (json.state_status == 'undefined') {

					$("#validation_state_status_update").addClass("has-error");

					$('#error_state_status_update').remove();

					$('#validation_state_status_update .col-md-7').append(
						"<span class='help-block' id='error_state_status_update'>" + json.state_status + "</span>");
				} else {
					$("#validation_state_status_update").removeClass("has-error");

					$('#error_state_status_update').remove();

					$("#validation_state_status_update").addClass("has-success");


				}

				if (typeof json.state_code != 'undefined') {

					$("#validation_state_code_update").addClass("has-error");

					$('#error_state_code_update').remove();

					$('#validation_state_code_update .col-md-7').append("<span class='help-block' id='error_state_code_update'>" +
						json.state_code + "</span>");
				} else {
					$("#validation_state_code_update").removeClass("has-error");

					$('#error_state_code_update').remove();

					$("#validation_state_code_update").addClass("has-success");


				}

				if (typeof json.state_number != 'undefined') {

					$("#validation_state_number_update").addClass("has-error");

					$('#error_state_number_update').remove();

					$('#validation_state_number_update .col-md-7').append(
						"<span class='help-block' id='error_state_number_update'>" + json.state_number + "</span>");
				} else {
					$("#validation_state_number_update").removeClass("has-error");

					$('#error_state_number_update').remove();

					$("#validation_state_number_update").addClass("has-success");


				}

				if (typeof json.edit_country_name != 'undefined') {


					$("#validation_edit_country_name_update").addClass("has-error");

					$('#error_edit_country_name_update').remove();

					$('#validation_edit_country_name_update .col-md-7').append(
						"<span class='help-block' id='error_edit_country_name_update'>" + json.edit_country_name + "</span>");

				} else {
					$("#validation_edit_country_name_update").removeClass("has-error");

					$('#error_edit_country_name_update').remove();

					$("#validation_edit_country_name_update").addClass("has-success");


				}




			}
		});


	});

</script>
