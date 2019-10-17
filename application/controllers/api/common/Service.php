<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends API_Controller
{

    public function index()
    {

        $servicelist = $this->Base_Model->query("SELECT `tbl_products`.`Product` as `ProductName`, `tbl_products`.`Id` as `Id`, `tbl_products`.`StatusId` as `StatusId`, `tbl_products`.`ImagePath` as `ImagePath`, `tbl_category`.`CategoryName` as `CategoryName`, `tbl_subcategory`.`SubcategoryName` as `SubCategoryName` FROM `tbl_products` JOIN `tbl_category` ON `tbl_category`.`CategoryId`=`tbl_products`.`CategoryId` JOIN `tbl_subcategory` ON `tbl_subcategory`.`SubCategoryId`=`tbl_products`.`SubcategoryId` WHERE `tbl_products`.`LanguageId` = 'eng1' AND `tbl_products`.`StatusId` != 3 AND `tbl_category`.`LanguageId` = 'ENG1' AND `tbl_subcategory`.`LanguageId` = 'ENG1'");

        json_output(200, $servicelist);

    }

}
