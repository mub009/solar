<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">Admin Delete</h4>
</div>


<form action="<?=base_url() . 'backend/admin/user/admin/admin/delete'?>" method="post">

	<input type="hidden" class="form-control" id="delete_Admin_id" value="<?=$id?>" name="delete_Admin_id" autocomplete="off">


	<div class="modal-footer">
		<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
		<input type="submit" class="btn green" name='delete' value="Delete">
	</div>
</form>

</div>

<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
