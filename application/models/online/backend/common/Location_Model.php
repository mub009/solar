<?php

class Location_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function country()
    {

        $this->db->select('*');
        $this->db->where(array('StatusId !=' => 3));
        $query = $this->db->get('tbl_country');
        return $query->result_array();

    }

    public function state()
    {

        $this->db->select('`tbl_state`.`Id` as Id,`tbl_state`.`StateName` as StateName,`tbl_state`.`StateCode` as StateCode,tbl_country.CountryName as CountryName,`tbl_state`.`StatusId` as StatusId');
        $this->db->where(array('tbl_state.StatusId !=' => 3));
        $this->db->join('tbl_country', 'tbl_country.Id=tbl_state.CountryId', 'join');
        $query = $this->db->get('tbl_state');
        return $query->result_array();

    }

    public function city()
    {
        $this->db->select('*');
        $this->db->where(array('StatusId !=' => 3));
        $query = $this->db->get('tbl_city');
        return $query->result_array();

    }

    public function area()
    {
        $this->db->select('*');
        $this->db->where(array('StatusId !=' => 3));
        $query = $this->db->get('tbl_area');
        return $query->result_array();

    }

    public function business()
    {
        $this->db->select('*');
        $this->db->where(array('StatusId !=' => 3));
        $query = $this->db->get('tbl_business_type');
        return $query->result_array();

    }

}
