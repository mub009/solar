<div class="modal-body">
	<div class="portlet light form-fit bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-social-dribbble font-green"></i>
				<span class="caption-subject font-green bold uppercase">Update Currency</span>
			</div>
			<div class="actions">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="" id="UpdateForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
				<input type="hidden" class="form-control" name="id" id="edit_currency_id">
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



					<div class="form-group" id="validation_currency_number_update">
						<label class="control-label col-md-5" style=" text-align:left;">Currency Name</label>
						<div class="col-md-7">

							<input type="text" class="form-control" id="edit_currency_number" name="currency_number" placeholder="Enter currency Number"
							 autocomplete="off">
						</div>
					</div>
					<div class="form-group" id="validation_currency_code_update">
						<label class="control-label col-md-5" style=" text-align:left;">Currency Symbol</label>
						<div class="col-md-7">

							<input type="text" class="form-control" id="edit_currency_code" name="currency_code" placeholder="Enter Currency Symbol"
							 autocomplete="off">
						</div>
					</div>



					<div class="form-group" id="validation_currency_status_update">
						<label class="control-label col-md-5" style=" text-align:left;">Currency Status</label>
						<div class="col-md-7">

							<select name='currency_status' id="editStatusList" class="form-control">

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
			url: base_url + 'backend/admin/general/currency/currency/update',
			type: 'POST',
			dataType: "json",
            async: false,
			data: post_data + "&update=true",
			success: function (data) {

				location.reload();

			},
			error: function (jqXhr) {

				var json = $.parseJSON(jqXhr.responseText);

				console.log(jqXhr);


				if (json.currency_status == 'undefined') {

					$("#validation_currency_status_update").addClass("has-error");

					$('#error_currency_status_update').remove();

					$('#validation_currency_status_update .col-md-7').append(
						"<span class='help-block' id='error_currency_status_update'>" + json.currency_status + "</span>");
				} else {
					$("#validation_currency_status_update").removeClass("has-error");

					$('#error_currency_status_update').remove();

					$("#validation_currency_status_update").addClass("has-success");


				}

				if (typeof json.currency_code != 'undefined') {

					$("#validation_currency_code_update").addClass("has-error");

					$('#error_currency_code_update').remove();

					$('#validation_currency_code_update .col-md-7').append(
						"<span class='help-block' id='error_currency_code_update'>" + json.currency_code + "</span>");
				} else {
					$("#validation_currency_code_update").removeClass("has-error");

					$('#error_currency_code_update').remove();

					$("#validation_currency_code_update").addClass("has-success");


				}

				if (typeof json.currency_number != 'undefined') {

					$("#validation_currency_number_update").addClass("has-error");

					$('#error_currency_number_update').remove();

					$('#validation_currency_number_update .col-md-7').append(
						"<span class='help-block' id='error_currency_number_update'>" + json.currency_number + "</span>");
				} else {
					$("#validation_currency_number_update").removeClass("has-error");

					$('#error_currency_number_update').remove();

					$("#validation_currency_number_update").addClass("has-success");


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



	function editFunc(id) {

		var base_url = '<?=base_url()?>';

		$.ajax({
			url: base_url + 'backend/admin/general/currency/currency/details/' + id,
			type: 'get',
            async: false,
			dataType: 'json',
			success: function (response) {



				$.ajax({
					type: "POST",
					url: "<?=base_url()?>backend/admin/general/state/state/ajax",
					data: 'country_id=' + response[0].CountryId,
					success: function (data) {

						$("#edit_state_list").html(data);
						$("#edit_state_list").children('[value="' + response[0].StateId + '"]').attr('selected', true);

					}

				});


				//alert(response[0].txt_users_username);

				console.log(response);

				$("#edit_currency_number").val(response[0].Currency);

				$("#edit_currency_code").val(response[0].CurrencySymbol);

				$("#edit_currency_id").val(response[0].Id);

				//edit_currency_id

				$("#editStatusList").children('[value="' + response[0].StatusId + '"]').attr('selected', true);

				$("#edit_country_name").children('[value="' + response[0].CountryId + '"]').attr('selected', true);

				// $("#edit_currency_status").val(response.txt_attribute_notice);
			}

		});


	}

	editFunc(<?=$id?>)

</script>
