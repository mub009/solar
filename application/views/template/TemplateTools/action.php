

    <div class="btn-group" id="btngroup">
    
        <button class="btn btn-xs btn-danger dropdown-toggle text-center" type="button" data-toggle="dropdown"
            aria-expanded="false">
            Actions
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right" role="menu">


            <?php

foreach ($action_config as $row) {
    if ($row['EveryPrivilege'] or in_array($row['value'], $row['privilege'])) {
        ?>
            <li>

<?php
if(empty($row['link_mode']))
{
?>
  <a href="<?=base_url() . $row['link'] . $row['id']?>" data-toggle='modal' data-target='#basic'><i class="<?=$row['icon']?>"></i> <?=$row['action_name']?></a>



<?php


}
elseif((int)$row['link_mode']==2)
{
?>

                <a href=""  onclick='<?=$row['OnClickFun']?>' data-toggle='modal' data-target='#<?=$row['ModalName']?>'><i class="<?=$row['icon']?>"></i> <?=$row['action_name']?></a>



<?php

}
elseif((int)$row['link_mode']==1)
{
?>


        
        <a href="<?=base_url() . $row['link'] . $row['id']?>"><i class="<?=$row['icon']?>"></i> <?=$row['action_name']?></a>


<?php

}

?>

            </li>
            <?php
  }
}
?>

        </ul>
    </div>
    
  