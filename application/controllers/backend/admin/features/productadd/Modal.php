<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/manage_product/ProductAdd_Model",'ProductAdd_Model');

        $this->data += $this->ProductAdd_Model->read_modal_product();

    }

   
    public function view($id)
    {
        $this->data['productadd']=$this->Base_Model->select('tbl_products','*',$where=array('Id' => $id),$order_desc=null,$order_asc=null,$limit=null,$start=null,$return='row_array');
        //   print_r($this->data['productadd']);
        $this->load->view('backend/admin/manage_product/productadd/Modal/view', $this->data);
    

    }

}
