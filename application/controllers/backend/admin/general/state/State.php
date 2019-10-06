<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * State
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class State extends Admin_Controller
{


/**
 * title nav bar
 */

    protected $title_nav_bar = array();


/**
 * @var array
 * store title nav bar
 */

 /**
  * Title name
  */

 protected $title;

 /**
  * @var string
  * store title name
  */

  /**
   *  state details
   */
  protected $state_details = array();
  
  /**
  * @var string
  * store state details
  */



    public function __construct()
    {
        parent::__construct();
     //Load Dependencies

     /** load state model */
     $this->load->model("online/backend/admin/general/State_Model", 'State_Model');

     $this->data += $this->State_Model->read_state(); 

     $this->title_nav_bar=  array('Home' => 'backend/admin/dashboard', 'General' => 'backend/admin/general/state/State', 'State' => 'backend/admin/general/state/State');

     $this->title = 'State List';
     
    }


    /**
 *@func showing State list
 *@param no param
 *author mubashir
 */

//its default function and using for state list

    public function index()
    {

        /**
         * set privilege
         */
        if (!in_array('StateView', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }


        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title;

        $this->_Datatable_config();

        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'State');
        //load template

        $this->template('general/state/state', $this->data);

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
                'json_url'=>'backend/admin/general/state/state/datatable',
                'column_name'=>array('Id','Country','state','Code','Status','Actions','view')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'StateView',
                'link_value'=>'backend/admin/general/state/Modal/insert'
 
            ),
            'title'=>'State List'
 
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
        ->select('tbl_state.Id,tbl_country.CountryName ,tbl_state.StateName,tbl_state.StateCode,tbl_status.StatusValue,0 as action,0 as view')
        ->join('tbl_country', 'tbl_country.Id=tbl_state.CountryId')
        ->join('tbl_status', 'tbl_status.Id=tbl_state.StatusId')
        ->where(array('tbl_state.StatusId !=' => 3))
           ->from('tbl_state');
        
  
            $config['action_config']=array(array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'StateView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/state/modal/update/',
                'icon'=>icon_edit,
                'action_name'=>'Edit',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'StateView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/state/modal/delete/',
                'icon'=>icon_delete,
                'action_name'=>'Delete',
                'id'=>'$1'
            )
        );
       
        
        $this->datatables->edit_action('action',  $config, 'Id');

        $this->datatables->edit_view('view', "backend/admin/general/state/modal/view/$1", 'Id');

                
        
        echo $this->datatables->generate();

    }








    
    /**
 *@func insert state
 *@param no param
 *author mubashir
 */

    public function insert()
    {
        if (!in_array('StateAdd', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        //checking for submit button

        if (isset($_POST['submit'])) {

//validate form data

            $this->form_validation->set_rules('country_name', 'Country ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('state_number', 'state', 'required|callback_is_unique[tbl_state.StateName]|regex_match[/^[0-9 a-zA-Z]+$/]');

            $this->form_validation->set_rules('state_code', 'State Code', 'required|regex_match[/^[0-9 a-zA-Z +]+$/]');

//set error code how to display error in display

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger display-show">
					<button class="close" data-close="alert"></button><h3>Error Occure</h3><br>', '</div>');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//make unique key

//store data in variable using $state_details

//statusid is 1 that is active ,

                $this->state_details = array('StatusId' => 1, 'StateName' => $this->input->post('state_number'), 'StateCode' => $this->input->post('state_code'), 'CountryId' => $this->input->post('country_name'), 'InsertedBy' => $this->data['user_id'], 'InsertedDate' => date('Y-m-d'));

//then calling insert function

                if ($this->Base_Model->insert('tbl_state', $this->state_details)) {

/*                        $key ='FLstate'.$id;

$this->Base_Model->update('tbl_state',array('Id'=>$id),array('stateCode'=>$key));

 */

//set flash message
                    $this->session->set_flashdata('success', 'Successfully created state ');

                    $this->output->set_status_header('200');

                    echo json_encode('200');

//redirect to state page
                    redirect('backend/admin/general/state', 'refresh');

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
 *@func update state
 *@param no param
 *author mubashir
 */

    public function update()
    {
        if (!in_array('StateEdit', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
//checking for update button

        if (isset($_POST['update'])) {

//validate form data
            $this->form_validation->set_rules('edit_country_name', 'country', 'required|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('state_number', 'state', 'required|regex_match[/^[0-9 A-Z a-z]+$/]');

            $this->form_validation->set_rules('state_code', 'state Code', 'required|regex_match[/^[0-9 + A-Z a-z]+$/]');

            $this->form_validation->set_rules('state_status', 'state Status', 'required|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('id', 'id', 'required');

//set error code how to display error in display

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger display-show">
			<button class="close" data-close="alert"></button><h3>Error Occure</h3><br>', '</div>');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $state_details

$this->state_details = array('StatusId' => $this->input->post('state_status'), 'stateName' => $this->input->post('state_number'), 'CountryId' => $this->input->post('edit_country_name'), 'stateCode' => $this->input->post('state_code'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'));

//then calling update function

                if ($this->Base_Model->update('tbl_state', array('Id' => $this->input->post('id')), $this->state_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update state ');
                    $this->output->set_status_header('200');

                    echo json_encode('200');

                    //redirect to state page

                    redirect('backend/admin/general/state/State/', 'refresh');

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
     *@func state details in particular data 
     *@param id its unique id
     *author mubashir
     */

    public function details($id)
    {
        if (!in_array('StateView', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        //read state details from database
        $this->state_details = $this->Base_Model->select('tbl_state', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['state_details']);

        echo json_encode($this->state_details, true);

    }




/**
     *@func state delete in particular data 
     *@param no param
     *author mubashir
     */

    public function delete()
    {
        if (!in_array('StateDelete', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
//checking for update button

        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_state_id', 'Delete state', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //SET Delete status mode
                $this->state_details = array('StatusId' => 3);

                if ($this->Base_Model->update('tbl_state', array('Id' => $this->input->post('delete_state_id')), $this->state_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Delete state ');

                    //redirect to state page

                    redirect('backend/admin/general/state/state/', 'refresh');

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

    //ajax function that using to ajax calling from any other view

    public function ajax()
    {

        //store in $CountryId variable using post method

        $CountryId = $this->input->post('country_id');

        //read value from tbl_state tabl

        $this->data['ajax'] = $this->Base_Model->select('tbl_state', '*', array('CountryId' => $CountryId, 'StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //load view page

        $this->load->view('backend/admin/general/state/state_ajax', $this->data);
    }

}
