<?php

class State_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function read_state()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['state_details'] = $this->Location_Model->state();

        return $data;
    }
    public function read_modal_state()
    {

        $data['status'] = $this->Status_Model->item_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['state_details'] = $this->Location_Model->state();

        return $data;

    }

}
