<?php

class Languagemaster_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function languagemaster()
    {

        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3, 'DefaultSettings !=' => 'default'));

        $query = $this->db->get('tbl_languagemaster');

        return $query->result_array();

    }
    public function read_languagemaster()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['LanguageMaster_details'] = $this->languagemaster();

        return $data;
    }
    public function read_modal_languagemaster()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['LanguageMaster_details'] = $this->languagemaster();

        return $data;
    }

}
