<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Country Admin
 *
 * @author: mubashir
 *
 * @version: 1.0.0
 *
 **@extends:Admin_Controller
 *
 */

class Admin extends Admin_Controller
{

    /**
     *  Dashboard Title name
     */

    protected $title_name;

    /**
     * Dashboard Nav Bar Link
     */

    protected $title_nav_bar;

    /**
     * OTP Verification Status
     */

    protected $Otp_Verification_Status;

    /**
     * Country Admin UserMasterId
     */

    protected $Country_Admin_UserMasterId;

    /**
     * Active Status Id
     */

    protected $Active_Status_Id;

    /**
     * Table Name
     */
    protected $Table_Name;

    /**
     * prefix name
     */
    protected $prefix_name;

    /**
     * privilege
     */

     protected $privilege;

    public function __construct()
    {
        parent::__construct();

        /**
         * Assign title value
         */

        $this->title_name = 'Country Admin List';

        /**
         * Assign title nav bar value
         */

        $this->title_nav_bar = array('Home' => 'backend/admin/dashboard', 'User' => 'backend/admin/user/admin/admin', 'Admin' => 'backend/admin/user/admin/admin');

        /**
         * assign OTP verification status value
         */

        $this->OtpVerificationStatusId = 1;

        /**
         * assign Country Admin UserMasterId value
         */
        $this->Country_Admin_UserMasterId = 88;

        /**
         * assign Active StatusId value
         */
        $this->Active_Status_Id = 1;

        /**
         * assign Table name
         */
        $this->Table_Name = 'tbl_user_type';

        /**
         * assign prefix value
         */
        $this->prefix_name = 'FLUserType';

        /**
         * privilege array
         */
       
         $this->privilege;


    }

    /**
     *  View Country Admin List
     *
     * @param: No param
     *
     *  */

    public function index()
    {

        /**
         *  Check Country Admin privilege in Admin Country View Part
         *
         * */

        $this->_AdminPrivilegeChecking('AdminView');

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title_name;

        /** Load Admin Model  */

        $this->load->model("online/backend/admin/user/Admin_Model", 'Admin_Model');

        $this->data += $this->Admin_Model->read_admin();
        
        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','pending','approved','notactive','view'),'Country Admin');


        $this->_Datatable_config();

        /**
         * Load template Country Admin
         */

        $this->template('user/admin/admin', $this->data);

    }

    /**
     *  datatable config
     *
     * @param: No param
     *
     *  */
    public function _Datatable_config()
    {

        if ($this->data['AdminPrivilege']) {
           
            $this->privilege=array('admin');
        }
        else
        {
            
            $this->privilege=$this->data['CountryPrivilege'];
        }

       
        $config=array(
            'datatable'=>array(
                'json_url'=>'backend/admin/user/admin/admin/datatable',
                'column_name'=>array('User Id','Admin Number','Country','Status','OTP','Created','Actions','view')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'AdminView',
                'link_value'=>'backend/admin/user/admin/Modal/insert'
 
            ),
            'title'=>'COUNTRY ADMIN LIST'
 
         );
         
         $this->data['datatable']=$this->Datatabledesign->design($config);
        
        
    }

   


   /**
     *  append datatable 
     *
     * @param: No param
     *
     *  */
    public function datatable()
    {
        $this->datatables
      
        ->select('tbl_user_type.UserId as Id,tbl_user_type.MobileNo,tbl_country.CountryName,tbl_status.StatusValue,tbl_otpStatus.StatusValue as Otpverification,tbl_user_type.InsertDate,0 as action,0 as view,tbl_user_type.UserId')

        ->join('tbl_country', 'tbl_country.Id=tbl_user_type.CountryId')
        
        ->join('tbl_status', 'tbl_status.Id=tbl_user_type.StatusId')

        ->join('tbl_status as tbl_otpStatus', 'tbl_otpStatus.Id=tbl_user_type.OtpVerification')

        ->where(array('tbl_user_type.UserTypeId' => 88, 'tbl_user_type.StatusId !=' => 3))

        ->from('tbl_user_type');
        
  
            $config['action_config']=array(array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'DealerEdit',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/user/admin/modal/update/',
                'icon'=>icon_edit,
                'action_name'=>'Edit',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'DealerDelete',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/user/admin/modal/delete/',
                'icon'=>icon_delete,
                'action_name'=>'Delete',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'AdminView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/user/dealer/templatelist/templatelist/index/',
                'link_mode'=>true,
                'icon'=>icon_edit,
                'action_name'=>'Template Edit',
                'id'=>'$2'
            )
        );
       
        
        $this->datatables->edit_action('action',  $config, 'Id,UserId');

        $this->datatables->edit_view('view', "backend/admin/user/admin/modal/view/$1", 'UserId');

                
        
        echo $this->datatables->generate();

    }


     /**
     *  Insert Country Admin User
     *
     * @param: No param
     *
     *  */

    public function insert()
    {
        /**
         *  Check Country Admin privilege in Admin Add Part
         *
         * */
           $this->_AdminPrivilegeChecking('AdminAdd');

            /**
             *  validate Post data
             *
             */

            $this->form_validation->set_rules('country_name', 'Country ', 'required|regex_match[/^[0-9 +]+$/]|callback_admin_checking[tbl_user_type.CountryId]');

            $this->form_validation->set_rules('Admin_number', 'Admin number', 'required|is_unique[tbl_user_type.MobileNo]|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            /**
             * validate form is true or false
             */

            if ($this->form_validation->run() == true) {

                $Admin_details = array('StatusId' => $this->Active_Status_Id, 'OtpVerification' => $this->OtpVerificationStatusId, 'Password' => $this->_passwordhash($this->input->post('confirm_password')), 'MobileNo' => $this->input->post('Admin_number'), 'UserTypeId' => $this->Country_Admin_UserMasterId, 'InsertBy' => $this->data['user_id'], 'CountryId' => $this->input->post('country_name'), 'InsertDate' => $this->data['dateAndtime']);

                /**
                 * insert Data in this function
                 */

                if ($UserId = $this->Base_Model->insert($this->Table_Name, $Admin_details)) {

                    $this->session->set_flashdata('success', 'Successfully created Admin Account');

                    $this->output->set_status_header('200');

                    echo json_encode('success');

                } else {

                    /**
                     *  database prb show in here or query prb
                     */
                    echo 'Database Problem Occur';

                }

            } else {
                $this->output->set_status_header('400');
                echo json_encode($this->form_validation->error_array());

            }


    }

    public function details($id = null)
    {

        $this->_AdminPrivilegeChecking('AdminView');

        if ($id) {
            //read Admin details from database

            $this->data['Admin_details'] = $this->Base_Model->select('tbl_user_type', '*', $where = array('UserId' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

            // print_r($this->data['Admin_details']);
        } else {

            //read Admin details from database

            $this->data['Admin_details'] = $this->Base_Model->select('tbl_user_type', '*', '', $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

            // print_r($this->data['Admin_details']);

        }

        echo json_encode($this->data['Admin_details'], true);

    }

    public function admin_checking($value, $field_name)
    {

        $explodedata = explode('.', $field_name);

        if ($this->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "' and UserTypeId='88' and StatusId!=3")) {

            $this->form_validation->set_message('admin_checking', ' Already registered');
            return false;

        } else {
            return true;

        }

    }

    public function check_mobileno($value, $CountryId)
    {

        $data = $this->System_Model->ReadUserTypeDetails($value, $CountryId, 88);

        if ($maximumlength = $data['TotalMobileNumberDigits']) {

            $length = strlen($value);

            if ($length == $maximumlength) {
                echo "valid";
            } else {
                echo "invalid";

            }
        }
    }

    public function update()
    {

        $this->_AdminPrivilegeChecking('AdminEdit');

//checking for update button

        if (isset($_POST['update'])) {

//validate form data

            $this->form_validation->set_rules('Admin_number', 'Number', 'required|regex_match[/^[0-9]+$/]|callback_admin_checking[tbl_user_type.CountryId]');

            $this->form_validation->set_rules('Admin_status', 'Admin Status', 'required|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('id', 'id', 'required');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $Admin_details

                $Admin_details = array('StatusId' => $this->input->post('Admin_status'), 'MobileNo' => $this->input->post('Admin_number'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => $this->data['dateAndtime']);

//then calling update function


                if ($this->Base_Model->update('tbl_user_type', array('UserId' => $this->input->post('id')), $Admin_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update Admin Account');

                    $this->output->set_status_header('200');

                    echo json_encode('200');

                    //redirect to Admin page

                    redirect('admin/user/Admin', 'refresh');

                } else {
                    //its database prb show in here or query prb

                    echo 'Database Problem Occure';

                }

            } else {

                $this->output->set_status_header('400');

                echo json_encode($this->form_validation->error_array());

            }

        }

    }

//delete data from tbl_user

    public function delete()
    {

        $this->_AdminPrivilegeChecking('AdminDelete');

//checking for update button

        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_Admin_id', 'Delete Admin', 'required');

            //SET Delete status mode
            $Admin_details = array('StatusId' => 3);

            if ($this->Base_Model->update('tbl_user_type', array('UserId' => $this->input->post('delete_Admin_id')), $Admin_details)) {

                //$this->notification($usertypeid = $this->input->post('delete_Admin_id'), 'AdminDelete', $message = ' Account is Deleted ', $icon = '<i class="fa fa-plus"></i>');

                //set flash message

                $this->session->set_flashdata('success', 'Successfully Delete Admin Account');

                //redirect to Admin page

                redirect('backend/admin/user/admin/admin', 'refresh');

            } else {
                //its database prb show in here or query prb

                echo 'Database Problem Occure';


            }

        }

    }

}
