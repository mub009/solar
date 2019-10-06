<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Appversioncontroller extends Admin_Controller
{

public function index()
    {

        $this->data['title_nav_bar'] = array('home' =>'admin/dashboard');
        
        $this->_Datatable_config();

         $this->template('applicationconfiguration/appversioncontroller', $this->data);

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
                'json_url'=>'/backend/admin/applicationconfiguration/appversioncontroller/datatable',
                'column_name'=>array('SlNo','AppVersionCode','AppVersionName','OS Type','Releasing Date')
            ),
            'toolbar'=>array(
                'privilege_array'=>$this->privilege,
                'privilege_value'=>'AreaView',
 
            ),
            'title'=>'App Updation List'
 
         );
         
         $this->data['datatable']=$this->Datatabledesign->design($config);
        
        
    }


   /**
     *  append datatable 
     *
     * @param: No param
     *
     *  */
    public function datatable()
    {
        $this->datatables
        ->select('tbl_app_updation.Id,tbl_app_updation.AppVersion,tbl_app_updation.AppCode,tbl_app_updation.TypeOs,tbl_app_updation.CreatedDateTime')
        ->where(array('StatusId !=' => 3))
        ->from('tbl_app_updation');

      echo $this->datatables->generate();

    }

    public function apk_insert()
    {
        $this->form_validation->set_rules('apk_app_version_code', 'App Version Code ', 'required');

        $this->form_validation->set_rules('apk_app_version', 'App Version ', 'required');


        if ($this->form_validation->run() == true) {
           
            $appUpdation = array('AppVersion' => $this->input->post('apk_app_version'), 'AppCode' => $this->input->post('apk_app_version_code'), 'TypeOs' => 'APK', 'StatusId' => 1, 'Created_by' => $this->data['user_id'], 'CreatedDateTime' => date('Y-m-d'));

            if ($this->Base_Model->insert('tbl_app_updation', $appUpdation)) {

                json_output(200,'success');
          

            }
            else
            {
                json_output(201,'fail');
            }
        }
        else
        {
     
            json_output(400, $this->form_validation->error_array());
          
        }
    }



    
    public function ios_insert()
    {
        $this->form_validation->set_rules('ios_app_version_code', 'App Version Code ', 'required');

        $this->form_validation->set_rules('ios_app_version', 'App Version ', 'required');


        if ($this->form_validation->run() == true) {
           
            $appUpdation = array('AppVersion' => $this->input->post('ios_app_version_code'), 'AppCode' => $this->input->post('ios_app_version'), 'TypeOs' => 'IOS', 'StatusId' => 1, 'Created_by' => $this->data['user_id'], 'CreatedDateTime' => date('Y-m-d'));

            if ($this->Base_Model->insert('tbl_app_updation', $appUpdation)) {

                json_output(200,'success');
          

            }
            else
            {
                json_output(201,'fail');
            }
        }
        else
        {
     
            json_output(400, $this->form_validation->error_array());
          
        }
    }
}
