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

namespace Mage\Wishlist\Test\Block\Customer\Wishlist;

use Mage\Wishlist\Test\Block\Customer\Wishlist\Items\Product;
use Magento\Mtf\Block\Block;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Customer wishlist items block on frontend.
 */
class Items extends Block
{
    /**
     * Item product block.
     *
     * @var string
     */
    protected $itemProductBlock = '//tbody//tr[.//h3[@class="product-name" and *[text()="%s"]]]';

    /**
     * Get item product block.
     *
     * @param InjectableFixture $product
     * @return Product
     */
    public function getItemProductBlock(InjectableFixture $product)
    {
        $selector = sprintf($this->itemProductBlock, $product->getName());
        return $this->blockFactory->create(
            'Mage\Wishlist\Test\Block\Customer\Wishlist\Items\Product',
            ['element' => $this->_rootElement->find($selector, Locator::SELECTOR_XPATH)]
        );
    }
}
