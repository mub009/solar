<?php

class Producttemplate_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        $this->load->model("online/backend/admin/manage_data/Category_Model", 'Category_Model');

    }
    public function template($userid)
    {

        $this->db->select('tbl_templatemaster.Id as Id,tbl_templatemaster.StatusId as StatusId,tbl_templatemaster.TemplateId as TemplateId,tbl_templatemaster.TemplateName as TemplateName,tbl_country.CountryName as CountryName,tbl_state.StateName as StateName,tbl_city.CityName as CityName');

        $this->db->join('tbl_country', 'tbl_country.Id=tbl_templatemaster.CountryId', 'join');

        $this->db->join('tbl_state', 'tbl_state.Id=tbl_templatemaster.StateId', 'join');

        $this->db->join('tbl_city', 'tbl_city.Id=tbl_templatemaster.CityId', 'join');

        $this->db->join('tbl_dealertemplate', 'tbl_dealertemplate.TemplateMasterId = tbl_templatemaster.TemplateId', 'join');

        $this->db->where(array('tbl_templatemaster.StatusId!=' => 3, 'tbl_dealertemplate.DealerUserTypeId' => $userid));

        $query = $this->db->get('tbl_templatemaster');
//
        return $query->result_array();
    }
    public function vendorlist()
    {
        $this->db->select('*');

        $this->db->join('tbl_generateproductlist', 'tbl_generateproductlist.VendorUserTypeId=tbl_user_type.UserId', 'left join');

        $this->db->where(array('tbl_user_type.`UserTypeId` =' => 44, 'tbl_user_type.StatusId !=' => 3));

        $query = $this->db->get('tbl_user_type');

        return $query->result_array();
    }
    public function productlist()
    {

        $this->db->select(' tbl_products.Product as ProductName,tbl_products.ProductId as ProductId,tbl_products.ImagePath as ImagePath,tbl_products.StatusId as StatusId,tbl_products.Description as Description,tbl_category.CategoryName as CategoryName,tbl_subcategory.SubcategoryName AS SubcategoryName');

        $this->db->join('tbl_products', 'tbl_products.ProductId=tbl_itemtemplate.ProductId', 'join');

        $this->db->join('tbl_subcategory', 'tbl_subcategory.SubCategoryId=tbl_products.SubcategoryId', 'join');

        $this->db->join('tbl_category', 'tbl_category.CategoryId=tbl_products.CategoryId', 'join');

        $this->db->where(array('templatemaster_id=' => $template_id, 'tbl_products.LanguageId=' => 'ENG1', 'tbl_category.LanguageId=' => 'ENG1', 'tbl_subcategory.LanguageId=' => 'ENG1', 'tbl_itemtemplate.Tick=' => 'on'));

        $query = $this->db->get('tbl_products');

        return $query->result_array();

    }
    public function mastertemplate($template_id)
    {
        $this->db->select('*');

        $this->db->join('tbl_country', "tbl_country.Id=tbl_templatemaster.CountryId", 'JOIN');

        $this->db->join('tbl_state', "tbl_state.Id=tbl_templatemaster.StateId", 'JOIN');

        $this->db->join('tbl_city', " tbl_city.Id=tbl_templatemaster.CityId", 'JOIN');

        $this->db->where(array('TemplateId=' => $template_id));

        $query = $this->db->get('tbl_templatemaster');

        return $query->row_array();

    }

    public function read_template($userid)
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['Template_details'] = $this->template($userid);

        $data['category'] = $this->Category_Model->Category();

        return $data;
    }

    public function read_generateproduct()
    {
        $data['status'] = $this->Status_Model->account_creation_status();

        $data['category'] = $this->Category_Model->Category();

        $data['ProductList'] = $this->productlist();

        $data['MasterTemplate'] = $this->mastertemplate($template_id);

        $data['vendor_list'] = $this->vendorlist();

    }

}
