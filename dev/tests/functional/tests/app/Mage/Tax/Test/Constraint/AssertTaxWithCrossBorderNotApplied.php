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

namespace Mage\Tax\Test\Constraint;

/**
 * Checks that prices on category, product and cart pages are equal for each customer.
 */
class AssertTaxWithCrossBorderNotApplied extends AbstractAssertTaxWithCrossBorderApplying
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert prices on category, product and cart pages are equal for each customer.
     *
     * @param array $actualPrices
     * @return void
     */
    public function assert(array $actualPrices)
    {
        //Prices verification
        \PHPUnit_Framework_Assert::assertNotEmpty(
            array_diff($actualPrices[0], $actualPrices[1]),
            'Prices for customers should be different.'
        );
    }

    /**
     * Returns string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Cross border trading is not applied on front.';
    }
}
