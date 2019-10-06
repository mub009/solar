<?php

class Country_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function account_creation_status()
    {
        $this->db->select('*');
        $this->db->where(array('StatusMasterId=' => 1));
        $query = $this->db->get('tbl_status');
        return $query->result_array();

    }
}
