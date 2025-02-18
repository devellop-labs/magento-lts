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

namespace Mage\GiftMessage\Test\Constraint;

use Mage\Customer\Test\Fixture\Customer;
use Mage\Customer\Test\Page\CustomerAccountLogout;
use Mage\GiftMessage\Test\Fixture\GiftMessage;
use Mage\Sales\Test\Page\OrderHistory;
use Mage\Sales\Test\Page\OrderView;

/**
 * Assert that message from dataset is displayed on order view page on frontend.
 */
class AssertGiftMessageInFrontendOrder extends AbstractAssertGiftMessageOnFrontend
{
    /* tags */
    const SEVERITY = 'high';
    /* end tags */

    /**
     * Assert that message from dataset is displayed on order view page on frontend.
     *
     * @param GiftMessage $giftMessage
     * @param Customer $customer
     * @param OrderHistory $orderHistory
     * @param OrderView $orderView
     * @param CustomerAccountLogout $customerAccountLogout
     * @param string $orderId
     * @return void
     */
    public function processAssert(
        GiftMessage $giftMessage,
        Customer $customer,
        OrderHistory $orderHistory,
        OrderView $orderView,
        CustomerAccountLogout $customerAccountLogout,
        $orderId
    ) {
        $this->loginOnFrontend($customer);
        $this->openOrderPage($orderHistory, $orderId);
        $expectedData = $this->prepareExpectedData($giftMessage);

        \PHPUnit_Framework_Assert::assertEquals(
            $expectedData,
            $orderView->getGiftMessageForOrderBlock()->getGiftMessage()
        );
        $customerAccountLogout->open();
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return "Gift message is displayed on order view page on frontend correctly.";
    }
}
