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

namespace Mage\Checkout\Test\TestStep;

use Mage\Checkout\Test\Page\CheckoutMultishippingAddresses;
use Mage\Checkout\Test\Page\CheckoutMultishippingAddressNewShipping;
use Mage\Customer\Test\Fixture\Address;
use Mage\Customer\Test\Fixture\Customer;
use Magento\Mtf\TestStep\TestStepInterface;

/**
 * Enter a new addresses on checkout with multishipping address step.
 */
class EnterNewAddressesStep implements TestStepInterface
{
    /**
     * Checkout multishipping addresses page.
     *
     * @var CheckoutMultishippingAddresses
     */
    protected $checkoutMultishippingAddresses;

    /**
     * Checkout multishipping address new shipping page.
     *
     * @var CheckoutMultishippingAddressNewShipping
     */
    protected $checkoutMultishippingAddressNewShipping;

    /**
     * New address fixture.
     *
     * @var Address[]
     */
    protected $newAddresses;

    /**
     * Customer fixture.
     *
     * @var Customer
     */
    protected $customer;

    /**
     * @constructor
     * @param CheckoutMultishippingAddresses $checkoutMultishippingAddresses
     * @param CheckoutMultishippingAddressNewShipping $checkoutMultishippingAddressNewShipping
     * @param Address[] $newAddresses [optional]
     * @param Customer|null $customer
     */
    public function __construct(
        CheckoutMultishippingAddresses $checkoutMultishippingAddresses,
        CheckoutMultishippingAddressNewShipping $checkoutMultishippingAddressNewShipping,
        array $newAddresses = [],
        Customer $customer = null
    ) {
        $this->checkoutMultishippingAddresses = $checkoutMultishippingAddresses;
        $this->checkoutMultishippingAddressNewShipping = $checkoutMultishippingAddressNewShipping;
        $this->newAddresses = $newAddresses;
        $this->customer = $customer;
    }

    /**
     * Enter new addresses.
     *
     * @return array
     */
    public function run()
    {
        if (empty($this->newAddresses)) {
            return [];
        }
        foreach ($this->newAddresses as $address) {
            $this->checkoutMultishippingAddresses->getAddressesBlock()->clickEnterNewAddress();
            $this->checkoutMultishippingAddressNewShipping->getAddressEditBlock()->fill($address);
            $this->checkoutMultishippingAddressNewShipping->getAddressEditBlock()->save();
        }

        return ['addresses' => $this->newAddresses];
    }
}
