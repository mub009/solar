<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Are You <?=$statusDetails['Name']?></h4>
</div>


<form method="post" id="actionform">

    <input type="hidden" value="<?=$statusId?>"  name="StatusId" autocomplete="off">

    <input type="hidden" value="<?=$ServiceId?>" name="actionId" autocomplete="off">


    <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">No</button>
        <input type="submit"  id="actionbtn" class="btn btn-green" name='action' value="Yes">
    </div>
</form>

<script>

$(document).ready(function () {
    
$('#actionbtn').click(function (e) { 
    e.preventDefault();
    
$.ajax({
    type: "post",
    url: "<?=base_url().'backend/admin/complaint/complaint/action/'?>",
    data: $('#actionform').serialize(),
    dataType: "json",
    success: function (response) {


        $('#basic').modal('toggle');
                    

        if(response.statusCode==200)
        {


            swal({
                    title: "Successfully Update ",
                    text: "",
                    type: "success",
                },
                function(){ 
       location.reload();
   }
                );


    $('#design1').DataTable().destroy();
   
   Datatable(Filter());


          //  location.reload();
        }
        else if(response.statusCode==400)
        {

        }
    }
});

});

});


</script>