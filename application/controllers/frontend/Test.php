<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function index()
    {

        // $contacts = '919633871889';

        // $response = file_get_contents("http://phpfile.imarahinfotech.com/metroplusapp/otp.php?contacts=$contacts&otp=123");

        // echo $response;

        $this->load->library('Firebase');

        $this->load->library('Push');

        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        // notification title
        $title = 'test';

        // notification message
        $message = 'message';

        $this->push->setImage('https://api.androidhive.info/images/minion.jpg');

        $this->push->setIsBackground(false);

        $this->push->setPayload($payload);

        $json = $this->push->getPush();

        $response = $this->firebase->send('cQG2Q7GYgrc:APA91bHNtN4PzqbGhoq7kFZxnKYPWVfVMD9FTxwb0a9nTlhz_LDBD6reyWMbJWnVuSUjil5wsZ6BnWdC0GBZ3a8iiPVr6Fmr5xOoiKXEAAp0SYEAr1YR8glvyOvkd0un1aZSt06ePGHh', $json);

        print_R($response);
    }

    public function check()
    {
        $this->load->helper('data_output_helper');

        json_output(200, array('ss'));

        data_output(200, array('ss'), 'json');

    }

}
