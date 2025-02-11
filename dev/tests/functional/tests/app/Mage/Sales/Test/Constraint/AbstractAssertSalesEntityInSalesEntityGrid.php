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

use Mage\Sales\Test\Fixture\Order;
use Mage\Adminhtml\Test\Block\Widget\Grid;
use Mage\Shipping\Test\Page\Adminhtml\SalesShipment;

/**
 * Abstract assert sales entity with corresponding filter is present in 'Sales Entity' with correct data.
 */
abstract class AbstractAssertSalesEntityInSalesEntityGrid extends AbstractAssertSalesEntityInGrid
{
    /**
     * Sales entity index page.
     *
     * @var SalesShipment
     */
    protected $salesEntityIndexPage;

    /**
     * Open page for assert.
     *
     * @return void
     */
    protected function openPage()
    {
        $this->salesEntityIndexPage->open();
    }

    /**
     * Get grid for assert.
     *
     * @return Grid
     */
    protected function getGrid()
    {
        return $this->salesEntityIndexPage->getGrid();
    }

    /**
     * Get default filter.
     *
     * @param string $entityId
     * @return array
     */
    protected function getDefaultFilter($entityId)
    {
        return ['id' => $entityId, 'order_id' => $this->orderId];
    }
}
