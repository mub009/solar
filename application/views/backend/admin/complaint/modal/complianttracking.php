<div class="modal-body">
    <div class="portlet light form-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Product Tracking</span>
            </div>
            <div class="actions">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> Details</th>
                                                        <th>Status </th>
                                                        <th> Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               <?php
if (!empty($tracking)) {
    $count = 1;
    foreach ($tracking as $row) {
        ?>
                                                       <tr>
                                                        <td>
                                                        <?=$count?>
                                                        </td>
                                                        <td>
                                                        <?=$row['Details']?>&nbsp
                                                        </td>
                                                        <td>
                                                        <?php


    if($row['StatusId'] == 5) {
    
        echo "<span class='label label-sm label-success'> Approved</span>";
    
    } elseif ($row['StatusId'] == 2) {
    
        echo "<span class='label label-sm btn btn-info'> Pending </span>";
    
    } elseif ($row['StatusId'] == 6) {
    
        echo "<span class='label label-sm btn btn-success'> Forward </span>";
    
    } elseif ($row['StatusId'] == 7) {
    
        echo "<span class='label label-sm btn purple-soft'> Rejected </span>";
    
    }
        ?>


</td>
<td>
<?=$row['created_at']?>
</td>

                                                       </tr>
                                                       <?php
$count++;
    }
}
?>


                                               </tbody>
                                            </table>
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
