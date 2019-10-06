<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */



$route['default_controller'] = 'common/login/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

//admin panel



//$route['API'] = 'Rest_server';

/** common Api */

//API service

//COUNT API 134 ON 22/APR/19

$route["api/customer_logout"] = "api/frontend/customer/customer/logout";


//customer



//logout



$route["api/r_country_list"] = "api/common/country/index";

$route["api/mobile_verification"] = "api/common/mobileverification/index";

$route["api/r_language_list"] = "api/common/language/index";

$route["api/r_language_list"] = "api/common/language/index";

$route["api/u_user_profile"] = "api/frontend/customer/customer/updation";

$route["api/r_user_profile"] = "api/frontend/customer/customer/index";

$route["api/r_complaint"] = "api/frontend/customer/complaint/index";

$route["api/c_complaint"] = "api/frontend/customer/complaint/Create";

$route["api/r_complaintList"] = "api/frontend/customer/complaint/complaintserviceitem";

$route["api/c_installdetails"] = "api/frontend/customer/installitem/create";

$route["api/r_installdetails"] = "api/frontend/customer/installitem/index";



//APP Updating


$route["api/r_app_version_in_ios"] = "api/common/appconfig/IOS";

$route["api/r_app_version_in_apk"] = "api/common/appconfig/APK";

$route["api/r_service"] = "api/common/service/index";




