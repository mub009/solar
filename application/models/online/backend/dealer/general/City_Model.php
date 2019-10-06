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
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['city_details'] = $this->Location_Model->city();

        return $data;
    }


}