<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Country extends API_Controller
{

    public function index()
    {

        $country = $this->Base_Model->select('tbl_country', 'Id,CountryCode,CountryName,TotalMobileNumberDigits', $where = array('StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        json_output(200, $country);

    }

}
