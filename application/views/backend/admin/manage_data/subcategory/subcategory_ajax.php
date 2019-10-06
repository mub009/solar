<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet light form-fit bordered">


			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-green"></i>
					<span class="caption-subject font-green sbold uppercase"> SUBCATEGORY</span>
				</div>
				<div class="actions">

				</div>
			</div>

			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?=base_url() . 'backend/admin/manage_data/managelanguage/managelanguage/subcategory_update'?>" method='post' class="form-horizontal form-bordered">
					<div class="form-body">




						<?php
//category

foreach ($subcategory_details as $row) {

    ?>

						<div class="form-group">

							<label class="control-label col-md-6" style=" text-align:left;">

									<?=$row['SubcategoryName']?>
	
							</label>

							<div class="col-md-6">

								<input class="form-control" name="laguage[<?=$row['SubCategoryId']?>]" value="<?=$row['parentSubcategoryName']?>"
								 type="text" required>

							</div>
						</div>
						<?php

}

?>

						<input class="form-control" name="set_language_id" value="<?=$select_value?>" type="hidden" required>




						<div class="form-actions">
							<div class="row">
								<div class="col-md-12">
									<center>

										<input type="submit" class="btn blue" value="Save" name='update'>


									</center>


								</div>
							</div>
						</div>

						<!-- END FORM-->
					</div>
				</form>
			</div>
		</div>
