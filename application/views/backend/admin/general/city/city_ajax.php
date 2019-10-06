<option value=''>Select Your City</option>

<?php

if(!empty($ajax))
{
foreach($ajax as $row)
 {
?>

  <option value='<?=$row['Id']?>'><?=$row['CityName']?></option>

<?php
  }

}

?>