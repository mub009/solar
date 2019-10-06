<?php

class Login_Modal extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function login($MobileNo, $country_name = 0)
    {

        if (!empty($MobileNo) && !empty($country_name)) {
            $this->db->select('tbl_user_type.Password as Password,tbl_user_type.UserId as UserId,tbl_user_type.CountryId as CountryId,tbl_user_type.MobileNo as MobileNo,tbl_user_type.InsertBy as InsertBy,tbl_user_type.OtpVerification as OtpVerification,tbl_user_type.UserTypeId as UserTypeId,tbl_user_type.StatusId as StatusId,tbl_usertypemaster.UserType as UserType,tbl_currencymaster.Currency as Currency,tbl_currencymaster.CurrencySymbol as CurrencySymbol');
            $this->db->join('tbl_usertypemaster', 'tbl_usertypemaster.UserTypeId=tbl_user_type.UserTypeId', 'join');
            $this->db->join('tbl_currencymaster', 'tbl_currencymaster.CountryId=tbl_user_type.CountryId', 'left');
            $this->db->where(array('tbl_user_type.MobileNo' => $MobileNo, 'tbl_user_type.CountryId' => $country_name));
            $query = $this->db->get('tbl_user_type');
            return $query->row_array();

        } else {
            $this->db->select('tbl_user_type.Password as Password,tbl_user_type.UserId as UserId,tbl_user_type.CountryId as CountryId,tbl_user_type.MobileNo as MobileNo,tbl_user_type.InsertBy as InsertBy,tbl_user_type.OtpVerification as OtpVerification,tbl_user_type.UserTypeId as UserTypeId,tbl_user_type.StatusId as StatusId,tbl_usertypemaster.UserType as UserType,tbl_currencymaster.Currency as Currency,tbl_currencymaster.CurrencySymbol as CurrencySymbol');
            $this->db->join('tbl_usertypemaster', 'tbl_usertypemaster.UserTypeId=tbl_user_type.UserTypeId', 'join');
            $this->db->join('tbl_currencymaster', 'tbl_currencymaster.CountryId=tbl_user_type.CountryId', 'left');
            $this->db->where(array('tbl_user_type.MobileNo' => $MobileNo, 'tbl_user_type.UserTypeId ' => 11));
            $query = $this->db->get('tbl_user_type');
            return $query->row_array();
        }

    }

    public function loginDetails($userId=null)
    {

        if($userId)
        {
        $this->db->select('tbl_user_type.Password as Password,tbl_user_type.UserId as user_id,tbl_user_type.CountryId as CountryId,tbl_user_type.MobileNo as phone,tbl_user_type.InsertBy as InsertBy,tbl_user_type.OtpVerification as OtpVerification,tbl_user_type.UserTypeId as usermaster,tbl_user_type.StatusId as status,tbl_usertypemaster.UserType as HeaderName,tbl_currencymaster.Currency as Currency,tbl_currencymaster.CurrencySymbol as CurrencySymbol');
        $this->db->join('tbl_usertypemaster', 'tbl_usertypemaster.UserTypeId=tbl_user_type.UserTypeId', 'join');
        $this->db->join('tbl_currencymaster', 'tbl_currencymaster.CountryId=tbl_user_type.CountryId', 'left');
        $this->db->where(array('tbl_user_type.UserId ' => $userId));
        $query = $this->db->get('tbl_user_type');
        return $query->row_array();
        }
        else
        {
         die('Unauthorized access');
        }
    }

}
