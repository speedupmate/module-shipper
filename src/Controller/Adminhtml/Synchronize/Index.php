<?php
/**
 *
 * WebShopApps Shipping Module
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
 * Shipper HQ Shipping
 *
 * @category ShipperHQ
 * @package ShipperHQ_Shipping_Carrier
 * @copyright Copyright (c) 2014 Zowta LLC (http://www.ShipperHQ.com)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author ShipperHQ Team sales@shipperhq.com
 */
namespace ShipperHQ\Shipper\Controller\Adminhtml\Synchronize;
class Index extends \ShipperHQ\Shipper\Controller\Adminhtml\Synchronize
{
    /**
     * Index Action for Synchronize
     * @return Void
     * */

    public function execute()
    {

        $result = $this->sychronizerFactory->create()->updateSynchronizeData();
        if (array_key_exists('error', $result)) {
           // $session = Mage::getSingleton('Mage_Adminhtml_Model_Session');
           // $message = Mage::helper('shipperhq_shipper')->__($result['error']);
           // $session->addError($message);

        } else {
          //  $session = Mage::getSingleton('Mage_Adminhtml_Model_Session');
            if ($result['result'] == 0) {
           //     $message = Mage::helper('shipperhq_shipper')->__('Received latest attribute values from ShipperHQ, no changes are required.');
            //    $session->addSuccess($message);
            } else {
              //  $message = Mage::helper('shipperhq_shipper')->__('Received latest attribute values from ShipperHQ, %s changes required. Ready to synchronize', $result['result']);
               // $session->addSuccess($message);
            }


        }

       return $this->_resultPageFactory->create();
    }
}
?>