

<table class="table table-striped table-bordered table-hover table-checkable order-column" id="<?=(!empty($table_name))?$table_name:'design1'?>">
    <thead>
        <tr>
            <?php

foreach($column_name as $row)
{
    ?>

            <th class="text-center">
                <?=$row?>
            </th>

            <?php
}

?>


        </tr>
    </thead>

</table>


<script>



var <?=(!empty($table_name))?$table_name:'datatableobj'?>;

//ss sasamsmm


$(document).ready(function () {

//  $('#filterform').preventDefault();

  Datatable();
 

function Datatable(filterData=null)
{

  this.<?=(!empty($table_name))?$table_name:'datatableobj'?>=$('#<?=(!empty($table_name))?$table_name:'design1'?>').DataTable({
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
               buttons: [{
                   extend: 'excel',
                   text: 'Excel',
                   className: 'buttonsToHide',
                   filename: 'Test_Excel',
                   icon: 'fa-print',
                   exportOptions: { modifier: {  search: 'applied',
                   order: 'applied'}, columns: [ 0,1,2,3]  }
               },
               {
                   extend: 'csv',
                   text: 'CSV',
                   className: 'buttonsToHide',
                   filename: 'Test_Csv',
                   exportOptions: { modifier: { search: 'applied',
                   order: 'applied'}, columns: [0,1,2,3] }
               },
               {
                   extend: 'pdf',
                   text: 'PDF',
                   className: 'buttonsToHide',
                   filename: 'Test_Pdf',
                   exportOptions: { modifier: { search: 'applied',
                   order: 'applied'} , columns: [0,1,2,3]}
               },

               'colvis'
               ],
           "bProcessing": true,
           "serverSide": true,
           "ajax": {
               url: "<?=base_url($json_url)?>", // json datasource
               type: "post", // type of method  , by default would be get
               data: 
               {
                   check : filterData
               },
               error: function () { // error handling code

                 // $("#design1").css("display", "none");
               },
               columnDefs: [
                {
                className: 'dt-body-center'
               }
             ]
           }
       });

}      


$('#filter').click(function (e) { 
    e.preventDefault();
   

    $('#<?=(!empty($table_name))?$table_name:'design1'?>').DataTable().destroy();
   
    Datatable(Filter());
    
});



$("#csvExportReporttoExcel").on("click", function() {
   <?=(!empty($table_name))?$table_name:'datatableobj'?>.button( '.buttons-csv' ).trigger();
});

$("#pdfExportReporttoExcel").on("click", function() {
   <?=(!empty($table_name))?$table_name:'datatableobj'?>.button( '.buttons-pdf' ).trigger();
});

$("#excelExportReporttoExcel").on("click", function() {
   <?=(!empty($table_name))?$table_name:'datatableobj'?>.button( '.buttons-excel' ).trigger();
});

   });



</script>