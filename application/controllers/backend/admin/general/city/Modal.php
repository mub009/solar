<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/general/City_Model", 'City_Model');

        $this->data += $this->City_Model->read_modal_city();
      
    }

    public function insert()
    {
        if (!in_array('CityAdd', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->load->view('backend/admin/general/city/Modal/Insert', $this->data);

    }

    public function update($id)
    {
        $this->data['id'] = $id;

        $citydetails = $this->Base_Model->select('tbl_city', '*', $where = array('Id' => $id, 'StatusId !=' => 3));

        $this->data['state_details'] = $this->Base_Model->select('tbl_state', '*', $where = array('CountryId' => $citydetails['CountryId'], 'StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        $this->load->view('backend/admin/general/city/Modal/Update', $this->data);
   
   
    }

    public function delete($id)
    {
        if (!in_array('CityDelete', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/city/Modal/Delete', $this->data);

    }
    public function view($id)
    {
        

     $this->data['view'] =  $this->Base_Model->select('tbl_city', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'row_array');

     $this->load->view('backend/admin/general/city/Modal/view', $this->data);

    }


}
