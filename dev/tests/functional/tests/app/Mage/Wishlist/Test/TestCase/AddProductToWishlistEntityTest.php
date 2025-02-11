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

namespace Mage\Wishlist\Test\TestCase;

use Mage\Customer\Test\Fixture\Customer;

/**
 * Preconditions:
 * 1. Customer is registered.
 * 2. Product is created.
 *
 * Steps:
 * 1. Login as a customer.
 * 2. Navigate to catalog page.
 * 3. Add created product to Wishlist according to dataset.
 * 4. Perform all assertions.
 *
 * @group Wishlist_(CS)
 * @ZephyrId MPERF-6997
 */
class AddProductToWishlistEntityTest extends AbstractWishlistTest
{
    /**
     * Run Add Product To Wishlist test.
     *
     * @param Customer $customer
     * @param string $product
     * @param bool $configure
     * @return array
     */
    public function test(Customer $customer, $product, $configure)
    {
        $product = $this->createProducts($product)[0];

        // Steps:
        $this->loginCustomer($customer);
        $this->addToWishlist([$product], $configure);

        return ['product' => $product];
    }
}
