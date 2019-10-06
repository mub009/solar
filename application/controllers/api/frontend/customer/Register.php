<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends API_Controller
{

    public $data = array();

    protected $flag=0;

    public function __construct()
    {
        parent::__construct();

         $auth_name=$this->config->item('AuthName');
        

        if(empty($this->input->get_request_header($this->config->item('APIKEY_Name'))) or $this->input->get_request_header($this->config->item('APIKEY_Name'))!=$this->config->item('APIKEY_value'))
          {
                
                $this->json_encode(400,'No Api Key');
  
            }



        if (empty($this->input->get_request_header($auth_name, true))) {
            
            $this->json_encode(400,'No Authentication key');
            
            
        } else {

        
           
            $DataInfo =  $this->authorization_token->ValidateToken($this->input->get_request_header($auth_name, true),$this->config->item('api_customer_jwt_key'),$this->config->item('api_jwt_algorithm'),0);

        
            if ($DataInfo['status'] == 1) {

              
                if ($DataInfo['data']->UserMasterId == 33 ) {

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

    //customer details
    public function index()
    {
        $this->form_validation->set_rules('Name', 'Name', 'required|regex_match[/^[0-9 + A-Z a-z]+$/]');

        $this->form_validation->set_rules('Contact1', 'Contact1', 'required|regex_match[/^[0-9 +]+$/]');
        
        $this->form_validation->set_rules('Contact2', 'Contact2', 'required|regex_match[/^[0-9 +]+$/]');

        $this->form_validation->set_rules('AreaCode', 'AreaCode', 'required');

        $this->form_validation->set_rules('Gender', 'Gender', 'required');

        $this->form_validation->set_rules('DOB', 'DOB', 'required');

        $this->form_validation->set_rules('Email', 'Email', 'required');
        
        //$this->form_validation->set_rules('ProfilePic', 'ProfilePic', 'required');
        
        if($this->form_validation->run() == true)
        {

            $customer_details=array('CustomerName'=>$this->input->post('Name'),'ProfilePic'=>$this->input->post('ProfilePic'),'Contact1'=>$this->input->post('Contact1'),'Contact2'=>$this->input->post('Contact2'),'AreaCode'=>$this->input->post('AreaCode'),'Gender'=>$this->input->post('Gender'),'DOB'=>$this->input->post('DOB'),'CountryId'=>$this->data['userinfo']['CountryId'],'Email'=>$this->input->post('Email'),'FCMToken'=>$this->input->post('FCMToken'),'RegisterdDate'=>date('Y-m-d'),'UpdatedDate'=>date('Y-m-d'));

            $Address_details=array('BuildingDetails'=>$this->input->post('BuildingDetails'),'StreetDetails'=>$this->input->post('StreetDetails'),'Locality'=>$this->input->post('Locality'),'State'=>$this->input->post('State'),'City'=>$this->input->post('City'),'PinCode'=>$this->input->post('PinCode'),'Landmark'=>$this->input->post('Landmark'),'Latitude'=>$this->input->post('Latitude'),'Longitude'=>$this->input->post('Longitude'),);


            $OTP_Verification=array('OtpVerification'=>1,'StatusId'=>1);

            if($this->Base_Model->update('tbl_customer',array('UserId'=>$this->data['userinfo']['UserTypeId']),$customer_details))
            {

      
                $customer_default_address_id=$this->Base_Model->select('tbl_customer','AddressId',array('UserId'=>$this->data['userinfo']['UserTypeId']));
    

                if($this->Base_Model->update('tbl_address',array('AddressId'=>$customer_default_address_id['AddressId']),$Address_details))
                    {

                    $this->Base_Model->update('tbl_user_type',array('UserId'=>$this->data['userinfo']['UserTypeId']),$OTP_Verification);

                    $this->flag=1;


                    //again added auth key

                    unset($this->data['userinfo']['StatusId']);

                    unset($this->data['userinfo']['OtpVerification']);
                    
                    $auth_name=$this->config->item('AuthName');

                    $authkey=$this->authorization_token->GenerateToken($this->data['userinfo']+array('StatusId'=>1,'OtpVerification'=>1),$this->config->item('api_customer_jwt_key'),$this->config->item('api_jwt_algorithm'));

                    
                    $success=array('status'=>'success','UserId'=>$this->data['userinfo']['UserId'],'Auth'=>$authkey);

                    }
                else
                    {

                    $fail=array('status'=>'fail');

                    }

                }
                else
                {

                $fail=array('status'=>'fail');

                }
        if($this->flag)
        {

            json_output(200, $success);
        }
        else
        {
            json_output(400, $fail);
        }

            }
            else
            {
                json_output(400,$this->form_validation->error_array());
            }


    }

}