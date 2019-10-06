<?php

class Managelanguage_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
   
    public function read_managelanguage()
    {

        $data['LanguageMaster_details'] = $this->Languagemaster_Model->languagemaster();

        $data['Label_details'] = $this->Label_Model->label();

        return $data;
    }
}