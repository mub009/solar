<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Country Delete</h4>
</div>


<form action="<?=base_url() . 'backend/admin/general/country/country/delete'?>" method="post">

    <input type="hidden" value="<?=$id?>" class="form-control" id="delete_country_id" name="delete_country_id"
        autocomplete="off">


    <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" name='delete' value="Delete">
    </div>
</form>