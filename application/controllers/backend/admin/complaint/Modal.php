<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Admin_Controller
{


    public function tracking($productrequestid)
    {

           $this->data['tracking'] = $this->Base_Model->query("SELECT `tbl_product_request_tracking`.`Details` as Details,`tbl_product_request_tracking`.`created_at` as created_at,tbl_product_request.ProductName as productname,tbl_product_request_tracking.StatusId as StatusId,tbl_user_type.MobileNo as mobileno,tbl_usertypemaster.UserType as UserType,tbl_status.Name as statusName FROM `tbl_product_request_tracking`  join tbl_product_request on tbl_product_request.ProductRequestId=`tbl_product_request_tracking`.`ProductRequestId` join tbl_status on tbl_status.id=tbl_product_request_tracking.StatusId  join tbl_user_type on tbl_user_type.UserId=tbl_product_request.UserId join tbl_usertypemaster on tbl_product_request.UserTypeId=tbl_usertypemaster.UserTypeId where `tbl_product_request`.id='" . $productrequestid . "' ");

            $this->load->view('backend/dealer/productrequest/modal/productrequesttracking', $this->data);
    }



    public function action($statusId,$ServiceId)
    {


        if(!empty($statusId)&&!empty($ServiceId))
        {


        $this->data['statusDetails'] = $this->Base_Model->select('tbl_status','*',array('Id'=>$statusId));
        
        $this->data['statusId']=$statusId;

        $this->data['ServiceId']=$ServiceId;

        $this->load->view('backend/admin/complaint/modal/action', $this->data);
       
        }
        else {

            echo "No Action";
        }
    }



}
