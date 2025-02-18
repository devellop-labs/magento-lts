<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Tests
 * @package    Tests_Functional
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Mage\Sales\Test\Constraint;

use Mage\Customer\Test\Fixture\Customer;
use Mage\Sales\Test\Fixture\Order;
use Magento\Mtf\ObjectManager;
use Magento\Mtf\Fixture\InjectableFixture;
use Mage\Adminhtml\Test\Block\Sales\Order\AbstractItems\AbstractItem;

/**
 * Abstract assert sales entity items on frontend.
 */
abstract class AbstractAssertSalesEntityItemsOnFrontend extends AbstractAssertItems
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Customer fixture.
     *
     * @var Customer
     */
    protected $customer;

    /**
     * Process assert.
     *
     * @param array $ids
     * @param Order|null $order
     * @param string|null $orderId
     * @param array|null $products
     * @param array|null $verifyData
     * @param Customer|null $customer
     * @return void
     */
    public function processAssert(
        array $ids,
        Order $order = null,
        $orderId = null,
        array $products = null,
        array $verifyData = null,
        Customer $customer = null
    ) {
        $this->setFields($order, $orderId, $products, $verifyData, $customer);
        $this->openPage();
        $this->assert($ids);
    }

    /**
     * Get items block.
     *
     * @param string $entityId
     * @return AbstractItem
     */
    protected function getItemsBlock($entityId)
    {
        return $this->salesTypeViewPage->getEntitiesBlock()->getBlock($entityId)->getItemsBlock();
    }

    /**
     * Set fields for assert.
     *
     * @param Order|null $order
     * @param string|null $orderId
     * @param array|null $products
     * @param array|null $verifyData
     * @param Customer|null $customer
     */
    protected function setFields(
        Order $order = null,
        $orderId = null,
        array $products = null,
        array $verifyData = null,
        Customer $customer = null
    ) {
        parent::setFields($order, $orderId, $products, $verifyData);
        $this->customer = ($customer == null)
            ? $order->getDataFieldConfig('customer_id')['source']->getCustomer()
            : $customer;
    }

    /**
     * Open verify page.
     *
     * @return void
     */
    protected function openPage()
    {
        $frontendAction = new FrontendActionsForSalesAssert();
        $frontendAction->loginCustomerAndOpenOrderPage($this->customer);
        $frontendAction->openEntityTab($this->orderId, $this->entityType);
    }

    /**
     * Get product name.
     *
     * @param InjectableFixture $product
     * @return string
     */
    protected function getProductName(InjectableFixture $product)
    {
        return strtoupper($product->getName());
    }

    /**
     * Get product data.
     *
     * @param InjectableFixture $product
     * @return array
     */
    protected function getProductData(InjectableFixture $product)
    {
        $productData = parent::getProductData($product);
        $productData['product_sku'] = $productData['product']['sku'];
        unset($productData['product']['sku']);

        return $productData;
    }
}
