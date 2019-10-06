<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Profile information
 *
 * @author: Ajooba.T.V
 *
 * @version: 1.0.0
 *
 * @extends:Vendor_Controller
 *
 */

class Profile extends Vendor_Controller
{

     /**
     *  Profile Title name
     * @var String
     */

    protected $title_name;

    /**
     * Profile Nav Bar Link
     * @var array
     */

    protected $title_nav_bar=array();

    /** 
     * Stored in Vendor Details
     * @var Array
     */

    protected $address_details=array();
     /** 
     * Stored in Vendor Details
     * @var Array
     */

    protected $vendor_details=array();



    /**
     * Set const value in  tbl_vendor;
     * @var string const 
     */

    const  tbl_vendor='tbl_vendor';
    /**
     * Set const value in  tbl_vendor;
     * @var string const 
     */

    const  tbl_adress='tbl_adress';

    /** 
     * Set Flag value default 0 ->false ;
     * @var int
     */
    /** 
     * Stored in Dealer address Details
     * @var Array
     */

    protected $address=array();



    protected $flag=0;

    
    /** 
     * user information;
     * @var array;
     */
    protected  $userinfo=array();


    public function __construct()
    {
        parent::__construct();

        /**
         * Assign title value
         */

        $this->title_name = 'Profile';

        /**
         * Assign title nav bar value
         */

        $this->title_nav_bar = array('home' => 'library/dashboard');

    }

    public function index()
    {

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title_name;
        // print_r($this->data);
        // $data = $this->check_is_loyality();
        //  $this->data['personal_info_updation']=$this->Base_Model->select(self:: tbl_vendor,'*',array('UserId'=>$this->data['user_id']))&&$this->Base_Model->select(self:: tbl_address,'*',array('UserId'=>$this->data['user_id']));
         $this->data['personal_info_updation']=$this->Base_Model->query("SELECT * FROM tbl_vendor join tbl_address on tbl_address.AddressId=tbl_vendor.AddressId where tbl_vendor.UserId='".$this->data['user_id']."'",'row_array');
       
       
         /** load template */

        $this->template('profile', $this->data);

    }

}