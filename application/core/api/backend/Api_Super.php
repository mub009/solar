<?php

class Api_Deliveryboy_Controller extends MY_Controller
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

  
            $DataInfo =  $this->authorization_token->ValidateToken($this->input->get_request_header($auth_name, true),$this->config->item('api_deliveryboy_jwt_key'),$this->config->item('api_jwt_algorithm'),0);

           

            if ($DataInfo['status'] == 1) {

                if ($DataInfo['data']->UserMasterId == 77 or $DataInfo['data']->UserMasterId == 66 ) {

                   
                    $this->data['userinfo'] = (array) $DataInfo['data'];

              
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