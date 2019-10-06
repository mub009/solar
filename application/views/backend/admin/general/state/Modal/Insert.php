<div class="modal-body">

	<div class="portlet light form-fit bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-social-dribbble font-green"></i>
				<span class="caption-subject font-green bold uppercase">State</span>
			</div>
			<div class="actions">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="" id="InsertForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
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



					<div class="form-group" id="validation_state_number_insert">
						<label class="control-label col-md-5" style=" text-align:left;">State Name <span class="required" aria-required="true"> * </span></label>
						<div class="col-md-7">

							<input type="text" class="form-control" id="state_number" name="state_number" placeholder="Enter state Name"
							 autocomplete="off">
						</div>
					</div>



					<div class="form-group" id="validation_state_code_insert">
						<label class="control-label col-md-5" style=" text-align:left;">State Code <span class="required" aria-required="true"> * </span></label>
						<div class="col-md-7">

							<input type="text" class="form-control" id="state_code" name="state_code" placeholder="Enter state Code"
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

		//console.log(post_data);

		//has-error
        var me = $(this);

if (me.data('requestRunning')) {
    alert('Please Wait Your request is processing');
    return;
}
me.data('requestRunning', true);

		$.ajax({
			url: base_url + 'backend/admin/general/state/state/insert',
			type: 'POST',
			dataType: "json",
            async: false,
			data: post_data + "&submit=true",
			success: function (data) {
              flag=false;
				location.reload();

			},
			error: function (jqXhr) {

				var json = $.parseJSON(jqXhr.responseText);

				console.log(json);


				if (typeof json.state_code != 'undefined') {

					$("#validation_state_code_insert").addClass("has-error");

					$('#error_state_code_insert').remove();

					$('#validation_state_code_insert .col-md-7').append("<span class='help-block' id='error_state_code_insert'>" +
						json.state_code + "</span>");
				} else {
					$("#validation_state_code_insert").removeClass("has-error");

					$('#error_state_code_insert').remove();

					$("#validation_state_code_insert").addClass("has-success");


				}

				if (typeof json.state_number != 'undefined') {

					$("#validation_state_number_insert").addClass("has-error");

					$('#error_state_number_insert').remove();

					$('#validation_state_number_insert .col-md-7').append(
						"<span class='help-block' id='error_state_number_insert'>" + json.state_number + "</span>");


				} else {
					$("#validation_state_number_insert").removeClass("has-error");

					$('#error_state_number_insert').remove();

					$("#validation_state_number_insert").addClass("has-success");


				}

				if (typeof json.country_name != 'undefined') {

					$("#validation_country_name_insert").addClass("has-error");

					$('#error_country_name_insert').remove();

					$('#validation_country_name_insert .col-md-7').append(
						"<span class='help-block' id='error_country_name_insert'>" + json.country_name + "</span>");


				} else {
					$("#validation_country_name_insert").removeClass("has-error");

					$('#error_country_name_insert').remove();

					$("#validation_country_name_insert").addClass("has-success");


				}




			},
             complete: function() {

if($flag)
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
