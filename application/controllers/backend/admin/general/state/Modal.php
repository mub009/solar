<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/general/State_Model", 'State_Model');

        $this->data += $this->State_Model->read_modal_state();
    }

    public function insert()
    {
        if (!in_array('StateAdd', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }

        $this->load->view('backend/admin/general/state/Modal/Insert', $this->data);

    }

    public function update($id)
    {
        if (!in_array('StateEdit', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }

        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/state/Modal/Update', $this->data);
    }

    public function delete($id)
    {
        if (!in_array('StateDelete', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/state/Modal/Delete', $this->data);

    }
    public function view($id)
    {
        

  $this->data['view'] =  $this->Base_Model->select('tbl_state', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'row_array');

   
// print_r( $this->data['view']);

  $this->load->view('backend/admin/general/state/Modal/view', $this->data);

    }

    // public function details($id)
    // {

    //     $this->data['country_details'] = $this->Base_Model->select('tbl_country', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

    //     return $this->data;

    // }

}


    // public function details($id)
    // {

    //     $this->data['state_details'] = $this->Base_Model->select('tbl_state', '*', $where = array('StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

    //     return $this->data;

    // }


