<?php

class Supervisor_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function supervisor()
    {
        $this->db->select(' `tbl_user_type`.`UserId` as Id,`tbl_user_type`.`CountryId` as CountryId,`tbl_user_type`.`MobileNo` as MobileNo,`tbl_user_type`.`StatusId` as StatusId,tbl_country.CountryName as CountryName');

        $this->db->join('tbl_country', 'tbl_country.id=tbl_user_type.CountryId', 'join');

        $this->db->where(array('tbl_user_type.UserTypeId =' => 55, 'tbl_user_type.StatusId !=' => 3));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();
    }

    public function read_supervisor()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['Supervisor_details'] = $this->supervisor();

        return $data;
    }
 public function read_modal_supervisor()
 {
    $data['status'] = $this->Status_Model->account_creation_status();

    $data['country'] = $this->Location_Model->country();

    $data['Supervisor_details'] = $this->supervisor();
  
    return $data;
 }

}