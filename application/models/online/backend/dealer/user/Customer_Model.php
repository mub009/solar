<?php

class Customer_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        $this->load->model("online/backend/admin/user/Customer_Model", 'Customer_Model');

    }
    public function customer()
    {
        $this->db->select('*');

        $this->db->join('tbl_user_type','tbl_user_type on tbl_user_type.UserId=tbl_customer.UserId', 'join');

        $this->db->where(array('tbl_user_type.StatusId !=' =>3));

        $query = $this->db->get('tbl_customer');

        return $query->result_array();

    }
   
    public function read_customer()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['customer_details'] = $this->customer();

        return $data;
    }
    public function Customer_details()
    {
        $this->db->select('*');

        $this->db->join('tbl_user_type','tbl_user_type on tbl_user_type.UserId=tbl_customer.UserId', 'join');

        $this->db->where(array('tbl_user_type.StatusId !=' =>3,'UserId=' => $id));

        $details = $this->db->get('tbl_customer');

        return $details->row_array();

    }
   
   

}