<?php

class Category_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }
    public function Category()
    {
        $this->db->select('tbl_category.id as Id,tbl_category.CategoryId,tbl_category.ImagePath as ImagePath,tbl_category.CategoryName as CategoryName,tbl_category.StatusId as StatusId,tbl_languagemaster.Languages as LaguageName');

        $this->db->join('tbl_languagemaster', 'tbl_languagemaster.LanguageId=tbl_category.LanguageId', 'join');

        $this->db->where(array('tbl_category.StatusId !=' => 3, 'tbl_category.LanguageId=' => 'ENG1'));

        $query = $this->db->get('tbl_category');

        return $query->result_array();

    }
    public function read_Category()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['Category_details'] = $this->Category();

        return $data;
    }
    public function read_modal_ctegory()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['category_details'] = $this->Category();

        return $data;
    }
}
