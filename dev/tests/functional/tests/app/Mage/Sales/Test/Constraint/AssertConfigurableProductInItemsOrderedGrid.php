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

namespace Mage\Sales\Test\Constraint;

use Mage\Catalog\Test\Fixture\ConfigurableProduct;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Assert configurable product was added to Items Ordered grid in customer account on Order creation page backend.
 */
class AssertConfigurableProductInItemsOrderedGrid extends AssertProductInItemsOrderedGrid
{
    /**
     * Get configurable product price.
     *
     * @param InjectableFixture $product
     * @return int
     */
    protected function getProductPrice(InjectableFixture $product)
    {
        $price = $product->getPrice();
        if (!$this->productsIsConfigured) {
            return $price;
        }
        $checkoutData = $product->getCheckoutData();
        if ($checkoutData === null) {
            return 0;
        }
        $attributesData = $product->getConfigurableOptions()['attributes_data'];
        foreach ($checkoutData['options']['configurable_options'] as $option) {
            $itemOption = $attributesData[$option['title']]['options'][$option['value']];
            $price += $itemOption['price_type'] == 'Fixed'
                ? $itemOption['price']
                : $product->getPrice() / 100 * $itemOption['price'];
        }

        return $price;
    }
}
