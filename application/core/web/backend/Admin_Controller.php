<?php

class Admin_Controller extends MY_Controller
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

                $LoginDetails=$this->Login_Modal->loginDetails($DataInfo['data']->userId);


         
                if (($LoginDetails['usermaster'] == 11 or $LoginDetails['usermaster'] == 88) && $LoginDetails['status'] == 1) {


                    $this->data['user_id'] = $LoginDetails['user_id'];

                    $this->data['InsertBy'] = $LoginDetails['InsertBy'];

                    $this->data['userinfo'] = $LoginDetails;

                    if ($LoginDetails['OtpVerification'] == 2) {

                        redirect('common/otp');

                    } else {

                        if ($LoginDetails['usermaster'] == 11) {

                            $this->data['AdminPrivilege'] = true;
                            $this->_CountryPrivilegePermission();
                            $this->_DealerPrivilegePermission();
                            $this->_VendorPrivilegePermission();

                        } elseif ($LoginDetails['usermaster'] == 88) {

                            $this->data['AdminPrivilege'] = false;

                            $this->_CountryPrivilegePermission();

                        }
                    }

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

    public function template($page = null, $data = array())
    {
        $this->data['change_profile'] = $this->Base_Model->select(self::tbl_admin, '*', array('UserId' => $this->data['user_id']));
        $this->data['personal_info_updation'] = $this->Base_Model->select(self::tbl_admin, '*', array('UserId' => $this->data['user_id']));
        $this->r_notification();

        $this->load->view('template/admin/_include/header', $this->data);

        $this->load->view('template/admin/_include/header_menu');

        $this->load->view('template/admin/_include/side_menubar', $data);

        $this->load->view('template/admin/_include/modal');

        $this->load->view('template/admin/_include/notification');

        $this->load->view('backend/admin/' . $page, $data);

        $this->load->view('template/admin/_include/footer');

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

        $AdminPrivilege = $this->Base_Model->select('tbl_usertypemaster', $data = '*', $where = array('UserTypeId' => 11));

        $this->data['CountryPrivilege'] = json_decode($AdminPrivilege['permission']);

    }
    public function _CountryPrivilegePermission()
    {

        $CountryPrivilege = $this->Base_Model->select('tbl_usertypemaster', $data = '*', $where = array('UserTypeId' => 88));

        $this->data['CountryPrivilege'] = json_decode($CountryPrivilege['permission']);

    }

    public function _DealerPrivilegePermission()
    {

        $DealerPrivilege = $this->Base_Model->select('tbl_usertypemaster', $data = '*', $where = array('UserTypeId' => 22));

        $this->data['DealerPrivilege'] = json_decode($DealerPrivilege['permission']);

    }

    public function _VendorPrivilegePermission()
    {

        $VendorPrivilege = $this->Base_Model->select('tbl_usertypemaster', $data = '*', $where = array('UserTypeId' => 44));

        $this->data['VendorPrivilege'] = json_decode($VendorPrivilege['permission']);
    }
}
