<?php

class Customer_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function customer()
    {
        $this->db->select('tbl_user_type.UserTypeId as UserTypeId,tbl_user_type.UserId as UserId,tbl_address.BuildingDetails as BuildingDetails,tbl_address.StreetDetails as StreetDetails,tbl_address.Locality as Locality,tbl_address.State as State,tbl_address.City as City,tbl_address.PinCode as PinCode,tbl_address.Landmark as Landmark,tbl_user_type.UserId as UserId,tbl_customer.CustomerName as Name,tbl_customer.ProfilePic as ProfilePic,tbl_customer.Contact1 as Contact1,tbl_customer.Contact2 as Contact2,tbl_customer.AreaCode as AreaCode,tbl_customer.Gender as Gender,tbl_customer.DOB as DOB,tbl_address.latitude as latitude ,tbl_address.longitude as longitude,tbl_user_type.StatusId as StatusId,tbl_customer.Email as Email,tbl_customer.FCMToken as FCMToken,tbl_user_type.MobileNo as MobileNo,tbl_user_type.OtpVerification as OtpVerification,tbl_usertypemaster.UserType as UserTypeName');

        $this->db->join('tbl_usertypemaster', 'tbl_usertypemaster.UserTypeId=tbl_user_type.UserTypeId', 'join');

        $this->db->join('tbl_customer', 'tbl_customer.UserId=tbl_user_type.UserId', 'join');

        $this->db->join('tbl_address', 'tbl_address.AddressId=tbl_customer.AddressId', 'join');

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();

    }
    public function read_customer()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['customer_details'] = $this->customer();

        return $data;
    }

}
