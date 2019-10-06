<div class="modal-body">
	<div class="portlet light form-fit bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-social-dribbble font-green"></i>
				<span class="caption-subject font-green bold uppercase">Update Admin</span>
			</div>
			<div class="actions">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="" id="UpdateForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
				<input type="hidden" class="form-control" name="id" id="edit_Admin_id">
				<div class="form-body">



					<div class="form-group" id="validation_country_name_insert">
						<label class="control-label col-md-5" style=" text-align:left;">Country Name</label>
						<div class="col-md-7 ">

							<select class="form-control" name='country_name' id="editCountryList">
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




					<div class="form-group" id="validation_Admin_number_update">
						<label class="control-label col-md-5" style=" text-align:left;">Admin Mobile Number</label>
						<div class="col-md-7">

							<input type="text" class="form-control" id="edit_Admin_number" name="Admin_number" placeholder="Enter Admin Mobile Number"
							 autocomplete="off">
						</div>
					</div>



					<div class="form-group" id="validation_Admin_status_update">
						<label class="control-label col-md-5" style=" text-align:left;">Admin Status</label>
						<div class="col-md-7">

							<select name='Admin_status' id="editStatusList" class="form-control">

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

					<!-- END FORM-->
				</div>
		</div>
	</div>


</div>
<div class="modal-footer">
	<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
	<input type="submit" class="btn green" name='update' id="update" value="Save changes">
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
			url: base_url + 'backend/admin/user/admin/admin/update',
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


				if (json.Admin_status == 'undefined') {

					$("#validation_Admin_status_update").addClass("has-error");

					$('#error_Admin_status_update').remove();

					$('#validation_Admin_status_update .col-md-7').append(
						"<span class='help-block' id='error_Admin_status_update'>" + json.Admin_status + "</span>");
				} else {
					$("#validation_Admin_status_update").removeClass("has-error");

					$('#error_Admin_status_update').remove();

					$("#validation_Admin_status_update").addClass("has-success");


				}

				if (typeof json.Admin_number != 'undefined') {


					$("#validation_Admin_number_update").addClass("has-error");

					$('#error_Admin_number_update').remove();

					$('#validation_Admin_number_update .col-md-7').append(
						"<span class='help-block' id='error_Admin_number_update'>" + json.Admin_number + "</span>");

				} else {
					$("#validation_Admin_number_update").removeClass("has-error");

					$('#error_Admin_number_update').remove();

					$("#validation_Admin_number_update").addClass("has-success");


				}




			}
		});


	});


	//alert('active open');

	function editFunc(id) {

		var base_url = '<?=base_url()?>';

		$.ajax({
			url: base_url + 'backend/admin/user/admin/admin/details/' + id,
			type: 'get',
			dataType: 'json',
            async: false,
			success: function (response) {

				console.log(response);

				$("#edit_Admin_number").val(response[0].MobileNo);


				$("#edit_Admin_id").val(response[0].UserId);


	            $("#editStatusList").children('[value="' + response[0].StatusId + '"]').attr('selected', true);

				$("#editCountryList").children('[value="' + response[0].CountryId + '"]').attr('selected', true);

			}

		});


	}


	editFunc("<?=$id?>");

</script>
