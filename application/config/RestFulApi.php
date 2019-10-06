<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['APIkey'] = false;

/**
-----------------------Mobile api authorization---------------------------------------------------
 */

 /**
  * api auth header name 
  */
  
  $config['AuthName'] ='API-Auth';

  /**
   * API KEY NAME
   */

   
$config['APIKEY_Name'] ='API-KEY';

//
/**
 * API KEY value 
 */

$config['APIKEY_value'] ='12345';


/*
|--------------------
| JWT Secure Key
|--------------------------------------------------------------------------
 */

$config['api_vendor_jwt_key'] = '!@#$%^#&()vendor\\';


$config['api_dealer_jwt_key'] = 'e^^!@~0$%^&()dealer\\';


$config['api_supervisor_jwt_key'] = 'e!@~0$%++^&()supervisor\\';

// $config['api_thirdpartydeliveryboy_jwt_key'] = 'e!@~0$,,,%^&()thirdpartydeliveryboy\\';

$config['api_deliveryboy_jwt_key'] = 'e!..@~0$%^&()deliveryboy\\';


$config['api_customer_jwt_key'] = 'e!ER@~0$%^&()customer\\';


/*
|-----------------------
| JWT Algorithm Type
|--------------------------------------------------------------------------
 */

$config['api_jwt_algorithm'] = 'HS256';

/*
|-----------------------
| Token Request Header Name
|--------------------------------------------------------------------------
 */

$config['token_header'] = 'Auth';


/**
-----------------------web authorization---------------------------------------------------
 */

/*
|--------------------
| JWT Secure Key
|--------------------------------------------------------------------------
 */
$config['web_token_key'] = 'eyJ0eXAiOiJKV1QiLCJhbGciTWvLUzI1NiJ9IiRkYXRhIg';

/*
|-----------------------
| JWT Algorithm Type
|--------------------------------------------------------------------------
 */
$config['web_jwt_algorithm'] = 'HS256';

/*
|-----------------------
| Token Expire Time

| https://www.tools4noobs.com/online_tools/hh_mm_ss_to_seconds/
|--------------------------------------------------------------------------
| ( 1 Day ) : 60 * 60 * 24 = 86400
| ( 1 Hour ) : 60 * 60     = 3600
| ( 1 Minute ) : 60        = 60
 */
$config['web_token_expire_time'] = 3600;
