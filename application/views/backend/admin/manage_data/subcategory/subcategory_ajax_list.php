<option value=''>Select Your Subcategory</option>

<?php

if(!empty($ajax))
{
foreach($ajax as $row)
 {
?>

  <option value='<?=$row['SubCategoryId']?>'><?=$row['SubcategoryName']?></option>

<?php
  }

}

?>