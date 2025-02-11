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

namespace Mage\Sales\Test\TestStep;

use Mage\Sales\Test\Page\Adminhtml\SalesOrderIndex;
use Magento\Mtf\TestStep\TestStepInterface;

/**
 * Open Sales Orders.
 */
class OpenSalesOrdersStep implements TestStepInterface
{
    /**
     * Sales order index page.
     *
     * @var SalesOrderIndex
     */
    protected $orderIndex;

    /**
     * @constructor
     * @param SalesOrderIndex $orderIndex
     */
    public function __construct(SalesOrderIndex $orderIndex)
    {
        $this->orderIndex = $orderIndex;
    }

    /**
     * Open Sales order.
     *
     * @return void
     */
    public function run()
    {
        $this->orderIndex->open();
    }
}
