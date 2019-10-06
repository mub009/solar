<?php

class Vendor_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function vendor()
    {
        $this->db->select('*');

        $this->db->where(array('UserTypeId' => 44, 'StatusId !=' => 3));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();

    }
   
    public function vendor_business_type()
    {
        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3));

        $query = $this->db->get('tbl_business_type');

        return $query->result_array();

    }
    public function read_vendor()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['vendor_details'] = $this->vendor();

        return $data;
    }
}
