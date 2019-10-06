<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/manage_data/Subcategory_Model",'Subcategory_Model');
        
        $this->data+= $this->Subcategory_Model->read_modal_subctegory();
    }

   
    public function view($id)
    {


        $this->data['subcategory_details']=$this->Base_Model->select('tbl_subcategory','*',$where=array('Id'=>$id),$order_desc=null,$order_asc=null,$limit=null,$start=null,$return='row_array');
        $this->load->view('backend/admin/manage_data/subcategory/modal/view', $this->data);
        return $this->data;

    }

}
