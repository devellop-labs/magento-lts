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

namespace Mage\Paypal\Test\TestCase;

use Magento\Mtf\Fixture\FixtureFactory;

/**
 * Abstract class for create sales entity for pay pal express checkout.
 */
abstract class AbstractCreateSalesEntityForPaypalExpressCheckoutTest
    extends AbstractCreateSalesEntityForOnlinePaymentMethodsTest
{
    /**
     * Prepare Pay Pal and magento customers for test.
     *
     * @param FixtureFactory $fixtureFactory
     * @return array
     */
    public function __prepare(FixtureFactory $fixtureFactory)
    {
        $magentoCustomer = parent::__prepare($fixtureFactory);
        $paypalCustomer = $fixtureFactory->create('Mage\Paypal\Test\Fixture\PaypalCustomer', ['dataset' => 'default']);

        return ['paypalCustomer' => $paypalCustomer, 'customer' => $magentoCustomer['customer']];
    }
}
