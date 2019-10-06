<?php

class City_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function read_city()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['city_details'] = $this->Location_Model->city();

        return $data;

    }

    public function read_modal_city()
    {

        $data['country'] = $this->Location_Model->country();

        $data['status'] = $this->Status_Model->item_creation_status();

        $data['state_details'] = $this->Location_Model->state();

        return $data;

    }

}
