<?php

class Unitmaster_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function unitmaster()
    {

        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3));

        $query = $this->db->get('tbl_unitmaster');

        return $query->result_array();

    }
    public function read_unitmaster()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['UnitMaster_details'] = $this->unitmaster();

        return $data;
    }
    public function read_modal_unitmaster()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['UnitMaster_details'] = $this->unitmaster();

        return $data;
    }

}
