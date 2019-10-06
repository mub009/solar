<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobileverification extends API_Controller
{

    public function index()
    {


            $this->form_validation->set_rules('Mobile_Number', 'Mobile Number', 'required|regex_match[/^[0-9 +]+$/]');

            $this->form_validation->set_rules('CountryId', 'CountryId', 'required|regex_match[/^[0-9 +]+$/]');

            //validate form is true or false

            if ($this->form_validation->run() == true) {

                $MobileNumber = $this->input->post('Mobile_Number');

                $FCM_Token = $this->input->post('FCM_Token');

                $CountryId=$this->input->post('CountryId');

                
                if ($mobile_detail = $this->Base_Model->query("SELECT if(tbl_user_type.UserTypeId is null OR tbl_user_type.UserTypeId = '','',tbl_user_type.UserTypeId) as UserTypeId,if(tbl_user_type.StatusId is null OR tbl_user_type.StatusId = '','',tbl_user_type.StatusId) as StatusId,if(tbl_user_type.CountryId is null OR tbl_user_type.CountryId = '','',tbl_user_type.CountryId) as CountryId,if(tbl_user_type.OtpVerification is null OR tbl_user_type.OtpVerification = '','',tbl_user_type.OtpVerification) as OtpVerification,if(tbl_user_type.UserId is null OR tbl_user_type.UserId = '','',tbl_user_type.UserId) as UserId,if(tbl_user_type.MobileNo is null OR tbl_user_type.MobileNo = '','',tbl_user_type.MobileNo) as MobileNo,if(tbl_user_type.OtpVerification is null OR tbl_user_type.OtpVerification = '','',tbl_user_type.OtpVerification) as OtpVerification,if(tbl_usertypemaster.UserType is null OR tbl_usertypemaster.UserType = '','',tbl_usertypemaster.UserType) as UserTypeName FROM `tbl_user_type` join tbl_usertypemaster on tbl_usertypemaster.UserTypeId=tbl_user_type.UserTypeId where MobileNo='$MobileNumber' and tbl_user_type.CountryId='$CountryId'")) {

    
              
                    $flag = false;

                    if ($mobile_detail[0]['UserTypeName'] == 'CUSTOMER') {


                        $Detail = $this->Base_Model->query("SELECT tbl_user_type.UserTypeId as UserTypeId,tbl_user_type.StatusId as StatusId,tbl_user_type.CountryId as CountryId,tbl_user_type.UserId as UserMasterId, tbl_customer.CustomerId as UserId,tbl_address.BuildingDetails as BuildingDetails,tbl_address.StreetDetails as StreetDetails,tbl_address.Locality as Locality,tbl_address.State as State,tbl_address.City as City,tbl_address.PinCode as PinCode,tbl_address.Landmark as Landmark, tbl_customer.CustomerName  as Name,tbl_customer.ProfilePic as ProfilePic,tbl_customer.Contact1 as Contact1,tbl_customer.Contact2 as Contact2,tbl_customer.AreaCode as AreaCode,tbl_customer.Gender as Gender,tbl_customer.DOB as DOB,tbl_address.latitude as latitude ,tbl_address.longitude as longitude,tbl_user_type.StatusId as StatusId,tbl_customer.Email as Email,tbl_customer.FCMToken as FCMToken,tbl_user_type.MobileNo as MobileNo,tbl_user_type.OtpVerification as OtpVerification,tbl_usertypemaster.UserType as UserTypeName FROM tbl_user_type join tbl_usertypemaster on tbl_usertypemaster.UserTypeId = tbl_user_type.UserTypeId join tbl_customer on tbl_customer.UserId = tbl_user_type.UserId join tbl_address on tbl_address.AddressId = tbl_customer.AddressId where tbl_user_type.MobileNo ='$MobileNumber' and tbl_user_type.CountryId='$CountryId' limit 1");
              
                        $flag = true;

                        
                    }
                    
                    $UserId = $mobile_detail[0]['UserId'];

                    $this->Base_Model->query("UPDATE tbl_user_type SET FCM_Token = '$FCM_Token' WHERE UserId ='$UserId'", 'query');
                    
        
                    if ($flag) {

                        if ($mobile_detail[0]['OtpVerification'] == 2) {

                               
//ss
                           
                            $userinfo = array('OTP' => 1234, 'UserMasterId' => $mobile_detail[0]['UserId'], 'UserTypeId' => $mobile_detail[0]['UserTypeId'], 'OTP_Status' => 2,'auth'=>$this->auth($Detail[0]));

                            json_output(200, $userinfo);
                            

                        } else {


                    
                            if (!empty($Detail[0])) {

                                $userinfo=$Detail[0]+array('OTP_Status' =>1, 'OTP' => 1234,'auth'=>$this->auth($Detail[0]));
                                
                                json_output(200,$userinfo);

                               
                            } else {

                                json_output(400,'No Data Information here bz this is old account');

                            }

                        }
                    }else
                    {

                        json_output(400,array('msg'=>'Here No user'));



                    }

                } else {

                   
                  


                    if ($key = $this->Base_Model->insert('tbl_user_type', array('MobileNo' => $MobileNumber, 'UserTypeId' => 33, 'OtpVerification' => 2, 'StatusId' => 1,'CountryId'=>$CountryId, 'InsertDate' => $this->data['dateAndtime']))) {

                  //sss
                        //insert customer

                        $customer_id = $this->Base_Model->insert('tbl_customer', array('UserId' => $key));

              
                        $customer_key='FLCustomer1'.$customer_id;
                        //insert address

                        $address_id = $this->Base_Model->insert('tbl_address', array('UserId' => $key));

                        $address_key='FLaddress'.$address_id;

                        //update address table

                        $this->Base_Model->update('tbl_address', array('Id' => $address_id), array('UserId' => $key, 'AddressId' => $address_key));

                        //update customer table

                        $this->Base_Model->update('tbl_customer', array('Id' => $customer_id), array('CustomerId' => $customer_key, 'AddressId' => $address_key));

                       
                        $encrypt=array('CountryId'=>$CountryId,'UserId'=>$customer_key,'StatusId'=>1,'OtpVerification'=>1,'UserTypeId'=>$key,'UserMasterId'=>33);
                        
                        
                        json_output(200,array('OTP_Status' => 2, 'UserMasterId' => $key, 'UserTypeId' => 33,'auth'=>$this->authorization_token->GenerateToken($encrypt,$this->config->item('api_customer_jwt_key'),$this->config->item('api_jwt_algorithm'))));

                    }
                    else
                    {
                        json_output(400,'fail');
                    }


                }
            } else {
               

                json_output(400,$this->form_validation->error_array());

            }
        
    }
    
    public function update_user_fcm_token()
    {

        if (isset($_POST['Mobile_Number'])) {

            $this->form_validation->set_rules('UserId', 'UserId', 'required');
            $this->form_validation->set_rules('FCM_Token', 'FCM_Token', 'required');

            //validate form is true or false

            if ($this->form_validation->run() == true) {
                $UserId = $this->input->post('UserId');
                $FCM_Token = $this->input->post('FCM_Token');
                
                if($this->Base_Model->query("UPDATE tbl_user_type SET FCM_Token = '$FCM_Token' WHERE UserId ='$UserId'", 'query')){
                   json_output(200, array('status' => 'success')); 
                }else{
                    json_output(200, array('status' => 'fail')); 
                }
                
            } else {

                json_output(400, $this->form_validation->error_array());
            }
        }
    }

    public function auth($Userdetails)
    {


     $encrypt=array('CountryId'=>$Userdetails['CountryId'],'UserId'=>$Userdetails['UserId'],'StatusId'=>$Userdetails['StatusId'],'OtpVerification'=>$Userdetails['OtpVerification'],'UserTypeId'=>$Userdetails['UserMasterId'],'UserMasterId'=>$Userdetails['UserTypeId']);
       
        if($Userdetails['UserTypeId']=='22')
        {
                  //DEALER
           return $this->authorization_token->GenerateToken($encrypt,$this->config->item('api_dealer_jwt_key'),$this->config->item('api_jwt_algorithm'));
        }
      elseif($Userdetails['UserTypeId']=='33')
        {
                  //CUSTOMER
           return $this->authorization_token->GenerateToken($encrypt,$this->config->item('api_customer_jwt_key'),$this->config->item('api_jwt_algorithm'));
        }
        elseif($Userdetails['UserTypeId']=='44')
        {
                 //VENDOR
           return  $this->authorization_token->GenerateToken($encrypt,$this->config->item('api_vendor_jwt_key'),$this->config->item('api_jwt_algorithm'));
    
        }
        elseif($Userdetails['UserTypeId']=='55')
        {
            //SUPERVISOR

           return $this->authorization_token->GenerateToken($encrypt,$this->config->item('api_supervisor_jwt_key'),$this->config->item('api_jwt_algorithm'));
    
        }
        elseif($Userdetails['UserTypeId']=='66')
        {
             //THIRDPARTYDELIVERYBOY

            return $this->authorization_token->GenerateToken($encrypt,$this->config->item('api_deliveryboy_jwt_key'),$this->config->item('api_jwt_algorithm'));
    
        }
        elseif($Userdetails['UserTypeId']=='77')
        {
            //DELIVERYBOY

           return $this->authorization_token->GenerateToken($encrypt,$this->config->item('api_deliveryboy_jwt_key'),$this->config->item('api_jwt_algorithm'));
    
        }
        
    }

    public function logout()
    {

    }


    
   
}
