<?php

class VendorSystemSettings extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function vendorInfo($VendorUserTypeId)
     {
       $this->db->select('*');
       
       $this->db->join('tbl_vendor', 'tbl_vendor.UserId=tbl_user_type.UserId', 'join');
       
        $this->db->where(array('tbl_user_type.UserId' => $VendorUserTypeId));

        if ($query = $this->db->get('tbl_user_type')) {

            return $query->row_array();
        } else {
            return false;
        }
     }

    public function loyalityconfig($vendorUsertypeid)
    {

        $this->db->select('*');

        $this->db->where(array('UserTypeId' => $vendorUsertypeid));

        $query = $this->db->get('tbl_settings_vendor_loyality');

        return $query->row_array();

    }

    public function CurrentBalance($vendorUsertypeid)
    {

        $this->db->select_sum('Amount');

        $this->db->where(array('VendorUserTypeId' => $vendorUsertypeid));

        $query = $this->db->get('tbl_LoyalityVendorLedger');

        return $query->row_array();

    }

   
    public function get_loyalty_privilege($vendorUsertypeid)
    {

        $this->db->select('*');

        $this->db->where(array('VendorUserTypeId' => $vendorUsertypeid));

        $query = $this->db->get('tbl_vendor_services');

        return $query->row_array();

    }
    


}
