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

namespace Mage\Adminhtml\Test\Block\System\Config;

use Magento\Mtf\Block\Block;
use Mage\Adminhtml\Test\Fixture\Store;

/**
 * Store switcher block.
 */
class Switcher extends Block
{
    /**
     * StoreView selector.
     *
     * @var string
     */
    protected $storeViewSelector = 'option[value$="%s"]';

    /**
     * Check if store visible in scope dropdown.
     *
     * @param Store $store
     * @return bool
     */
    public function isStoreVisible($store)
    {
        return $this->_rootElement->find(sprintf($this->storeViewSelector, $store->getCode()))->isVisible();
    }
}
