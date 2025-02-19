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

use Magento\Mtf\Client\Browser;
use Mage\Checkout\Test\Page\CheckoutCart;
use Magento\Mtf\Fixture\InjectableFixture;
use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Catalog\Test\Fixture\CatalogProductSimple;
use Mage\Catalog\Test\Fixture\ConfigurableProduct;
use Mage\Catalog\Test\Page\Product\CatalogProductView;

/**
 * Assert that products are displayed in related section.
 */
class AssertRelatedProducts extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'middle';
    /* end tags */

    /**
     * Assert that products are displayed in related section.
     *
     * @param Browser $browser
     * @param CheckoutCart $checkoutCart
     * @param CatalogProductView $catalogProductView
     * @param array $productsData
     * @param array $relatedProductsData
     * @return void
     */
    public function processAssert(
        Browser $browser,
        CheckoutCart $checkoutCart,
        CatalogProductView $catalogProductView,
        array $productsData,
        array $relatedProductsData
    ) {
        $checkoutCart->open()->getCartBlock()->clearShoppingCart();

        $index = $relatedProductsData['firstProduct']['productIndex'];
        $productCheck = $productsData[$index]['product'];
        $relatedProducts = $productsData[$index]['relatedProducts']['related_products']['value'];
        $browser->open($_ENV['app_frontend_url'] . $productCheck->getUrlKey() . '.html');
        $this->assertRelatedSection($catalogProductView, $relatedProducts);

        $index = $relatedProductsData['secondProduct']['productIndex'];
        $productCheck = $productsData[$index]['product'];
        $relatedProducts = $productsData[$index]['relatedProducts']['related_products']['value'];
        $this->openRelatedProduct($catalogProductView, $productCheck);
        $this->assertRelatedSection($catalogProductView, $relatedProducts);

        $index = $relatedProductsData['thirdProduct']['productIndex'];
        $productCheck = $productsData[$index]['product'];
        $this->openRelatedProduct($catalogProductView, $productCheck);
        $this->assertRelatedSectionAbsent($catalogProductView);
    }

    /**
     * Open related product.
     *
     * @param CatalogProductView $catalogProductView
     * @param InjectableFixture $productCheck
     * @return void
     */
    protected function openRelatedProduct(CatalogProductView $catalogProductView, InjectableFixture $productCheck)
    {
        $relatedBlock = $catalogProductView->getRelatedProductBlock();
        $relatedBlock->getItemBlock($productCheck)->openProduct();
    }

    /**
     * Check products on related section.
     *
     * @param CatalogProductView $catalogProductView
     * @param array $relatedProducts
     * @return void
     */
    protected function assertRelatedSection(CatalogProductView $catalogProductView, array $relatedProducts)
    {
        $errors = [];
        $relatedBlock = $catalogProductView->getRelatedProductBlock();
        foreach ($relatedProducts as $relatedProduct) {
            if (!$relatedBlock->getItemBlock($relatedProduct)->isVisible()) {
                $errors[] = "Product {$relatedProduct->getName()} is absent in up-sell section.";
            }
        }

        \PHPUnit_Framework_Assert::assertEmpty($errors, implode("\n", $errors));
    }

    /**
     * Check that related section is absent.
     *
     * @param CatalogProductView $catalogProductView
     * @return void
     */
    protected function assertRelatedSectionAbsent(CatalogProductView $catalogProductView)
    {
        \PHPUnit_Framework_Assert::assertFalse($catalogProductView->getUpsellBlock()->isVisible());
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Products are displayed in related section.';
    }
}
