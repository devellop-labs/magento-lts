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

namespace Mage\Widget\Test\Block\Adminhtml\Widget;

/**
 * Widget grid on the Widget Instance Index page.
 */
class WidgetGrid extends \Mage\Adminhtml\Test\Block\Widget\Grid
{
    /**
     * Locator value for link in action column.
     *
     * @var string
     */
    protected $editLink = 'td.last';

    /**
     * Filters array mapping.
     *
     * @var array
     */
    protected $filters = [
        'title' => [
            'selector' => 'input[name="title"]',
        ],
    ];
}
