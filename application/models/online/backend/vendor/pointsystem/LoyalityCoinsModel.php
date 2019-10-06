<?php

class LoyalityCoinsModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        
    }

    public function getcoins($value)
    {

        $this->db->trans_begin();
        $flag=false;
        
        $VendorLoyalityConfig = $this->VendorSystemSettings->loyalityconfig($value['VendorUserTypeId']);

        $CountryLoyalityConfig = $this->System_Model->ReadCountryAdminDetails($value['CountryId']);

        if ($VendorLoyalityConfig['MinimumPurchase'] <= $value['PurchaseAmount']) {

            if ($CustomerDetails = $this->System_Model->ReadUserTypeDetails($value['CustomerMobile'], $this->data['userinfo']['CountryId'], 33)) {

                $commissionAmount = ($value['PurchaseAmount'] * $VendorLoyalityConfig['VendorCommissionPercentage'] / 100);

                $TotalCurrencyPoint = (int) (($value['PurchaseAmount']) / $VendorLoyalityConfig['Currency']);

                $GotPoint = $TotalCurrencyPoint * $VendorLoyalityConfig['PointValue'];

                $CustomerPointCr = (int) $GotPoint;

                $VendorPointDr =  ((($GotPoint/$CountryLoyalityConfig['PointRate'])*$CountryLoyalityConfig['CurrencyRate'] + $commissionAmount) * -1);

                $CountryPointCr =  (($GotPoint/$CountryLoyalityConfig['PointRate'])*$CountryLoyalityConfig['CurrencyRate'] + $commissionAmount);

                $pointvalueincurrency=(($GotPoint/$CountryLoyalityConfig['PointRate'])*$CountryLoyalityConfig['CurrencyRate']);
                
                $LoyalityLedgerPosting = array(
                    'VendorUserTypeId' => $VendorLoyalityConfig['UserTypeId'],
                    'CustomerUserTypeId' => $CustomerDetails['UserId'],
                    'CountryAdminUserTypeId' => $CountryLoyalityConfig['UserId'],
                    'InvoiceNo' => $value['InvoiceNo'],
                    'PointRate' => $VendorLoyalityConfig['PointValue'],
                    'InvoiceAmount' => $value['PurchaseAmount'],
                    'R/S' => 'S',
                    'Points' => $GotPoint,
                    'PointRateInCurrency' => $VendorLoyalityConfig['Currency'],
                    'CurrencyId' => $CustomerDetails['CurrencyId'],
                    'CountryId' => $CustomerDetails['CountryId'],
                    'VendorCash' => $VendorPointDr,
                    'CustomerPoint' => $CustomerPointCr,
                    'CountryAdminCash' => $CountryPointCr,
                    'CommissionInAmount' => $commissionAmount,
                    'currency' =>$pointvalueincurrency,
                    'CreatedDate'=>$value['dateandtime']
                    

                );



                if ($transactionId = $this->Base_Model->insert('tbl_LoyalityLedger', $LoyalityLedgerPosting, $key = 'trans', $key_colum_name = 'TransactionId')) {

                    $AdminCurrentAmount = $this->AdminSystemModel->CurrentBalance($CountryLoyalityConfig['UserId']);

                    $flag = true;
                    $CountryAdminLedgerPosting = array(
                        'TransactionId' => $transactionId,
                        'CrorDr' => 'Cr',
                        'Amount' => $CountryPointCr,
                        'CurrentBalance' => $AdminCurrentAmount['Amount'] + $CountryPointCr,
                        'CurrencyId' => $CustomerDetails['CurrencyId'],
                        'CountryId' => $CustomerDetails['CountryId'],
                        'CountryAdminCommissionAmount' => $commissionAmount,
                        'VendorUserTypeId ' => $VendorLoyalityConfig['UserTypeId'],
                        'AdminUsertypeId' => $CountryLoyalityConfig['UserId'],
                        'CountryAdminCommissionPercentage' => $VendorLoyalityConfig['VendorCommissionPercentage'],
                        'CreatedDate'=>$value['dateandtime']
                    );

                    if ($this->Base_Model->insert('tbl_LoyalityCountryAdminLedger', $CountryAdminLedgerPosting)) {

                        $VendorCurrentAmount = $this->VendorSystemSettings->CurrentBalance($VendorLoyalityConfig['UserTypeId']);

                        $flag = true;
                        //VendorPosting
                        $VendorLedgerPosting = array(
                            'TransactionId' => $transactionId,
                            'CrOrDr' => 'Dr',
                            'Amount' => $VendorPointDr,
                            'CurrentBalance' => $VendorCurrentAmount['Amount'] + $VendorPointDr,
                            'CurrencyId' => $CustomerDetails['CurrencyId'],
                            'CountryId' => $CustomerDetails['CountryId'],
                            'VendorUserTypeId' => $VendorLoyalityConfig['UserTypeId'],
                            'CountryAdminCommissionAmount' => $commissionAmount,
                            'CountryAdminUserTypeId' => $CountryLoyalityConfig['UserId'],
                            'CreatedDate'=>$value['dateandtime']
                        );

                        if ($this->Base_Model->insert('tbl_LoyalityVendorLedger', $VendorLedgerPosting)) {

                            $flag = true;
                            $CustomerCurrentPoint = $this->CustomerSystemModel->CurrentBalance($CustomerDetails['UserId']);

                            $CustomerLedgerPosting = array(
                                'TransactionId' => $transactionId,
                                'CrOrDr' => 'Cr',
                                'Points' => $CustomerPointCr,
                                'CurrentBalance' => $CustomerCurrentPoint['Points'] + $CustomerPointCr,
                                'CurrencyId' => $CustomerDetails['CurrencyId'],
                                'CountryId' => $CustomerDetails['CountryId'],
                                'VendorUserTypeId' => $VendorLoyalityConfig['UserTypeId'],
                                'CustomerUserTypeId' => $CustomerDetails['UserId'],
                                'CountryAdminUserTypeId' => $CountryLoyalityConfig['UserId'],
                                'CreatedDate'=>$value['dateandtime']
                            );

                            if ($this->Base_Model->insert('tbl_LoyalityCustomerLedger', $CustomerLedgerPosting)) {

                                $flag = array('points'=>$CustomerPointCr);

                            }
                        } else {

                            $flag = false;
                        }
                    } else {

                        $flag = false;
                    }
                } else {

                    $flag = false;
                }

            } else {

                $flag = false;
            }

        }

        if ($flag) {

            $this->db->trans_commit();

            return $flag;

        } else {
            $this->db->trans_rollback();

            return $flag;
        }
    }

    public function redeemcoins($value)
    {

        $this->db->trans_begin();

        $VendorLoyalityConfig = $this->VendorSystemSettings->loyalityconfig($value['VendorUserTypeId']);

        $CountryLoyalityConfig = $this->System_Model->ReadCountryAdminDetails($value['CountryId']);

        if ($CustomerDetails = $this->System_Model->ReadUserTypeDetails($value['CustomerMobile'], $value['CountryId'], 33)) {

            $CustomerGetLastPointData = $this->CustomerSystemModel->GetLastPointData($CustomerDetails['UserId']);

            if ($CountryLoyalityConfig['PurchasePoint'] <= $CustomerGetLastPointData['CurrentBalance'] && $CustomerGetLastPointData['CurrentBalance'] >= $value['CustomerPoint']) {

                $valueofpoints = (int) ($value['CustomerPoint'] / $CountryLoyalityConfig['PointRate']);

                $CustomerPointDr = (int) $value['CustomerPoint'] * -1;

                $VendorPointCr = $valueofpoints * $CountryLoyalityConfig['CurrencyRate'];

                $CountryPointDr = (int) $VendorPointCr * -1;
                
                $pointvalueincurrency=(($value['CustomerPoint']/$CountryLoyalityConfig['PointRate'])*$CountryLoyalityConfig['CurrencyRate']);
                
                $CustomerBalanceAmount = $value['PurchaseAmount'] - $VendorPointCr;
//WORK CLOSE
                $LoyalityLedgerPosting = array(
                    'VendorUserTypeId' => $VendorLoyalityConfig['UserTypeId'],
                    'CustomerUserTypeId' => $CustomerDetails['UserId'],
                    'CountryAdminUserTypeId' => $CountryLoyalityConfig['UserId'],
                    'InvoiceNo' => $value['InvoiceNo'],
                    'PointRate' => $CountryLoyalityConfig['PointRate'],
                    'InvoiceAmount' => $value['PurchaseAmount'],
                    'R/S' => 'R',
                    'Points' => $CustomerPointDr * -1,
                    'PointRateInCurrency' => $CountryLoyalityConfig['CurrencyRate'],
                    'CurrencyId' => $CustomerDetails['CurrencyId'],
                    'CountryId' => $CustomerDetails['CountryId'],
                    'VendorCash' => $VendorPointCr,
                    'CustomerPoint' => $CustomerPointDr,
                    'CountryAdminCash' => $CountryPointDr,
                    'CommissionInAmount' => 0,
                    'currency' =>$pointvalueincurrency*-1,
                    'CreatedDate'=>$value['dateandtime']

                );

                if ($transactionId = $this->Base_Model->insert('tbl_LoyalityLedger', $LoyalityLedgerPosting, $key = 'trans', $key_colum_name = 'TransactionId')) {

                    $AdminCurrentAmount = $this->AdminSystemModel->CurrentBalance($CountryLoyalityConfig['UserId']);

                    $flag = true;
                    $CountryAdminLedgerPosting = array(
                        'TransactionId' => $transactionId,
                        'CrorDr' => 'Dr',
                        'Amount' => $CountryPointDr,
                        'CurrentBalance' => $AdminCurrentAmount['Amount'] - (-1*$CountryPointDr),
                        'CurrencyId' => $CustomerDetails['CurrencyId'],
                        'CountryId' => $CustomerDetails['CountryId'],
                        'CountryAdminCommissionAmount' => 0,
                        'VendorUserTypeId ' => $VendorLoyalityConfig['UserTypeId'],
                        'AdminUsertypeId' => $CountryLoyalityConfig['UserId'],
                        'CountryAdminCommissionPercentage' => 0,
                        'CreatedDate'=>$value['dateandtime']
                    );

                    if ($this->Base_Model->insert('tbl_LoyalityCountryAdminLedger', $CountryAdminLedgerPosting)) {

                        $VendorCurrentAmount = $this->VendorSystemSettings->CurrentBalance($VendorLoyalityConfig['UserTypeId']);

                        $flag = true;
                        //VendorPosting
                        $VendorLedgerPosting = array(
                            'TransactionId' => $transactionId,
                            'CrOrDr' => 'Cr',
                            'Amount' => $VendorPointCr,
                            'CurrentBalance' => $VendorCurrentAmount['Amount'] + $VendorPointCr,
                            'CurrencyId' => $CustomerDetails['CurrencyId'],
                            'CountryId' => $CustomerDetails['CountryId'],
                            'VendorUserTypeId' => $VendorLoyalityConfig['UserTypeId'],
                            'CountryAdminCommissionAmount' => 0,
                            'CountryAdminUserTypeId' => $CountryLoyalityConfig['UserId'],
                            'CreatedDate'=>$value['dateandtime']
                        );

                        if ($this->Base_Model->insert('tbl_LoyalityVendorLedger', $VendorLedgerPosting)) {

                            $CustomerCurrentPoint = $this->CustomerSystemModel->CurrentBalance($CustomerDetails['UserId']);

                            $flag = true;
                            $CustomerLedgerPosting = array(
                                'TransactionId' => $transactionId,
                                'CrOrDr' => 'Dr',
                                'Points' => $CustomerPointDr,
                                'CurrentBalance' => $CustomerCurrentPoint['Points'] - ($CustomerPointDr * -1),
                                'CurrencyId' => $CustomerDetails['CurrencyId'],
                                'CountryId' => $CustomerDetails['CountryId'],
                                'VendorUserTypeId' => $VendorLoyalityConfig['UserTypeId'],
                                'CustomerUserTypeId' => $CustomerDetails['UserId'],
                                'CountryAdminUserTypeId' => $CountryLoyalityConfig['UserId'],
                                'CreatedDate'=>$value['dateandtime']
                            );

                            if ($this->Base_Model->insert('tbl_LoyalityCustomerLedger', $CustomerLedgerPosting)) {

                                $flag = true;

                                

                            }
                        } else {
                            $flag = false;
                        }
                    } else {
                        $flag = false;
                    }
                } else {
                    $flag = false;
                }

            } else {
                $flag = false;
            }

        }

        if ($flag) {

            $this->db->trans_commit();

            $redeemaftergetpoints = array(
                'CustomerMobile' => $value['CustomerMobile'],
                'InvoiceNo' => $value['InvoiceNo'],
                'PurchaseAmount' => $CustomerBalanceAmount,
                'VendorUserTypeId' => $value['VendorUserTypeId'],
                'CountryId' => $value['CountryId'],
                'CreatedDate'=>$value['dateandtime'],
            );

            $this->getcoins($redeemaftergetpoints);

            return $flag;

        } else {
            $this->db->trans_rollback();

            return $flag;
        }

    }



    public function selfiepoint($selfie_point_data,$customermobilenumber)
    {


        $CustomerDetails = $this->System_Model->ReadUserTypeDetails($customermobilenumber,$selfie_point_data['CountryId'],33);

        if($this->Base_Model->insert('tbl_selfie_point_list', $selfie_point_data+array('CustomerUserTypeId'=>$CustomerDetails['UserId'],'StatusId'=>2)))
        {

            return true;
        }
        else
        {
            return false;
        }
    }
}
