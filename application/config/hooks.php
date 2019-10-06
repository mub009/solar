<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|    https://codeigniter.com/user_guide/general/hooks.html
|
 */
// $hook['display_override'] = array(
//     'class' => 'CSRF_Protection',
//     'function' => 'inject_tokens',
//     'filename' => 'CSRF_Protection.php',
//     'filepath' => 'hooks',
// );


// hook for enable/disable profiling




// if (isset($_SERVER["REQUEST_URI"])) {

//     $url = explode('/', $_SERVER["REQUEST_URI"]);

//     if ($url[1] != 'api') {
      
//         $hook['post_controller_constructor'][] = array(
//         'class'    => 'ProfilerEnabler',
//         'function' => 'enableProfiler',
//         'filename' => 'hooks.profiler.php',
//         'filepath' => 'hooks',
//         'params'   => array());
        
//     } 
// }