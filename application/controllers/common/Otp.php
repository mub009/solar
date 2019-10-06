<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Otp extends CI_Controller
{

    public function index()
    {

        $this->load->view('common/OTP');

    }

    public function action()
    {

        $this->data['userinfo'] = $this->session->userdata();

        $this->form_validation->set_rules('OTP', 'OTP', 'required');

        if ($this->form_validation->run() == true) {

            if ($this->input->post('OTP') == '1234') {

                $OTP = array('OtpVerification' => 'active');

//then calling update function
           
             $DataInfo = $this->authorization_token->validateWebLoginToken($this->session->userdata('token'));


                if ($this->Base_Model->update('tbl_user_type', array('UserId' => $DataInfo['data']->user_id), $OTP)) {

                $this->session->unset_userdata('token');
                
                $olddata= (array)$DataInfo['data'];
                
                unset($olddata['OtpVerification']);
                
                $activeData=$olddata+array('OtpVerification'=>'active');
                
                $this->session->set_userdata(array('token' =>$this->authorization_token->WebgenerateToken( $activeData)));

                if ($olddata['usermaster'] == 11) {
                            redirect('backend/admin/dashboard', 'refresh');
                        } elseif ($olddata['usermaster'] == 22) {

                            redirect('backend/dealer/dashboard', 'refresh');
                        } elseif ($olddata['usermaster'] == 44) {

                            redirect('backend/vendor/dashboard', 'refresh');
                        } elseif ($olddata['usermaster'] == 88) {
                            redirect('backend/admin/dashboard', 'refresh');
                        }
             


                } else {
                    $this->data['errors'] = 'Database Prb';

                }

            } else {
                $this->data['errors'] = 'Invalid OTP';
            }

        } else {
            $this->data['errors'] = '';
        }
die();
        $this->load->view('common/OTP', $this->data);

    }
}
