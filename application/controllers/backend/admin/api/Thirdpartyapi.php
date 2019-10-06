
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Thirdpartyapi extends Admin_Controller
{

    public function index()
    {

        $this->data['title_nav_bar'] = array('home' => 'backend/admin/dashboard');

        $this->data['title'] = 'Thirdpartyapi';

        //$this->template('user/test',$this->data);
        $this->data['thirdpartylist'] = $this->Base_Model->select('tbl_Settings_thirdpartyAPIkey', '*', $where = null, $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        $this->template('api/thirdpartyapi', $this->data);

    }

    public function update()
    {

        foreach ($this->input->post("APIKeysId[]") as $key => $row) {

            $Admin_details = array('Key' => $this->input->post("APIKeys[$key]"));

            if ($this->Base_Model->update('tbl_Settings_thirdpartyAPIkey', array('Id' => (int) $row), $Admin_details)) {

                //set flash message
                $this->session->set_flashdata('success', 'Successfully created Admin Account');

                $this->output->set_status_header('200');

                echo json_encode('success');

            } else {
                //its database prb show in here or query prb

                $this->output->set_status_header('400');
                echo 'Database Problem Occure';

            }

        }
    }

    public function insert()
    {
        $this->form_validation->set_rules('Name', 'Name', 'required|regex_match[/^[0-9 A-Z a-z]+$/]');
        $this->form_validation->set_rules('Key', 'Key', 'required|regex_match[/^[0-9 A-Z a-z]+$/]');

        //validate form is true or false

        if ($this->form_validation->run() == true) {

            $APIKeys = array('Name' => $this->input->post('Name'), 'Key' => $this->input->post('Key'), 'createdby' => $this->data['user_id']);

            if ($this->Base_Model->insert('tbl_Settings_thirdpartyAPIkey', $APIKeys)) {

                //set flash message
                $this->session->set_flashdata('success', 'Successfully created Admin Account');

                $this->output->set_status_header('200');

                echo json_encode('success');

            } else {
                $this->output->set_status_header('400');
                echo 'Database Problem Occure';
            }

        } else {
            $this->output->set_status_header('400');
            echo json_encode($this->form_validation->error_array());

        }

    }

}