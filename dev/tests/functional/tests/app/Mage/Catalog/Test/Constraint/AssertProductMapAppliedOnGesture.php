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

use Mage\Cms\Test\Page\CmsIndex;
use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Catalog\Test\Fixture\CatalogCategory;
use Mage\Catalog\Test\Page\Category\CatalogCategoryView;

/**
 * Assert that products' MAP has been applied and price is visible MSRP popup dialog.
 */
class AssertProductMapAppliedOnGesture extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert that product products' MAP has been applied on gesture.
     *
     * @param CatalogCategoryView $catalogCategoryView
     * @param CmsIndex $cmsIndex
     * @param CatalogCategory $category
     * @param array $products
     * @return void
     */
    public function processAssert(
        CatalogCategoryView $catalogCategoryView,
        CmsIndex $cmsIndex,
        CatalogCategory $category,
        array $products
    ) {
        foreach ($products as $product) {
            $productName = $product->getName();
            $cmsIndex->open();
            $cmsIndex->getTopmenu()->selectCategory($category->getName());
            $listProductBlock = $catalogCategoryView->getListProductBlock();

            // Check that price is present in MAP popup.
            $productPriceBlock = $listProductBlock->getProductPriceBlock($productName);
            $productPriceBlock->clickForPrice();
            $msrpPopupBlock = $productPriceBlock->getMapBlock();
            $map = $msrpPopupBlock->isVisible() ? $msrpPopupBlock->getMap() : null;

            \PHPUnit_Framework_Assert::assertEquals(
                number_format($product->getPrice(), 2),
                $map,
                "MAP of $productName product is not visible or not equal to product price."
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
        return "Products' MAP has been applied on gesture.";
    }
}
