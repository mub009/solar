<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Profile information
 *
 * @author: mubashir
 *
 * @version: 1.0.0
 *
 * @extends:Admin_Controller
 *
 */

class Profile extends Admin_Controller
{

    /**
     *  Profile Title name
     * @var String
     */

    protected $title_name;

    /**
     * Profile Nav Bar Link
     * @var array
     */

    protected $title_nav_bar = array();

    /**
     * Stored in Admin Details
     * @var Array
     */

    protected $admin_details = array();

    /**
     * Set const value in tbl_settings;
     * @var string const
     */

    const tbl_settings = 'tbl_settings';

    /**
     * Set const value in tbl_admin;
     * @var string const
     */

    const tbl_admin = 'tbl_admin';

    /**
     * Set Flag value default 0 ->false ;
     * @var int
     */

    protected $flag = 0;

    /**
     * user information;
     * @var array;
     */

    protected $userinfo = array();

    // /**
    //  * dashboard config
    //  */

    //  protected $siteconfig=array();

    public function __construct()
    {
        parent::__construct();

        /**
         * Assign title value
         */

        $this->title_name = 'Profile';

        /**
         * Assign title nav bar value
         */

        $this->title_nav_bar = array('home' => 'admin/dashboard');

        // $this->siteconfig=array('id' => 0);

    }

    public function index()
    {
        

        $this->data['title_nav_bar'] = $this->title_nav_bar;

        $this->data['title'] = $this->title_name;
        //$this->DashboardImage();

        $this->data['config'] = $this->Base_Model->select(self::tbl_settings, '*', array('UserId' => $this->data['user_id']));

        
        /** load template */

        $this->data['personal_info_updation'] = $this->Base_Model->select(self::tbl_admin, '*', array('UserId' => $this->data['user_id']));


        $this->template('profile', $this->data);

    }

/**
 * @func update dashboard config
 * @param no param
 * @return no return
 */

    /**
     * @func personal info updation
     * @param no param
     */

    public function personal_info_updation()
    {

        /**
         * form validation data
         */
        $this->form_validation->set_rules('FirstName', 'FirstName', 'required|regex_match[/^[a-z A-Z . , ]+$/]');

        $this->form_validation->set_rules('LastName', 'LastName', 'required|regex_match[/^[0-9 a-z A-Z . , ]+$/]');

        $this->form_validation->set_rules('MobileNumber', 'Mobile Number', 'required|regex_match[/^[0-9 +]+$/]');

        $this->form_validation->set_rules('Interests', 'Interests', 'required|regex_match[/^[0-9 a-z A-Z . , ,]+$/]');

        $this->form_validation->set_rules('Occupation', 'Occupation', 'required|regex_match[/^[0-9 a-z A-Z . , ]+$/]');

        $this->form_validation->set_rules('About', 'About', 'required|regex_match[/^[a-z A-Z . , ]+$/]');

        $this->form_validation->set_rules('WebsiteUrl', 'WebsiteUrl', 'required|regex_match[/^[0-9 a-z A-Z .]+$/]');

        /**
         *  form validate is true or false
         */

        if ($this->form_validation->run() == true) {

            $this->admin_details = array(
                'FirstName'    => $this->input->post('FirstName'),
                'LastName'     => $this->input->post('LastName'),
                'MobileNumber' => $this->input->post('MobileNumber'),
                'Interests'    => $this->input->post('Interests'),
                'Occupation'   => $this->input->post('Occupation'),
                'About'        => $this->input->post('About'),
                'WebsiteUrl'   => $this->input->post('WebsiteUrl'),
            );

            /**
             * @func checking data is exists
             * @param usertypeid ->read from Global variable
             * @param tablename with column
             * @return true or false
             */

            if ($this->data_checking($this->data['user_id'], 'tbl_admin.UserId')) {

                if ($this->Base_Model->update(self::tbl_admin, array('UserId' => $this->data['user_id']), $this->admin_details)) {
                    $this->session->set_flashdata('success', 'Successfully Your Profile');
                    $this->flag = 1;
                } else {
                    $this->flag = 0;
                }

            } else {

               

                if ($this->Base_Model->insert(self::tbl_admin, $this->admin_details + array('UserId' => $this->data['user_id']))) {
                   
                    $this->session->set_flashdata('success', 'Successfully Your Profile');
                    $this->flag = 1;

                } else {
                    $this->flag = 0;
                }
            }
        } else {

            /** Error occur in form validation */
            $this->flag = 3;

        }

        if ($this->flag == 1) {
            json_output(200, 'success');
        } else {

            if ($this->flag == 3) {

                json_output(400, $this->form_validation->error_array());

            } else {

                json_output(400, 'fail');

            }

        }
    }

    /**
     * @func change password
     * @param no param
     */

    public function change_password()
    {
        /**
         * form validation data
         */
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

        $this->form_validation->set_rules('new_password', 'New Password', 'required|regex_match[/^[0-9 a-zA-Z]+$/]');

        $this->form_validation->set_rules('re_type_password', 'Confirm Password', 'required|matches[new_password]|regex_match[/^[0-9 a-zA-Z]+$/]');

        /**
         * form validate is true or false
         */

        if ($this->form_validation->run() == true) {

            $this->userinfo = $this->System_Model->ReadUserTypeIdDetails($this->data['userinfo']['user_id']);

            /**
             *@func password_verify() is inbuilt function in php and compare database value and input value
             *@param input value
             *@param database value
             *@return  not match return false -> 0 and match return true ->1
             * */

            if (password_verify($this->input->post('current_password'), $this->userinfo['Password'])) {

                $this->admin_details = array(
                    'Password' => $this->_passwordhash($this->input->post('re_type_password')),
                );

                if ($this->Base_Model->update('tbl_user_type', array('UserId' => $this->data['user_id']), $this->admin_details)) {

                    $this->session->unset_userdata('token');

                    $this->session->set_flashdata('success', 'Successfully Your Profile');

                    json_output(200, 'success');

                    redirect('common/login');

                } else {
                    json_output(400, 'Database Problem');

                }

            }
            else
            {
                json_output(400, array('current_password'=>'Old password does not match'));
            }

        } else {

            json_output(400, $this->form_validation->error_array());
        }
    }
    public function change_profile()
    {
        /**
         * @func do_upload is CI inbuilt upload function
         * @param input file name
         * @return if file not upload in server then return false -> 0 or file upload success then return -> 1
         */

       
       
         $this->image->ImageConfig();

        
        if ($this->upload->do_upload('profilepic')) {

            $imageInformation = $this->upload->data();

            $this->image->image_cropping($imageInformation);

            /**
             * @func data is CI inbuilt upload details function
             * @param no param
             * @return upload of details////
             */

            $data = array('upload_data' => $this->upload->data());

            //$imageInformation['file_name']

            $this->admin_details = array('ProfilePic' => $imageInformation['file_name']);

            /**
             * @func checking data is exists
             * @param usertypeid
             * @param tablename with column
             * @return true or false
             */

            if ($this->Base_Model->update('tbl_admin', array('UserId' => $this->data['user_id']), $this->admin_details)) {

                $this->session->set_flashdata('success', 'Successfully Your Profile');

                $this->flag = 1;

            } else {

                $this->flag = 0;
            }

        } else {
            $this->flag = 3;

        }

        if ($this->flag) {

            if (3 == $this->flag) {

                json_output(400, $this->upload->display_errors());
            } else {
                json_output(200, 'success');
            }
        } else {
            json_output(400, 'fail');
        }

    }

    // function config_update()
    // {

    //     $this->form_validation->set_rules('DashboardHeight', 'DashboardHeight', 'required|regex_match[/^[0-9 a-z A-Z %]+$/]');

    //     $this->form_validation->set_rules('DashboardWidth', 'DashboardWidth', 'required|regex_match[/^[0-9 a-z A-Z %]+$/]');

    //     $this->form_validation->set_rules('DashboardPadding', 'DashboardPadding', 'required|regex_match[/^[0-9 a-z A-Z %]+$/]');
    //     // json_output(200,'check');

    //     if ($this->form_validation->run() == true)
    //     {

    //         if(!empty($_FILES['DashboardImage']))
    //         {

    //             $imagename=$this->image->DashboardImage();

    //             $this->load->library('upload', $imagename);

    //             if ($this->upload->do_upload('DashboardImage'))

    //             if ($this->upload->do_upload('')) {

    //                 /**
    //                  * @func data is CI inbuilt upload details function
    //                  * @param no param
    //                  * @return upload of details
    //                  */
    //                 // $data = array('upload_data' => $this->upload->data());

    //                 // $this->admin_details= array('DashboardImagePath' => 'assets/upload/image/DashboardImagePath/' . $data['upload_data']['file_name']);

    //                    /**
    //                      * @func checking data is exists
    //                      * @param usertypeid
    //                      * @param tablename with column
    //                      * @return true or false
    //                      */

    //                     if ($this->Base_Model->update('tbl_settings',array('UserId' => $this->data['user_id']), $this->admin_details)) {

    //                         $this->flag = 1;

    //                     } else {

    //                         $this->flag = 0;
    //                     }

    //            }
    //            else
    //            {
    //             $this->flag=3;

    //            }

    //     }

    //     $this->admin_details+= array('DashboardHeight' =>$this->input->post('DashboardHeight'),'DashboardWidth' =>$this->input->post('DashboardWidth'),'DashboardPadding'=>$this->input->post('DashboardPadding'));

    //      if ($this->Base_Model->update('tbl_settings',array('UserId' => $this->data['user_id']), $this->admin_details)) {

    //         $this->flag = 1;

    //     } else {

    //         $this->flag = 0;
    //     }
    // } else {

    //     $this->flag==4;
    // }

    //     if($this->flag) {

    //         if($this->flag==3)
    //         {

    //             json_output(400,$this->upload->display_errors());
    //         }
    //         elseif($this->flag==4)
    //         {

    //             json_output(400,$this->form_validation->error_array());

    //         }
    //         else
    //         {
    //         json_output(200, 'success');
    //         }
    //     } else {

    //         json_output(400, 'fail');
    //     }

    // }

    public function config_Update()
    {

        $this->form_validation->set_rules('DashboardHeight', 'DashboardHeight', 'required');

        $this->form_validation->set_rules('DashboardWidth', 'DashboardWidth', 'required');

        $this->form_validation->set_rules('DashboardPadding', 'DashboardPadding', 'required');

        if ($this->form_validation->run() == true) {

            $this->image->ImageConfig();

            if(isset($_FILES['DashboardImage']))
            {

            

            if ($this->upload->do_upload('DashboardImage')) {

                $imageInformation = $this->upload->data();

                $this->image->image_cropping($imageInformation);

                $this->admin_details = array('DashboardImagePath' => $imageInformation['file_name'],'DashboardWidth'=>$this->input->post('DashboardWidth'),'DashboardHeight'=>$this->input->post('DashboardHeight'),'DashboardPadding'=>$this->input->post('DashboardPadding'));
            }
            else
            {
                $this->admin_details = array('DashboardWidth'=>$this->input->post('DashboardWidth'),'DashboardHeight'=>$this->input->post('DashboardHeight'),'DashboardPadding'=>$this->input->post('DashboardPadding'));
            }

                if ($this->Base_Model->update('tbl_settings', array('UserId' => $this->data['user_id']), $this->admin_details)) {

                    $this->session->set_flashdata('success', 'Successfully Your Profile');

                    $this->flag = 1;

                } else {

                    $this->flag = 0;
                }

                

            } else {
                //image upload error
                json_output(400, $this->upload->display_errors());
            }

        } else {

            //form validation error
            json_output(400, $this->form_validation->error_array());
        }


        if($this->flag)
        {
            json_output(200, 'success');
        }
        else
        {
            json_output(201, 'fail');
        }
    }

}
