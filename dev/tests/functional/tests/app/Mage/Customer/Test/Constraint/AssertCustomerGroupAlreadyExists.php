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

namespace Mage\Customer\Test\Constraint;

use Mage\Customer\Test\Page\Adminhtml\CustomerGroupNew;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 * Assert that customer group already exist error message is displayed after customer group save.
 */
class AssertCustomerGroupAlreadyExists extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Customer group already exists error message.
     */
    const ERROR_MESSAGE = 'Customer Group already exists.';

    /**
     * Assert that customer group already exist error message is displayed after customer group save.
     *
     * @param CustomerGroupNew $customerGroupNew
     * @return void
     */
    public function processAssert(CustomerGroupNew $customerGroupNew)
    {
        \PHPUnit_Framework_Assert::assertEquals(
            self::ERROR_MESSAGE,
            $customerGroupNew->getMessagesBlock()->getErrorMessages()
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Customer group already exist error message is displayed.';
    }
}
