<?php

class ProductPriceListModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function index($UserTypeId, $GenerateProductListId, $subcategory)
    {

        $query = $this->db->query("
        SELECT  distinct(tbl_generateproductlistdetails.id), tbl_generateproductlistdetails.id as id,tbl_generateproductlist.GenerateProductListId as GenerateProductListId,tbl_taxmaster.TaxValue as taxPercentage,tbl_generateproductlistdetails.Discount as DiscountPercentage,tbl_generateproductlist.commission as commissionPercentage,tbl_generateproductlist.isCommissionInclude as isCommissionInclude,tbl_vendor.isTaxInclude as isTaxInclude,tbl_unitmaster.Unit as UnitName,tbl_unitmaster.id as UnitMasterId,tbl_generateproductlistdetails.price as price,tbl_generateproductlistdetails.Discount as Discount,tbl_generateproductlistdetails.qty as qty,tbl_products.ProductId AS ProductId,tbl_generateproductlist.Tick as Tick,

                  CASE

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN (tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100))-((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100)))*tbl_generateproductlist.commission/100))*tbl_taxmaster.TaxValue/100

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN ((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))*tbl_taxmaster.TaxValue/100)

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN (tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))*tbl_taxmaster.TaxValue/100

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN ((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))*tbl_taxmaster.TaxValue/100)

   END as TaxAmount,

   CASE

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN ((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100)))*tbl_generateproductlist.commission/100)

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN ((tbl_generateproductlistdetails.price-tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))*tbl_taxmaster.TaxValue/100)))*tbl_generateproductlist.commission/100

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN (tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))*tbl_generateproductlist.commission/100

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100

   END as CommissionAmount,

   CASE

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100)


   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN (tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100)

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN ((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))*tbl_taxmaster.TaxValue/100))*tbl_generateproductlistdetails.Discount/100


   END as Discount,

   CASE

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN tbl_generateproductlistdetails.price-(((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100))-((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100)))*tbl_generateproductlist.commission/100))*tbl_taxmaster.TaxValue/100)+(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100))+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100)))*tbl_generateproductlist.commission/100))

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN tbl_generateproductlistdetails.price

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN tbl_generateproductlistdetails.price-((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))*tbl_taxmaster.TaxValue/100+(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100)

   END as ProductCost,

   CASE

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN tbl_generateproductlistdetails.price+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))*tbl_taxmaster.TaxValue/100)

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN tbl_generateproductlistdetails.price

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN ((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))*tbl_taxmaster.TaxValue/100))

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN tbl_generateproductlistdetails.price-((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100)))*tbl_generateproductlist.commission/100)

   END as ActualPrice,

   CASE

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN tbl_generateproductlistdetails.price-tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))*tbl_taxmaster.TaxValue/100)

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'NO' THEN (tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlistdetails.Discount/100))

   WHEN tbl_vendor.isTaxInclude = 'NO' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN (((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))*tbl_taxmaster.TaxValue/100)))-((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*tbl_generateproductlist.commission/100))*tbl_taxmaster.TaxValue/100))*tbl_generateproductlistdetails.Discount/100

   WHEN tbl_vendor.isTaxInclude = 'YES' AND tbl_generateproductlist.isCommissionInclude = 'YES' THEN  tbl_generateproductlistdetails.price-((tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100))+((tbl_generateproductlistdetails.price-(tbl_generateproductlistdetails.price*(tbl_generateproductlistdetails.Discount/100)))*tbl_generateproductlist.commission/100))

  END as SellPrice

                FROM  `tbl_itemtemplate`


                LEFT JOIN tbl_generateproductlist on tbl_generateproductlist.ProductId=tbl_itemtemplate.ProductId and tbl_generateproductlist.VendorUserTypeId='" . $UserTypeId . "' and tbl_generateproductlist.commission is NOT null

                join tbl_products on tbl_products.ProductId=tbl_itemtemplate.ProductId

                join tbl_taxmaster on tbl_taxmaster.Id=tbl_generateproductlist.TaxmasterId

                join tbl_subcategory on tbl_subcategory.SubCategoryId=tbl_products.SubcategoryId

                join tbl_category on tbl_category.CategoryId=tbl_products.CategoryId

                JOIN tbl_generateproductlistdetails on tbl_generateproductlistdetails.GenerateProductListId=tbl_generateproductlist.GenerateProductListId

                JOIN tbl_vendor on tbl_vendor.UserId=tbl_generateproductlist.VendorUserTypeId

                join tbl_unitmaster on tbl_unitmaster.Id=tbl_generateproductlistdetails.UnitMasterId

                where tbl_products.LanguageId='ENG1' and tbl_category.LanguageId='ENG1' and tbl_subcategory.LanguageId='ENG1' and tbl_itemtemplate.Tick='on' and tbl_generateproductlist.Tick='on'  and tbl_generateproductlistdetails.StatusId!=3  and tbl_generateproductlistdetails.GenerateProductListId='" . $GenerateProductListId . "'
                and tbl_generateproductlist.Tick='on' " . $val = ($subcategory == 'offer') ? "and Discount>0" : '' . " ");

        return $query->result_array();

    }

}
