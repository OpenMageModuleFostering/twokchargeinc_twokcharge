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
 
echo 'Running Insall script (mysql4-install-0.1.0.php) for module TwoKChargeInc_TwoKCharge <br />'; 

$installer = $this;

$installer->startSetup();

$conn = $installer->getConnection();
$prod = 'processing_paid';

$select = $conn
    ->select()
    ->from($this->getTable('sales/order_status'))
    ->where('status = ?', $prod );
$data1 = $conn->fetchAll($select);

if ($data1) {
    echo 'In database jet - sales/order_status';
} else {
   //echo 'Insert in db - sales/order_status';

    $installer->run("   
           INSERT INTO  `{$this->getTable('sales/order_status')}` (
            `status`, `label`
        ) VALUES (
            'processing_paid', 'Processing (Successfully Paid)'
        );
    "); 
}

$select = $conn
    ->select()
    ->from($this->getTable('sales/order_status_state'))
    ->where('status = ?', $prod );
$data2 = $conn->fetchAll($select);

if ($data2) {
    echo 'In database jet - sales/order_status_state';
} else {
   //echo 'Insert in db - sales/order_status_state';

    $installer->run("   
    
        INSERT INTO  `{$this->getTable('sales/order_status_state')}` (
            `status`, `state`, `is_default`
        ) VALUES (
            'processing_paid', 'processing', '1'
        );
        
    ");
  
}

$installer->endSetup();

?>
