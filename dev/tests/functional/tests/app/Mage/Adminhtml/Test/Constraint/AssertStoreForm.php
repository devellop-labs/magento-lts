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

use Magento\Mtf\Constraint\AbstractAssertForm;
use Mage\Adminhtml\Test\Fixture\Store;
use Mage\Adminhtml\Test\Page\Adminhtml\StoreNew;
use Mage\Adminhtml\Test\Page\Adminhtml\StoreIndex;

/**
 * Assert that displayed Store View data on edit page equals passed from fixture.
 */
class AssertStoreForm extends AbstractAssertForm
{
    /**
     * Constraint severeness.
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Assert that displayed Store View data on edit page equals passed from fixture.
     *
     * @param StoreIndex $storeIndex
     * @param StoreNew $storeNew
     * @param Store $store
     * @return void
     */
    public function processAssert(StoreIndex $storeIndex, StoreNew $storeNew, Store $store)
    {
        $storeIndex->open()->getStoreGrid()->openStore($store);
        $errors = $this->verifyData($store->getData(), $storeNew->getStoreForm()->getData());
        \PHPUnit_Framework_Assert::assertEmpty($errors, $errors);
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Store View data on edit page equals data from fixture.';
    }
}
