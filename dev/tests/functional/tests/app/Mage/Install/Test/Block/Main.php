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

namespace Mage\Install\Test\Block;

use Magento\Mtf\Block\Block;

/**
 * Main block.
 */
class Main extends Block
{
    /**
     * Title text.
     *
     * @var string
     */
    protected $title = '.page-head';

    /**
     * Title text.
     *
     * @var string
     */
    protected $deployStatus = '#status';

    /**
     * Get license text.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_rootElement->find($this->title)->getText();
    }

    /**
     * Get license text.
     *
     * @return string
     */
    public function getDeployStatus()
    {
        return $this->_rootElement->find($this->deployStatus)->getText();
    }
}
