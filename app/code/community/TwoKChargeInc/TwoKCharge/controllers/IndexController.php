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

class TwoKChargeInc_TwoKCharge_IndexController extends Mage_Core_Controller_Front_Action {

    // call response.phtml page 
    // need for DirectPay and DirectPayMax
     public function indexAction()
    {
        $this->loadLayout();          
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'twokcharge',
            array('template' => 'twokcharge/response.phtml')
        );
        $this->getLayout()->getBlock('content')->append($block);
        $this->_initLayoutMessages('core/session'); 
        $this->renderLayout(); 
    } 
     
    // call success.phtml page if result of transaction is success
    public function successAction() {
        
        $this->loadLayout();
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'twokcharge',
            array('template' => 'twokcharge/success.phtml')
        );
        $this->getLayout()->getBlock('content')->append($block);
        $this->_initLayoutMessages('core/session'); 
        $this->renderLayout(); 
        
    }
    
     // call failure.phtml page if result of transaction is failure
     public function failureAction() {
        
        $this->loadLayout();
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'twokcharge',
            array('template' => 'twokcharge/failure.phtml')
        );
        $this->getLayout()->getBlock('content')->append($block);
        $this->_initLayoutMessages('core/session'); 
        $this->renderLayout(); 
        
    }
     
    // call isapprove.phtml page if result of transaction is all ready approve
    public function isapproveAction() {
        
        $this->loadLayout();
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'twokcharge',
            array('template' => 'twokcharge/isapprove.phtml')
        );
        $this->getLayout()->getBlock('content')->append($block);
        $this->_initLayoutMessages('core/session'); 
        $this->renderLayout(); 
        
    }   

     
}   
?>