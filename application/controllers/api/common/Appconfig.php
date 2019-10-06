<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Appconfig extends API_Controller {

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

    }

    // List all your items 
    public function OSVersion($OSType)
    {

        $data=$this->Base_Model->query("select tbl_app_updation.AppVersion,tbl_app_updation.AppCode from tbl_app_updation join (SELECT max(tbl_app_updation.Id) as Id FROM `tbl_app_updation` GROUP by tbl_app_updation.TypeOs)new on new.Id=tbl_app_updation.Id where TypeOs='".$OSType."'",'row_array');    
        json_output(200,  $data);

    }


    public function IOS()
    {

        $this->OSVersion('IOS');
    }


    
    public function APK()
    {

        $this->OSVersion('APK');
    }
}

?>