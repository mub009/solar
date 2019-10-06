<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * City
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */


class City extends Admin_Controller
{

    /**
     * title nav bar
     */
    protected $title_nav_bar = array();

    /**
     * @var array
     * store title nav bar
     */

     /**title name 
      * 
      */
     protected $title;

     /**
      * @var string
      * store title name
      */

      /**city details
      * 
      */
      protected $city_details = array();

      /**
       * @var array
       * store city details
       */

//its default function and using for city list

public function __construct()
    {
        parent::__construct();
     //Load Dependencies

     /** Load City Model */
     $this->load->model("online/backend/admin/general/City_Model", 'City_Model');

     $this->data += $this->City_Model->read_city();

     $this->title_nav_bar = array('Home' => 'backend/admin/dashboard', 'General' => 'backend/admin/general/city/city', 'City' => 'backend/admin/general/city/city');
    
     $this->title = 'City List';
    }

/**
 *@func showing area list
 *@param no param
 *author mubashir
 */
    public function index()
    {
 
        /** set privilege */

        $this->_AdminPrivilegeChecking('CityView');

        $this->data['title_nav_bar'] =$this->title_nav_bar; 

        $this->data['title'] =  $this->title;

        $this->_Datatable_config();

        /** load template */
        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'State');

        $this->template('general/city/city', $this->data);

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
                'json_url'=>'backend/admin/general/city/city/datatable',
                'column_name'=>array('Id','City','Code','Status','Actions','view')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'CityView',
                'link_value'=>'backend/admin/general/city/Modal/insert'
 
            ),
            'title'=>'City List'
 
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
        ->select('tbl_city.Id,tbl_city.CityName,tbl_city.CityCode,tbl_status.StatusValue,0 as action,0 as view')
        ->join('tbl_status', 'tbl_status.Id=tbl_city.StatusId')
        ->where(array('StatusId !=' => 3))
           ->from('tbl_city');
        
  
            $config['action_config']=array(array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'CityView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/city/modal/update/',
                'icon'=>icon_edit,
                'action_name'=>'Edit',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'CityView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/city/modal/delete/',
                'icon'=>icon_delete,
                'action_name'=>'Delete',
                'id'=>'$1'
            )
        );
       
        
        $this->datatables->edit_action('action',  $config, 'Id');

        $this->datatables->edit_view('view', "backend/admin/general/city/modal/view/$1", 'Id');

                
        
        echo $this->datatables->generate();

    }










    /**
 *@func insert city 
 *@param no param
 *author mubashir
 */


    public function insert()
    {
/** set privilege */
        $this->_AdminPrivilegeChecking('CityAdd');

//checking for submit button

        if (isset($_POST['submit'])) {

//validate form data

            $this->form_validation->set_rules('country_id', 'Country ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('state_id', 'state ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('city_number', 'city', 'required|callback_is_unique[tbl_city.CityName]|regex_match[/^[0-9 a-zA-Z]+$/]');
            $this->form_validation->set_rules('city_code', 'City Code', 'required|regex_match[/^[0-9 a-zA-Z +]+$/]');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $city_details

//statusid is 1 that is active ,

                $this->city_details = array('StatusId' => 1, 'CityName' => $this->input->post('city_number'), 'CityCode' => $this->input->post('city_code'), 'CountryId' => $this->input->post('country_id'), 'StateId' => $this->input->post('state_id'), 'InsertedBy' => $this->data['user_id'], 'InsertedDate' => date('Y-m-d'));

//then calling insert function

                if ($this->Base_Model->insert('tbl_city', $this->city_details)) {

//set flash message
                    $this->session->set_flashdata('success', 'Successfully created city ');
                    $this->output->set_status_header('200');

                    echo json_encode('200');

//redirect to city page
                    redirect('backend/admin/general/city/city', 'refresh');

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
 *@func update city 
 *@param no param
 *author mubashir
 */


    public function update()
    {

/** set privilege */
        $this->_AdminPrivilegeChecking('CityEdit');

//checking for update button

        if (isset($_POST['update'])) {

//validate form data

            $this->form_validation->set_rules('edit_country_name', 'Country ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('state_id', 'state ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('city_number', 'city', 'required|regex_match[/^[0-9 A-Z a-z]+$/]');

            $this->form_validation->set_rules('city_code', 'city Code', 'required|regex_match[/^[0-9 + A-Z a-z]+$/]');

            $this->form_validation->set_rules('city_status', 'city Status', 'required|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('id', 'id', 'required');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $this->city_details

$this->city_details = array('StatusId' =>$this->input->post('city_status') , 'CityName' => $this->input->post('city_number'), 'CityCode' => $this->input->post('city_code'), 'CountryId' => $this->input->post('edit_country_name'), 'StateId' => $this->input->post('state_id'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'));

//then calling update function

                if ($this->Base_Model->update('tbl_city', array('Id' => $this->input->post('id')), $this->city_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update city');
                    $this->output->set_status_header('200');

                    echo json_encode('200');

                    //redirect to city page

                    redirect('backend/admin/general/city/city', 'refresh');

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
     *@func city details in particular data 
     *@param id its unique id
     *author mubashir
     */

    public function details($id)
    {

        /** set privilege */

        $this->_AdminPrivilegeChecking('CityView');

        //read city details from database
        $this->city_details= $this->Base_Model->select('tbl_city', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['city_details']);

        echo json_encode($this->city_details, true);

    }



/**
 *@func delete city in particular data 
 *@param no param
 *author mubashir
 */

//delete data from tbl_user

    public function delete()
    {
    
        $this->_AdminPrivilegeChecking('CityDelete');

//checking for update button

        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_city_id', 'Delete city', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //SET Delete status mode
                $this->city_details = array('StatusId' => 3);

                if ($this->Base_Model->update('tbl_city', array('Id' => $this->input->post('delete_city_id')), $this->city_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Delete city ');

                    //redirect to city page

                    redirect('backend/admin/general/city/city', 'refresh');

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

    //ajax function that using to ajax calling

    public function ajax()
    {

        //store in $StateId variable using post method

        $StateId = $this->input->post('state_id');

        //read value from tbl_city

        $this->data['ajax'] = $this->Base_Model->select('tbl_city', '*', array('StateId' => $StateId, 'StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //load view page

        $this->load->view('backend/admin/general/city/city_ajax', $this->data);
    }

}
