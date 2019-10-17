<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    
     /**
     * Set const value in  tbl_vendor;
     * @var string const 
     */

    const  tbl_address='tbl_address';

    
    public $data=array();
    
    public function __construct()
    {
        parent::__construct();

        // $this->load->model("online/backend/common/Login_Modal", 'Login_Modal');

    }

    public function index()
    {
       

      
       
    //    $this->data['select_login']= $this->Base_Model->select(self::tbl_settings_login, '*', array('id' => '$id'));
       
    //    print_r('$select_login');
    
  
        $this->data['country']=$this->Location_Model->country();

        //    $this->load->view('admin/user/test');

        if ($this->session->userdata('usermaster') == '11') {

            redirect('backend/admin/dashboard');

        } elseif ($this->session->userdata('usermaster') == '22') {

            redirect('backend/dealer/dashboard');

        } else {
            $this->load->view('common/login',$this->data);
        }

    }

    public function logout()
    {

        $this->session->sess_destroy();

        redirect('common/login');

    }

    public function action()
    {

        
        $this->form_validation->set_rules('MobileNo', 'MobileNo', 'required');

        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger display-show">
                    <button class="close" data-close="alert"></button>', '</div>');

        if ($this->form_validation->run() == true) {

            $email_exists = $this->Login_Modal->login($this->input->post('MobileNo'),$this->input->post('country_name'));

            if ($email_exists == true) {

                $login = password_verify($this->input->post('password'), $email_exists['Password']);

                if ($login) {

                    if ($email_exists['StatusId'] == 1) {

                        // $logged_in_sess = array(
                        //     'user_id' => $email_exists['UserId'],
                        //     'CountryId' => $email_exists['CountryId'],
                        //     'phone' => $email_exists['MobileNo'],
                        //     'InsertBy' => $email_exists['InsertBy'],
                        //     'OtpVerification' => $email_exists['OtpVerification'],
                        //     'logged_in' => true,
                        //     'usermaster' => $email_exists['UserTypeId'],
                        //     'status' => $email_exists['StatusId'],
                        //     'HeaderName' => $email_exists['UserType'],
                        //     'Currency' => $email_exists['Currency'],
                        //     'CurrencySymbol' => $email_exists['CurrencySymbol'],
                        // );

                        $logged_in_sess = array('userId'=>$email_exists['UserId']);

                        $this->session->set_userdata(array('token' => $this->authorization_token->GenerateToken($logged_in_sess,$this->config->item('web_token_key'),$this->config->item('web_jwt_algorithm'))));

                        if ($email_exists['UserTypeId'] == 11) {

                            redirect('backend/admin/dashboard', 'refresh');


                        } elseif ($email_exists['UserTypeId'] == 22) {

                            redirect('backend/dealer/dashboard', 'refresh');
                        } elseif ($email_exists['UserTypeId'] == 44) {

                            redirect('backend/vendor/dashboard', 'refresh');
                        } elseif ($email_exists['UserTypeId'] == 88) {
                            redirect('backend/admin/dashboard', 'refresh');
                        }
                          elseif ($email_exists['UserTypeId'] == 99) {
                            redirect('backend/company/dashboard', 'refresh');
                        }

                    } else {
                        //

                        if ($email_exists['StatusId'] == 2) {

                            $this->data['errors'] = 'Your Account is Pending';

                            $this->load->view('common/login', $this->data);

                        } elseif ($email_exists['StatusId'] == 3) {

                            $this->data['errors'] = 'Your Account was Deleted';

                            $this->load->view('common/login', $this->data);

                        } elseif ($email_exists['StatusId'] == 4) {

                            $this->data['errors'] = 'Your Account is Blocked';

                            $this->load->view('common/login', $this->data);

                        } elseif ($email_exists['OtpVerification'] == '2') {
                            $this->data['errors'] = 'Please Active Your Account';

                            $this->load->view('common/login', $this->data);

                        }
                    }

                } else {

                    $this->data['errors'] = 'Incorrect username/password combination';
                    $this->load->view('common/login', $this->data);
                }
            } else {

                $this->data['errors'] = 'Account does not exists';

            $this->index();            }
        } else {
            // false case
            $this->index();
        }

    }
   
}
