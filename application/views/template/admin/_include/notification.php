<div  id="alert_container">

<?php

if(validation_errors())
{

?>

                       <div class="portlet box danger">
                            
                           <p class="red btn-outline" width="100%"><h3>Error Occure</h3><br><?=validation_errors()?></p>
                        </div>

                  
<?php

}
elseif($messsage=$this->session->flashdata('success'))
{
 ?>
   

 <div  class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa fa-check-square-o"></i>  <?=$messsage?></div>



                       
 <?php
}
?>
</div>