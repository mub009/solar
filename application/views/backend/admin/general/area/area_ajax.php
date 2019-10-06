<option value=''>Select Your Area</option>

<?php

if(!empty($ajax))
{
foreach($ajax as $row)
 {
?>

  <option value='<?=$row['Id']?>'><?=$row['AreaName']?></option>

<?php
  }

}

?>