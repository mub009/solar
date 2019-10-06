<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Dashboard
 *
 * @author: mubashir
 *
 * @version: 1.0.0
 *
 **@extends:Admin_Controller
 *
 */
class Dashboard extends Admin_Controller
{
 /**
  *  Dashboard Title name
  */

 protected $title_name;

 /** Dashboard Nav Bar Link */

 protected $title_nav_bar;

 public function __construct()
 {
  parent::__construct();

  /**
   * Assign title value
   */

  $this->title_name = 'Admin Dashboard';

  /**
   * Assign title nav bar value
   */

  $this->title_nav_bar = array('home' => 'admin/dashboard');

 }

 public function index()
 {

  $this->data['title_nav_bar'] = $this->title_nav_bar;

  $this->data['title'] = $this->title_name;

//admin dashboard

  if ($this->data['AdminPrivilege']) {

   $this->data['Country_Admin_count'] = $this->Base_Model->count(array('tbl_user_type.UserTypeId' => 88, 'tbl_user_type.StatusId !=' => 3), 'tbl_user_type');

   $this->data['admin_vendor_count'] = $this->Base_Model->count(array('tbl_user_type.UserTypeId' => 44, 'tbl_user_type.StatusId !=' => 3), 'tbl_user_type');

   $this->data['admin_customer_count'] = $this->Base_Model->count(array('tbl_user_type.UserTypeId' => 33, 'tbl_user_type.StatusId !=' => 3), 'tbl_user_type');
  } else {

//country dashboard

   $this->data['country_admin_Dealer_count'] = $this->Base_Model->count(array('tbl_user_type.UserTypeId' => 22, 'tbl_user_type.StatusId !=' => 3, 'InsertBy' => $this->data['user_id']), 'tbl_user_type');

   $this->data['country_admin_vendor_count'] = $this->Base_Model->count(array('tbl_user_type.UserTypeId' => 44, 'tbl_user_type.StatusId !=' => 3, 'tbl_user_type.CountryId' => $this->data['userinfo']['CountryId']), 'tbl_user_type');

   $this->data['country_admin_customer_count'] = $this->Base_Model->count(array('tbl_user_type.UserTypeId' => 33, 'tbl_user_type.StatusId !=' => 3, 'tbl_user_type.CountryId' => $this->data['userinfo']['CountryId']), 'tbl_user_type');
  }

  $this->data['product_count'] = $this->Base_Model->count(array('Id'), 'tbl_products');

  /**
   * Load Dashboard Template
   */
  $this->template('dashboard', $this->data);

 }


 public function Country_via_Customer_list()
 {

   // $country=$this->Base_Model->query('SELECT tbl_country.CountryName, COUNT(CountryName) as count FROM tbl_user_type left join tbl_country on tbl_country.Id=tbl_user_type.CountryId where UserTypeId=44  GROUP BY tbl_country.CountryName');
   
       $country=$this->Base_Model->query('SELECT tbl_country.CountryName as country, COUNT(CountryName) as visits FROM tbl_country left join tbl_user_type on tbl_country.Id=tbl_user_type.CountryId where tbl_user_type.UserTypeId=33 GROUP BY tbl_country.CountryName order by visits desc ');
     
       $max=$this->Base_Model->query('SELECT MAX(visits)+20 as max FROM (SELECT tbl_country.CountryName as country, COUNT(CountryName) as visits  FROM tbl_country left join tbl_user_type on tbl_country.Id=tbl_user_type.CountryId where tbl_user_type.UserTypeId=33 GROUP BY tbl_country.CountryName order by visits desc) as a','row_array');
     

      echo json_encode(array('list'=>$country,'max'=>$max));

      
      
     //ssSELECT tbl_country.CountryName, COUNT(*) as count FROM tbl_user_type join tbl_country on tbl_country.Id=tbl_user_type.CountryId GROUP BY tbl_country.CountryName
 }

}
