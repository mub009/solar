<?php

class ProductAdd_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        $this->load->model("online/backend/admin/manage_data/Category_Model", 'Category_Model');

    }
    public function product()
    {
        $this->db->select('tbl_products.Product as ProductName,tbl_products.Id as Id,tbl_products.StatusId as StatusId,tbl_products.ImagePath as ImagePath,tbl_category.CategoryName as CategoryName,tbl_subcategory.SubcategoryName as SubCategoryName');

        $this->db->join('tbl_category', 'tbl_category.CategoryId=tbl_products.CategoryId', 'join');

        $this->db->join('tbl_subcategory', 'tbl_subcategory.SubCategoryId=tbl_products.SubcategoryId', 'join');

        $this->db->where(array('tbl_products.LanguageId' => 'eng1', 'tbl_products.StatusId !=' => 3, 'tbl_category.LanguageId=' => 'ENG1', 'tbl_subcategory.LanguageId=' => 'ENG1'));

        $query = $this->db->get('tbl_products');

        return $query->result_array();

    }
    public function read_product()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['Category_details'] = $this->Category_Model->Category();

        $data['product'] = $this->product();

        return $data;
    }
    public function read_modal_product()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['product_details'] = $this->product();

        return $data;
    }
}
