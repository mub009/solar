<?php

class Defaultcategory_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function Category()
    {
        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3));

        $query = $this->db->get('tbl_default_category');

        return $query->result_array();

    }
    public function read_Defaultcategory()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['Category_details'] = $this->Category();


        return $data;
    }
    public function read_modal_category()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['category_details'] = $this->Category();

        return $data;
    }
}
