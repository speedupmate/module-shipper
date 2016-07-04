<?php
/**
 *
 * ShipperHQ Shipping Module
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
 * @copyright Copyright (c) 2015 Zowta LLC (http://www.ShipperHQ.com)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author ShipperHQ Team sales@shipperhq.com
 */
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ShipperHQ\Shipper\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;


/**
 * ShipperHQ Shipper module observer
 */
class RecordOrder extends AbstractRecordOrder implements ObserverInterface
{
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @param \ShipperHQ\Shipper\Helper\Data $shipperDataHelper
     * @param  \ShipperHQ\Shipper\Model\CarrierGroupFactory $carrierGroupFactory
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @param \ShipperHQ\Shipper\Helper\LogAssist $shipperLogger
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param \Magento\Checkout\Model\Session $checkoutSession
     */
    public function __construct(
        \ShipperHQ\Shipper\Helper\Data $shipperDataHelper,
        \ShipperHQ\Shipper\Model\CarrierGroupFactory $carrierGroupFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \ShipperHQ\Shipper\Helper\LogAssist $shipperLogger,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->orderFactory = $orderFactory;
        $this->checkoutSession = $checkoutSession;
        parent::__construct($shipperDataHelper, $carrierGroupFactory, $quoteRepository, $shipperLogger);
    }

    /**
     * Record order shipping information after order is placed
     *
     * @param EventObserver $observer
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        if ($this->shipperDataHelper->getConfigValue('carriers/shipper/active')) {
            $order = $this->orderFactory->create()->loadByIncrementId(
                $this->checkoutSession->getLastRealOrderId()
            );
            if($order->getIncrementId()) {
                $this->recordOrder($order);
            }

        }
    }

}
