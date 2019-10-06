<?php

class Area_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function read_area()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['area_details'] = $this->Location_Model->area();

        return $data;

    }

    public function read_modal_area()
    {

        $data['country'] = $this->Location_Model->country();

        $data['status'] = $this->Status_Model->item_creation_status();

        $data['state_details'] = $this->Location_Model->state();

        $data['city_details'] = $this->Location_Model->city();

        return $data;

    }

}
