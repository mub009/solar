
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apipagination extends Admin_Controller
{

    public function index()
    {

        $this->data['title_nav_bar'] = array('home' => 'backend/admin/dashboard');

        $this->data['title'] = 'Thirdpartyapi';

        //$this->template('user/test',$this->data);
        $this->data['thirdpartylist'] = $this->Base_Model->select('tbl_Settings_thirdpartyAPIkey', '*', $where = null, $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        $this->template('api/apipagination', $this->data);

    }

}