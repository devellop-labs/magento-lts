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

namespace Mage\Adminhtml\Test\Block\Tax\Rate;

/**
 * Tax rates grid on Tax Rate index page.
 */
class RatesGrid extends \Mage\Adminhtml\Test\Block\Widget\Grid
{
    /**
     * Grid filters' selectors.
     *
     * @var array
     */
    protected $filters = [
        'code' => [
            'selector' => 'input[name="code"]',
        ],
        'tax_country_id' => [
            'selector' => 'select[name="tax_country_id"]',
            'input' => 'select',
        ],
        'tax_postcode' => [
            'selector' => 'input[name="tax_postcode"]',
        ],
    ];

    /**
     * Locator value of td with tax rate.
     *
     * @var string
     */
    protected $editLink = 'td';
}
