<?php

class Businesstype_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function read_business()
    
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['Business_details'] = $this->Location_Model->business();

        return $data;

    }

    public function read_modal_business()
    {

        $data['status'] = $this->Status_Model->item_creation_status();

     

        return $data;

    }

}
