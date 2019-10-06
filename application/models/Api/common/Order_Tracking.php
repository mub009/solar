<?php
  
class Order_Tracking extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function index($OrderId)
    {
        
     

        $query = $this->db->query("SELECT tbl_orderstatus.OrderStatusName,tbl_order_tracking.orderstatusid,tbl_order_tracking.date_time,
        tbl_order.ExpectedDeliveryDate,tbl_order.ExpectedDeliveryTime,tbl_deliveryboy.Name 
        FROM tbl_order_tracking 
        join tbl_orderstatus on  tbl_orderstatus.OrderStatusId =tbl_order_tracking.orderstatusid
        join tbl_order on  tbl_order.OrderId=tbl_order_tracking.orderid 
        join tbl_deliveryboy on tbl_deliveryboy.UserId=tbl_order.DeliveryBoyId    
        WHERE tbl_order_tracking.orderid='$OrderId' ORDER BY 'ASC' ");
        return $query->result_array();
       
 }

 
}
