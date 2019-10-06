<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RestFulApi extends CI_Model
{

    public function check_auth_client()
    {
        $this->load->library('JWT');

        $apikey = $this->input->get_request_header('API-KEY', true);

        $ApiId = $this->input->get_request_header('API-Id', true);

        if (!empty($ApiId) && !empty($apikey)) {

            $this->db->select('*');

            $this->db->where(array('api_key' => $apikey, 'KeyId' => $ApiId));

            $query = $this->db->get('api_keys');

            if (!$query->row_array()) {

                $this->output->set_content_type('application/json');
                $this->output->set_status_header(401);
                echo json_encode(array('statusCode' => 401, 'data' => array('message' => 'Unauthorized.')));
                die();
            }
        } else {

            $this->output->set_content_type('application/json');
            $this->output->set_status_header(401);
            echo json_encode(array('statusCode' => 401, 'data' => array('message' => 'Unauthorized.')));
            die();
        }

    }

    public function login($username, $password)
    {
        $q = $this->db->select('password,id')->from('users')->where('username', $username)->get()->row();

        if ($q == "") {
            return array('status' => 204, 'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id = $q->id;
            echo $hashed_password . " " . $password;
            //exit;
            if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
                $last_login = date('Y-m-d H:i:s');
                $token = crypt(substr(md5(rand()), 0, 7));
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->trans_start();
                $this->db->where('id', $id)->update('users', array('last_login' => $last_login));

                $this->db->insert('users_authentication', array('users_id' => $id, 'token' => $token, 'expired_at' => $expired_at));

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    return array('status' => 500, 'message' => 'Internal server error.');
                } else {
                    $this->db->trans_commit();
                    return array('status' => 200, 'message' => 'Successfully login.', 'id' => $id, 'token' => $token);
                }
            } else {
                echo "Wrong password";
                exit();
                return array('status' => 204, 'message' => 'Wrong password.');
            }
        }
    }

    public function logout()
    {
        $users_id = $this->input->get_request_header('User-ID', true);
        $token = $this->input->get_request_header('Authorization', true);
        $this->db->where('users_id', $users_id)->where('token', $token)->delete('users_authentication');
        return array('status' => 200, 'message' => 'Successfully logout.');
    }

    public function auth()
    {
        $users_id = $this->input->get_request_header('User-ID', true);
        $token = $this->input->get_request_header('Authorization', true);
        $q = $this->db->select('expired_at')->from('users_authentication')->where('users_id', $users_id)->where('token', $token)->get()->row();
        if ($q == "") {
            return json_output(401, array('status' => 401, 'message' => 'Unauthorized.'));
        } else {
            if ($q->expired_at < date('Y-m-d H:i:s')) {
                return json_output(401, array('status' => 401, 'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('users_id', $users_id)->where('token', $token)->update('users_authentication', array('expired_at' => $expired_at, 'updated_at' => $updated_at));
                return array('status' => 200, 'message' => 'Authorized.');
            }
        }
    }

}
