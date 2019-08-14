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


$installer = $this;

$installer->startSetup();

$table = $this->getTable('twokcharge_resource');

$installer->run("
    
    DROP TABLE IF EXISTS {$table};
    CREATE TABLE `{$table}` 
    (
    type_name VARCHAR(255) NOT NULL UNIQUE, 
    type_label VARCHAR(255) NOT NULL,
    allow_country TEXT NOT NULL, 
    validation VARCHAR(255) NOT NULL
    ) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
    
     INSERT INTO `{$table}` 
        (`type_name`, `type_label`, `allow_country`, `validation`  ) 
     VALUES 
        ( 'ACH', 'ACH - Online Check', 'US|CA', 'achValidation' ),
        ( 'BARPAY', 'BARPAY', 'DE', 'emptyValidation' ),
        ( 'EPS', 'EPS', 'AT', 'emptyValidation' ),
        ( 'IDEAL', 'iDEAL', 'NL', 'idealValidation' ),
        ( 'GIROPAY', 'GiroPay', 'DE', 'giropayValidation' ),
        ( 'YELLOWPAY', 'YellowPay', 'CH', 'emptyValidation' ),
        ( 'EuroDebit', 'EuroDebit', 'DE|AT|NL', 'eurodebitValidation' ),     
        ( 'DIRECTPAYMAX', 'Pay by Bank', 'DE|US', 'directpaymaxValidation' ),
        ( 'DIRECTPAY', 'Directpay', 'AD|AT|BE|CH|CY|CZ|DE|DK|EE|ES|FI|FR|GB|GI|GR|HR|HU|IE|IS|IT|LT|LU|LV|MK|MT|NL|NO|PL|PT|RO|RS|SE|SI|SK|TN|TR|US', 'emptyValidation' ),
        ( 'PAYSAFE', 'Paysafecard', 'AR|AT|BE|CH|CS|CY|CZ|DE|DK|ES|FI|FR|GB|GR|IE|IT|LU|LV|MX|NL|NO|PL|PT|RO|SE|SI|US', 'emptyValidation' ),
        ( 'POLI', 'POLi', 'AU|NZ', 'emptyValidation' ),
        ( 'PRZELEWY', 'Przelewy24', 'PL', 'emptyValidation' ),
        ( 'TELEINGRESO', 'Teleingreso', 'ES', 'emptyValidation' ),
        ( 'SEPA', 'EuroDebit SEPA', 'BE|BG|CH|CY|CZ|DK|ES|FI|FR|GB|GR|HU|IE|IS|IT|LI|LT|LU|LV|MC|MT|NO|PL|PT|RO|SE|SI|SK', 'sepaValidation' ), 
        ( 'QIWI', 'QIWI', 'RU', 'emptyValidation' );
        
");

// ( 'CreditCard', 'Credit Card', 'AD|AE|AF|AG|AI|AL|AM|AN|AO|AQ|AR|AS|AT|AU|AW|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BJ|BM|BN|BO|BR|BS|BT|BW|BY|BZ|CA|CD|CH|CI|CK|CL|CM|CN|CO|CR|RS|CU|CV|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EE|EG|ES|ET|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GH|GI|GL|GM|GN|GP|GQ|GR|GT|GU|GW|GY|HK|HN|HR|HT|HU|ID|IE|IL|IN|IQ|IR|IS|IT|JM|JO|JP|KE|KG|KH|KI|KM|KN|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MG|ML|MM|MN|MO|MR|MS|MT|MU|MV|MW|MX|MY|MZ|NA|NC|NE|NG|NI|NL|NO|NP|NR|NZ|OM|PA|PE|PF|PG|PH|PK|PL|PM|PR|PT|PY|QA|RO|RU|RW|SA|SB|SC|SE|SG|SH|SI|SK|SL|SM|SN|SO|SR|ST|SV|SY|SZ|TC|TD|TG|TH|TJ|TM|TN|TO|TR|TT|TW|TZ|UA|UG|US|UY|UZ|VA|VC|VE|VG|VN|VU|WF|WS|YE|YT|YU|ZA|ZM|ZR|ZW', 'creditcardValidation' ),
// ( 'BrazilPay', 'BrazilPay', 'BR', 'brazilpayValidation' ),
// ( 'CHINADEBIT', 'China Debit', 'CN', 'emptyValidation' ),
// ( 'FASTERPAY', 'FasterPay', 'GB' ),

$installer->endSetup();



