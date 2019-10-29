
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{
    const tbl_admin='tbl_admin';

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/user/Admin_Model", 'Admin_Model');

        $this->data += $this->Admin_Model->read_modal_admin();


    }


    public function insert()
    {

        $this->_AdminPrivilegeChecking('AdminAdd');

        $this->load->view('backend/admin/user/admin/Modal/Insert', $this->data);

    }

    public function update($id)
    {

        $this->_AdminPrivilegeChecking('AdminEdit');

        $this->data['id'] = $id;

        $this->load->view('backend/admin/user/admin/Modal/Update', $this->data);
    }

    public function delete($id)
    {

        $this->_AdminPrivilegeChecking('AdminDelete');

        $this->data['id'] = $id;

        $this->load->view('backend/admin/user/admin/Modal/Delete', $this->data);

    }

    public function details($id)
    {

        $this->_AdminPrivilegeChecking('AdminView');

        $this->data['state_details'] = $this->Base_Model->select('tbl_user_type', '*', $where = array('UserId' => $id, 'StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        return $this->data;

    }
    
    public function view($id)
    {

        $this->data['view'] = $this->Admin_Model->admininfo($id);
   
        $this->load->view('backend/admin/user/admin/Modal/view', $this->data);

    }
   
    public function customerview($id)
    {
        
        $this->data['customerview'] = $this->Base_Model->select('tbl_customer', '*', $where = array('UserId' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'row_array');
    
   
        print_r($this->data['customerview']);

        die();

        $this->load->view('backend/admin/user/admin/Modal/customerview', $this->data);

    }
  
   

}
