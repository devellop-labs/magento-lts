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

namespace Mage\Paypal\Test\Block\Product;

use Magento\Mtf\Fixture\InjectableFixture;
use Mage\Catalog\Test\Fixture\CatalogProductSimple;

/**
 * Product view block on the product page for pay pal.
 */
class View extends \Mage\Catalog\Test\Block\Product\View
{
    /**
     * 'Check out with PayPal' button
     *
     * @var string
     */
    protected $paypalCheckout = '[data-action=checkout-form-submit]';

    /**
     * Check out with PayPal.
     *
     * @param InjectableFixture $product
     * @return void
     */
    public function paypalCheckout(InjectableFixture $product)
    {
        /** @var CatalogProductSimple $product */
        $checkoutData = $product->getCheckoutData();
        if (isset($checkoutData['options'])) {
            $this->fillOptions($product);
        }
        if (isset($checkoutData['qty'])) {
            $this->setQty($checkoutData['qty']);
        }
        $this->_rootElement->find($this->paypalCheckout)->click();
    }
}
