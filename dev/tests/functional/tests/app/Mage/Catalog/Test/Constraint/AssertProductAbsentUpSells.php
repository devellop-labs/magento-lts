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

use Mage\Catalog\Test\Fixture\CatalogProductSimple;
use Mage\Catalog\Test\Page\Product\CatalogProductView;
use Magento\Mtf\Client\BrowserInterface;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Assert that product is not displayed in up-sell section.
 */
class AssertProductAbsentUpSells extends AbstractConstraint
{
    /**
     * Assert that product is not displayed in up-sell section.
     *
     * @param BrowserInterface $browser
     * @param CatalogProductSimple $product
     * @param CatalogProductView $catalogProductView
     * @param InjectableFixture[]|null $promotedProducts
     * @return void
     */
    public function processAssert(
        BrowserInterface $browser,
        CatalogProductSimple $product,
        CatalogProductView $catalogProductView,
        array $promotedProducts = null
    ) {
        if (!$promotedProducts) {
            $promotedProducts = $product->hasData('up_sell_products')
                ? $product->getDataFieldConfig('up_sell_products')['source']->getProducts()
                : [];
        }

        $browser->open($_ENV['app_frontend_url'] . $product->getUrlKey() . '.html');
        foreach ($promotedProducts as $promotedProduct) {
            \PHPUnit_Framework_Assert::assertFalse(
                $catalogProductView->getUpsellBlock()->getItemBlock($promotedProduct)->isVisible(),
                'Product \'' . $promotedProduct->getName() . '\' is exist in up-sells products.'
            );
        }
    }

    /**
     * Text success product is not displayed in up-sell section.
     *
     * @return string
     */
    public function toString()
    {
        return 'Product is not displayed in up-sell section.';
    }
}
