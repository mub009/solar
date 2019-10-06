<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Authorization_Token
 * ----------------------------------------------------------
 * API Token Generate/Validation
 *
 * @author: Mubashir
 * @version: 0.0.1
 */

require_once APPPATH . 'third_party/php-jwt/JWT.php';
require_once APPPATH . 'third_party/php-jwt/BeforeValidException.php';
require_once APPPATH . 'third_party/php-jwt/ExpiredException.php';
require_once APPPATH . 'third_party/php-jwt/SignatureInvalidException.php';

use \Firebase\JWT\JWT;

class Authorization_Token
{
    /**
     * Token Key
     */
    protected $token_key;

    /**
     * Token algorithm
     */
    protected $token_algorithm;

    /**
     * Token Request Header Name
     */
    protected $token_header;

    /**
     * Token Expire Time
     */
    protected $token_expire_time;

    /**
     * web token expire time
     */

    protected $web_token_expire_time;

    /**
     * web token key
     */

    protected $web_token_key;

    /**
     * web token algorithm
     */

    protected $web_jwt_algorithm;

    public function __construct()
    {
        $this->CI = &get_instance();

        /**
         * jwt config file load
         */
        $this->CI->load->config('RestFulApi');

        /**
         * Load Config Items Values
         */
        $this->token_key = $this->CI->config->item('jwt_key');

        $this->token_algorithm = $this->CI->config->item('jwt_algorithm');

        $this->token_header = $this->CI->config->item('token_header');

        $this->web_token_expire_time = $this->CI->config->item('web_token_expire_time');

       
    }


    /**
     * Token Header Check
     * @param: request headers
     */
    private function tokenIsExist($headers)
    {
        if (!empty($headers) and is_array($headers)) {
            foreach ($headers as $header_name => $header_value) {
                if (strtolower(trim($header_name)) == strtolower(trim($this->token_header))) {
                    return ['status' => true, 'token' => $header_value];
                }

            }
        }
        return false;
    }

    /**
     * Generate Token
     * @param: {array} data
     */
    public function GenerateToken($data = null,$token_key,$jwt_algorithm)
    {
        
        $this->web_token_key = $token_key;

        $this->web_jwt_algorithm = $jwt_algorithm;

        if ($data and is_array($data)) {
            // add api time key in user array()
            $data['Created_Time'] = time();

            try {

                $jwttoken = JWT::encode($data, $this->web_token_key, $this->web_jwt_algorithm);

                return $this->_encodeJwtToken($this->web_token_key, $jwttoken);

            } catch (Exception $e) {
                return 'Message: ' . $e->getMessage();
            }
        } else {
            return "Token Data Undefined!";
        }
    }



    /**
     * Validate Token with Header
     * @return : user informations
     */
    public function ValidateToken($Stringtoken,$token_key,$jwt_algorithm,$timeflag=1)
    {


        $this->web_token_key = $token_key;

        $this->web_jwt_algorithm = $jwt_algorithm;



        /**
         * String Decode
         */

        $token = $this->_decodeJwtToken($this->web_token_key, $Stringtoken);

        if ($token) {
            try {

                try {
                    $token_decode = JWT::decode($token, $this->web_token_key, array($this->web_jwt_algorithm));
                } catch (Exception $e) {
                    return ['status' => false, 'message' => $e->getMessage()];
                }

                if (!empty($token_decode) and is_object($token_decode)) {
                    
                    if($timeflag)
                    {

                    // Check Token Create Time [Created_Time]
                   
                    if (empty($token_decode->Created_Time or !is_numeric($token_decode->Created_Time))) {

                        return ['status' => false, 'message' => 'Token Time Not Define!'];
                    } else {
                        /**
                         * Check Token Time Valid
                         */
                        $time_difference = strtotime('now') - $token_decode->Created_Time;

                        if ($time_difference >= $this->web_token_expire_time) {
                            return ['status' => false, 'message' => 'Token Time Expire.'];

                        } else {

                    
                            if ($time_difference <= $this->web_token_expire_time/2) {

                                $token_decode_array = (array) $token_decode;

                                unset($token_decode_array['Created_Time']);

                                $this->CI->session->set_userdata('token', $this->GenerateToken($token_decode_array,$this->web_token_key, $this->web_jwt_algorithm));

                            }

                            /**
                             * All Validation False Return Data
                             */
                            return ['status' => true, 'data' => $token_decode];
                        }
                    }

                }
                else
                {
                    return ['status' => true, 'data' => $token_decode];
                }
             }
                 else {
                    return ['status' => false, 'message' => 'Forbidden'];
                }
            } catch (Exception $e) {
                return ['status' => false, 'message' => $e->getMessage()];
            }
        } else {
            // Authorization Header Not Found!
            return ['status' => false, 'message' => 'Invalid Data'];
        }
    }



    /** hidden encryption method */

    public function _encodeJwtToken($key, $Jwttoken)
    {

        if ($key and $Jwttoken) {

            $this->_encryptionInitialize($key);

            return $this->CI->encryption->encrypt($Jwttoken);

        } else {
            return false;

        }
    }

    public function _decodeJwtToken($key, $Jwttoken)
    {
        if ($key and $Jwttoken) {

            $this->_encryptionInitialize($key);

            return $this->CI->encryption->decrypt($Jwttoken);

        } else {
            return false;

        }

    }

    public function _encryptionInitialize($key)
    {
        $this->CI->encryption->initialize(
            array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $key,
            )
        );

    }

}
