
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Complaint extends Admin_Controller
{

    private $where;

    private $details;

    private $ResponseFlag=false;

    public function index()
    {


        $this->data['title_nav_bar'] = array('home' => 'backend/admin/dashboard', 'Complaint' => 'backend/admin/complaint/complaint');


        $this->data['title'] = 'Complaint List';

        $this->_Datatable_config();

        $this->data['legancy']=$this->Legancy->design(array('active','block','actions','notactive','approved','pending'),'Product Request');
        

        $this->template('complaint/complaint', $this->data);
    }

    public function statuschange()
    {


        $this->form_validation->set_rules('statusid', 'statusid', 'required');

        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() == true) {

            if ($this->input->post('statusid') == 6) {

                $statuschange = array('StatusId' => $this->input->post('statusid'), 'AdminUserTypeId' => $this->data['userinfo']['InsertBy']);
            } else {
                $statuschange = array('StatusId' => $this->input->post('statusid'));

            }


            if ($this->Base_Model->update('tbl_product_request', array('ProductRequestId' => $this->input->post('id')), $statuschange)) {

               $this->product_request_tracking($Details= 'Product Request', $StatusId=$this->input->post('statusid'),$ProductRequestId=$this->input->post('id'),$UserTypeId=22);


                $this->session->set_flashdata('success', 'Successfully Change Your request');

                $this->output->set_status_header('200');

                echo json_encode('200');

            } else {
        
                echo 'Database Problem Occure';

            }

        } else {
            $this->output->set_status_header('400');
            echo json_encode($this->form_validation->error_array());

        }

    }


       /**
     *  datatable config
     *
     * @param: No param
     *
     *  */

    public function _Datatable_config()
    {

       
        $config=array(
            'datatable'=>array(
                'json_url'=>'backend/admin/complaint/complaint/datatable/',
                'column_name'=>array('Id','Customer','complaintDetails','Status','Action')
            ),
            'toolbar'=>array(
                'privilege_array'=>array('admin'),
                'privilege_value'=>'admin',
                'link_value'=>'',
                'link'=>false

 
            ),
            'title'=>  'Comaplaint List'
 
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
        ->select('tbl_complaintMaster.Id as Id,tbl_user_type.MobileNo,tbl_complaintMaster.complaintDetails as complaintDetails,tbl_status.StatusValue,0 as Action,0 as Tracking')
        ->join('tbl_user_type', 'tbl_user_type.UserId=tbl_complaintMaster.CustomerUserTypeId')
        ->join('tbl_status', 'tbl_status.Id=tbl_complaintMaster.StatusId')
        ->from('tbl_complaintMaster');
        
  
            $config['action_config']=array(array(
                'EveryPrivilege'=>array('admin'),
                'value'=>'admin',
                'privilege'=> array('admin'),
                'link'=>'backend/admin/complaint/modal/action/8/',
                'icon'=>icon_edit,
                'action_name'=>'Reject',
                'id'=>'$1'
            ),
            array(

                'EveryPrivilege'=>array('admin'),
                'value'=>'admin',
                'privilege'=> array('admin'),
                'link'=>'backend/admin/complaint/modal/action/9/',
                'icon'=>icon_delete,
                'action_name'=>'Accept',
                'id'=>'$1'
            ),
            array(
                'EveryPrivilege'=>array('admin'),
                'value'=>'admin',
                'privilege'=> array('admin'),
                'link'=>'backend/admin/complaint/modal/action/7/',
                'icon'=>icon_delete,
                'action_name'=>'Complete',
                'id'=>'$1'
            )
        );
       

        
        $this->datatables->edit_action('Action',  $config, 'Id');

        echo $this->datatables->generate();

    }


    public function action()
    {


$this->form_validation->set_rules('actionId', 'actionId', 'trim|required');

$this->form_validation->set_rules('StatusId', 'StatusId', 'trim|required');


if ($this->form_validation->run() == TRUE) {




    $this->where=array('Id'=>$this->input->post('actionId'));

    $this->details=array('StatusId'=>$this->input->post('StatusId'));



    if($this->Base_Model->update('tbl_complaintMaster',$this->where,$this->details))
    {

        $this->ResponseFlag=200;

    }
    else {
        
        $this->ResponseFlag=400;

    }


    json_output($this->ResponseFlag,'');



} else {


    json_output(400,$this->form_validation->error_array());
}




    }


}
