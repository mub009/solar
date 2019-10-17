<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends Api_Customer_Controller
{
    
    
    protected $flag=0;

    //customer details
    public function index()
    {
            $CustomerUserTypeId = $this->data['userinfo']['UserTypeId'];

            $Detail = $this->Base_Model->query("SELECT * FROM `tbl_user_type` join tbl_usertypemaster on tbl_usertypemaster.UserTypeId=tbl_user_type.UserTypeId join tbl_customer on tbl_customer.UserId=tbl_user_type.UserId join tbl_address on tbl_address.AddressId=tbl_customer.AddressId where tbl_user_type.UserId='$CustomerUserTypeId'");
            
            json_output(200, $Detail);

        

    }

//registration or updation
    public function updation()
    {

        $this->form_validation->set_rules('Name', 'Name', "required");

        $this->form_validation->set_rules('ContactNo', 'ContactNo', 'required');

        $this->form_validation->set_rules('BuildingDetails', 'BuildingDetails', 'required');
        
        $this->form_validation->set_rules('StreetDetails', 'StreetDetails', 'required');
        
        $this->form_validation->set_rules('Locality', 'Locality', 'required');
        
        $this->form_validation->set_rules('State', 'State', 'required');
        
        $this->form_validation->set_rules('City', 'City', 'required');

        $this->form_validation->set_rules('Landmark', 'Landmark', 'required');

        $this->form_validation->set_rules('dateofplantination', 'dateofplantination', 'required');

        $this->form_validation->set_rules('is_grid', 'is_grid', 'required');

        if ($this->form_validation->run() == true) {


            $customer_details = array('CustomerName' => $this->input->post('Name'),'SolarCustomerId'=>$this->input->post('SolarCustomerId'),'ProfilePic' => '', 'Contact1' => $this->input->post('ContactNo'), 'Contact2' => '', 'AreaCode' => '', 'Gender' => '', 'DOB' => '', 'CountryId' => $this->data['userinfo']['CountryId'], 'Email' => '', 'RegisterdDate' => date('Y-m-d'), 'UpdatedDate' => date('Y-m-d'),'is_grid'=>$this->input->post('is_grid'));

            $Address_details = array('BuildingDetails' => $this->input->post('BuildingDetails'), 'StreetDetails' => $this->input->post('StreetDetails'), 'Locality' => $this->input->post('Locality'), 'State' => $this->input->post('State'), 'City' => $this->input->post('City'), 'PinCode' => $this->input->post('PinCode'), 'Landmark' => $this->input->post('Landmark'), 'Latitude' => '', 'Longitude' =>'' );

            $OTP_Verification = array('OtpVerification' => 1, 'StatusId' => 1);

            if ($this->Base_Model->update('tbl_customer', array('UserId' => $this->data['userinfo']['UserTypeId']), $customer_details)) {

                $customer_default_address_id = $this->Base_Model->select('tbl_customer', 'AddressId', array('UserId' => $this->data['userinfo']['UserTypeId']));

                if ($this->Base_Model->update('tbl_address', array('AddressId' => $customer_default_address_id['AddressId']), $Address_details)) {

                    $this->Base_Model->update('tbl_user_type', array('UserId' => $this->data['userinfo']['UserTypeId']), $OTP_Verification);

                    $this->flag = 1;

                    $success = array('status' => 'success');



                } else {

                    $fail = array('status' => 'fail');

                }

            } else {

                $fail = array('status' => 'fail');

            }
            if ($this->flag) {

                json_output(200, $success);
            } else {
                json_output(400, $fail);
            }

        } else {
            json_output(400, $this->form_validation->error_array());
        }

    }






    public function logout()
    {

  
            if($this->Base_Model->update('tbl_user_type', array('UserId' => $this->data['userinfo']['UserTypeId'] ),array('FCM_Token'=>'')))
            {
                json_output(200,'success');
            }
            else
            {
                json_output(400,'fail');
            }
  
    }

}
