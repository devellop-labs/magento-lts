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

namespace Mage\Adminhtml\Test\Block\System\Process;

use Magento\Mtf\Client\Locator;

/**
 * Adminhtml index management grid.
 */
class Grid extends \Mage\Adminhtml\Test\Block\Widget\Grid
{
    /**
     * Mass action for all indexes.
     *
     * @param string $actionType
     * @return void
     */
    public function massactionForAll($actionType)
    {
        $this->_rootElement->find($this->selectAll)->click();
        $this->_rootElement->find($this->massactionSelect, Locator::SELECTOR_CSS, 'select')->setValue($actionType);
        $this->massActionSubmit(false);
    }
}
