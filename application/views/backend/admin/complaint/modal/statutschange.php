<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Status Changing</span>
            </div>
            <div class="actions">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" id="UpdateForm" method="post"  class="form-horizontal form-bordered">
                <div class="form-body">



                 <input type="hidden" class="form-control" id="id" value="<?=$id?>" name="id"  autocomplete="off">


                    <div class="form-group" id="validation_vendor_status_update">
                        <label class="control-label col-md-5" style=" text-align:left;">Status</label>
                        <div class="col-md-7">


                            <select name='statusid' id="editStatusList" class="form-control">
                                <?php

foreach ($status as $row) {

    if ($row['Id'] == $productrequestlist[0]['StatusId']) {

        ?>
?>
                                <option value="<?=$row['Id']?>" selected>
                                    <?=$row['Name']?>
                                </option>


        <?php

    } else {
        ?>
                                <option value="<?=$row['Id']?>">
                                    <?=$row['Name']?>
                                </option>
                                <?php
}
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

$('#update').click(function (e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "<?=base_url('backend/dealer/productrequest/productrequestlist/statuschange')?>",
        data: $("#UpdateForm").serialize(),
        success: function (response) {

       // console.log(response);
         location.reload();


        }
    });

});
</script>