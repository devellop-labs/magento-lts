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

namespace Mage\Checkout\Test\Constraint;

/**
 * Assert that subtotal in the shopping cart is equals to expected total from data set.
 */
class AssertSubtotalInShoppingCart extends AbstractAssertProductInShoppingCart
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Data type.
     *
     * @var string
     */
    protected $dataType = 'subtotal';

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Subtotal in the shopping cart equals to expected total from data set.';
    }
}
