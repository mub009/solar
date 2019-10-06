

<table class="table table-striped table-bordered table-hover table-checkable order-column" id="<?=(!empty($table_name))?$table_name:'design2'?>">

    <thead>
        <tr>
            <?php

foreach($column_name as $row)
{
    ?>

            <th>
                <?=$row?>
            </th>

            <?php
}

?>


        </tr>
    </thead>

</table>


