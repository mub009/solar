<?php
  
class Dealsandoffers extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function index($Vendorusertypeid)
    {
        
     

        $query = $this->db->query("SELECT U.*,tbl_vendor.StoreName,tbl_vendor.latitude,tbl_vendor.longitude,tbl_products.Product FROM (SELECT tbl_deals_and_offer.ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,tbl_deals_and_offer.ID,tbl_deals_and_offer.VendorUserTypeId,'Product_Wise' as type, 1 AS KM ,tbl_deal_product_wise.ImagePath,tbl_deal_product_wise.details,tbl_deal_product_wise.Title,tbl_deal_product_wise.Discount,tbl_deal_product_wise.actualAmount  FROM `tbl_deals_and_offer` join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId join tbl_deal_product_wise on tbl_deal_product_wise.DealsAndOfferId=`tbl_deals_and_offer`.`id` where tbl_vendor.UserId='$Vendorusertypeid' and tbl_deal_product_wise.type='KM'

                            UNION

SELECT tbl_deals_and_offer.ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,B.ID,tbl_deals_and_offer.VendorUserTypeId,'Product_Wise' as type,0 AS KM ,0 as ImagePath,B.details,B.Title,B.Discount,B.actualAmount FROM `tbl_deals_and_offer`
 join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId  JOIN
tbl_deal_product_wise AS B on B.DealsAndOfferId=`tbl_deals_and_offer`.`id` AND tbl_vendor.UserId='$Vendorusertypeid' and B.type='CONTACT'

                             UNION


SELECT tbl_deals_and_offer.ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,tbl_deals_and_offer.ID,tbl_deals_and_offer.VendorUserTypeId,'Normal_Wise' as type,0 AS KM ,tbl_deal_normal_wise.ImagePath as ImagePath,tbl_deal_normal_wise.details,tbl_deal_normal_wise.Title,tbl_deal_normal_wise.Discount,tbl_deal_normal_wise.actualAmount FROM `tbl_deals_and_offer`  join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId  JOIN
tbl_deal_normal_wise  on tbl_deal_normal_wise.DealsAndOfferId=`tbl_deals_and_offer`.`id` AND tbl_vendor.UserId='$Vendorusertypeid' and tbl_deal_normal_wise.type='KM'


                                      UNION

                                      SELECT tbl_deals_and_offer.ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,tbl_deals_and_offer.ID,tbl_deals_and_offer.VendorUserTypeId,'Normal_Wise' as type, 1 AS KM ,tbl_deal_normal_wise.ImagePath,tbl_deal_normal_wise.details,tbl_deal_normal_wise.Title ,tbl_deal_normal_wise.Discount,tbl_deal_normal_wise.actualAmount FROM `tbl_deals_and_offer`  join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId join tbl_deal_normal_wise on tbl_deal_normal_wise.DealsAndOfferId=`tbl_deals_and_offer`.`id` where tbl_vendor.UserId='$Vendorusertypeid' and tbl_deal_normal_wise.type='CONTACT'

                                 ) AS U join tbl_vendor on tbl_vendor.UserId=U.VendorUserTypeId  left join tbl_products on tbl_products.ProductId=U.productId and  tbl_products.LanguageId='ENG1' ORDER by U.StartDate

");

   return $query->result_array();
 }

 

 public function tracking($OrderId)
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

