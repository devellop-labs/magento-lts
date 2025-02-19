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

namespace Mage\Adminhtml\Test\Block\Catalog\Product\Edit\Tab\AssociatedProducts;

use Mage\Adminhtml\Test\Block\Widget\Grid as GridInterface;

/**
 * Associated product grid.
 */
class Grid extends GridInterface
{
    /**
     * Filters array mapping.
     *
     * @var array
     */
    protected $filters = [
        'name' => [
            'selector' => '#super_product_grid_filter_name',
        ],
        'id' => [
            'selector' => '#super_product_grid_filter_entity_id',
        ],
        'sku' => [
            'selector' => '#super_product_grid_filter_sku',
        ],
    ];
}
