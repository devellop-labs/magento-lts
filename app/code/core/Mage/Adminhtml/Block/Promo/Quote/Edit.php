<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2022 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Shopping cart rule edit form block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 */
class Mage_Adminhtml_Block_Promo_Quote_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize form
     * Add standard buttons
     * Add "Save and Continue" button
     */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'promo_quote';

        parent::__construct();

        $this->_addButton('save_and_continue_edit', [
            'class'   => 'save',
            'label'   => Mage::helper('salesrule')->__('Save and Continue Edit'),
            'onclick' => 'editForm.submit($(\'edit_form\').action + \'back/edit/\')',
        ], 10);
    }

    /**
     * Getter for form header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $rule = Mage::registry('current_promo_quote_rule');
        if ($rule->getRuleId()) {
            return Mage::helper('salesrule')->__("Edit Rule '%s'", $this->escapeHtml($rule->getName()));
        }
        return Mage::helper('salesrule')->__('New Rule');
    }

    /**
     * Retrieve products JSON
     *
     * @return string
     */
    public function getProductsJson()
    {
        return '{}';
    }
}
