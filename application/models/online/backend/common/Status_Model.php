<?php

class Status_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function account_creation_status()
    {
        $this->db->select('*');
        $this->db->where(array('is_AccountCreationStatus=' => 1));
        $query = $this->db->get('tbl_status');
        return $query->result_array();

    }
    public function item_creation_status()
    {
        $this->db->select('*');
        $this->db->where(array('is_ItemCreationStatus=' => 1));
        $query = $this->db->get('tbl_status');
        return $query->result_array();

    }
}
