<?php

class CustomerSystemModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function CurrentBalance($CustomerUsertypeid)
    {

        $this->db->select_sum('Points');

        $this->db->where(array('CustomerUserTypeId' => $CustomerUsertypeid));

        $query = $this->db->get('tbl_LoyalityCustomerLedger');

        return $query->row_array();

    }

    public function GetLastPointData($CustomerUsertypeid)
    {

        $this->db->select('*');

        $this->db->where(array('CustomerUserTypeId' => $CustomerUsertypeid));

        $this->db->order_by('Id', "desc");

        $query = $this->db->get('tbl_LoyalityCustomerLedger');

        return $query->row_array();

    }

    public function ReadUserTypeDetails($mobile, $countryId, $UserType)
    {

        $this->db->select('*');

        $this->db->join('tbl_country', 'tbl_country.Id=tbl_user_type.CountryId', 'join');

        $this->db->join('tbl_currencymaster', 'tbl_currencymaster.CountryId=tbl_country.Id', 'join');
       
        $this->db->join('tbl_customer', 'tbl_customer.UserId=tbl_user_type.UserId', 'join');

        $this->db->where(array('tbl_user_type.MobileNo' => $mobile, 'tbl_user_type.CountryId' => $countryId, 'tbl_user_type.UserTypeId' => $UserType));

        if ($query = $this->db->get('tbl_user_type')) {

            return $query->row_array();
        } else {
            return false;
        }
    }

}
