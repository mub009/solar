<?php

class PointSystemModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function Loyality($config)
    {
        if (!empty($config['UserTypeId'])) {

            if ($this->Base_Model->data_checking($config['UserTypeId'], 'tbl_settings_vendor_loyality.UserTypeId')) {

                if ($this->Base_Model->update('tbl_settings_vendor_loyality', array('UserTypeId' => $config['UserTypeId']), $config)) {
                    return true;
                } else {
                    return false;
                }

            } else {

                if ($this->Base_Model->insert('tbl_settings_vendor_loyality', $config)) {
                    return true;

                } else {
                    return false;
                }

            }
        } else {
            return false;
        }

    }
    //ss

    public function read_vendor_loyality_config_point($vendorUserTypeId)
    {

        return $this->Base_Model->select('tbl_settings_vendor_loyality', 'PointValue as PointRate,Currency as CurrencyRate,MinimumPurchase,VendorCommissionPercentage', $where = array('UserTypeId =' => $vendorUserTypeId));

    }
}
