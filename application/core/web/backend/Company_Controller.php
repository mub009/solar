<?php

class Company_Controller extends MY_Controller
{

    public $data = array();

    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata('token'))) {

            redirect('common/login');

        } else {

            $DataInfo = $this->authorization_token->ValidateToken($this->session->userdata('token'),$this->config->item('web_token_key'),$this->config->item('web_jwt_algorithm'));

            if ($DataInfo['status'] == 1) {

                $LoginDetails=$this->Login_Modal->loginDetails($DataInfo['data']->userId);



                if ($LoginDetails['usermaster'] == 99 && $LoginDetails['status'] ==1) {

                    $this->data['user_id'] = $LoginDetails['user_id'];

                    $this->data['InsertBy'] = $LoginDetails['InsertBy'];

                    $this->data['userinfo'] = $LoginDetails;
                    
                    // $this->data['loyalty_privilege']=$this->VendorSystemSettings->get_loyalty_privilege($this->data['user_id']);
       

                    //  $this->_VendorPrivilegePermission();

                    //  $this->data['vendor'] = $this->Base_Model->select('tbl_vendor', $data = '*', $where = array('UserId' => $this->data['user_id']));

                } else {

                    $this->session->set_flashdata('Error', 'You not permit Area');

                    redirect('common/login');

                }
            } else {

                $this->session->unset_userdata('token');

                $this->session->set_flashdata('Error', 'Expire Your Time Please Login Again');

                redirect('common/login');

            }

        }

    }

    public function template($page = null)
    {
       
       
        $this->r_notification();

        $this->load->view('template/company/_include/header', $this->data);

        $this->load->view('template/company/_include/header_menu');

        $this->load->view('template/company/_include/side_menubar', $this->data);

        $this->load->view('template/company/_include/notification');

        $this->load->view('template/company/_include/modal');

        $this->load->view('backend/company/' . $page, $this->data);

        $this->load->view('template/company/_include/footer');

    }

}
