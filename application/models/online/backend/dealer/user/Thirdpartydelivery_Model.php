<?php

class Thirdpartydelivery_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

    }
    public function thirdpartydelivery($UsertypeId)
    {


        $this->db->select('*');

        $this->db->where(array('UserTypeId' => 66, 'StatusId !=' => 3,'UpdatedBy'=>$UsertypeId));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();

    }

    public function read_thirdpartydelivery($UsertypeId)
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['ThirdPartyDelivery_details'] = $this->thirdpartydelivery($UsertypeId);

        return $data;
    }

    public function read_modal_thirdpartydelivery($UsertypeId)
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['ThirdPartyDelivery_details'] = $this->thirdpartydelivery($UsertypeId);
      
        return $data;
    }


}
   