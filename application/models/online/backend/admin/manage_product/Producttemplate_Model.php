<?php

class Producttemplate_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        $this->load->model("online/backend/admin/manage_data/Category_Model", 'Category_Model');

        $this->load->model("online/backend/admin/manage_product/ProductAdd_Model", 'ProductAdd_Model');

        $this->load->model("online/backend/admin/general/Country_Model", 'Country_Model');

        $this->load->model("online/backend/admin/general/State_Model", 'State_Model');

        $this->load->model("online/backend/admin/general/City_Model", 'City_Model');

    }
    public function template()
    {

        $this->db->select('tbl_templatemaster.Id as Id,tbl_templatemaster.StatusId as StatusId,tbl_templatemaster.TemplateId as TemplateId,tbl_templatemaster.TemplateName as TemplateName,tbl_country.CountryName as CountryName,tbl_state.StateName as StateName,tbl_city.CityName as CityName');

        $this->db->join('tbl_country', 'tbl_country.Id=tbl_templatemaster.CountryId', 'join');

        $this->db->join('tbl_state', 'tbl_state.Id=tbl_templatemaster.StateId', 'join');

        $this->db->join('tbl_city', 'tbl_city.Id=tbl_templatemaster.CityId', 'join');

        $this->db->where(array('tbl_templatemaster.StatusId!=' => 3));

        $query = $this->db->get('tbl_templatemaster');

        return $query->result_array();
    }

    public function tax()
    {
        $this->db->select('*');

        $this->db->where(array('StatusId !=' => 3));

        $query = $this->db->get('tbl_taxmaster');

        return $query->result_array();
    }
    public function mastertemplate($template_id)
    {
        $this->db->select('*');

        $this->db->where(array('TemplateId' => $template_id));

        $query = $this->db->get('tbl_templatemaster');

        return $query->row_array();

    }
    public function productlist($template_id)
    {

        $this->db->select('tbl_products.ProductId as ProductId,tbl_products.Product as ProductName,tbl_products.ProductId as ProductId,tbl_products.ImagePath as ImagePath,tbl_products.StatusId as StatusId,tbl_products.Description as Description,tbl_category.CategoryName as CategoryName,tbl_subcategory.SubcategoryName AS SubcategoryName,tbl_itemtemplate.TaxmasterId as TaxmasterId,tbl_itemtemplate.Tick as Tick');

        $this->db->join('tbl_itemtemplate', "tbl_itemtemplate.ProductId = tbl_products.ProductId and templatemaster_id ='$template_id'", 'left');

        $this->db->join('tbl_subcategory', 'tbl_subcategory.SubCategoryId=tbl_products.SubcategoryId', 'join');

        $this->db->join('tbl_category', 'tbl_category.CategoryId=tbl_products.CategoryId', 'join');

        $this->db->where(array('tbl_products.StatusId!=' => 3, 'tbl_products.LanguageId=' => 'ENG1', 'tbl_category.LanguageId=' => 'ENG1', 'tbl_subcategory.LanguageId=' => 'ENG1'));

        $query = $this->db->get('tbl_products');

        return $query->result_array();

    }

    public function read_template()
    {
        $data['status'] = $this->Status_Model->item_creation_status();

        $data['category'] = $this->Category_Model->Category();

        $data['Template_details'] = $this->template();

        $data['tax'] = $this->tax();

        return $data;

    }
    public function read_edittemplate($template_id)
    {
        $data['category'] = $this->Category_Model->Category();

        $data['mastertemplate'] = $this->mastertemplate($template_id);

        $data['tbl_country'] = $this->Location_Model->country();

        $data['tbl_state'] = $this->Location_Model->state();

        $data['tbl_city'] = $this->Location_Model->city();

        $data['tax'] = $this->tax();

        $data['productlist'] = $this->productlist($template_id);


        $data['country'] = $this->Location_Model->country();

        $data['status'] = $this->Status_Model->item_creation_status();

        $data['template_id'] = $this->template();

        return $data;

    }
   
    public function ReadTemplate($templateId)
    {
    
            $this->db->select('tbl_templatemaster.Id as Id,tbl_templatemaster.StatusId as StatusId,tbl_templatemaster.TemplateId as TemplateId,tbl_templatemaster.TemplateName as TemplateName,tbl_country.CountryName as CountryName,tbl_state.StateName as StateName,tbl_city.CityName as CityName');
    
            $this->db->join('tbl_country', 'tbl_country.Id=tbl_templatemaster.CountryId', 'join');
    
            $this->db->join('tbl_state', 'tbl_state.Id=tbl_templatemaster.StateId', 'join');
    
            $this->db->join('tbl_city', 'tbl_city.Id=tbl_templatemaster.CityId', 'join');
    
            $this->db->where(array('tbl_templatemaster.StatusId!=' => 3,'tbl_templatemaster.TemplateId'=>$templateId));
    
            $query = $this->db->get('tbl_templatemaster');
    
            return $query->row_array();
    
    }
   
}
