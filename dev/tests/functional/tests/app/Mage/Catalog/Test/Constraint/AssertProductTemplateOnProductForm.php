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

use Mage\Catalog\Test\Fixture\CatalogAttributeSet;
use Mage\Catalog\Test\Fixture\CatalogProductAttribute;
use Mage\Catalog\Test\Fixture\CatalogProductSimple;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProductEdit;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProduct;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProductNew;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Mtf\Fixture\FixtureFactory;

/**
 * Check Attribute Set and Product Attribute on Product form.
 */
class AssertProductTemplateOnProductForm extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'high';
    /* end tags */

    /**
     * Assert that created product template:
     * 1. Displays in product template suggest container dropdown
     * 2. Can be used for new created product.
     *
     * @param FixtureFactory $fixtureFactory
     * @param CatalogProductEdit $productEdit
     * @param CatalogProduct $productGrid
     * @param CatalogAttributeSet $attributeSet
     * @param CatalogAttributeSet $attributeSetOriginal
     * @param CatalogProductNew $newProductPage
     * @param CatalogProductAttribute $productAttribute
     * @return void
     */
    public function processAssert(
        FixtureFactory $fixtureFactory,
        CatalogProductEdit $productEdit,
        CatalogProduct $productGrid,
        CatalogAttributeSet $attributeSet,
        CatalogProductNew $newProductPage,
        CatalogProductAttribute $productAttribute,
        CatalogAttributeSet $attributeSetOriginal = null
    ) {
        $productGrid->open();
        $productGrid->getGridPageActionBlock()->addNew();

        /**@var CatalogProductSimple $productSimple */
        $productSimple = $fixtureFactory->createByCode(
            'catalogProductSimple',
            [
                'dataset' => 'default',
                'data' => [
                    'attribute_set_id' => ['attribute_set' => $attributeSet],
                ],
            ]
        );
        $newProductPage->getProductForm()->fill($productSimple);
        $newProductPage->getFormPageActions()->saveAndContinue();

        $attributeSetName = $attributeSet->getAttributeSetName();
        \PHPUnit_Framework_Assert::assertTrue(
            $productEdit->getProductForm()->checkAttributeSet($attributeSetName),
            "Product isn't in '$attributeSetName' Attribute Set."
        );

        if ($attributeSetOriginal === null) {
            $productEdit->getProductForm()->openTab('general');

            \PHPUnit_Framework_Assert::assertTrue(
                $productEdit->getProductForm()->checkAttributeLabel($productAttribute),
                "Product Attribute is absent on Product form."
            );
        }
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Product Attribute and Attribute Set are present on the Product form.';
    }
}
