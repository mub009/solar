<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Complaint extends Api_Customer_Controller
{

    public function index()
    {

     $complaint=$this->Base_Model->query("SELECT * FROM tbl_complaintMaster join tbl_complaintList on tbl_complaintList.complaintMasterId=tbl_complaintMaster.Id join tbl_status on tbl_complaintMaster.StatusId=tbl_status.Id  where tbl_complaintMaster.CustomerUserTypeId='".$this->data['userinfo']['UserTypeId']."' ORDER BY tbl_complaintMaster.`Id` Desc");
    
     json_output(200, $complaint);


    }


    public function Create()
    {

       //sssss

        $this->form_validation->set_rules('json_array', 'json_array', 'required');

        $this->form_validation->set_rules('complaintDetails', 'complaintDetails', 'required');

        if ($this->form_validation->run() == true) {


        $json_array=$this->input->post('json_array'); 
       
        if ($this->json_validator($json_array)) {
        
            $Id=$this->Base_Model->insert('tbl_complaintMaster',array('StatusId'=>2,'Created_At'=>$this->data['dateAndtime'],'complaintDetails'=>$this->input->post('complaintDetails'),'CustomerUserTypeId'=>$this->data['userinfo']['UserTypeId']));
 
            foreach(json_decode($json_array) as $row)
            {

             $this->Base_Model->insert('tbl_complaintList',array('complaintMasterId'=>$Id,'ServiceId'=>$row));
              
             $this->Base_Model->insert('tbl_complaintTracking',array('complaintMasterId'=>$Id,'StatusId'=>2,'Created_At'=>$this->data['dateAndtime']));
        
            }

            json_output(200, 'success');
            
        }
    } else {
        json_output(400, $this->form_validation->error_array());
    }



    }



    public function ComplaintServiceItem()
    {

        $this->form_validation->set_rules('complaintMasterId', 'complaintMasterId', 'required');

        if ($this->form_validation->run() == true) {
         
            $Service=$this->Base_Model->query("SELECT * FROM tbl_complaintList join tbl_products on tbl_products.ProductId=tbl_complaintList.ServiceId where tbl_complaintList.complaintMasterId='".$this->input->post('complaintMasterId')."' and tbl_products.LanguageId='Eng1' ORDER BY tbl_complaintList.`Id` Desc");
            
            $tracking=$this->Base_Model->query("SELECT * FROM tbl_complaintTracking join tbl_status on tbl_status.Id=tbl_complaintTracking.StatusId where tbl_complaintTracking.complaintMasterId='".$this->input->post('complaintMasterId')."'  ORDER BY tbl_complaintTracking.`Id` Asc");
   
            json_output(200, array('Service'=>$Service,'tracking'=>$tracking));
        }
        else
        {
            json_output(400, $this->form_validation->error_array()); 
        }

   


    }

}