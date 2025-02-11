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

namespace Mage\CurrencySymbol\Test\TestStep;

use Magento\Mtf\TestStep\TestStepInterface;
use Mage\CurrencySymbol\Test\Page\Adminhtml\SystemCurrencyIndex;

/**
 * Import currency rates.
 */
class ImportCurrencyRatesStep implements TestStepInterface
{
    /**
     * Currency symbols.
     *
     * @var string
     */
    protected $currencySymbols;

    /**
     * @constructor
     * @param SystemCurrencyIndex $currencyRatesIndex
     * @param string $currencySymbols
     */
    public function __construct(SystemCurrencyIndex $currencyRatesIndex, $currencySymbols)
    {
        $this->currencyRatesIndex = $currencyRatesIndex;
        $this->currencySymbols = $currencySymbols;
    }

    /**
     * Import currency rates step.
     *
     * @return void
     */
    public function run()
    {
        if ($this->currencySymbols !== '-') {
            $this->currencyRatesIndex->open();
            $this->currencyRatesIndex->getGridPageActions()->clickImportButton();
            $this->currencyRatesIndex->getGridPageActions()->saveCurrentRate();
        }
    }
}
