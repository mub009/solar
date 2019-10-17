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

    const tbl_mahal = 'tbl_mahal';


    protected $transitionFlag=0;
    

/**
 * api variable
 * 
 */

 public $CountryId,$UserId,$StatusId,$OtpVerification,$UserTypeId,$UserMasterId,$Created_Time;

 


    public function __construct()
    {
        parent::__construct();

    

        

        $this->data['pagenation_length']=28;


        $this->load->library('Formvalidation');

        $this->data['config_update'] = $this->Base_Model->select(self::tbl_settings, '*', array('UserId' => 1));
    
   

    }


    public function trans_begin()
    {
        
        $this->transitionFlag=1;

        $this->db->trans_begin();
    }

    public function trans_complete()
    {
        if($this->transitionFlag)
        {
            $this->db->trans_commit();
        }
        else
        {
           $this->db->trans_rollback();
        }
    }




    public function generate_password($length = 20){
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                  '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
      
        $str = '';
        $max = strlen($chars) - 1;
      
        for ($i=0; $i < $length; $i++)
          $str .= $chars[random_int(0, $max)];
      
        return $str;
      }

    public function CurrentTimeAndDate($TimeZone='Asia/Kolkata')
    { 

   
       date_default_timezone_set(($TimeZone)?$TimeZone:'Asia/Kolkata'); 
       
       
       $this->data['dateAndtime'] = date('Y-m-d H:i:s');


       $ExplodeTimeAndDate=explode(' ',date('Y-m-d H:i:s'));

       $this->data['DateAndtimestamp'] = strtotime($this->data['dateAndtime']);
     
       $this->data['currentTime']=$ExplodeTimeAndDate[0];
       $this->data['currentDate']=$ExplodeTimeAndDate[1];


   }



    public function notification($usertypeid, $type, $message, $icon = '<i class="fa fa-plus"></i>', $link = 0)
    {

        $message = array(
            'link' => $link,
            'message' => $message,
            'UserTypeId' => $usertypeid,
            'create_by' => $this->data['userinfo']['UserId'],
            'create_date'=>$this->data['dateAndtime'],
            'type' => $type,
            'icon' => $icon,

        );

        if ($this->Base_Model->insert('tbl_notification', $message)) {
            return true;
        } else {
            return false;

        }

    }


    public function r_notification()
    {

        if ($return = $this->Base_Model->select('tbl_notification', $data = '*', $where = array('UserTypeId' => $this->data['userinfo']['UserId']), $order_desc = 'create_date', $order_asc = null, $limit = null, $start = null, $return = 'result_array')) {

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


    public function TimeZone($value)
    {


        if (date_default_timezone_set($value)) {
            return true;

        } else {
            $this->form_validation->set_message('Invalid Time Zone', $value . ' ');
            return false;

        }

    }


    
    public function ZeroValue($value)
    {


        if ($value!=0) {
            return true;

        } else {
            $this->form_validation->set_message('Invalid value', $value . ' ');
            return false;

        }

    }



 //   date_default_timezone_set(($TimeZone)?$TimeZone:'Asia/Kolkata'); 
       

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

        if ($this->Base_Model->query("SELECT * FROM tbl_user WHERE MobileNo='" . $value . "' and CountryId='" . $CountryId . "'")) {
         
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
            $this->form_validation->set_message('is_mobile_number_checking_no_status', $value . ' Invalid Digit, Should be'.$countrydetails['TotalMobileNumberDigits'].' Digit');

            return false;
            }
         
        }

    }


    public function is_unique_no_status($value, $field_name)
    {

        $explodedata = explode('.', $field_name);

        if ($this->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "'")) {

            $this->form_validation->set_message('is_unique', $value . ' Already Exist');
            return false;

        } else {

            return true;
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
   
      	/**
	 * Validate the password
	 *
	 * @param string $password
	 *
	 * @return bool
	 */
	public function valid_password($password = '')
	{
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');
			return FALSE;
		}
		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
			return FALSE;
		}
		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
			return FALSE;
		}
		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
			return FALSE;
		}
		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
			return FALSE;
		}
		return TRUE;
	}

}

require APPPATH . "core/web/backend/Admin_Controller.php";

require APPPATH . "core/web/backend/Madhrasa_Controller.php";

require APPPATH . "core/web/backend/Mahal_Controller.php";





require APPPATH . "core/API_Controller.php";




