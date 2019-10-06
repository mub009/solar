<?php

class Vendorlist_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();


    }
public function vendorlist()
{
    $this->db->select('tbl_user_type.UserId,tbl_user_type.*,tbl_vendor.*,tbl_generateproductlist.MasterTemplateId');

    $this->db->join('tbl_generateproductlist', 'tbl_generateproductlist.VendorUserTypeId=tbl_user_type.UserId', 'join');

    $this->db->join('tbl_vendor', 'tbl_vendor.UserId=tbl_user_type.UserId', 'join');

    $this->db->where(array(' tbl_user_type.UserTypeId =' => 44 , 'tbl_user_type.StatusId !=' => 3 ));

    $query = $this->db->get('tbl_user_type');

    return $query->result_array();

}


public function read_vendorlist()
{
    $data['status'] = $this->Status_Model->account_creation_status();

    $data['VendorList'] = $this->Producttemplate_Model->vendorlist();

    return $data;
}
}