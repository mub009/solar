<option value="">Select</option>

<?php

if (!empty($DeliveryTypeBoy)) {
    foreach ($DeliveryTypeBoy as $row) {

        ?>

    <option value="<?=$row['UserId']?>"><?=$row['MobileNo']?></option>

    <?php

    }
}

?>