

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">
                        <?=$title?></span>
                </div>
            </div>

        <div class="portlet-body">
    

        <!-- tool bar -->

<?php
if(!empty($toolbar))
{
?>
 
           <?=$toolbar?>

<?php
}
?>
        <!-- datatable  -->
      
           <?=$table?>
        

            </div>
        </div>
    </div>
</div>
