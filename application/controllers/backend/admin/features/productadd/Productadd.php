<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Productadd
 * @author: mubashir
 * @author:(sub) raseel
 * @version: 1.0.0
 *
 *@extends:Admin_Controller
 *
 */

class Productadd extends Admin_Controller
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

      /** product details */

      protected $ProductAdd_details = array();

      /**
       * @var array
       * store product details
       */


//its default function and using for ProductAdd list
public function __construct()
    {
        parent::__construct();
        //Load Dependencies

        $this->load->model("online/backend/admin/manage_product/ProductAdd_Model", 'ProductAdd_Model');

        $this->data += $this->ProductAdd_Model->read_product();



        $this->title_nav_bar = array('Home' => 'backend/admin/dashboard', 'Service List' => 'backend/admin/features/productadd/productadd/', 'Service List' => 'backend/admin/features/productadd/productadd/');

        $this->title = 'Service List';

    }

    /**
 *@func showing product list
 *@param no param
 *author mubashir
 */


    public function index()
    {
        /** set privilege */
        $this->_AdminPrivilegeChecking('ProductView');

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title;

        $this->data['legancy']=$this->Legancy->design(array('add','active','actions','block','view'),'Product');
       /** load template */

        $this->template('features/productadd/productadd', $this->data);

    }



    
    /**
 *@func insert add product 
 *@param no param
 *author mubashir
 */

    public function insert()
    {
  if (!in_array('ProductAdd', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
//validate form data

        $this->form_validation->set_rules('Product_number', 'Product Name', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

        $this->form_validation->set_rules('category_id', 'category', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

        $this->form_validation->set_rules('product_discription', 'Product Discription', 'required');

        $this->form_validation->set_rules('subcategory_id', 'subcategory', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

//validate form is true or false

        if ($this->form_validation->run() == true) 
        {


            $this->image->ImageConfig();


                if ($this->upload->do_upload('image')) {

                    $imageInformation = $this->upload->data();

                    $this->image->image_cropping($imageInformation);
                } else {
                    echo json_encode($this->upload->display_errors());

                }

            $this->ProductAdd_details = array('CategoryId' => $this->input->post('category_id'), 'SubcategoryId' => $this->input->post('subcategory_id'), 'StatusId' => 1, 'Product' => $this->input->post('Product_number'), 'InsertedBy' => $this->data['user_id'], 'InsertedDate' => date('Y-m-d'), 'LanguageId' => 'ENG1', 'ImagePath' => $imageInformation['file_name'], 'Description' => $this->input->post('product_discription'));

            if ($this->Base_Model->insert('tbl_products', $this->ProductAdd_details, $key = 'FLProduct', $key_colum_name = 'ProductId')) {


                $this->session->set_flashdata('success', 'Successfully created Product');

                $this->output->set_status_header('200');

            } else {

                echo 'Database Problem Occure';

            }

        } else {

            $this->output->set_status_header('400');

            echo json_encode($this->form_validation->error_array());

        }

    }


        
/**
 *@func update add product  
 *@param no param
 *author mubashir
 */


    public function update()
    {
        if (!in_array('ProductEdit', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        //validate form data

        $this->form_validation->set_rules('Product_number', 'Product Name', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

        $this->form_validation->set_rules('category_id', 'category', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

        $this->form_validation->set_rules('product_discription', 'Product Discription', 'required');

        $this->form_validation->set_rules('subcategory_id', 'subcategory', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

        $this->form_validation->set_rules('id', 'id', 'required');

//validate form is true or false

        if ($this->form_validation->run() == true) {

//store data in variable using $ProductAdd_details

$this->ProductAdd_details = array('StatusId' => $this->input->post('Product_status'), 'Description' => $this->input->post('product_discription'), 'Product' => $this->input->post('Product_number'), 'UpdatedBy' => $this->data['user_id'], 'UpdatedDate' => date('Y-m-d'), 'CategoryId' => $this->input->post('category_id'), 'SubcategoryId' => $this->input->post('subcategory_id'));

             $this->image->ImageConfig();


            if ($this->upload->do_upload('image')) {

                $imageInformation = $this->upload->data();

                $this->image->image_cropping($imageInformation);

                $this->ProductAdd_details += array('ImagePath' => $imageInformation['file_name']);

            }

            if (!empty($this->ProductAdd_details)) {

                if ($this->Base_Model->update('tbl_products', array('Id' => $this->input->post('id')), $this->ProductAdd_details)) {

                    //set flash message

                    $this->session->set_flashdata('success', 'Successfully Update Product');

                    $this->output->set_status_header('200');

                    //redirect to ProductAdd page

                    redirect('admin/features/productadd', 'refresh');

                } else {
                    //its database prb show in here or query prb

                    echo 'Database Problem Occure';

                    die();

                }

            }

        } else {

            $this->output->set_status_header('400');

            echo json_encode($this->form_validation->error_array());

        }

    }

    public function details($id)
    {
        if (!in_array('ProductView', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
        //read ProductAdd details from database
        $this->ProductAdd_details = $this->Base_Model->select('tbl_products', '*', $where = array('Id' => $id), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');

        //    print_r($this->data['ProductAdd_details']);

        echo json_encode($this->ProductAdd_details, true);

    }

//delete data from tbl_user

    public function delete()
    {
        if (!in_array('ProductDelete', $this->data['CountryPrivilege'])) {
            redirect('backend/admin/dashboard', 'refresh');
        }
//checking for update button

        $this->form_validation->set_rules('delete_Product_id', 'Delete Product', 'required');

        //validate form is true or false

        if ($this->form_validation->run() == true) {

            //SET Delete status mode
            $this->ProductAdd_details = array('StatusId' => 3);

            if ($this->Base_Model->update('tbl_products', array('Id' => $this->input->post('delete_Product_id')), $this->ProductAdd_details)) {

                //set flash message

                $this->session->set_flashdata('success', 'Successfully Product Deleted');

            } else {

                //its database prb show in here or query prb

                $this->session->set_flashdata('error', 'Database Problem Occure');

            }
        } else {
            $this->session->set_flashdata('error', 'Delete Id Not occure');

        }
        redirect('backend/admin/features/productadd/productadd', 'refresh');

    }

}
