<?php

class Dealer_Controller extends MY_Controller
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

                
                if ($LoginDetails['usermaster'] == 22 && $LoginDetails['status'] ==1) {

                    $this->data['user_id'] = $LoginDetails['user_id'];

                    $this->data['InsertBy'] = $LoginDetails['InsertBy'];

                    $this->data['userinfo'] = $LoginDetails;

                    $this->_DealerPrivilegePermission();

                    $dealer_id = $this->Base_Model->select('tbl_dealer', $data = 'DealerId', $where = array('UserId' => $this->data['user_id']));

                    $this->data['DealerId'] = $dealer_id['DealerId'];

                    $this->load->model("online/backend/dealer/loyality/PointSystemModel", 'PointSystemModel');

                } else {

                    $this->session->set_flashdata('Error', 'You not permit Area');

                    redirect('common/login');

                }

            } else {

                $this->session->set_userdata('token');

                $this->session->set_flashdata('Error', 'Expire Your Time Please Login Again');

                redirect('common/login');

            }
        }

    }

    public function template($page = null, $data = array())
    {
        $this->r_notification();
            
    $this->data['personal_info_updation']=$this->Base_Model->query("SELECT * FROM tbl_dealer join tbl_address on tbl_address.AddressId=tbl_dealer.AddressId where tbl_dealer.UserId='".$this->data['user_id']."'",'row_array');
     
    $this->data['change_profile'] = $this->Base_Model->select(self::tbl_dealer, '*', array('UserId' => $this->data['user_id']));
        $this->load->view('template/dealer/_include/header', $this->data);

        $this->load->view('template/dealer/_include/header_menu');

        $this->load->view('template/dealer/_include/side_menubar', $data);

        $this->load->view('template/dealer/_include/modal');

        $this->load->view('template/dealer/_include/notification');

        //page loading

        $this->load->view('backend/dealer/' . $page, $data);

        $this->load->view('template/dealer/_include/footer');

    }

    public function Loyality($config)
    {
        return $this->PointSystemModel->Loyality($config);

    }

    public function _DealerPrivilegePermission()
    {

        $DealerPrivilege = $this->Base_Model->select('tbl_usertypemaster', $data = '*', $where = array('UserTypeId' => 22));

        $this->data['DealerPrivilege'] = json_decode($DealerPrivilege['permission']);

    }

}
