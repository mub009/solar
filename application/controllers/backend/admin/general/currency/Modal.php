<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("online/backend/admin/general/Currency_Model", 'Currency_Model');

        $this->data += $this->Currency_Model->read_modal_currency();
    }

    public function insert()
    {
        if (!in_array('CurrencyAdd', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->load->view('backend/admin/general/currency/Modal/Insert', $this->data);

    }

    public function update($id)
    {
        if (!in_array('CurrencyEdit', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/currency/Modal/Update', $this->data);
    }

    public function delete($id)
    {
        if (!in_array('CurrencyDelete', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->data['id'] = $id;

        $this->load->view('backend/admin/general/currency/Modal/Delete', $this->data);

    }

    public function details($id)
    {
        if (!in_array('CurrencyView', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        $this->data['currency_details'] = $this->Base_Model->query("SELECT `tbl_currencymaster`.`Id` as Id,`tbl_currencymaster`.`Currency` as currency,`tbl_currencymaster`.`CurrencySymbol` as CurrencySymbol,tbl_country.CountryName as countryname,`tbl_currencymaster`.`StatusId` as StatusId FROM `tbl_currencymaster` join tbl_country on tbl_country.Id=tbl_currencymaster.CountryId where tbl_country.StatusId!=3 and `tbl_currencymaster`.`StatusId`!=3");

        return $this->data;

    }
    
    public function view($id)
    {
       
        $this->data['currency_details'] = $this->Base_Model->query("SELECT `tbl_currencymaster`.`Id` as Id,`tbl_currencymaster`.`Currency` as currency,`tbl_currencymaster`.`CurrencySymbol` as CurrencySymbol,tbl_country.CountryName as countryname,`tbl_currencymaster`.`StatusId` as StatusId FROM `tbl_currencymaster` join tbl_country on tbl_country.Id=tbl_currencymaster.CountryId where tbl_country.StatusId!=3 and `tbl_currencymaster`.`StatusId`!=3 and `tbl_currencymaster`.`Id`=$id" ,'row_array');

        $this->load->view('backend/admin/general/currency/Modal/view', $this->data);

    }
    

}
