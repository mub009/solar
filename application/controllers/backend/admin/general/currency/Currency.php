<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Currency
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class Currency extends Admin_Controller
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
     *  title name
     */

    protected $title;

    /**
     * @var string
     * store title name
     */

    /**
     *  Currency details
     */

    protected $Currency_details = array();

    /**
     * @var array
     * store currency details
     */

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

        /** load currency model */
        $this->load->model("online/backend/admin/general/Currency_Model", 'Currency_Model');

        $this->data += $this->Currency_Model->read_currency();

        $this->title_nav_bar = array('Home' => 'backend/admin/dashboard', 'General' => 'backend/admin/general/currency/currency', 'Currency' => 'backend/admin/general/currency/currency');

        $this->title = 'Currency List';
    }

    /**
     *@func showing Currency list
     *@param no param
     *author mubashir
     */

    public function index()
    {

        /**
         * set privilege
         */
        $this->_AdminPrivilegeChecking('CurrencyView');

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title;

        $this->_Datatable_config();

        //load template
        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'Currency');

        $this->template('general/currency/currency', $this->data);

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
                'json_url'=>'backend/admin/general/currency/currency/datatable',
                'column_name'=>array('Id','Country','Currency','Symbol','Status','Actions','view')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'CurrencyView',
                'link_value'=>'backend/admin/general/currency/Modal/insert'
 
            ),
            'title'=>'Currency List'
 
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
        ->select('tbl_currencymaster.Id,tbl_country.CountryName,tbl_currencymaster.Currency,tbl_currencymaster.CurrencySymbol,tbl_status.StatusValue,0 as action,0 as view')
        ->join('tbl_status', 'tbl_status.Id=tbl_currencymaster.StatusId')
        ->join('tbl_country', 'tbl_country.Id=tbl_currencymaster.CountryId')
        ->where(array('tbl_currencymaster.StatusId !=' => 3))
        ->from('tbl_currencymaster');
        
  
            $config['action_config']=array(array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'CurrencyView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/currency/modal/update/',
                'icon'=>icon_edit,
                'action_name'=>'Edit',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>$this->data['AdminPrivilege'],
                'value'=>'CurrencyView',
                'privilege'=> $this->data['CountryPrivilege'],
                'link'=>'backend/admin/general/currency/modal/delete/',
                'icon'=>icon_delete,
                'action_name'=>'Delete',
                'id'=>'$1'
            )
        );
       
        
        $this->datatables->edit_action('action',  $config, 'Id');

        $this->datatables->edit_view('view', "backend/admin/general/currency/modal/view/$1", 'Id');

                
        
        echo $this->datatables->generate();

    }





    /**
     *@func insert currency
     *@param no param
     *author mubashir
     */
    public function insert()
    {

           $this->_AdminPrivilegeChecking('CurrencyAdd');

    

//validate form data

            $this->form_validation->set_rules('country_id', 'Country ', 'required|callback_is_unique[tbl_currencymaster.CountryId]|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('currency_number', 'Currency', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

            $this->form_validation->set_rules('currency_code', 'currency symbol', 'required');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $Currency_details

//statusid is 1 that is active ,

                 $this->Currency_details = array('StatusId' => 1, 'Currency' => $this->input->post('currency_number'), 'CurrencySymbol' => $this->input->post('currency_code'), 'CountryId' => $this->input->post('country_id'), 'InsertBy' => $this->data['user_id'], 'InsertDate' => date('Y-m-d'));

//then calling insert function

                if ($id=$this->Base_Model->insert('tbl_currencymaster', $this->Currency_details)) {

//genarate currency code

                    $key = strtoupper(substr($this->input->post('currency_number'), 0, 3) . $id);

                    $this->Base_Model->update('tbl_currencymaster', array('Id' => $id), array('CurrencyId' => $key));

//set flash message
                    $this->session->set_flashdata('success', 'Successfully created Currency ');

                    $this->output->set_status_header('200');

                    echo json_encode('success');


                } else {
//its database prb show in here or query prb

                    echo 'Database Problem Occure';

                }

            } else {
                $this->output->set_status_header('400');

                echo json_encode($this->form_validation->error_array());
            }


    }

/**
 *@func update currency
 *@param no param
 *author mubashir
 */

    public function update()
    {

        $this->_AdminPrivilegeChecking('CurrencyEdit');

//checking for update button

        if (isset($_POST['update'])) {

//validate form data

            $this->form_validation->set_rules('edit_country_name', 'Country ', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('currency_number', 'Currency', 'required|regex_match[/^[0-9 A-Z a-z]+$/]');

            $this->form_validation->set_rules('currency_code', 'Currency Symbol', 'required');

            $this->form_validation->set_rules('currency_status', 'Currency Status', 'required|regex_match[/^[0-9]+$/]');

            $this->form_validation->set_rules('id', 'id', 'required');

//validate form is true or false

            if ($this->form_validation->run() == true) {

//store data in variable using $Currency_details

                $this->Currency_details = array('StatusId' => $this->input->post('currency_status'), 'Currency' => $this->input->post('currency_number'), 'CurrencySymbol' => $this->input->post('currency_code'), 'CountryId' => $this->input->post('edit_country_name'), 'UpdateBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'));

//then calling update function

                if ($this->Base_Model->update('tbl_currencymaster', array('Id' => $this->input->post('id')), $this->Currency_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update Currency ');

                    $this->output->set_status_header('200');

                    echo json_encode('200');
                    //redirect to Currency page

                    redirect('backend/admin/genaral/currency/currency', 'refresh');

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
 *@func details currency in particular data
 *@param id its unique id
 *author mubashir
 */
    public function details($id)
    {

        $this->_AdminPrivilegeChecking('CurrencyView');

        //read Currency details from database
        $this->Currency_details = $this->Base_Model->select('tbl_currencymaster', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['Currency_details']);

        echo json_encode($this->Currency_details, true);

    }

//delete data from tbl_user

/**
 *@func delete currency in particular data
 *@param no param
 *author mubashir
 */

    public function delete()
    {

        $this->_AdminPrivilegeChecking('CurrencyDelete');

//checking for update button

        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_currency_id', 'Delete Currency', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //SET Delete status mode
                $this->Currency_details = array('StatusId' => 3);

                if ($this->Base_Model->update('tbl_currencymaster', array('Id' => $this->input->post('delete_currency_id')), $this->Currency_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Delete Currency ');

                    //redirect to Currency page

                    redirect('backend/admin/general/currency/currency', 'refresh');

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
