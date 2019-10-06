<?php

class Currency_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function currency()
    {

        $this->db->select('`tbl_currencymaster`.`Id` as Id,`tbl_currencymaster`.`Currency` as currency,`tbl_currencymaster`.`CurrencySymbol` as CurrencySymbol,tbl_country.CountryName as countryname,`tbl_currencymaster`.`StatusId` as StatusId');

        $this->db->where(array('tbl_currencymaster.StatusId !=' => 3));

        $this->db->join('tbl_country', 'tbl_country on tbl_country.Id=tbl_currencymaster.CountryId', 'join');

        $query = $this->db->get('tbl_currencymaster');

        return $query->result_array();

    }

    public function read_currency()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['country'] = $this->Location_Model->country();

        $data['currency_details'] = $this->currency();

        return $data;

    }
    public function read_modal_currency()
    {

        $data['status'] = $this->Status_Model->item_creation_status();

        $data['country'] = $this->Location_Model->country();

        return $data;

    }

}
