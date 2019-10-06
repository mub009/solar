<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/general/Country_Model", 'Country_Model');

        $this->data += $this->Country_Model->read_modal_country();

      //  $this->data['status'] = $this->Base_Model->select('tbl_status', '*', '', $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

    }

    public function insert()
    {
  
        $this->_AdminPrivilegeChecking('CountryAdd');

        $this->load->view('backend/admin/general/country/Modal/Insert');

    }

    public function update($id)
    {

  $this->_AdminPrivilegeChecking('CountryEdit');
  
        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/country/Modal/Update', $this->data);
    }

    public function delete($id)
    {
        $this->_AdminPrivilegeChecking('CountryDelete');
      

        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/country/Modal/Delete', $this->data);

    }
    public function view($id)
    {
        
  
  
  $this->data['view'] =  $this->Base_Model->select('tbl_country', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'row_array');

  $this->load->view('backend/admin/general/country/Modal/view', $this->data);
    }


}
