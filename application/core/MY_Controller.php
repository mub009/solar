<?php

class MY_Controller extends CI_Controller
{
     /**
     * Set const value in tbl_settings;
     * @var string const
     */


    const tbl_settings = 'tbl_settings';

     /**
     * Set const value in tbl_admin;
     * @var string const
     */

    const tbl_admin = 'tbl_admin';
    
    /**
     * Set const value in  tbl_dealer;
     * @var string const 
     */

    const  tbl_dealer=' tbl_dealer';
     /**
     * Set const value in  tbl_vendor;
     * @var string const 
     */

    const  tbl_vendor='tbl_vendor';


/**
 * api variable
 * 
 */

 public $CountryId,$UserId,$StatusId,$OtpVerification,$UserTypeId,$UserMasterId,$Created_Time;

 


    public function __construct()
    {
        parent::__construct();

        if($this->data['is_loyality'] = $this->is_loyality())
        {
            
        }
    
        date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
        
        $this->data['dateAndtime'] = date('Y-m-d H:i:s');

        $this->data['pagenation_length']=5;


        $this->load->library('Formvalidation');

        $this->data['config_update'] = $this->Base_Model->select(self::tbl_settings, '*', array('UserId' => 1));
    

    }




    public function notification($usertypeid, $type, $message, $icon = '<i class="fa fa-plus"></i>', $link = 0)
    {

        $message = array(
            'link' => $link,
            'message' => $message,
            'UserTypeId' => $usertypeid,
            'create_by' => $this->data['user_id'],
            'type' => $type,
            'icon' => $icon,

        );

        if ($this->Base_Model->insert('tbl_notification', $message)) {
            return true;
        } else {
            return false;

        }

    }

    public function product_request_tracking($Details, $StatusId, $ProductRequestId, $UserTypeId)
    {

        if (!empty($Details) && !empty($ProductRequestId) && !empty($UserTypeId)) {

            $tracking = array(
                'Details' => $Details,
                'StatusId' => $StatusId,
                'ProductRequestId' => $ProductRequestId,
                'UserTypeId' => $UserTypeId,
                'UserId' => $this->data['user_id'],
            );

            if ($this->Base_Model->insert('tbl_product_request_tracking', $tracking)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;

        }
    }

    public function r_notification()
    {

        if ($return = $this->Base_Model->select('tbl_notification', $data = '*', $where = array('UserTypeId' => $this->data['user_id']), $order_desc = 'create_date', $order_asc = null, $limit = null, $start = null, $return = 'result_array')) {

            $this->data['notification'] = $return;
        }
    }

    public function data_checking($value, $field_name)
    {

       
        return $this->formvalidation->exists($value, $field_name);

    }

    public function multi_data_checking($value, $field_name)
    {

        $explodedata = explode('.', $field_name);

        if ($this->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "' and $explodedata[2]='" . $explodedata[3] . "' and StatusId!=3")) {
            return true;

        } else {
            $this->form_validation->set_message('multi_data_checking', $value . ' Not exists');

            return false;

        }

    }

    public function multi_data_checking_no_status($value, $field_name)
    {

        $explodedata = explode('.', $field_name);

        if ($this->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "' and $explodedata[2]='" . $explodedata[3] . "'")) {
            return true;

        } else {
            $this->form_validation->set_message('multi_data_checking_no_status', $value . ' Not exists');
            return false;

        }

    }


    public function is_unique_multi_no_status($value, $field_name)
    {

        $explodedata = explode('.', $field_name);

        if ($this->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "' and $explodedata[2]='" . $explodedata[3] . "'")) {
         
            $this->form_validation->set_message('is_unique_multi_no_status', $value . ' is not unique Mobile number');
    
            return false;

        } else {
            
            return true;
        }

    }


    
    public function is_mobile_number_checking_no_status($value, $CountryId)
    {

        if ($this->Base_Model->query("SELECT * FROM tbl_user_type WHERE MobileNo='" . $value . "' and CountryId='" . $CountryId . "'")) {
         
            $this->form_validation->set_message('is_mobile_number_checking_no_status', $value . ' Number Already exist');
    
            return false;

        } else {
            
            $countrydetails=$this->Base_Model->query("SELECT * FROM tbl_country WHERE Id='" . $CountryId . "'",'row_array');


            if(strlen($value) == $countrydetails['TotalMobileNumberDigits'])
            {
                return true;
            }
            else
            {
            ///ssss    
            $this->form_validation->set_message('is_mobile_number_checking_no_status', $value . ' Invalid Digit, atleast '.$countrydetails['TotalMobileNumberDigits'].' Digit');

            return false;
            }
         
        }

    }


    public function is_unique($value, $field_name)
    {

        $explodedata = explode('.', $field_name);

        if ($this->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "' and StatusId!=3")) {

            $this->form_validation->set_message('is_unique', $value . ' Already Exist');
            return false;

        } else {

            return true;
        }

    }

    public function _passwordhash($password)
    {
        if ($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        } else {
            return false;
        }
    }
    public function _otp($phonenumber)
    {
        if ($phonenumber) {

            $contacts = $phonenumber;

            $otp = rand(0000, 9999);

            file_get_contents("http://phpfile.imarahinfotech.com/metroplusapp/otp.php?contacts=$contacts&otp=$otp");

            return $otp;
        } else {
            return false;
        }
    }

    public function is_loyality()
    {

        return $this->System_Model->is_loyality();

    }

    public function json_encode($statuscode,$data)
    {

       echo json_encode(array('statusCode' => $statuscode, 'data' => $data));

       die();
    }
    
    public function json_validator($data=NULL) {
        if (!empty($data)) {
                      @json_decode($data);
                      return (json_last_error() === JSON_ERROR_NONE);
              }
              return false;
      }
   

}

require APPPATH . "core/web/backend/Admin_Controller.php";

require APPPATH . "core/web/backend/Dealer_Controller.php";

require APPPATH . "core/web/backend/Vendor_Controller.php";

require APPPATH . "core/web/backend/Company_Controller.php";

require APPPATH . "core/API_Controller.php";

require APPPATH . "core/api/frontend/Api_Customer_Controller.php";

require APPPATH . "core/api/backend/Api_Dealer_Controller.php";

require APPPATH . "core/api/backend/Api_Vendor_Controller.php";

require APPPATH . "core/api/backend/Api_Deliveryboy_Controller.php";


require APPPATH . "core/api/backend/Api_Supervisor_Controller.php";




//Api_Supervisor_Controller