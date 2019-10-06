<?php

class Vendor_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

    }
    public function vendor($DealarUserTypeId)
    {
        $this->db->select('*');

        $this->db->join('tbl_vendor', 'tbl_vendor.UserId=tbl_user_type.UserId', 'left join');

        $this->db->where(array('UserTypeId' => 44, 'StatusId !=' => 3,'InsertBy'=>$DealarUserTypeId));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();

    }

    public function Company()
    {
        $this->db->select('*');

        $this->db->where(array('UserTypeId' => 99, 'StatusId !=' => 3));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();

    }


    public function IndividualVendorDetails($VendorUserTypeId)
    {
        $this->db->select('*');

        $this->db->join('tbl_vendor', 'tbl_vendor.UserId=tbl_user_type.UserId', 'join');

        $this->db->join('tbl_country', 'tbl_country.Id=tbl_user_type.CountryId', 'join');

        $this->db->join('tbl_address', 'tbl_address.AddressId=tbl_vendor.AddressId', 'join');

        $this->db->join('tbl_currencymaster', 'tbl_currencymaster.CountryId=tbl_country.Id', 'join');

    
        $this->db->join('tbl_settings_vendor_loyality', 'tbl_settings_vendor_loyality.UserTypeId=tbl_user_type.UserId', 'left');

        $this->db->join('tbl_vendor_services', 'tbl_vendor_services.vendorUserTypeId=tbl_user_type.UserId', 'join');

        // /tbl_settings_vendor_loyality

        $this->db->where(array('tbl_user_type.UserTypeId' => 44, 'tbl_user_type.UserId' => $VendorUserTypeId));

        $query = $this->db->get('tbl_user_type');

        return $query->row_array();

    }
    

    

    public function read_vendor($DealarUserTypeId)
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['vendor_details'] = $this->vendor($DealarUserTypeId);

        return $data;
    }
    public function vendor_business_type()
    {
        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3));

        $query = $this->db->get('tbl_business_type');

        return $query->result_array();

    }


    public function read_attributes()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['vendor_business_type'] = $this->vendor_business_type();

        $data['companylist'] = $this->Company();
        
        return $data;
    }
    public function read_vendor_details($VendorUserTypeId)
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['vendor_details'] = $this->IndividualVendorDetails($VendorUserTypeId);

        $data['vendor_business_type'] = $this->vendor_business_type();

        $data['companylist'] = $this->Company();

        return $data;
    }


}
