<?php

class Country_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    } 

    public function read_country()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country_details'] = $this->Location_Model->country();

        
        return $data;

    }
}