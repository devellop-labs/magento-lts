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

namespace Mage\Catalog\Test\Block\Product\ProductList;

use Magento\Mtf\Block\Block;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\InjectableFixture;
use Magento\Mtf\Block\BlockInterface;

/**
 * Related product block on the page.
 */
class Related extends Block
{
    /**
     * Related product locator on the page.
     *
     * @var string
     */
    protected $relatedProduct = "//div[normalize-space(*[@class='product-name']//a)='%s']";

    /**
     * Get item block.
     *
     * @param InjectableFixture $product
     * @return BlockInterface
     */
    public function getItemBlock(InjectableFixture $product)
    {
        return $this->blockFactory->create(
            'Mage\Catalog\Test\Block\Product\ProductList\Related\Item',
            [
                'element' => $this->_rootElement->find(
                    sprintf($this->relatedProduct, $product->getName()),
                    Locator::SELECTOR_XPATH
                )
            ]
        );
    }

}
