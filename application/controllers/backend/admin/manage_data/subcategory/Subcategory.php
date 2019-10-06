<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Subcategory
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class Subcategory extends Admin_Controller
{

    /** title nav bar */

    protected $title_nav_bar = array();

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


      /** subcategory details */

      protected $Subcategory_details = array();

      /**
       * @var array
       * store subcategory details
       */


    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

        /** load subcategory model */

        $this->load->model("online/backend/admin/manage_data/Subcategory_Model", 'Subcategory_Model');

        $this->data += $this->Subcategory_Model->read_subcategory();

        $this->title_nav_bar =  array('Home' => 'backend/admin/dashboard', 'Manage Data' => 'backend/admin/manage_data/subcategory/subcategory', 'SubCategory' => 'backend/admin/manage_data/subcategory/subcategory');

        $this->title = 'Subcategory List';
    }


    
/**
 *@func showing SubCategory list
 *@param no param
 *author mubashir
 */



//its default function and using for Subcategory list

    public function index()
    {


        /** set privilege */
    
        $this->_AdminPrivilegeChecking('SubCategoryView');

        //Datatables

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title;
        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'Subcategory');


        ///read category details from tbl_subcategory

        //$this->data['category'] = $this->Base_Model->select('tbl_category', '*', $where = array('StatusId !=' => 3, 'LanguageId' => 'ENG1'), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        // //read Subcategory details from tbl_users_type and join country table

        //$this->data['Subcategory_details'] = $this->Base_Model->query("SELECT tbl_category.CategoryName as CategoryName,tbl_subcategory.id as Id,tbl_subcategory.ImagePath as ImagePath,tbl_subcategory.SubcategoryName as SubcategoryName,tbl_subcategory.StatusId as StatusId,tbl_languagemaster.Languages as LaguageName FROM `tbl_subcategory` join tbl_category on tbl_subcategory.CategoryId=tbl_category.CategoryId join tbl_languagemaster on tbl_languagemaster.LanguageId=tbl_subcategory.LanguageId WHERE tbl_subcategory.StatusId !=3 and  tbl_subcategory.LanguageId='ENG1' and tbl_category.LanguageId='ENG1' and tbl_category.StatusId !=3");

        // //read status from tbl_status

        //$this->data['status'] = $this->Base_Model->select('tbl_status', '*', '', $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //load template

        $this->template('manage_data/subcategory/subcategory', $this->data);

    }




      
/**
 *@func insert SubCategory 
 *@param no param
 *author mubashir
 */

    public function insert()
    {

  
        $this->_AdminPrivilegeChecking('SubCategoryAdd');

//validate form data

        $this->form_validation->set_rules('Subcategory_number', 'Subcategory', 'required|regex_match[/^[0-9 a-z A-Z , ]+$/]');

        $this->form_validation->set_rules('category_id', 'category', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

//validate form is true or false

        if ($this->form_validation->run() == true) {

            $this->image->ImageConfig();

            if ($this->upload->do_upload('image')) {

            $imageInformation = $this->upload->data();

            $this->image->image_cropping($imageInformation);

//make unique key

//store data in variable using $Subcategory_details

//statusid is 1 that is active and userid is our genarate uniquekey

                $this->Subcategory_details = array('StatusId' => 1, 'CategoryId' => $this->input->post('category_id'), 'SubcategoryName' => $this->input->post('Subcategory_number'), 'ImagePath' =>$imageInformation['file_name'], 'InsertedBy' => $this->data['user_id'], 'InsertedDate' => date('Y-m-d'), 'LanguageId' => 'ENG1');

//then calling insert function

                if ($this->Base_Model->insert('tbl_subcategory', $this->Subcategory_details, 'FLSubcategory', 'SubcategoryId')) {

//set flash message
                    $this->session->set_flashdata('success', 'Successfully created Subcategory ');

//redirect to Subcategory page
                    redirect('backend/admin/manage_data/subcategory/subcategory', 'refresh');

                } else {

                    unlink('assets/upload/image/subcategory/' . $data['upload_data']['file_name']);

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
 *@func update SubCategory 
 *@param no param
 *author mubashir
 */

    public function update()
    {

        $this->_AdminPrivilegeChecking('SubCategoryEdit');

//validate form data

        $this->form_validation->set_rules('category_id', 'category', 'required|regex_match[/^[0-9 a-zA-Z ,]+$/]');

        $this->form_validation->set_rules('Subcategory_number', 'Subcategory', 'required|regex_match[/^[0-9 A-Z , a-z]+$/]');

        $this->form_validation->set_rules('Subcategory_status', 'Subcategory Status', 'required|regex_match[/^[0-9]+$/]');

        $this->form_validation->set_rules('id', 'id', 'required');

//validate form is true or false

        if ($this->form_validation->run() == true) {

//store data in variable using $Subcategory_details

$this->Subcategory_details = array('StatusId' => $this->input->post('Subcategory_status'), 'CategoryId' => $this->input->post('category_id'), 'SubcategoryName' => $this->input->post('Subcategory_number'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'));

            if (!empty($_FILES['image']['name'])) {

                $this->image->ImageConfig();

                if ($this->upload->do_upload('image')) {

                    $imageInformation = $this->upload->data();

                    $this->image->image_cropping($imageInformation);

                    $this->Subcategory_details += array('ImagePath' => $imageInformation['file_name']);

                } else {

                    $this->Subcategory_details = array();

                    $this->session->set_flashdata('error', $this->upload->display_errors());

                }

            }

            if (!empty($this->Subcategory_details)) {
//then calling update function

                if ($this->Base_Model->update('tbl_subcategory', array('Id' => $this->input->post('id')), $this->Subcategory_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update Subcategory ');

                    //redirect to Subcategory page

                    redirect('backend/admin/manage_data/subcategory/subcategory', 'refresh');

                } else {
                    //its database prb show in here or query prb

                    $this->session->set_flashdata('error', ' Database Problem');

                }

            }
        }

    }

    /**
 *@func details SubCategory in particular data 
 *@param id its unique id 
 *author mubashir
 */

    public function details($id)
    {

        
        $this->_AdminPrivilegeChecking('SubCategoryView');

        //read Subcategory details from database

        $this->Subcategory_details = $this->Base_Model->select('tbl_subcategory', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['Subcategory_details']);

        echo json_encode($this->Subcategory_details, true);

    }

    
/**
 *@func delete SubCategory in particular data 
 *@param no param
 *author mubashir
 */

//delete data from tbl_user

    public function delete()
    {

        
        $this->_AdminPrivilegeChecking('SubCategoryDelete');

//checking for update button

        if (isset($_POST['delete'])) {

            //validate form data

            $this->form_validation->set_rules('delete_Subcategory_id', 'Delete Subcategory', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                //SET Delete status mode
                $this->Subcategory_details = array('StatusId' => 3);

                if ($this->Base_Model->update('tbl_subcategory', array('Id' => $this->input->post('delete_Subcategory_id')), $this->Subcategory_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Delete Subcategory');

                    //redirect to Subcategory page

                } else {
                    //its database prb show in here or query prb

                    echo 'Database Problem Occure';

                    die();

                }
            }

        }

        redirect('backend/admin/manage_data/subcategory/subcategory', 'refresh');

    }

    //ajax function that using to ajax calling from any other view

    public function ajax()
    {

        //store in $category_id variable using post method

        $category_id = $this->input->post('category_id');

        //read value from tbl_subcategory tabl

        $this->data['ajax'] = $this->Base_Model->select('tbl_subcategory', '*', array('CategoryId' => $category_id, 'StatusId !=' => 3, 'LanguageId' => 'ENG1'), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //load view page

        $this->load->view('backend/admin/manage_data/subcategory/subcategory_ajax_list', $this->data);

    }

    //ajax function that using to ajax calling

    public function language_ajax()
    {

//open category

        $categoryId = $this->input->post('category_id');

        $languageId = $this->input->post('language_id');
//read value from tbl_subcategory

        $ajax = $this->Base_Model->select('tbl_subcategory', '*', array('CategoryId' => $categoryId, 'LanguageId' => $languageId, 'StatusId !=' => 3), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        $default_subcategory = $this->Base_Model->query("SELECT * FROM `tbl_subcategory` join tbl_languagemaster on tbl_languagemaster.LanguageId=tbl_subcategory.LanguageId where tbl_languagemaster.LanguageId='ENG1' and `tbl_subcategory`.CategoryId='$categoryId'");

        if (count($default_subcategory) > count($ajax)) {

            $new_subcategory = array();

            foreach ($ajax as $row) {

                array_push($new_subcategory, $row['SubCategoryId']);
            }

            foreach ($default_subcategory as $row) {

                if (!in_array($row['SubCategoryId'], $new_subcategory)) {

                    $label = array('LanguageId' => $this->input->post('language_id'), 'ImagePath' => $row['ImagePath'], 'CategoryId' => $categoryId, 'SubCategoryId' => $row['SubCategoryId'], 'StatusId' => 1, 'InsertedBy' => 'admin', 'InsertedDate' => date('Y-m-d'));

                    $this->Base_Model->insert('tbl_subcategory', $label);
                }

            }

        }

        $this->data['select_value'] = $languageId;

        $this->data['subcategory_details'] = $this->Base_Model->query("SELECT tbl_subcategory.SubCategoryId as SubCategoryId,tbl_subcategory.SubcategoryName as SubcategoryName,tbl_parent.SubcategoryName as parentSubcategoryName FROM `tbl_subcategory` join tbl_subcategory as tbl_parent on tbl_parent.SubCategoryId=tbl_subcategory.SubCategoryId where tbl_parent.LanguageId='$languageId' and `tbl_subcategory`.LanguageId='ENG1'  AND tbl_subcategory.CategoryId='$categoryId' AND tbl_parent.CategoryId='$categoryId'");

        //load view page

        $this->load->view('backend/admin/manage_data/subcategory/subcategory_ajax', $this->data);
    }

    public function ajax_multi_subcategory()
    {

        //store in $category variable using post method

        $category = $this->input->post('category');

        $items = explode(',', $category);

        $ajax = array();

        foreach ($items as $row_one) {

            $value = $this->Base_Model->select('tbl_subcategory', '*', array('CategoryId' => $row_one, 'StatusId !=' => 3, 'LanguageId' => 'ENG1'), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

            foreach ($value as $row_two) {

                array_push($ajax, $row_two);
            }

        }

        $this->data['ajax'] = $ajax;

        $this->load->view('backend/admin/manage_data/subcategory/subcategory_ajax_multi_list', $this->data);

    }

}
