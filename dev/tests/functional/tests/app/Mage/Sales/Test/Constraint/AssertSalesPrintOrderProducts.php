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

use Mage\Sales\Test\Page\SalesGuestPrint;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Assert that products printed correctly on sales guest print page.
 */
class AssertSalesPrintOrderProducts extends AbstractConstraint
{
    /**
     * Template for error message.
     */
    const ERROR_MESSAGE = "Product with name: '%s' was not found on sales guest print page.\n";

    /**
     * Assert that products printed correctly on sales guest print page.
     *
     * @param SalesGuestPrint $salesGuestPrint
     * @param InjectableFixture[] $products
     * @return void
     */
    public function processAssert(SalesGuestPrint $salesGuestPrint, array $products)
    {
        $errors = '';
        foreach ($products as $product) {
            if (!$salesGuestPrint->getViewBlock()->isItemVisible($product)) {
                $errors .= sprintf(self::ERROR_MESSAGE, $product->getName());
            }
        }

        \PHPUnit_Framework_Assert::assertEmpty($errors, $errors);
    }

    /**
     * Returns a string representation of successful assertion.
     *
     * @return string
     */
    public function toString()
    {
        return "Products were printed correctly.";
    }
}
