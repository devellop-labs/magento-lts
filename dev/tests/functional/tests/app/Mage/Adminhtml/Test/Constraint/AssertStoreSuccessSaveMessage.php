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

namespace Mage\Adminhtml\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Adminhtml\Test\Page\Adminhtml\StoreIndex;

/**
 * Assert that after Store View save successful message appears.
 */
class AssertStoreSuccessSaveMessage extends AbstractConstraint
{
    /**
     * Success store view create message.
     */
    const SUCCESS_MESSAGE = 'The store view has been saved';

    /**
     * Constraint severeness.
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Assert that success message is displayed after Store View has been created.
     *
     * @param StoreIndex $storeIndex
     * @param string|null $savedMessage
     * @return void
     */
    public function processAssert(StoreIndex $storeIndex, $savedMessage = null)
    {
        $expectedMessage = ($savedMessage === null) ? self::SUCCESS_MESSAGE : $savedMessage;
        \PHPUnit_Framework_Assert::assertEquals(
            $expectedMessage,
            $storeIndex->getMessagesBlock()->getSuccessMessages(),
            'Wrong success message is displayed.'
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Store View success create message is present.';
    }
}
