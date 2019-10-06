<?php

class Api_Dealer_Controller extends MY_Controller
{

    public $data = array();

    public function __construct()
    {
        parent::__construct();

     
        $auth_name=$this->config->item('AuthName');
     
    
        if(empty($this->input->get_request_header($this->config->item('APIKEY_Name'))) or $this->input->get_request_header($this->config->item('APIKEY_value'))==$this->config->item('APIKEY_Name'))
            {

                echo $this->input->get_request_header($this->config->item('AuthName'));

                $this->json_encode(400,'No Api Key');

            }



        if (empty($this->input->get_request_header($auth_name, true))) {
            
            
            $this->json_encode(400,'No Authentication key');
            
         } else {

  
            $DataInfo =  $this->authorization_token->ValidateToken($this->input->get_request_header($auth_name, true),$this->config->item('api_dealer_jwt_key'),$this->config->item('api_jwt_algorithm'),0);

           

            if ($DataInfo['status'] == 1) {

                if ($DataInfo['data']->UserMasterId == 22 ) {

                   

                    $this->data['userinfo'] = (array) $DataInfo['data'];

                if($this->uri->segment(3)!="c_dealer_registration")
                {
                  if ($DataInfo['data']->OtpVerification == 'not active') {

                     
                      $this->json_encode(400,'mobile number not verification');

                  }
                }
               }
               else
               {
                  $this->json_encode(400,'unAuthentication User');
               
               }

                } else {
                   
                       $this->json_encode(400,'Authentication key expire');
                  
         
                }
            } 

        }

}