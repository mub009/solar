<div class="row">
    <div class="col-md-12">


        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Notes</h3>
            </div>
            <div class="panel-body">
                <ul>

                    <?php
                    foreach($legancy as $key=>$row)
                    {
                        if(in_array($key,$assign_value))
                        {
                            echo $row;
                        }
                        
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>