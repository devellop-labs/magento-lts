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

use Mage\Catalog\Test\Page\Product\CatalogProductView;
use Magento\Mtf\Client\Browser;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Assert that 'Add to Cart' button is present on product page.
 */
class AssertAddToCartButtonPresent extends AbstractConstraint
{
    /**
     * Assert that 'Add to Cart' button is present on product page.
     *
     * @param CatalogProductView $catalogProductView
     * @param InjectableFixture $product
     * @param Browser $browser
     * @return void
     */
    public function processAssert(CatalogProductView $catalogProductView, InjectableFixture $product, Browser $browser)
    {
        $browser->open($_ENV['app_frontend_url'] . $product->getUrlKey() . '.html');
        \PHPUnit_Framework_Assert::assertTrue(
            $catalogProductView->getViewBlock()->checkAddToCartButton(),
            'Add to Cart button is absent on product page'
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Add to Cart button is present on product page.';
    }
}
