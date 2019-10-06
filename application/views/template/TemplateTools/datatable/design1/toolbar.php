<?php
if(!empty($privilege_array))
{
?>

<div class="table-toolbar">

    <div class="row">
        <div class="col-md-6">


            <!-- set privilege -->

            <?php

if (in_array($privilege_value, $privilege_array) or in_array('admin', $privilege_array)) {


    ?>
            <div class="btn-group">

                <?php

if(!empty($link_value))
{
    
    if ($link == 'link') {

        ?>
                <a href="<?=base_url() . $link_value?> " id="sample_edittable_1_new"
                    class="btn blue-hoki"> Add &nbsp<i class="fa fa-plus"></i></a>

                <?php
}
elseif($link == 'in_modal')

{

    ?>

    <a id="sample_editable_1_new" class="btn blue-hoki" data-target="#add" data-toggle="modal"> Add &nbsp<i class="fa fa-plus"></i></a>
    


    <?php
}
else {
        ?>
                <a href="<?=base_url() . $link_value?> " id="sample_edittable_1_new"
                    class="btn blue-hoki" data-target="#basic" data-toggle="modal"> Add &nbsp<i class="fa fa-plus"></i></a>


                <?php
}
   }
      ?>




            </div>
            <?php
}
?>
        </div>




        <div class="col-md-6">


                <?php

if ($tool) {
    ?>

      <div class="btn-group pull-right">
               <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                   <i class="fa fa-angle-down"></i>
               </button>
               <ul class="dropdown-menu pull-right">

                   <li>
                       <a href="javascript:;" id="pdfExportReporttoExcel">
                           <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                   </li>
                   <li>
                       <a href="javascript:;" id="csvExportReporttoExcel">
                           <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                   </li>
               </ul>
           </div>
            <?php
}
?>
        </div>
    </div>

    <?=($filter_link)?"<br>".$this->load->view($filter_link,'',true):''?>

</div>

<?php
}
?>