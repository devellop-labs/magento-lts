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

use Mage\Customer\Test\Fixture\CustomerGroup;
use Mage\Customer\Test\Page\Adminhtml\CustomerNew;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 * Assert that customer group find on account information page.
 */
class AssertCustomerGroupOnCustomerForm extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert that customer group find on customer account information page.
     *
     * @param CustomerGroup $customerGroup
     * @param CustomerNew $customerNew
     * @return void
     */
    public function processAssert(CustomerGroup $customerGroup, CustomerNew $customerNew)
    {
        $customerNew->open();
        $formCustomerGroups = $customerNew->getCustomerForm()->getCustomerGroups();
        $customerGroupCode = $customerGroup->getCustomerGroupCode();
        \PHPUnit_Framework_Assert::assertTrue(
            in_array($customerGroupCode, $formCustomerGroups),
            "Customer group '{$customerGroupCode}' is absent on customer account information page"
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Customer group find on customer account information page.';
    }
}
