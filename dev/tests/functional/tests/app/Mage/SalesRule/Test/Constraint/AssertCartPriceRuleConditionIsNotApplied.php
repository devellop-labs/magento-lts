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

namespace Mage\SalesRule\Test\Constraint;

/**
 * Assert that shopping cart subtotal equals with grand total(excluding shipping price if exist).
 */
class AssertCartPriceRuleConditionIsNotApplied extends AbstractCartPriceRuleApplying
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert that shopping cart subtotal equals with grand total.
     *
     * @return void
     */
    protected function assert()
    {
        $totals = $this->getTotals();
        \PHPUnit_Framework_Assert::assertEquals(
            $totals['subtotal'],
            $totals['grandTotal'],
            "Shopping cart subtotal: " . $totals['subtotal'] . " not equals with grand total: " . $totals['grandTotal']
            . ".\nPrice rule has been applied."
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return "Shopping cart subtotal equals with grand total - price rule hasn't been applied.";
    }
}
