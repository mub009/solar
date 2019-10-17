<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Address extends Api_Customer_Controller
{
    protected $flag = 0;

    public function index()
    {

        $UserTypeId = $this->data['userinfo']['UserTypeId'];

        $Address = $this->Base_Model->query("select if(tbl_address.AddressId is null OR tbl_address.AddressId = '','',tbl_address.AddressId) as AddressId,if(tbl_address.BuildingDetails is null OR tbl_address.BuildingDetails = '','',tbl_address.BuildingDetails) as BuildingDetails, if(tbl_address.StreetDetails is null OR tbl_address.StreetDetails = '','',tbl_address.StreetDetails) as StreetDetails,if(tbl_address.Locality is null OR tbl_address.Locality = '','',tbl_address.Locality) as Locality, if(tbl_address.State is null OR tbl_address.State = '','',tbl_address.State) as State, if(tbl_address.City is null OR tbl_address.City = '','',tbl_address.City) as City, if(tbl_address.PinCode is null OR tbl_address.PinCode = '','',tbl_address.PinCode) as PinCode, if(tbl_address.Landmark is null OR tbl_address.Landmark = '','',tbl_address.Landmark) as Landmark, if(tbl_address.latitude is null OR tbl_address.latitude = '','',tbl_address.latitude) as latitude, if(tbl_address.longitude is null OR tbl_address.longitude = '','',tbl_address.longitude) as longitude from tbl_user_type join tbl_address on tbl_address.UserId=tbl_user_type.UserId where tbl_user_type.UserId='$UserTypeId' and tbl_address.StatusId !=3");
 
        $default_address_id = $this->Base_Model->select('tbl_customer', $data = 'AddressId', $where = array('UserId' => $UserTypeId));
        
        $data = array( 'default_id' => $default_address_id['AddressId'],'Address' => $Address);

        json_output(200, $data);

    }

    public function update()
    {
        $UserTypeId = $this->data['userinfo']['UserTypeId'];

        $this->form_validation->set_rules('addressid', 'addressid', "required|callback_multi_data_checking_no_status[tbl_address.AddressId.UserId.$UserTypeId]");
        $this->form_validation->set_rules('BuildingDetails', 'BuildingDetails', 'required');
        $this->form_validation->set_rules('StreetDetails', 'StreetDetails', 'required');
        $this->form_validation->set_rules('Locality', 'Locality', 'required');
        $this->form_validation->set_rules('State', 'State', 'required');
        $this->form_validation->set_rules('City', 'City', 'required');
        $this->form_validation->set_rules('PinCode', 'PinCode', 'required');
        $this->form_validation->set_rules('Landmark', 'Landmark', 'required');
        $this->form_validation->set_rules('Latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('Longitude', 'Longitude', 'required');

        if ($this->form_validation->run() == true) {

            $address = array('BuildingDetails' => $this->input->post('BuildingDetails'), 'StreetDetails' => $this->input->post('StreetDetails'), 'Locality' => $this->input->post('Locality'), 'State' => $this->input->post('State'), 'City' => $this->input->post('City'), 'PinCode' => $this->input->post('PinCode'), 'Landmark' => $this->input->post('Landmark'), 'Latitude' => $this->input->post('Latitude'), 'Longitude' => $this->input->post('Longitude'));

            if ($this->Base_Model->update('tbl_address', array('AddressId' => $this->input->post('addressid'),'StatusId !='=>3), $address)) {

               json_output(200, array('status' => 'success'));

            } else {

               json_output(400, array('status' => 'fail'));
            }

           
        } else {
            json_output(400, $this->form_validation->error_array());
        }

    }

    public function insert()
    {
        ///ss
        $this->form_validation->set_rules('BuildingDetails', 'BuildingDetails', 'required');
        $this->form_validation->set_rules('StreetDetails', 'StreetDetails', 'required');
        $this->form_validation->set_rules('Locality', 'Locality', 'required');
        $this->form_validation->set_rules('State', 'State', 'required');
        $this->form_validation->set_rules('City', 'City', 'required');
        $this->form_validation->set_rules('PinCode', 'PinCode', 'required');
        // $this->form_validation->set_rules('Landmark', 'Landmark', 'required');
        $this->form_validation->set_rules('Latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('Longitude', 'Longitude', 'required');


        if ($this->form_validation->run() == true) {

            $address = array('UserId' => $this->data['userinfo']['UserTypeId'], 'BuildingDetails' => $this->input->post('BuildingDetails'), 'StreetDetails' => $this->input->post('StreetDetails'), 'Locality' => $this->input->post('Locality'), 'State' => $this->input->post('State'), 'City' => $this->input->post('City'), 'PinCode' => $this->input->post('PinCode'), 'Landmark' => $this->input->post('Landmark'), 'Latitude' => $this->input->post('Latitude'), 'Longitude' => $this->input->post('Longitude'),'StatusId'=>1);

            if ($this->Base_Model->insert('tbl_address',$address, $key = 'FLaddress', 'AddressId')) {

                json_output(200,  array('status' => 'success'));

            } else {

                json_output(400,  array('status' => 'fail'));

            }
        } else {
            json_output(200, $this->form_validation->error_array());
        }

          
    }

    public function default_address_change()
    {
        $UserTypeId = $this->data['userinfo']['UserTypeId'];

      $this->form_validation->set_rules('AddressId', 'addressid', "required|callback_multi_data_checking_no_status[tbl_address.AddressId.UserId.$UserTypeId]");

      if ($this->form_validation->run() == true) {


            if ($this->Base_Model->update('tbl_customer', array('UserId' =>$this->data['userinfo']['UserTypeId']), array('AddressId' => $this->input->post('AddressId')))) {

                 
                 json_output(200,array('status' => 'success'));

            } else {


                 json_output(400,array('status' => 'fail'));

            }

      }
      else
      {
         json_output(400, $this->form_validation->error_array());
      }

    }

    public function Delete()
    {
        $UserTypeId = $this->data['userinfo']['UserTypeId'];

        $this->form_validation->set_rules('addressid', 'addressid', "required|callback_multi_data_checking_no_status[tbl_address.AddressId.UserId.$UserTypeId]");

        if ($this->form_validation->run() == true) {

            $where = array('UserId' => $UserTypeId, 'AddressId' => $this->input->post('addressid'));

            if (!empty($this->Base_Model->select('tbl_address', '*', $where))) {

                if ($this->Base_Model->update('tbl_address',$where, array('StatusId'=>3))) {

                    json_output(200, array('status' => 'success', 'msg' => 'successfully delete Your File'));

                } else {

                    json_output(400, array('status' => 'fail', 'msg' => 'Your File Not Delete'));
                }

            } else {

               
                json_output(200, array('status' => 'no', 'msg' => 'No data here '));
               
            }

        } else {

         json_output(400, $this->form_validation->error_array());
        }


    }

}
