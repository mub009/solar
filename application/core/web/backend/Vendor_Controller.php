<?php

class Vendor_Controller extends MY_Controller
{

    public $data = array();

    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata('token'))) {

            redirect('common/login');

        } else {

            $DataInfo = $this->authorization_token->ValidateToken($this->session->userdata('token'),$this->config->item('web_token_key'),$this->config->item('web_jwt_algorithm'));


            if ($DataInfo['status'] == 1) {


                $LoginDetails=$this->Login_Modal->loginDetails($DataInfo['data']->userId);


                if ($LoginDetails['usermaster'] == 44 && $LoginDetails['status'] ==1) {

                    $this->data['user_id'] = $LoginDetails['user_id'];

                    $this->data['InsertBy'] = $LoginDetails['InsertBy'];

                    $this->data['userinfo'] = $LoginDetails;
                    
                    $this->data['loyalty_privilege']=$this->VendorSystemSettings->get_loyalty_privilege($this->data['user_id']);
       

                    $this->_VendorPrivilegePermission();

                    $this->data['vendor'] = $this->Base_Model->select('tbl_vendor', $data = '*', $where = array('UserId' => $this->data['user_id']));

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

    public function template($page = null)
    {
        $this->data['personal_info_updation']=$this->Base_Model->query("SELECT * FROM tbl_vendor join tbl_address on tbl_address.AddressId=tbl_vendor.AddressId
        where tbl_vendor.UserId='".$this->data['user_id']."'",'row_array');
     
        $this->data['change_profile'] = $this->Base_Model->select(self::tbl_vendor, '*', array('UserId' => $this->data['user_id']));
        $this->r_notification();

        $this->load->view('template/vendor/_include/header', $this->data);

        $this->load->view('template/vendor/_include/header_menu');

        $this->load->view('template/vendor/_include/side_menubar', $this->data);

        $this->load->view('template/vendor/_include/notification');

        $this->load->view('template/vendor/_include/modal');

        $this->load->view('backend/vendor/' . $page, $this->data);

        $this->load->view('template/vendor/_include/footer');

    }

    public function orderitem()
    {

        $this->data['order'] = $this->Base_Model->query("select tbl_orderproduct.Id as orderdetailsId , tbl_orderproduct.GenarateProductListId as ProductId, tbl_products.Product as Name, tbl_unitmaster.Unit as Unit, Quantity, tbl_orderproduct.Price, Total, Tax,tbl_orderproduct.isOrder as isOrder, tbl_orderproduct.Discount as Discount,tbl_orderproduct.OrderProductId as OrderProductId,ImagePath from tbl_orderproduct join tbl_generateproductlist on tbl_orderproduct.GenarateProductListId = tbl_generateproductlist.GenerateProductListId join tbl_products on tbl_products.ProductId=tbl_generateproductlist.ProductId join tbl_unitmaster on tbl_unitmaster.Id=tbl_orderproduct.UnitMasterId where tbl_orderproduct.OrderId ='" . $this->data['OrderId'] . "' and tbl_products.LanguageId='ENG1'");

        $this->data['orderlist'] = $this->Base_Model->query("SELECT * FROM `tbl_order` join tbl_address on tbl_address.AddressId=tbl_order.DeliveryAddressId where  OrderId='" . $this->data['OrderId'] . "'", 'row_array');

        $this->data['unit'] = $this->Base_Model->query('SELECT * FROM `tbl_unitmaster` where 	StatusId!=3');

        $this->data['taxmaster'] = $this->Base_Model->query('SELECT * FROM `tbl_taxmaster` where 	StatusId!=3');

        if (!empty($this->data['orderlist']['DeliveryBoyType'])) {
            if ($this->data['orderlist']['DeliveryBoyType'] == '77') {

                $this->data['DeliveryTypeBoyList'] = $this->Base_Model->select('tbl_user_type', '*', $where = array('InsertBy' => $this->data['user_id'], 'UserTypeId' => 77), $order_desc = null, $order_asc = null, $limit = null, $start = null, 'result_array');

            } elseif ($this->data['orderlist']['DeliveryBoyType'] == '66') {

                $this->data['DeliveryTypeBoyList'] = $this->Base_Model->select('tbl_user_type', '*', $where = array('InsertBy' => $this->data['InsertBy'], 'UserTypeId' => 66), $order_desc = null, $order_asc = null, $limit = null, $start = null, 'result_array');

            }
        }

        $this->template('order/productlist', $this->data);

    }

    public function action()
    {

        foreach ($_POST['OrderProductId'] as $key => $row) {

            $OrderItem = array('Quantity' => $_POST['Quantity'][$key], 'Tax' => $_POST['Tax'][$key], 'Discount' => $_POST['Discount'][$key], 'Price' => $_POST['Price'][$key], 'Total' => $_POST['total'][$key], 'isOrder' => $_POST['order'][$key]);

            $this->Base_Model->update('tbl_orderproduct', array('OrderProductId' => $row), $OrderItem);

        }

        $Order = array('TotalAmount' => $this->input->post('GrandTotal'), 'OrderStatusId' => $this->input->post('orderstatus'), 'DeliveryBoyType' => $this->input->post('deliveryboytype'), 'DeliveryBoyId' => $this->input->post('deliveryId'), 'DeliveredDate' => $this->input->post('deliverytimedate'));

        if ($this->Base_Model->update('tbl_order', array('OrderId' => $this->input->post('orderid')), $Order)) {

            echo json_encode('success');


            $orderstatus= $this->Base_Model->select('tbl_orderstatus', '*', array('OrderStatusId' => $this->input->post('orderstatus')));

            $this->session->set_flashdata('success', 'Successfully created '.$orderstatus['OrderStatusName'].' ');

        } else {

            echo json_encode('error');

        }

    }

    public function deliverytypeboy()
    {

        if ($this->input->post('DeliveryBoy') == '77') {

            $this->data['DeliveryTypeBoy'] = $this->Base_Model->select('tbl_user_type', '*', $where = array('InsertBy' => $this->data['user_id'], 'UserTypeId' => 77), $order_desc = null, $order_asc = null, $limit = null, $start = null, 'result_array');

        } elseif ($this->input->post('DeliveryBoy') == '66') {

            $this->data['DeliveryTypeBoy'] = $this->Base_Model->select('tbl_user_type', '*', $where = array('InsertBy' => $this->data['InsertBy'], 'UserTypeId' => 66), $order_desc = null, $order_asc = null, $limit = null, $start = null, 'result_array');

        }

        $this->load->view('core/backend/vendor/deliveryboy', $this->data);

    }

    public function _VendorPrivilegePermission()
    {

        $VendorPrivilege = $this->Base_Model->select('tbl_usertypemaster', $data = '*', $where = array('UserTypeId' => 44));

        $this->data['VendorPrivilege'] = json_decode($VendorPrivilege['permission']);
    }

}
