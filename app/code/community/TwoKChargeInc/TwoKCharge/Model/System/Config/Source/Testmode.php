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
 
class TwoKChargeInc_TwoKCharge_Model_System_Config_Source_Testmode
{

    public function toOptionArray()
    {

        return array(
            array('value' => 'TEST', 'label'=>Mage::helper('adminhtml')->__('TEST')),
            array('value' => 'LIVE', 'label'=>Mage::helper('adminhtml')->__('LIVE')),
        );
    }

}
