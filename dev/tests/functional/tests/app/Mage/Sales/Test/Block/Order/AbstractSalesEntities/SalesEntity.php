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

namespace Mage\Sales\Test\Block\Order\AbstractSalesEntities;

use Magento\Mtf\Block\Block;

/**
 * Item sales entity block.
 */
abstract class SalesEntity extends Block
{
    /**
     * Items block selector.
     *
     * @var string
     */
    protected $itemsSelector;

    /**
     * Sales entity items block class.
     *
     * @var string
     */
    protected $salesEntityItemsBlockClass;

    /**
     * Get items block.
     *
     * @return Block
     */
    public function getItemsBlock()
    {
        return $this->blockFactory->create(
            $this->salesEntityItemsBlockClass,
            ['element' => $this->_rootElement->find(sprintf($this->itemsSelector, $this->config['id']))]
        );
    }
}
