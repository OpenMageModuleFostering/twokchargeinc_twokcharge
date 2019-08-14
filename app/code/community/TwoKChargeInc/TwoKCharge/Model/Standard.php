<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Payment Method
 * @package     TwoKChargeInc_TwoKCharge
 * @copyright   Copyright (c) 2012 2000Charge Inc (http://www.2000charge.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class TwoKChargeInc_TwoKCharge_Model_Standard extends Mage_Payment_Model_Method_Abstract {
    
    protected $_isInitializeNeeded      = true;
    protected $_canUseInternal          = true;
    protected $_canUseForMultishipping  = false;
    
    protected $_code = 'twokcharge';
    protected $_formBlockType = 'twokcharge/form';
    protected $_infoBlockType = 'twokcharge/paymentInfo';
    
    protected $_redirectBlockType = 'twokcharge/redirect';
    protected $_responseBlockType = 'twokcharge/response';
                   
    const RESPONSE_CODE_APPROVED = 'Y';
    const RESPONSE_CODE_DECLINED = 'N';
    const RESPONSE_CODE_ERROR    = 'X'; 
    const RESPONSE_CODE_PENDING  = 'P'; 

/**
 * validation for ACH fields
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */
    public function achValidation($data, $order){
        
        $order->setAchAccounttype($data->getTwokchargeAchAccounttype());
        $order->setAchAccountnumber($data->getTwokchargeAchAccountnumber());
        $order->setAchRoutingnumber($data->getTwokchargeAchRoutingnumber());
        $order->setAchChecknumber($data->getTwokchargeAchChecknumber());
        $order->setAchPhoneVerfNum($data->getTwokchargeAchPhoneVerfNum());
        $order->setAchSsn($data->getTwokchargeAchSsn());
        return -1;
    }
/**
 * validation for CreditCard fields - not active
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */
    public function creditcardValidation($data, $order) {

        if (strlen($data->getTwokchargeCreditcardCvv()) != 4 && $data->getTwokchargeCreditcardType() == 'American Express' ) {
             $errorMsg = __('Please enter the 4 digits of your Card Verification Number (CVV2)');
             return $errorMsg;  
         }
         if (strlen($data->getTwokchargeCreditcardCvv()) != 3 && $data->getTwokchargeCreditcardType() != 'American Express' ) {
             $errorMsg = __('Please enter the 3 digits of your Card Verification Number (CVV2)');
             return $errorMsg;
         }
         
         $order->setCreditcardType($data->getTwokchargeCreditcardType());
         $order->setCreditcardNumber($data->getTwokchargeCreditcardNumber());
         $order->setCreditcardExpMonth($data->getTwokchargeCreditcardExpMonth());
         $order->setCreditcardExpYear($data->getTwokchargeCreditcardExpYear());
         $order->setCreditcardCvv($data->getTwokchargeCreditcardCvv());
         return -1;
    }

/**
 * validation for ideal fields
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */
    public function idealValidation($data, $order){
      
         $order->setIdealBankcode($data->getTwokchargeIdealBankcode());       
         return -1;
    }
 
/**
 * validation for sepa fields
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */
    public function sepaValidation($data, $order){
      
      if ($data->getSepaIbanHidden() != 'OK' ) {
          
             $errorMsg = $data->getTwokchargeSepaIbanHidden();
             return $errorMsg;
      }
 
  //       $order->setSepaSignum($data->getTwokchargeSepaSignum());
         $order->setSepaIban($data->getTwokchargeSepaIban());
         $order->setSepaBic($data->getTwokchargeSepaBic()); 
     
         $order->setSepaIbanHidden($data->getTwokchargeSepaIbanHidden());
 
         return -1;
    }
    
/**
 * validation for brazilpay fields - not active
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */    
 
    public function brazilpayValidation($data, $order){
      
         $order->setBrazilpayBankcode($data->getTwokchargeBrazilpayBankcode());      
         return -1;
    }
/**
 * validation for directpaymax fields
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */ 
    public function directpaymaxValidation($data, $order) {
      
         $order->setDirectpaymaxBankcode($data->getTwokchargeDirectpaymaxBankcode());
         return -1;
    }
/**
 * validation for eurodebit fields   
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */ 
    public function eurodebitValidation($data, $order) {
      
             $order->setEurodebitAccountnumber($data->getTwokchargeEurodebitAccountnumber());
             $order->setEurodebitRoutingnumber($data->getTwokchargeEurodebitRoutingnumber());
         return -1;
    }
/**
 * validation for giropay fields   
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */      
    public function giropayValidation($data, $order) {
      
         $order->setGiropayAccountnumber($data->getTwokchargeGiropayAccountnumber());
         $order->setGiropayRoutingnumber($data->getTwokchargeGiropayRoutingnumber()); 
         return -1;
    }
/**
 *  Not defined fiels in form - validator 
 *
 * @param String $data
 * @param Magento Object $order
 * @return String error message or -1 if all good
 */        
     public function emptyValidation($data, $order){
      
         return -1;
    }
     
/**
 * start validate function - integrate in Magento
 *
 * @param Varien_Object $data
 * @return 
 */
    public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        
        $order = Mage::getSingleton('checkout/session')->getQuote(); 
        $collection = Mage::getModel('twokcharge/dbsource')->getCollection()->addFieldToFilter('type_name', $data->getTwokchargeTypeName());
        $extrabrand = $collection->getFirstItem()->getData();
        $paymentLabel = $extrabrand['type_label'];
        $paymentValidation = $extrabrand['validation'];
        
        $paymentTypeName = $extrabrand['type_name'];
        $pp = "pp_".strtolower($paymentTypeName);
        $order->setPricePoint($this->getConfigData("$pp"));
        $order->setMode(($this->getConfigData('payment_mode') == 'TEST') ? 'TESTAPPROVE' : 'PRODUCTION');
        $order->setUrlcode($this->getConfigData('urlcode')); 
        
// this code necessary for info in payment page (PaymentInfo.php)
        $info = $this->getInfoInstance();
        $info->setTwokchargeTypeName($paymentLabel);

    if ($data->getTwokchargeTypeName() != '') {
        $order->setTwokchargeTypeName($data->getTwokchargeTypeName());

        $errorMsg = $this->$paymentValidation($data, $order);

        if ($errorMsg != -1) {
            Mage::throwException($errorMsg);
        }
    } else {   
        Mage::throwException(Mage::helper('paygate')->__('Please chose BankType '));  
    } 

        return $this;
    }

/**
 * methode for prepere and send infroramtion on service, checking and info client if all ok before place order
 * only for "EPS", "IDEAL", "GIROPAY", "PAYSAFE", "POLI", "PRZELEWY", "QIWI", 
 * "TELEINGRESO", "YELLOWPAY", "DIRECTPAY", "DIRECTPAYMAX", "TELEPAY" - special request
 * 
 * @param Varien_Object $data
 * @return 
 */
   public function prepare_payment_send(Varien_Object $observer) {

        $order = Mage::getSingleton('checkout/session')->getQuote();
        $payment = $order -> getPayment();
        $incrementId = $order -> getEntityId();

        // filter for payment gateway       
       if (in_array($order->getTwokchargeTypeName(), array("YELLOWPAY", "EPS", "IDEAL", "GIROPAY", "PAYSAFE", 
                                                                         "POLI", "PRZELEWY", "QIWI", "TELEINGRESO" 
                                                                       , "DIRECTPAY", "DIRECTPAYMAX", "TELEPAY"
                                                                         ))) {
            $amount = $order -> getGrandTotal();

            //build request list
            $cartValues = $this -> _buildRequest($order, $amount);
            // post request
            list($content, $response) = $this -> _postRequest($order, $cartValues);
            // formated postBack result
            list($isPaymentAccepted, $message) = $this->_formatPostResult($content);
            // if result have error
            if ($isPaymentAccepted == 'X') {
                
                Mage::getSingleton('checkout/session')->setResponseFlagTransaction($isPaymentAccepted);
                Mage::throwException(Mage::helper('paygate')->__($message));  
                
            } else {             
                Mage::getSingleton('checkout/session')->setResponseFlagTransaction($isPaymentAccepted);
                Mage::getSingleton('checkout/session')->setResponseTestField($content);

            }

            return -1;
        }
       
    }

/**
 * method for redirection page - integrate in magento
 * 
 * @return automatic redirect to return url
 */
    public function getOrderPlaceRedirectUrl()
    {
        
        $order = Mage::getSingleton('checkout/session')->getQuote();

        $payment = $order -> getPayment();
        $incrementId = $order -> getEntityId();

    //    $order->setPricePoint($this->getConfigData('pricepoint'));


// ----  direct pay gateway method - START !!!!!! -------
        if (in_array($order->getTwokchargeTypeName(), array("SEPA", "EuroDebit", "ACH", "CreditCard", "BARPAY"))) {

            $check = $this -> _getOrderDirectPay($order);
            if ($check == 'N' || $check == 'X') {

                return Mage::getUrl('checkout/onepage/failure', array('_secure' => true)); 
            }
                      
// ---- direct pay gateway method - END !!!!!! -----------------------------
// ---- redirect pay gateway method - START !!!!!! -------------------------
 /*       } elseif (in_array($order->getTwokchargeTypeName(), array("DIRECTPAY", "CHINADEBIT", 
                                                                            "BrazilPay", "DIRECTPAYMAX", "TELEPAY" ))) {

 //         Mage::log(var_export($order->debug(), TRUE), null,'$cart3.log'); 
          
            $amount = $order -> getGrandTotal();
            $cartValues = $this -> _buildRequest($order, $amount);
            
            list($content, $response) = $this -> _postRequest($order, $cartValues);
            list($isPaymentAccepted, $message) = $this->_formatPostResult($content);
                 
            $responseURL = $response['url'];
            
        // ---- redirect pay gateway method - DIRECTPAY and DIRECTPAYMAX only !!!!!! (specific)  --------
            if (in_array($order->getTwokchargeTypeName(), array("DIRECTPAY", "DIRECTPAYMAX", "TELEPAY"))) {
                
                if ($isPaymentAccepted == self::RESPONSE_CODE_DECLINED || $isPaymentAccepted == self::RESPONSE_CODE_ERROR) {
                    
                     $order->setStatus(self::STATUS_ERROR);  
                     $order->save(); 
                     $orderId = $order-> getReservedOrderId();
                     $orderOBJ = Mage::getModel('sales/order')->loadByIncrementId("$orderId");
                     $orderOBJ->setState(Mage_Sales_Model_Order::STATE_CANCELED, true);
                     $orderOBJ->save();
                     Mage::throwException(Mage::helper('paygate')->__('Unexpected error: '. $message));
                } else {
                    
                   Mage::getSingleton('twokcharge/session')->setPostBack(serialize($content));
                   Mage::getSingleton('twokcharge/session')->setBackFlag(serialize('TRUE'));

                   return Mage::getUrl('twokcharge/', array('_secure' => true)); 

                }
            } else {

               return $responseURL; 
               
            }
*/
      // filter for specific payment gateway   
      } elseif (in_array($order->getTwokchargeTypeName(), array("YELLOWPAY", "EPS", "IDEAL", "GIROPAY", "PAYSAFE", 
                                                                         "POLI", "PRZELEWY", "QIWI", "TELEINGRESO"  
                                                                         , "DIRECTPAY", "DIRECTPAYMAX", "TELEPAY" 
                                                                         ))) {

           $responseURL = Mage::getSingleton('checkout/session')->getResponseTestField();
        
               return $responseURL; 

        } else {
              
             $order->setStatus(self::STATUS_ERROR);
             $order->save(); 
             $orderId = $order-> getReservedOrderId();                 
             $orderOBJ = Mage::getModel('sales/order')->loadByIncrementId("$orderId"); 
             $orderOBJ->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'Unexpected error' );
             $orderOBJ->save();                
             Mage::throwException(Mage::helper('paygate')->__('Unexpected error'));
        }
        
  //  return Mage::getUrl(Mage::getSingleton('checkout/session')->getTestField(), array('_secure' => true));

    }

/**
* methode for prepere and send infroramtion on service, checking and info client 
 * 
 * @param Varien_Object $cart
 * @return automatic redirect to return url
 */
    protected function _getOrderDirectPay(Varien_Object $cart)
    {
               
       $amount = $cart -> getGrandTotal();
        if ($amount <= 0) {
            Mage::throwException(Mage::helper('paygate')->__('Invalid amount for authorization.'));
        }

        $cartValues = $this->_buildRequest($cart, $amount);
        list($content, $response) = $this->_postRequest($cart, $cartValues);
        list($isPaymentAccepted, $message) = $this->_formatPostResult($content);
 
        $this->_getStatusMessage($cart, $isPaymentAccepted, $message);

        return $isPaymentAccepted;  
    }  
    
/**
* methode for save place order result in database
 * 
 * @param Varien_Object $cart
 * @param var $isPaymentAccepted
 * @param String $message
 * @return void
 */   
    protected function _getStatusMessage($cart, $isPaymentAccepted, $message)
    {
     
        switch ($isPaymentAccepted) {
            case self::RESPONSE_CODE_APPROVED: 
                 $cart->setStatus(self::STATUS_APPROVED);
                 $cart->save(); 
                 $orderId = $cart-> getReservedOrderId(); 
                 $orderOBJ = Mage::getModel('sales/order')->loadByIncrementId("$orderId"); 
                 $orderOBJ->setState(Mage_Sales_Model_Order::STATE_PROCESSING, "Order has been successfully paid");
                 $orderOBJ->setStatus('processing_paid');
                 $orderOBJ->save(); 
                 break;
                 
            case self::RESPONSE_CODE_PENDING: 
                 $cart->setStatus(self::STATUS_APPROVED);
                 $cart->save();
                 $orderId = $cart-> getReservedOrderId();
                 $orderOBJ = Mage::getModel('sales/order')->loadByIncrementId("$orderId");
                 $orderOBJ->setState(Mage_Sales_Model_Order::STATE_NEW, true, "Order is pending");
                 $orderOBJ->setStatus('pending');
                 $orderOBJ->save();
                 break;
                 
            case self::RESPONSE_CODE_DECLINED:
                 $cart->setStatus(self::STATUS_DECLINED);
                 $cart->save();
                 $orderId = $cart-> getReservedOrderId();
                 $orderOBJ = Mage::getModel('sales/order')->loadByIncrementId("$orderId");
                 $orderOBJ->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, "Order has been canceled by payment service");
                 $orderOBJ->setStatus('canceled');
                 $orderOBJ->save();
                 break;
                  
            case self::RESPONSE_CODE_ERROR:
                 $cart->setStatus(self::STATUS_ERROR);
                 $cart->save();
                 $orderId = $cart-> getReservedOrderId();
                 $orderOBJ = Mage::getModel('sales/order')->loadByIncrementId("$orderId"); 
                 $orderOBJ->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, "Unexpected error - $message");
                 $orderOBJ->setStatus('canceled');
                 $orderOBJ->save();
                 break;
            
            default: 
                 $cart->setStatus(self::STATUS_ERROR);
                 $cart->save(); 
                 $orderId = $cart-> getReservedOrderId();
                 $orderOBJ = Mage::getModel('sales/order')->loadByIncrementId("$orderId"); 
                 $orderOBJ->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, "Unexpected error - $message !" );
                 $orderOBJ->save();                
                 Mage::throwException(Mage::helper('paygate')->__('Unexpected error'));  
            }
  
    }
    

/**
* methode for arrange postResult
* 
* @param String $result_dirty
* @return Array
*/    
    protected function _formatPostResult($result_dirty) 
    {     
      $match = explode("|",$result_dirty, 2);
      $flag_r = substr($match[0], 0, 1);

      return array($flag_r, $match[1]); 
    } 
    
/**
* methode for building request for service
* 
* @param Varien_Object $cart
* @return Array - list for post 
*/ 
    protected function _buildRequest(Varien_Object $cart)
    {
    if (!empty($cart)) {
        $billing = $cart->getBillingAddress();
        if (!empty($billing)) {
             if (!$billing->getRegion())  
                $billing->setRegion('NA');

               $fields = array(
                                "amount" => $cart->getGrandTotal(), // charge amount in specified currency
                                "paydesc" => "",  // (optional) Description of purchase 
                                "firstName" => $billing->getFirstname(),
                                "lastName" => $billing->getLastname(),
                                "address" => $billing->getStreet(1)." ".$billing->getStreet(2), 
                                "city" => $billing->getCity(),
                                "state" => $billing->getRegion(),
                                "zip" => $billing->getPostcode(),
                                "email" => $cart->getCustomerEmail(),
                                //"STATUS_URL" => "mailto:" . $config["Company"]["orders_department"], /company mail/
                                "Fax" =>  $billing->getFax(),
                                "Phone" => $billing->getTelephone(), //required - optional for some bank (this is not global filed!!)
                                "IP" => $cart->getRemoteIp(),
                                "username" => "notused",
                                "userpassword" => "notused",
                             // "memberLen" => 30, // (optional)
                                "xfield" => $cart-> getReservedOrderId(), //Order Protect Code
                                
                                "currencyid" => $cart->getQuoteCurrencyCode(),  //order_currency_code  ORDER -- 'global_currency_code' => 'EUR',  'base_currency_code' => 'EUR',  'store_currency_code' => 'EUR',  'order_currency_code' => 'EUR',
                                "country" => $billing->getCountry(),
                                "processmode" => $cart->getMode(), // TESTAPPROVE, TESTDECLINE , PRODUCTION
                               ); 
 
                 if ($cart->getTwokchargeTypeName() == 'EuroDebit') {
                   
                     $fields_tmp = array(
                     
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "accountnumber" => $cart->getEurodebitAccountnumber(),
                            "routingnumber" => $cart->getEurodebitRoutingnumber(),
                            );
                
                } elseif ($cart->getTwokchargeTypeName() == 'GIROPAY') {
                    
                     $fields_tmp = array(
                     
                            "authredirectmode" => 'H',
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "accountnumber" => $cart->getGiropayAccountnumber(),
                            "routingnumber" => $cart->getGiropayRoutingnumber(),
                            "resultredirecturl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            "postbackurl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/", 
                            );
                
                } elseif ($cart->getTwokchargeTypeName() == 'SEPA') {
                   
                     $fields_tmp = array(
                     
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
//                            "signum" => $cart->getSepaSignum(),
                            "iban" => $cart->getSepaIban(),
                            "bic" => $cart->getSepaBic(),
                            );
                            
                } elseif ($cart->getTwokchargeTypeName() == 'CreditCard') {
                   
                     $fields_tmp = array(
                     
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "cctype" => $cart->getCreditcardType(),
                            "ccnum" => $cart->getCreditcardNumber(),
                            "cvv2" => $cart->getCreditcardCvv(),                            
                            "ccexpiremonth" => $cart->getCreditcardExpMonth(),
                            "ccexpireyear" => $cart->getCreditcardExpYear(),                                                       
                            );

                } elseif (in_array($cart->getTwokchargeTypeName(), array("QIWI", "POLI", "PAYSAFE", "TELEINGRESO", 
                                                                                   "PRZELEWY", "EPS", "YELLOWPAY", "CHINADEBIT"))) {
                                                                                                                                                          
                     $fields_tmp = array(
                     
                            "authredirectmode" => 'H',
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "resultredirecturl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            "postbackurl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            

                            );  
                            
                } elseif ($cart->getTwokchargeTypeName() == 'IDEAL') {

                     $fields_tmp = array(
                     
                            "authredirectmode" => 'H',
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "bankcode" => $cart->getIdealBankcode(),
                            "resultredirecturl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            "postbackurl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            );  
                
                } elseif (in_array($cart->getTwokchargeTypeName(), array( "BARPAY"))) {

                     $fields_tmp = array(
                     
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "postbackurl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            );  
                   
                } elseif (in_array($cart->getTwokchargeTypeName(), array("DIRECTPAY", "TELEPAY"))) {

                     $fields_tmp = array(
                     
                            "authredirectmode" => 'H',
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "postbackurl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            );  
                   
                } elseif ($cart->getTwokchargeTypeName() == 'DIRECTPAYMAX') {

                     $fields_tmp = array(
                     
                            "authredirectmode" => 'H',
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "bankCode" =>  $cart->getDirectpaymaxBankcode(),
                            "postbackurl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            );  
                                           
                } elseif ($cart->getTwokchargeTypeName() == 'BrazilPay') {
                     
                     $fields_tmp = array(
                     
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "gatewayid" => 2,
                            "deposittype" => 2, // required if gatewayid is 1
                            "resultredirecturl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            "postbackurl" => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)."twokcharge/payment/redirect/",
                            "bankcode" => $cart->getBrazilpayBankcode(), // required if gatewayid is 1
                            "cpf" => "123456789", // required if gatewayid is 1
                            ); 
                            
                } elseif ($cart->getTwokchargeTypeName() == 'ACH') {

                     $fields_tmp = array(
                     
                            "pricepoint" => $cart->getPricePoint(),
                            "paymenttype" => $cart->getTwokchargeTypeName(),
                            "accounttype" => $cart->getAchAccounttype(),
                            "accountnumber" => $cart->getAchAccountnumber(),
                            "routingnumber" => $cart->getAchRoutingnumber(),
                            "checknumber" => $cart->getAchChecknumber(),
                            "phoneverfnum" => $cart->getAchPhoneVerfNum(),

                            "ssn" => $cart->getAchSsn(),  
                            ); 
                } 
                
                $fields = $fields + $fields_tmp;
    //       file_put_contents(Mage::getBaseDir('base')."/var/log/fields$$$.txt", print_r($fields, true), FILE_APPEND);   
                return $fields;
            }
        }

      return $cartValues;
    }

/**
* post request methode 
* 
* @param Varien_Object $cart
* @param Array $cartValues - list for post 
* @return Array
*/ 
    protected function _postRequest(Varien_Object $cart, $cartValues)
    {
     try {   
            $postData = http_build_query($cartValues);
            
            
   //          file_put_contents(Mage::getBaseDir('base')."/var/log/cartValues$$$.txt", print_r($cartValues, true), FILE_APPEND);          
            
            $urlToPost  = $cart->getUrlcode();
            // Create a curl request and send the values  
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_URL, $urlToPost);  
            curl_setopt($ch, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); //Put the created string here in use
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            
            $content = curl_exec($ch); //The string returned  
   //         file_put_contents(Mage::getBaseDir('base')."/var/log/content$$$.txt", $content, FILE_APPEND);  
            $response = curl_getinfo($ch);
   //         file_put_contents(Mage::getBaseDir('base')."/var/log/response$$$.txt", print_r($response, true), FILE_APPEND);   
            curl_close ($ch);

            if ($response['http_code'] == 301 || $response['http_code'] == 302)
            {
                ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
                $headers = get_headers($response['url']);
                
                $location = "";
                foreach($headers as $value)
                {
                    if (substr(strtolower($value), 0, 9) == "location:")
                        return get_final_url(trim(substr($value, 9, strlen($value))));
                }
            }
            
            if ($response['http_code'] && substr($response['http_code'], 0, 2) != "20") { //Unsuccessful post request...  
                throw new Exception("Returned HTTP CODE: " . $response['http_code'] . " for this URL: " . $urlToPost);  
            }

        } catch (Exception $e) {            

            Mage::throwException($e->getMessage());    
        } 

        return array($content, $response);
    }

}

