<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Area
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class Area extends Admin_Controller
{

    /**
     * title nav bar
     */
    protected $title_nav_bar = array();

    /**
     * @var array
     * store title nav bar data
     */

    /**
     * title name
     */
    protected $title;

    /**
     * @var string
     * Store title name
     */

     /**
      * area details
      */
    protected $area_details=array();

    /**
     * @var array
     * store area details
     */

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

        /** load area model */

        $this->load->model("online/backend/admin/general/Area_Model", 'Area_Model');

        $this->data += $this->Area_Model->read_area();

        $this->data['title_nav_bar'] = array('Home' => 'backend/admin/dashboard', 'General' => 'backend/admin/general/area/area', 'Area' => 'backend/admin/general/area/area');

        $this->title = 'Area List';
    }

/**
 *@func showing area list
 *@param no param
 *author mubashir
 */

    public function index()
    {

        /**
         * set privilege
         */

        $this->_AdminPrivilegeChecking('AreaView');


        $this->data['title'] = $this->title;

        $this->_Datatable_config();


        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'Area'); 
    

        /** load template */

        $this->template('general/area/area', $this->data);

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
                'json_url'=>'backend/admin/general/area/area/datatable',
                'column_name'=>array('Id','Area','Code','Status','Actions','view')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'AreaView',
                'link_value'=>'backend/admin/general/area/Modal/insert'
 
            ),
            'title'=>'Area List'
 
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
        ->select('tbl_area.Id,tbl_area.AreaName,tbl_area.AreaCode,tbl_status.StatusValue,0 as action,0 as view')
        ->join('tbl_status', 'tbl_status.Id=tbl_area.StatusId')
        ->where(array('StatusId !=' => 3))
        ->from('tbl_area');
        
  
            $config['action_config']=array(array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'AreaEdit',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/area/modal/update/',
                'icon'=>icon_edit,
                'action_name'=>'Edit',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'AreaDelete',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/area/modal/delete/',
                'icon'=>icon_delete,
                'action_name'=>'Delete',
                'id'=>'$1'
            )
        );
       
        
        $this->datatables->edit_action('action',  $config, 'Id');

        $this->datatables->edit_view('view', "backend/admin/general/area/modal/view/$1", 'Id');

                
        
        echo $this->datatables->generate();

    }







    
/**
 *@func insert area 
 *@param no param
 *author mubashir
 */

    public function insert()
    {

        $this->_AdminPrivilegeChecking('AreaAdd');

//checking for submit button

        if (isset($_POST['submit'])) {

//validate form data

            $this->form_validation->set_rules('country_id', 'Country ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('state_id', 'state ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('city_id', 'city ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('area_number', 'area', 'required|callback_is_unique[tbl_area.AreaName]|regex_match[/^[0-9 a-zA-Z . ,]+$/]');

            $this->form_validation->set_rules('area_code', 'area code', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $area_details

//statusid is 1 that is active ,

                $this->area_details = array('StatusId' => 1, 'areaName' => $this->input->post('area_number'), 'areaCode' => $this->input->post('area_code'), 'CountryId' => $this->input->post('country_id'), 'StateId' => $this->input->post('state_id'), 'CityId' => $this->input->post('city_id'), 'InsertedBy' => $this->data['user_id'], 'InsertedDate' => date('Y-m-d'));

//then calling insert function

                if ($this->Base_Model->insert('tbl_area', $this->area_details)) {

//set flash message
                    $this->session->set_flashdata('success', 'Successfully created Area ');

                    $this->output->set_status_header('200');

                    echo json_encode('200');

//redirect to area page
                    redirect('backend/admin/general/area/area', 'refresh');

                } else {
//its database prb show in here or query prb

                    echo 'Database Problem Occurs';

                }

            } else {
                
                $this->output->set_status_header('400');
                
                echo json_encode($this->form_validation->error_array());
            }

        }

    }


    
/**
 *@func update area 
 *@param no param
 *author mubashir
 */


    public function update()
    {
        $this->_AdminPrivilegeChecking('AreaEdit');

//checking for update button

        if (isset($_POST['update'])) {

//validate form data

            $this->form_validation->set_rules('edit_country_name', 'Country ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('state_id', 'state ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('city_id', 'city ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('area_number', 'area', 'required|regex_match[/^[0-9 A-Z a-z . ,]+$/]');

            $this->form_validation->set_rules('area_code', 'area Code', 'required|regex_match[/^[0-9 + a-z A-Z]+$/]');

            $this->form_validation->set_rules('area_status', 'area Status', 'required|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('id', 'id', 'required');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $area_details

             $this->area_details = array('StatusId' => $this->input->post('area_status'), 'areaName' => $this->input->post('area_number'), 'areaCode' => $this->input->post('area_code'), 'CountryId' => $this->input->post('edit_country_name'), 'CityId' => $this->input->post('city_id'), 'StateId' => $this->input->post('state_id'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'));

//then calling to update function

                if ($this->Base_Model->update('tbl_area', array('Id' => $this->input->post('id')), $this->area_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update Area ');
                   
                    $this->output->set_status_header('200');

                    echo json_encode('200');

                    //redirect to area page

                    redirect('backend/admin/general/area/area', 'refresh');

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
 *@func details area in particular data 
 *@param id its unique id 
 *author mubashir
 */

    public function details($id)
    {
        $this->_AdminPrivilegeChecking('AreaView');

        //read area details from database
        $this->area_details = $this->Base_Model->select('tbl_area', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['area_details']);

        echo json_encode( $this->area_details, true);

    }

/**
 *@func delete area in particular data 
 *@param no param
 *author mubashir
 */

    public function delete()
    {

        $this->_AdminPrivilegeChecking('AreaDelete');

//checking for update button

        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_area_id', 'Delete area', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //SET Delete status mode
                $this->area_details = array('StatusId' => 3);

                if ($this->Base_Model->update('tbl_area', array('Id' => $this->input->post('delete_area_id')), $this->area_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Delete Area');

                    //redirect to area page

                    redirect('backend/admin/general/area/area', 'refresh');

                } else {
                    //its database prb show in here or query prb

                    echo 'Database Problem Occure';

                    die();

                }
            }

        }

    }

    //ajax function that using to ajax calling

    public function ajax()
    {

        //store in $StateId variable using post method

        $CityId = $this->input->post('city_id');

        //read value from tbl_area

        $this->data['ajax'] = $this->Base_Model->select('tbl_area', '*', array('CityId' => $CityId), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //load view page

        $this->load->view('backend/admin/general/area/area_ajax', $this->data);
    }

}
