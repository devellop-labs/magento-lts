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

namespace Mage\SalesRule\Test\TestStep;

use Mage\SalesRule\Test\Page\Adminhtml\PromoQuoteEdit;
use Mage\SalesRule\Test\Page\Adminhtml\PromoQuoteIndex;
use Magento\Mtf\TestStep\TestStepInterface;

/**
 * Delete all sales rules on backend.
 */
class DeleteAllSalesRuleStep implements TestStepInterface
{
    /**
     * Promo Quote index page.
     *
     * @var PromoQuoteIndex
     */
    protected $promoQuoteIndex;

    /**
     * Promo Quote edit page.
     *
     * @var PromoQuoteEdit
     */
    protected $promoQuoteEdit;

    /**
     * @constructor
     * @param PromoQuoteIndex $promoQuoteIndex
     * @param PromoQuoteEdit $promoQuoteEdit
     */
    public function __construct(PromoQuoteIndex $promoQuoteIndex, PromoQuoteEdit $promoQuoteEdit)
    {
        $this->promoQuoteIndex = $promoQuoteIndex;
        $this->promoQuoteEdit = $promoQuoteEdit;
    }

    /**
     * Delete all sales rules on backend.
     *
     * @return array
     */
    public function run()
    {
        $this->promoQuoteIndex->open();
        $this->promoQuoteIndex->getPromoQuoteGrid()->resetFilter();
        while ($this->promoQuoteIndex->getPromoQuoteGrid()->isFirstRowVisible()) {
            $this->promoQuoteIndex->getPromoQuoteGrid()->openFirstRow();
            $this->promoQuoteEdit->getFormPageActions()->delete();
        }
    }
}
