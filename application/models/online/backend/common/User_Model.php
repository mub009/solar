<?php

class User_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function admin()
    {
        $this->db->select('*');
        $this->db->where(array('UserTypeId' => 88, 'StatusId !=' => 3));
        $query = $this->db->get('tbl_user_type');
        return $query->result_array();
      
    }
}