

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customerregister extends API_Controller
{

  
    ///vendor adding
    public function index()
    {

        $this->form_validation->set_rules('Name', 'Name', "required");

        $this->form_validation->set_rules('ContactNo', 'ContactNo', 'required');

        $this->form_validation->set_rules('address', 'address', 'required');

        $this->form_validation->set_rules('dateofplantination', 'dateofplantination', 'required');

        $this->form_validation->set_rules('is_grid', 'is_grid', 'required');


        //validate form is true or false

        if ($this->form_validation->run() == true) {


            $MobileNumber = $this->input->post('Mobile_Number');

            $DealerId = $this->data['userinfo']['UserTypeId'];

            $vendor_details = array('StatusId' => 2, 'MobileNo' => $MobileNumber,'CountryId'=>1 ,'UserTypeId' => 44, 'OtpVerification' => 2, 'InsertBy' => $DealerId, 'InsertDate' => date('Y-m-d'));

            if ($UserTypeId = $this->Base_Model->insert('tbl_user_type', $vendor_details)) {

                if ($address_key = $this->Base_Model->insert('tbl_address', array('UserId' => $UserTypeId, 'AddressId' => 'FLADDRESS'), $key = 'FLADDRESS', $key_colum_name = 'AddressId', $id = 'Id')) {
                   
                    if ($this->Base_Model->insert('tbl_vendor', array('VendorId' => $UserTypeId, 'AddressId' => $address_key, 'UserId' => $UserTypeId, 'DealerId' => $DealerId,'TypeOfBusinessId'=>$this->input->post('TypeOfBusinessId'),'VendorTypeId' => $this->input->post('vendorType')), $key = 'FLVENDOR', $key_colum_name = 'VendorId', $id = 'id')) {

                        $Service_details=array('vendorUserTypeId'=>$UserTypeId,'LoyaltyServiceId'=> $this->input->post('LoyaltyServiceId'),'EcommerceServiceId'=>$this->input->post('EcommerceServiceId'),'dealsServiceId'=>$this->input->post('dealsServiceId'),'Created_By'=>$this->data['userinfo']['UserTypeId'],'StatusId'=>1);

                        $this->Base_Model->insert('tbl_vendor_services', array('vendorUserTypeId' => $UserTypeId, 'Created_By' => $this->data['userinfo']['UserTypeId'], 'EcommerceServiceId' => (empty($this->input->post('EcommerceServiceId'))) ? '0' : '1', 'LoyaltyServiceId' => (empty($this->input->post('LoyaltyServiceId'))) ? '0' : '1', 'dealsServiceId' => (empty($this->input->post('dealsServiceId'))) ? '0' : '1', 'StatusId' => 1));

                        $data = array('status' => 'success');
                    } else {
                        $data = array('status' => 'fail3');
                    }
                } else {
                    $data = array('status' => 'fail2');
                }

            } else {
                $data = array('status' => 'fail1');
            }

            json_output(200, $data);

        } else {

            json_output(400, $this->form_validation->error_array());

        }

    }

}
