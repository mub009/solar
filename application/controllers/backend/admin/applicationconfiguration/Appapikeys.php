<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Appapikeys extends Admin_Controller
{

public function index()
    {

        $this->data['title_nav_bar'] = array('home' => 'admin/dashboard');
        

         $this->template('applicationconfiguration/appapikeys', $this->data);
    }


}
