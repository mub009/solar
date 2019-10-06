<option value=''>Select Your State</option>

<?php

if(!empty($ajax))
{
foreach($ajax as $row)
 {
?>

  <option value='<?=$row['Id']?>'><?=$row['StateName']?></option>

<?php
  }

}

?>