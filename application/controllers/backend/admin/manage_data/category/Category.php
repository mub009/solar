<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Category
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class Category extends Admin_Controller
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
      * title name
      */
     protected $title;

     /**
      * @var string
      * store tilte name
      */

      /**
       * category details
       */
      protected $Category_details = array();

      /**
       * @var array
       * store category details
       */


    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

        /**
         * load category model
         */

        $this->load->model("online/backend/admin/manage_data/Category_Model", 'Category_Model');

        $this->data += $this->Category_Model->read_category();

        $this->title_nav_bar = array('Home' => 'backend/admin/dashboard', 'Manage Data' => 'backend/admin/manage_data/category/category', 'Category' => 'backend/admin/manage_data/category/category');

        $this->title = 'Category List';


    }


//its default function and using for Category list


/**
 *@func showing category list
 *@param no param
 *author mubashir
 */


    public function index()
    {

        /**
         * set privilege
         */

        $this->_AdminPrivilegeChecking('CategoryView');

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] =  $this->title;
        $this->_Datatable_config();
        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'Category');


        /**
         * template
         */
        $this->template('manage_data/category/category', $this->data);

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
                'json_url'=>'backend/admin/manage_data/category/category/datatable',
                'column_name'=>array('SlNo','Category','Status','Actions','view')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'UnitMasterView',
                'link_value'=>'backend/admin/manage_data/category/Modal/insert'
 
            ),
            'title'=> $this->title
 
        );
         
         $this->data['datatable']=$this->Datatabledesign->design($config);
        
        
    }

    

    /**
 *@func insert category
 *@param no param
 *author mubashir
 */

    public function insert()
    {

        $this->_AdminPrivilegeChecking('CategoryAdd');

//validate form data

        $this->form_validation->set_rules('Category_number', 'Category', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

//validate form is true or false



        if ($this->form_validation->run() == true) {


            $this->image->ImageConfig();

            if ($this->upload->do_upload('image')) {


                $imageInformation = $this->upload->data();

                $this->image->image_cropping($imageInformation);

//store data in variable using $Category_details

//statusid is 1 that is active and userid is our genarate uniquekey

                $this->Category_details = array('StatusId' => 1, 'CategoryName' => $this->input->post('Category_number'), 'InsertedBy' => $this->data['user_id'], 'InsertedDate' => date('Y-m-d'), 'LanguageId' => 'ENG1', 'ImagePath' => $imageInformation['file_name']);

//then calling insert function

                if ($this->Base_Model->insert("tbl_category", $this->Category_details, $key = 'FLCategory', $key_colum_name = 'CategoryId')) {

//set flash message
                    $this->session->set_flashdata('success', 'Successfully created Category ');

                    $this->output->set_status_header('200');

                    echo json_encode('200');

                } else {
//its database prb show in here or query prb
                    echo 'Database Problem Occure';
                }
            } else {

                $this->output->set_status_header('400');
                echo json_encode(array('image' => $this->upload->display_errors()));

            }

        } else {
            $this->output->set_status_header('400');
            echo json_encode($this->form_validation->error_array());

        }

    }

       
/**
 *@func update category 
 *@param no param
 *author mubashir
 */

    public function update()
    {

        /**
         * set privilege
         */
        $this->_AdminPrivilegeChecking('CategoryEdit');

//validate form data

        $this->form_validation->set_rules('Category_number', 'Category number', 'required|regex_match[/^[0-9 A-Z a-z]+$/]');

        $this->form_validation->set_rules('Category_status', 'Category Status', 'required|regex_match[/^[0-9]+$/]');

        $this->form_validation->set_rules('id', 'id', 'required');

//validate form is true or false

        if ($this->form_validation->run() == true) {

//store data in variable using $Category_details

$this->Category_details = array('StatusId' => $this->input->post('Category_status'), 'CategoryName' => $this->input->post('Category_number'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'));


//ss
            if (!empty($_FILES['image']['name'])) {

                $this->image->ImageConfig();

                if ($this->upload->do_upload('image')) {

                    $imageInformation = $this->upload->data();

                    $this->image->image_cropping($imageInformation);

                    $this->Category_details += array('ImagePath' => $imageInformation['file_name']);

                } else {

                    $this->Category_details = array();

                    $Subcategory_details = array();

                    $this->session->set_flashdata('error', $this->upload->display_errors());
                }

            }

            if (!empty($this->Category_details)) {

//then calling update function

                if ($this->Base_Model->update('tbl_category', array('Id' => $this->input->post('id')), $this->Category_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update Category ');
                    $this->output->set_status_header('200');

                    echo json_encode('200');
                    //redirect to Category page

                    redirect('backend/admin/manage_data/category/category', 'refresh');

                } else {
                    //its database prb show in here or query prb

                    echo 'Database Problem Occure';

                }

            } else {

                $this->output->set_status_header('400');
                echo json_encode(array('image' => $this->upload->display_errors()));

            }

        } else {
            $this->output->set_status_header('400');
            echo json_encode($this->form_validation->error_array());

        }

        //may be occure error that time execute

    }


        
/**
 *@func details category in particular data 
 *@param id its unique id 
 *author mubashir
 */

    public function details($id)
    {

        $this->_AdminPrivilegeChecking('CategoryView');

        //read Category details from database
        $this->Category_details = $this->Base_Model->select('tbl_category', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['Category_details']);

        echo json_encode($this->Category_details, true);

    }

//delete data from tbl_user




/**
 *@func delete category in particular data 
 *@param no param
 *author mubashir
 */

    public function delete()
    {


        /**
         *  set privilege
         */
        $this->_AdminPrivilegeChecking('CategoryDelete');

//checking for update button


        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_Category_id', 'Delete Category', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //SET Delete status mode
                $this->Category_details = array('StatusId' => 3);

                if ($this->Base_Model->update('tbl_category', array('Id' => $this->input->post('delete_Category_id')),$this->Category_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Delete Category ');

                    //redirect to Category page

                    redirect('backend/admin/manage_data/category/category', 'refresh');

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