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

use Mage\Adminhtml\Test\Block\Widget\Grid as GridInterface;

/**
 * Appurtenant products grid.
 */
abstract class AbstractAppurtenantProductsGrid extends GridInterface
{
    /**
     * Grid fields map.
     *
     * @var array
     */
    protected $filters = [
        'name' => [
            'selector' => 'input[name="name"]',
        ],
        'sku' => [
            'selector' => 'input[name="sku"]',
        ],
        'type' => [
            'selector' => 'select[name="type"]',
            'input' => 'select',
        ],
    ];

    /**
     * Column selectors map.
     *
     * @var array
     */
    protected $columnFilters = [
        'entity_id' => '.="ID"',
        'name' => '.="Name"',
        'sku' => '.="SKU"',
    ];
}
