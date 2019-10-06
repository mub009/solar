<?php

class Country_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function read_country()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['country_details'] = $this->Location_Model->country();

        return $data;

    }

    public function read_modal_country()
    {

        $data['status'] = $this->Status_Model->item_creation_status();

        // $this->db->select('*');
        // $this->db->where(array('StatusId !=' => 3));
        // $query = $this->db->get('tbl_country');
        // $data['country_details'] = $query->result_array();
        return $data;

    }

}
