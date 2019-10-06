<?php

class Subcategory_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        $this->load->model("online/backend/admin/manage_data/Category_Model", 'Category_Model');

    }
    public function subcategory()
    {
        $this->db->select('tbl_category.CategoryName as CategoryName,tbl_subcategory.id as Id,tbl_subcategory.ImagePath as ImagePath,tbl_subcategory.SubcategoryName as SubcategoryName,tbl_subcategory.StatusId as StatusId,tbl_languagemaster.Languages as LaguageName');

        $this->db->join('tbl_category', 'tbl_subcategory.CategoryId=tbl_category.CategoryId', 'join');

        $this->db->join('tbl_languagemaster', 'tbl_languagemaster.LanguageId=tbl_subcategory.LanguageId', 'join');

        $this->db->where(array('tbl_subcategory.StatusId !=' => 3, 'tbl_subcategory.LanguageId =' => 'ENG1', 'tbl_category.LanguageId =' => 'ENG1', 'tbl_category.StatusId !=' => 3));

        $query = $this->db->get('tbl_subcategory');

        return $query->result_array();

    }

    public function read_subcategory()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['category'] = $this->Category_Model->Category();

        $data['Subcategory_details'] = $this->subcategory();

        return $data;
    }
    public function read_modal_subctegory()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['subcategory_details'] = $this->subcategory();

        return $data;
    }
}
