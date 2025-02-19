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

namespace Mage\Adminhtml\Test\Block\Catalog\Product\Edit\Tab\Configurable\QuickCreation;

use Magento\Mtf\Client\Element\SelectElement;
use Magento\Mtf\Client\Locator;

/**
 * Typified element class for attributes on creation form for configurable tab.
 */
class AttributesElement extends SelectElement
{
    /**
     * Selector for attribute input element.
     *
     * @var string
     */
    protected $attributeInput = '//tr[.//label[contains(text(),"%s")]]//select/option[@value=%s]';

    /**
     * Select attributes values.
     *
     * @param array $value
     * @return void
     */
    public function setValue($value)
    {
        $value = isset($value['value']) ? $value['value'] : $value;
        foreach ($value as $attributeCode => $itemValue) {
            $selector = sprintf($this->attributeInput, $attributeCode, $this->escapeQuotes($itemValue));
            $option = $this->find($selector, Locator::SELECTOR_XPATH);
            $option->click();
        }
    }

    /**
     * Skip this method.
     *
     * @return void
     */
    public function getValue()
    {
        //
    }
}
