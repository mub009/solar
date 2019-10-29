<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Customer
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class Customer extends Admin_Controller
{

    /** title nav bar */
    protected $title_nav_bar =array();

    /**
     * @var array
     * store title nav bar
     */

     /** title name */
     protected $title;

     /**
      * @var string
      * store title name
      */



    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

        $this->load->model("online/backend/admin/user/customer_Model", 'customer_Model');

        $this->data += $this->customer_Model->read_customer();

        $this->title_nav_bar = array('Home' => 'backend/admin/dashboard', 'User' => 'backend/admin/user/customer', 'Customer' => 'backend/admin/user/customer');

        $this->title  = 'Customer List';


    }


    
/**
 *@func showing customer list
 *@param no param
 *author mubashir
 */

    public function index()
    {

        /** set privilege */
        $this->_AdminPrivilegeChecking('VendorView');

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title;
        
        $this->_Datatable_config();
        
        $this->data['legancy']=$this->Legancy->design(array('pending','active','approved','block','notactive','view'),'Customer');

        /** load template */

        $this->template('user/customer', $this->data);

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
                'json_url'=>'backend/admin/user/customer/datatable',
                'column_name'=>array('User Id','CustomerName','Status','View')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'VendorView'

           ),
            'title'=>'CUSTOMER LIST'
 
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
      
        ->select('tbl_user_type.UserId as Id,tbl_user_type.MobileNo,tbl_status.StatusValue,0 as view,tbl_user_type.UserId')

        ->join('tbl_country', 'tbl_country.Id=tbl_user_type.CountryId')
        
        ->join('tbl_status', 'tbl_status.Id=tbl_user_type.StatusId')

        ->join('tbl_customer', 'tbl_customer.UserId=tbl_user_type.UserId')

        ->join('tbl_status as tbl_otpStatus', 'tbl_otpStatus.Id=tbl_user_type.OtpVerification')

        ->where(array('tbl_user_type.UserTypeId' => 33, 'tbl_user_type.StatusId !=' => 3))

        ->from('tbl_user_type');
        
        $this->datatables->edit_view('view', "backend/admin/user/Customer/customerview/$1",'Id');

                
        
        echo $this->datatables->generate();

    }







 /**
 *@func details customer in particular data 
 *@param id its unique id 
 *author mubashir
 */


    public function details($id)
    {

        //read omer details from database
        $this->data['customer_details'] = $this->Base_Model->select('tbl_customer', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['customer_details']);

        echo json_encode($this->data['customer_details'], true);

    }


/**
 *@func delete customer in particular data 
 *@param no param
 *author mubashir
 */

    public function delete()
    {

//checking for update button

        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_customer_id', 'Delete customer', 'required');

            //SET Delete status mode
            $customer_details = array('StatusId' => 3);

            if ($this->Base_Model->update('tbl_customer', array('Id' => $this->input->post('delete_customer_id')), $customer_details)) {

                //set flash message

                $this->session->set_flashdata('success', 'Successfully Delete customer Account');

                //redirect to customer page

                redirect('admin/user/customer', 'refresh');

            } else {
                //its database prb show in here or query prb

                echo 'Database Problem Occure';

                die();

            }

        }

        //read customer details from tbl_customer and check condition

        $this->data['customer_details'] = $this->Base_Model->select('tbl_customer', '*', $where = array('UserTypeId' => 22, 'StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //read status from tbl_status

        $this->data['title'] = 'Customer Managed';

        $this->data['status'] = $this->Base_Model->select('tbl_status', '*', '', $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        $this->template('settings/customer', $this->data);

    }
    public function customerview($id)
    {
        
        $this->data['customerview'] = $this->Base_Model->select('tbl_customer', '*', $where = array('UserId' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'row_array');
    

        $this->data['intall'] = $this->Base_Model->select('tbl_installdetails', '*', $where = array('CustomerUserTypeId' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

   
        $this->load->view('backend/admin/user/admin/Modal/customerview', $this->data);

    }

}
