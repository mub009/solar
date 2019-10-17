<?php

class Mahal_Controller extends MY_Controller
{

    public $data = array();

    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata('token'))) {

            $this->session->unset_userdata('token');

            redirect('common/login');

        } else {

            $DataInfo = $this->authorization_token->ValidateToken($this->session->userdata('token'),$this->config->item('web_token_key'),$this->config->item('web_jwt_algorithm'));

            if ($DataInfo['status'] == 1) {

                $this->data['userinfo'] =$this->Login_Modal->loginDetails($DataInfo['data']->userId);

         
                if ($this->data['userinfo']['UserMasterId'] == 2 &&  $this->data['userinfo']['status']== 1) {

                    $this->CurrentTimeAndDate($this->data['userinfo']['TimeZone']);

                 
                    if ($this->data['userinfo']['is_OtpVerification'] == 2) {

                            redirect('common/otp');

                    } else {

                 
                            $this->_MahalPrivilegePermission();
                    }

                } else {

                    $this->session->set_flashdata('Error', 'Your not permit this Area');

                    redirect('common/login');

                }
            } else {

                $this->session->unset_userdata('token');

                $this->session->set_flashdata('Error', 'Expire Your Time Please Login Again');

                redirect('common/login');

            }

        }

    }

    public function template($page = null, $data = array())
    {

        $this->data['change_profile'] = $this->Base_Model->select(self::tbl_mahal, '*', array('UserId' => $this->data['userinfo']['UserId']));
       
        $this->data['personal_info_updation'] = $this->Base_Model->select(self::tbl_mahal, '*', array('UserId' => $this->data['userinfo']['UserId']));
        
        $this->r_notification();

        $this->load->view('template/mahal/_include/header', $this->data);

        $this->load->view('template/mahal/_include/header_menu');

        $this->load->view('template/mahal/_include/side_menubar', $data);

        $this->load->view('template/mahal/_include/modal');

        $this->load->view('template/mahal/_include/notification');

        $this->load->view('backend/mahal/' . $page, $data);

        $this->load->view('template/mahal/_include/footer');

    }


    public function _MahalPrivilegePermission()
    {


        $MahalPrivilege = $this->Base_Model->select('tbl_usermaster', $data = '*', $where = array('id' => 2));

        $this->data['MahalPrivilege'] = json_decode($MahalPrivilege['Permission']);

    }

   

    
   
}
