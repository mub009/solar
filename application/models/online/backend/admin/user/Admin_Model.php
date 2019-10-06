<?php

class Admin_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function admin()
    {
        $this->db->select('tbl_user_type.UserId,tbl_user_type.MobileNo,tbl_user_type.StatusId,tbl_country.CountryName,tbl_user_type.OtpVerification,tbl_user_type.InsertDate');

        $this->db->join('tbl_country', 'tbl_country.Id=tbl_user_type.CountryId', 'join');

        $this->db->where(array('tbl_user_type.UserTypeId' => 88, 'tbl_user_type.StatusId !=' => 3));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();
    }

    public function read_admin()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['Admin_details'] = $this->admin();

        return $data;
    }
    public function read_modal_admin()
    {

        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['Admin_details'] = $this->admin();

        return $data;

    }

    public function admininfo($usertypeid)
    {
    
        $this->db->select('tbl_user_type.StatusId,tbl_admin.FirstName,tbl_admin.LastName,
        tbl_admin.MobileNumber,tbl_admin.Interests,tbl_admin.Occupation,tbl_admin.About,tbl_admin.WebsiteUrl,tbl_admin.ProfilePic');

        $this->db->join('tbl_country', 'tbl_country.Id=tbl_user_type.CountryId', 'join');

        $this->db->join('tbl_admin', 'tbl_admin.UserId=tbl_user_type.UserId', 'left');

        $this->db->where(array('tbl_user_type.UserTypeId' => 88, 'tbl_user_type.StatusId !=' => 3,'tbl_user_type.UserId'=>$usertypeid));

        $query = $this->db->get('tbl_user_type');

        return $query->row_array();
    }
   

}
