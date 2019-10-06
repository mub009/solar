<?php

class Label_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function label()
    {

        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3, 'LanguageId' => 'ENG1'));

        $query = $this->db->get('tbl_labels');

        return $query->result_array();

    }
    public function read_label()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['Label_details'] = $this->label();

        return $data;
    }
    public function read_modal_label()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['dealer_details'] = $this->label();

        return $data;
    }

}
