<?php

class Dealsandoffer extends CI_Model
{

 public function __construct()
 {

  parent::__construct();

  $this->load->database();
 }

 public function index($lat, $long, $CurrentDate, $Customerusertypeid)
 {

    // echo $CurrentDate;
    // die();
  $query = $this->db->query("SELECT U.*,tbl_vendor.storeprofile,tbl_address.StreetDetails,tbl_vendor.Contact1,tbl_vendor.StoreName,tbl_vendor.latitude,tbl_vendor.longitude,if(tbl_products.Product is null OR tbl_products.Product = '','',tbl_products.Product) as Product FROM (SELECT tbl_deals_and_offer.ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,tbl_deals_and_offer.ID,tbl_deals_and_offer.VendorUserTypeId,'Product_Wise' as type, 1 AS KM ,tbl_deal_product_wise.ImagePath,tbl_deal_product_wise.details,tbl_deal_product_wise.Title,tbl_deal_product_wise.Discount,tbl_deal_product_wise.actualAmount  FROM `tbl_deals_and_offer` join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId join tbl_deal_product_wise on tbl_deal_product_wise.DealsAndOfferId=`tbl_deals_and_offer`.`id` and tbl_deal_product_wise.kilometre >(SELECT
  (
    3959 * acos (
      cos ( radians($lat) )
      * cos( radians( tbl_vendor.latitude ) )
      * cos( radians( tbl_vendor.longitude ) - radians($long) )
      + sin ( radians($lat) )
      * sin( radians( tbl_vendor.latitude  ) )
    )
  ) AS distance
FROM tbl_deal_product_wise where tbl_deal_product_wise.DealsAndOfferId=tbl_deals_and_offer.id)

                            UNION

SELECT tbl_deals_and_offer.ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,B.ID,tbl_deals_and_offer.VendorUserTypeId,'Product_Wise' as type,0 AS KM ,0 as ImagePath,B.details,B.Title,B.Discount,B.actualAmount FROM `tbl_deals_and_offer`
 join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId  JOIN
tbl_deal_product_wise AS B on B.DealsAndOfferId=`tbl_deals_and_offer`.`id` AND CustomerUsertypeId='$Customerusertypeid'

                             UNION


SELECT '' as ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,tbl_deals_and_offer.ID,tbl_deals_and_offer.VendorUserTypeId,'Normal_Wise' as type,0 AS KM ,0 as ImagePath,tbl_deal_normal_wise.details,tbl_deal_normal_wise.Title,tbl_deal_normal_wise.Discount,tbl_deal_normal_wise.actualAmount FROM `tbl_deals_and_offer`  join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId  JOIN
tbl_deal_normal_wise  on tbl_deal_normal_wise.DealsAndOfferId=`tbl_deals_and_offer`.`id` AND CustomerUsertypeId='$Customerusertypeid'


                                      UNION

                                      SELECT '' as ProductId,tbl_deals_and_offer.StartDate,tbl_deals_and_offer.ExpireDate,tbl_deals_and_offer.ID,tbl_deals_and_offer.VendorUserTypeId,'Normal_Wise' as type, 1 AS KM ,tbl_deal_normal_wise.ImagePath,tbl_deal_normal_wise.details,tbl_deal_normal_wise.Title ,tbl_deal_normal_wise.Discount,tbl_deal_normal_wise.actualAmount FROM `tbl_deals_and_offer`  join tbl_vendor on `tbl_deals_and_offer`.`VendorUserTypeId`=tbl_vendor.UserId join tbl_deal_normal_wise on tbl_deal_normal_wise.DealsAndOfferId=`tbl_deals_and_offer`.`id` and tbl_deal_normal_wise.kilometre >(SELECT
 (
    3959 * acos (
      cos ( radians($lat) )
      * cos( radians( tbl_vendor.latitude ) )
      * cos( radians( tbl_vendor.longitude ) - radians($long) )
      + sin ( radians($lat) )
      * sin( radians( tbl_vendor.latitude  ) )
    )
  ) AS distance
FROM tbl_deal_normal_wise where tbl_deal_normal_wise.DealsAndOfferId=tbl_deals_and_offer.id)



                                 ) AS U join tbl_vendor on tbl_vendor.UserId=U.VendorUserTypeId  left join tbl_products on tbl_products.ProductId=U.productId and  tbl_products.LanguageId='ENG1' join tbl_address on tbl_address.AddressId=tbl_vendor.AddressId where date(U.StartDate) <= date('".$CurrentDate."') and date(U.ExpireDate) >=date('".$CurrentDate."')  ORDER by U.StartDate Desc 

");

  return $query->result_array();
 }

}
