<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/general/Area_Model", 'Area_Model');

        $this->data += $this->Area_Model->read_modal_area();

    }

    public function insert()
    {
        if (!in_array('AreaAdd', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->load->view('backend/admin/general/area/Modal/Insert', $this->data);

    }

    public function update($id)
    {
        if (!in_array('AreaEdit', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/area/Modal/Update', $this->data);
    }

    public function delete($id)
    {
        if (!in_array('AreaDelete', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/area/Modal/Delete', $this->data);

    }
    public function view($id)
    {
        

  $this->data['view'] =  $this->Base_Model->select('tbl_area', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'row_array');

   
// print_r( $this->data['view']);

  $this->load->view('backend/admin/general/area/Modal/view', $this->data);

    }

}
