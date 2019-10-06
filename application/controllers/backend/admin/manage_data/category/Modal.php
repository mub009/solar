
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/manage_data/Category_Model",'Category_Model');
        
        $this->data+= $this->Category_Model->read_modal_ctegory();
    }

   
    public function view($id)
    {
        $this->data['category_details']=$this->Base_Model->select('tbl_category','*',$where=array('Id'=>$id),$order_desc=null,$order_asc=null,$limit=null,$start=null,$return='row_array');
//  print_r($this->data['category_details']);
        $this->load->view('backend/admin/manage_data/category/modal/view', $this->data);
        return $this->data;

    }

}
