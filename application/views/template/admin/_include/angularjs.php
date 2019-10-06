

<!-- <script src="https://code.angularjs.org/1.3.0/angular.js"></script>  -->


<script>

    var app=angular.module('frashlemon', []);

    var base_url='<?=base_url()?>';

<?php
if (!empty($angular_path)) {

    require APPPATH . "third_party/angularjs/admin/" . $angular_path;
}
?>

</script>
