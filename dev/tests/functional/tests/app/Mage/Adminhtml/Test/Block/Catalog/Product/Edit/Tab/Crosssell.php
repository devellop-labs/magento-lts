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

namespace Mage\Adminhtml\Test\Block\Catalog\Product\Edit\Tab;

use Mage\Adminhtml\Test\Block\Catalog\Product\Edit\Tab\Crosssell\Grid as CrosssellGrid;
use Magento\Mtf\Client\Element\SimpleElement as Element;

/**
 * Cross-sells Tab.
 */
class Crosssell extends AbstractAppurtenant
{
    /**
     * Crosssell products type.
     *
     * @var string
     */
    protected $type = 'cross_sell_products';

    /**
     * Locator for cross sell products grid.
     *
     * @var string
     */
    protected $crossSellGrid = '#cross_sell_product_grid';

    /**
     * Get Crosssell grid.
     *
     * @param Element|null $element [optional]
     * @return CrosssellGrid
     */
    protected function getGrid(Element $element = null)
    {
        $element = $element ? $element : $this->_rootElement;
        return $this->blockFactory->create(
            '\Mage\Adminhtml\Test\Block\Catalog\Product\Edit\Tab\Crosssell\Grid',
            ['element' => $element->find($this->crossSellGrid)]
        );
    }
}
