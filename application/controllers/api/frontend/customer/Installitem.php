<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Installitem extends Api_Customer_Controller
{

   protected $is_flag=false;
   
   protected $installDetails;
   
   protected $Input_installDetailsDecode;

   protected $Input_installDetails;
   
    public function index()
    {


     $this->installDetails=$this->Base_Model->select('tbl_installdetails', $data = '*', $where = array('CustomerUserTypeId'=>$this->data['userinfo']['UserTypeId']), $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'result_array');
     
     json_output(200, $this->installDetails);
     
     
  
    }
    
    public function create()
    {


        $this->form_validation->set_rules('installDetails', 'installDetails', 'required');
            
           
         if ($this->form_validation->run() == true) {
             
             
        $this->db->trans_begin();
        
             $this->Input_installDetails=$this->input->post('installDetails');
        
             $this->Input_installDetailsDecode=json_decode($this->Input_installDetails);
             
             
            foreach ($this->Input_installDetailsDecode as $row) {
                       
                    $this->installDetails = array('itemName' => $row->itemName, 'NoofItem' => $row->NoofItem,'watts'=>$row->watts,'StatusId'=>1,'CustomerUserTypeId'=>$this->data['userinfo']['UserTypeId']);
           
           if(!empty($row->itemName) and !empty($row->NoofItem) and !empty($row->watts))
           {
           
                    if($this->Base_Model->insert('tbl_installdetails', $this->installDetails))
                    {
                        
                        $this->is_flag = true;
                    }
                    else
                    {
                        $this->is_flag = false;
                    }


            }
            else
            {
                        $this->is_flag = false;
            }

      }
      
           if($this->is_flag)
                {
                    
                 $this->db->trans_commit();
    
                  json_output(200, 'success');
                 
                }
                else
                {
                 $this->db->trans_rollback();
             
                  json_output(400, 'invalid data format');
         
                    
                }
                
                      
        
         }
         else
         {
              json_output(400, $this->form_validation->error_array());
         
             
         }
  
  
    }

  public function update()
    {

  
    }

}
