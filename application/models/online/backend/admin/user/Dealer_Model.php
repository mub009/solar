<?php

class Dealer_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function dealer()
    {

        $this->db->select('*');

        $this->db->where(($this->data['userinfo']['CountryId'] != null) ? array('UserTypeId' => 22, 'StatusId !=' => 3) + array('CountryId' => $this->data['userinfo']['CountryId']) : array('UserTypeId' => 22, 'StatusId !=' => 3));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();

    }
    public function read_dealer()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['dealer_details'] = $this->dealer();

        return $data;
    }
    public function read_modal_dealer()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['dealer_details'] = $this->dealer();

        return $data;
    }

}
