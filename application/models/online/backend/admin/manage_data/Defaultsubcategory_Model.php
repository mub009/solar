<?php

class Defaultsubcategory_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function Defaultsubcategory()
    {
        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3));

        $query = $this->db->get('tbl_default_subcategory');

        return $query->result_array();

    }
    public function read_Defaultsubcategory()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['default_subcategory'] = $this->Defaultsubcategory();



        return $data;
    }
}

    ?>