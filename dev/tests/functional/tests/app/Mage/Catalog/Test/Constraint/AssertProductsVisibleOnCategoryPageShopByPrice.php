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

use Mage\Catalog\Test\Fixture\CatalogCategory;
use Magento\Mtf\Client\Browser;
use Magento\Mtf\Fixture\InjectableFixture;
use Mage\Catalog\Test\Page\Category\CatalogCategoryView;

/**
 * Assert that filtered product is present on category page by price and another products are absent.
 */
class AssertProductsVisibleOnCategoryPageShopByPrice extends AbstractAssertProductsVisibleOnCategoryPageShopByFilter
{
    /**
     * Constraint severeness.
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Assert that filtered product is present on category page by price and another products are absent.
     *
     * @param CatalogCategoryView $catalogCategoryView
     * @param Browser $browser
     * @param CatalogCategory $category
     * @param InjectableFixture[] $products
     * @param string $searchProductsIndexes
     * @param string $filterLink
     * @return void
     */
    public function processAssert(
        CatalogCategoryView $catalogCategoryView,
        Browser $browser,
        CatalogCategory $category,
        array $products,
        $searchProductsIndexes,
        $filterLink
    ) {
        $browser->open($_ENV['app_frontend_url'] . strtolower($category->getUrlKey()) . '.html');
        $catalogCategoryView->getLayeredNavigationBlock()->selectPrice($filterLink);

        $this->verify($catalogCategoryView, $products, $searchProductsIndexes);
    }


    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Product is present in category after filter by price.';
    }
}
