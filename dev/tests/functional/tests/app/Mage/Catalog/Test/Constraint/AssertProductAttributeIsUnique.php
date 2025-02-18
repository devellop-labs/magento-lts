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

namespace Mage\Catalog\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Catalog\Test\Fixture\CatalogProductAttribute;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProductAttributeNew;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProductAttributeIndex;

/**
 * Check whether the attribute is unique.
 */
class AssertProductAttributeIsUnique extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Expected message.
     */
    const UNIQUE_MESSAGE = 'Attribute with the same code already exists';

    /**
     * Check whether the attribute is unique.
     *
     * @param CatalogProductAttribute $attribute
     * @param CatalogProductAttributeNew $attributeNew
     * @param CatalogProductAttributeIndex $catalogProductAttributeIndex
     * @return void
     */
    public function processAssert(
        CatalogProductAttribute $attribute,
        CatalogProductAttributeNew $attributeNew,
        CatalogProductAttributeIndex $catalogProductAttributeIndex
    ) {
        $catalogProductAttributeIndex->open();
        $catalogProductAttributeIndex->getPageActionsBlock()->addNew();
        $attributeNew->getAttributeForm()->fill($attribute);
        $attributeNew->getPageActions()->saveAndContinue();

        $actualMessage = $attributeNew->getMessagesBlock()->getErrorMessages();
        \PHPUnit_Framework_Assert::assertEquals(self::UNIQUE_MESSAGE, $actualMessage);
    }

    /**
     * Return string representation of object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Attribute is unique.';
    }
}
