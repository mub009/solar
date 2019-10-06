<?php

class AdminSystemModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function loyalityconfig($CountryAdminUserTypeId)
    {

        $this->db->select('*');

        $this->db->where(array('UserTypeId' => $CountryAdminUserTypeId));

        $query = $this->db->get('tbl_settings_country_admin');

        return $query->row_array();

    }

    public function CurrentBalance($AdminUsertypeid)
    {

        $this->db->select_sum('Amount');

        $this->db->where(array('AdminUsertypeId' => $AdminUsertypeid));

        $query = $this->db->get('tbl_LoyalityCountryAdminLedger');

        return $query->row_array();

    }

    
    public function SuperAdminDetails()
    {

        $this->db->select('*');

        $this->db->where(array('UserTypeId' => 11));
    
        $query = $this->db->get('tbl_user_type');

        return $query->row_array();

    }

    

}
