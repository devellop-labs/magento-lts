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

use Mage\Customer\Test\Fixture\Address;
use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Sales\Test\Page\Adminhtml\SalesOrderView;
use Mage\Sales\Test\Page\Adminhtml\SalesOrderIndex;

/**
 * Assert that orders were created with a right addresses.
 */
abstract class AbstractAssertOrdersAddress extends AbstractConstraint
{
    /**
     * Get address data from order form.
     *
     * @param SalesOrderView $salesOrderView
     * @return string
     */
    protected abstract function getFormAddress(SalesOrderView $salesOrderView);

    /**
     * Assert address.
     *
     * @param SalesOrderIndex $salesOrder
     * @param SalesOrderView $salesOrderView
     * @param string $orderId
     * @param string $addressData
     * @return void
     */
    protected function assert(SalesOrderIndex $salesOrder, SalesOrderView $salesOrderView, $orderId, $addressData)
    {
        $salesOrder->open()->getSalesOrderGrid()->searchAndOpen(['id' => $orderId]);
        \PHPUnit_Framework_Assert::assertEquals($addressData, $this->getFormAddress($salesOrderView));
    }

    /**
     * Prepare address data.
     *
     * @param Address $address
     * @return string
     */
    protected function prepareAddressData(Address $address)
    {
        $result = $address->getFirstname() . " ". $address->getLastname() . "\n"
            . $address->getCompany() . "\n"
            . $address->getStreet() . "\n"
            . $address->getCity() . ", " . $address->getRegionId() . ", " . $address->getPostcode() . "\n"
            . $address->getCountryId() . "\n"
            . "T: " . $address->getTelephone();
        if ($address->hasData('fax')) {
            $result .= "\nF: " . $address->getFax();
        }
        return $result;
    }
}
