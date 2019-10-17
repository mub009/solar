<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Language extends API_Controller
{

    public function index()
    {

        $data = $this->Base_Model->select('tbl_languagemaster', 'LanguageId, Languages', $where = array('StatusId =' => '1'), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        json_output(200, $data);

    }

}
