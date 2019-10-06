<?php

class System_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function is_loyality()
    {
        if ($this->Base_Model->select('tbl_settings', $data = '*', $where = array('id' => 1, 'is_points_system' => 1))) {
            return true;
        } else {
            return false;
        }

    }

    public function ReadCountryAdminDetails($CountryId)
    {

        $this->db->select('*');

        $this->db->join('tbl_user_type', 'tbl_user_type.UserId=tbl_settings_country_admin.UserTypeId', 'join');

        $this->db->where(array('tbl_settings_country_admin.CountryId' => $CountryId));

        $query = $this->db->get('tbl_settings_country_admin');

        return $query->row_array();

    }


    public function APIReadCountryAdminDetails($CountryId)
    {

        $this->db->select('PointRate,CurrencyRate,PurchasePoint');

        $this->db->join('tbl_user_type', 'tbl_user_type.UserId=tbl_settings_country_admin.UserTypeId', 'join');

        $this->db->where(array('tbl_settings_country_admin.CountryId' => $CountryId));

        $query = $this->db->get('tbl_settings_country_admin');

        return $query->row_array();

    }

    public function ReadUserTypeDetails($mobile, $countryId, $UserType)
    {

        $this->db->select('*');

        $this->db->join('tbl_country', 'tbl_country.Id=tbl_user_type.CountryId', 'join');

        $this->db->join('tbl_currencymaster', 'tbl_currencymaster.CountryId=tbl_country.Id', 'join');

        $this->db->where(array('tbl_user_type.MobileNo' => $mobile, 'tbl_user_type.CountryId' => $countryId, 'tbl_user_type.UserTypeId' => $UserType));

        if ($query = $this->db->get('tbl_user_type')) {

            return $query->row_array();
        } else {
            return false;
        }
    }


    public function ReadUserTypeIdDetails($UserTypeId)
    {

        $this->db->select('*');

        $this->db->where(array('tbl_user_type.UserId' => $UserTypeId));

        if ($query = $this->db->get('tbl_user_type')) {

            return $query->row_array();
        } else {
            return false;
        }


    }




}
