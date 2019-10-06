<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Country
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class Country extends Admin_Controller
{

    /**
     * title nav bar
     */
    protected $title_nav_bar = array();
    /**
     * @var array
     * store title nav bar
     */

     /** title */

     protected $title;

     /**
      * @var string
      * store title name
      */
      
      /** country details */
      protected $country_details = array();

      /**
       * @var array
       * store country details
       */

    public function __construct()
    {
        parent::__construct();
     //Load Dependencies

     /** load country model */
     $this->load->model("online/backend/admin/general/Country_Model", 'Country_Model');

 

     $this->title_nav_bar = array('Home' => 'backend/admin/dashboard', 'General' => 'backend/admin/general/country/country', 'Country' => 'backend/admin/general/country/country');

     $this->title = 'Country List';
    }

//its default function and using for country list

/**
 *@func showing city list
 *@param no param
 *author mubashir
 */

    public function index()
    {

        /** set privilege */

        $this->_AdminPrivilegeChecking('CountryView');

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title;

        $this->_Datatable_config();

        //load template
  $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'country');
  $this->template('general/country/country', $this->data);
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
                'json_url'=>'backend/admin/general/country/country/datatable',
                'column_name'=>array('Id','Country','Code','Digits','Status','Actions','view')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'CountryView',
                'link_value'=>'backend/admin/general/country/Modal/insert'
 
            ),
            'title'=>'Country List'
 
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
           ->select('tbl_country.Id,CountryName,CountryCode,TotalMobileNumberDigits,tbl_status.StatusValue,0 as action,0 as view')
           ->join('tbl_status', 'tbl_status.Id=tbl_country.StatusId')
           ->where(array('StatusId !=' => 3))
           ->from('tbl_country');
        
  
            $config['action_config']=array(array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'CountryView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/country/modal/update/',
                'icon'=>icon_edit,
                'action_name'=>'Edit',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'CountryView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/country/modal/delete/',
                'icon'=>icon_delete,
                'action_name'=>'Delete',
                'id'=>'$1'
            )
        );
       
        
        $this->datatables->edit_action('action',  $config, 'Id');

        $this->datatables->edit_view('view', "backend/admin/general/country/modal/view/$1", 'Id');

                
        
        echo $this->datatables->generate();

    }









    
/**
 *@func  insert city 
 *@param no param
 *author mubashir
 */


    public function insert()
    {
   $this->_AdminPrivilegeChecking('CountryAdd');

        //checking for submit button

        if (isset($_POST['submit'])) {

            //validate form data

            $this->form_validation->set_rules('country_number', 'Country', 'required|callback_is_unique[tbl_country.CountryName]|regex_match[/^[0-9 a-zA-Z]+$/]');

            $this->form_validation->set_rules('country_code', 'Country code', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('mobile_number', 'Total Mobile Number Digits', 'required|regex_match[/^[0-9 +]+$/]');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //make unique key

                //store data in variable using $country_details

                //statusid is 1 that is active , usertypeid is 22 that is country and userid is our genarate uniquekey

                $this->country_details = array('StatusId' => 1, 'CountryName' => $this->input->post('country_number'), 'CountryCode' => $this->input->post('country_code'),'TotalMobileNumberDigits' => $this->input->post('mobile_number'), 'InsertedBy' => $this->data['user_id'], 'InsertedDate' => date('Y-m-d'));

                //then calling insert function

                if ($this->Base_Model->insert('tbl_country', $this->country_details)) {

                    /*                        $key ='FLCOUNTRY'.$id;

                    $this->Base_Model->update('tbl_country',array('Id'=>$id),array('CountryCode'=>$key));

                     */

                    //set flash message
                    $this->session->set_flashdata('success', 'Successfully created country');

                    $this->output->set_status_header('200');

                    echo json_encode('200');

                    //redirect to country page
                    redirect('admin/general/country', 'refresh');

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


    /**
 *@func  update city 
 *@param no param
 *author mubashir
 */

    public function update()
    {
        $this->_AdminPrivilegeChecking('CountryEdit');

//checking for update button

        if (isset($_POST['update'])) {

//validate form data

            $this->form_validation->set_rules('country_number', 'country', 'required|regex_match[/^[0-9 A-Z a-z]+$/]');

            $this->form_validation->set_rules('country_code', 'Country Code', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('mobile_number', 'TotalMobileNumberDigits', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('country_status', 'country Status', 'required|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('id', 'id', 'required');

//set error code how to display error in display

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger display-show">
			<button class="close" data-close="alert"></button><h3>Error Occure</h3><br>', '</div>');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $country_details

$this->country_details = array('StatusId' => $this->input->post('country_status'), 'CountryName' => $this->input->post('country_number'), 'CountryCode' => $this->input->post('country_code'),'TotalMobileNumberDigits' => $this->input->post('mobile_number'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'));

//then calling update function

                if ($this->Base_Model->update('tbl_country', array('Id' => $this->input->post('id')), $this->country_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update country');
                    $this->output->set_status_header('200');

                    echo json_encode('200');

                    //redirect to country page

                    redirect('admin/general/country', 'refresh');

                } else {
                    //its database prb show in here or query prb

                    echo 'Database Problem Occure';

                }

            } else {
                $this->output->set_status_header('400');
                echo json_encode($this->form_validation->error_array());

            }

        }

//may be occure error that time execute

    }

  /**
     *@func country details in particular data 
     *@param id its unique id
     *author mubashir
     */


    public function details($id)
    {

        /** set privilege */
        $this->_AdminPrivilegeChecking('CountryView');


        //read country details from database
        $this->country_details = $this->Base_Model->select('tbl_country', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['country_details']);

        echo json_encode($this->country_details, true);

    }

/**
 *@func delete country in particular data 
 *@param no param
 *author mubashir
 */


    public function delete()
    {

//checking for update button

        if (isset($_POST['delete'])) {

/** set privilege */
            $this->_AdminPrivilegeChecking('CountryDelete');
            //validate form data

            $this->form_validation->set_rules('delete_country_id', 'Delete country', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //SET Delete status mode
                $this->country_details = array('StatusId' => 3);

                if ($this->Base_Model->update('tbl_country', array('Id' => $this->input->post('delete_country_id')), $this->country_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Delete Country');

                    //redirect to country page

                    redirect('backend/admin/general/country/country', 'refresh');

                } else {
                    //its database prb show in here or query prb

                    echo 'Database Problem Occure';

                    die();

                }
            }

        }

//may be occure error that time execute

        $this->index();

    }

}
