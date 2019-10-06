<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
  /**
  * Ignited Datatables
  *
  * This is a Datatable design
  *
  * @package    CodeIgnite
  * @author     Mubashir
  */
  class Datatabledesign
  {
    /**
    * Global container variables for chained argument results
    *
    */

    protected $data=array();

    protected $toolbar=array();

    protected $datatable=array();
    
    /**
    * Copies an instance of CI
    */
    public function __construct()
    {
      $this->ci =& get_instance();
    }

   
    public function design($config)
    {
      
    
      $this->toolbar_config($config['toolbar'],$config);

      $this->datatable_config($config['datatable']);

      $this->title_config($config['title']);
      
      return $this->rapping();

    }
   
    public function rapping()
    {

      $this->data['table']=$this->datatable();

      $this->data['toolbar']=$this->toolbar();

      return $this->ci->load->view('template/TemplateTools/datatable/design1/datatable',$this->data,true);
   
    }

    
    public function datatable()
    {
         
      return $this->ci->load->view('template/TemplateTools/datatable/design1/table',$this->datatable,true);
   
    }

    

    public function toolbar()
    {
       return $this->ci->load->view('template/TemplateTools/datatable/design1/toolbar',$this->toolbar,true);
    }

    public function toolbar_config($config,$table)
    {

   
      //sss

        if(!empty($config))
        {
        $this->toolbar=array(
            'privilege_array'=>$config['privilege_array'],
            'privilege_value'=>$config['privilege_value'],
            'tool'=>(!isset($config['tool']))?true:$config['tool'],
            'link'=>(!isset($config['link']))?false:$config['link'],
            'link_value'=>(!isset($config['link_value']))?false:$config['link_value'],
            'table_name'=>(!empty($table['table_name']))?$table['table_name']:false,
            'filter_link'=>(!isset($config['filter_link']))?false:$config['filter_link']
        );
        
    }
    else
    {
        $this->toolbar=$config;
    }


    }

    public function datatable_config($config)
    {
        $this->datatable=array(
            'json_url'=>$config['json_url'],
            'column_name'=>$config['column_name']
        );

    }

    public function title_config($config)
    {

        $this->data['title']=(!empty($config))?$config:'';
    }



  }