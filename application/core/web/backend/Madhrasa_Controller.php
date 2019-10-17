<?php

class Madhrasa_Controller extends MY_Controller
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

         
                if ($this->data['userinfo']['UserMasterId'] == 3 &&  $this->data['userinfo']['status']== 1) {

                    $this->CurrentTimeAndDate($this->data['userinfo']['TimeZone']);

                 
                    if ($this->data['userinfo']['is_OtpVerification'] == 0) {

                            redirect('common/otp');

                    } else {

                        if ($this->data['userinfo']['is_OtpVerification'] == 1) {

                            $this->_AdminPrivilegePermission();
                        }
                    }

                } else {

                    $this->session->set_flashdata('Error', 'You not permit this Area');

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

        $this->load->view('template/madhrasa/_include/header', $this->data);

        $this->load->view('template/madhrasa/_include/header_menu');

        $this->load->view('template/madhrasa/_include/side_menubar', $data);

        $this->load->view('template/madhrasa/_include/modal');

        $this->load->view('template/madhrasa/_include/notification');

        $this->load->view('backend/madhrasa/' . $page, $data);

        $this->load->view('template/madhrasa/_include/footer');

    }

    public function _AdminPrivilegeChecking($checking_name)
    {

        if (!$this->data['AdminPrivilege']) {
            if (!in_array($checking_name, $this->data['CountryPrivilege'])) {
                redirect('backend/admin/dashboard', 'refresh');
            }
        }

    }
    public function _AdminPrivilegePermission()
    {

        $this->data['AdminPrivilege'] = true;

        $AdminPrivilege = $this->Base_Model->select('tbl_usermaster', $data = '*', $where = array('id' => 1));
        
      
        $this->data['MahalPrivilege'] = json_decode($AdminPrivilege['Permission']);

    }
    public function _MahalPrivilegePermission()
    {
        $this->data['AdminPrivilege'] = false;

        $MahalPrivilege = $this->Base_Model->select('tbl_usermaster', $data = '*', $where = array('id' => 22));

        $this->data['MahalPrivilege'] = json_decode($MahalPrivilege['Permission']);

    }

   

    
   
}
