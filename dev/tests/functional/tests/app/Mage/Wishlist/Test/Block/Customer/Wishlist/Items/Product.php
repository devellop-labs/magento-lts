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

namespace Mage\Wishlist\Test\Block\Customer\Wishlist\Items;

use Magento\Mtf\Block\Form;

/**
 * Wishlist item product form.
 */
class Product extends Form
{
    /**
     * Selector for 'View Details' element.
     *
     * @var string
     */
    protected $viewDetails = '.details';

    /**
     * Selector for option's label.
     *
     * @var string
     */
    protected $optionLabel = 'dl dt';

    /**
     * Selector for option's value.
     *
     * @var string
     */
    protected $optionValue = 'dl dd';

    /**
     * Selector for 'Add to Cart' button.
     *
     * @var string
     */
    protected $addToCart = '.btn-cart';

    /**
     * Edit button css selector.
     *
     * @var string
     */
    protected $edit = '.link-edit';

    /**
     * Get product options.
     *
     * @return array|null
     */
    public function getOptions()
    {
        $viewDetails = $this->_rootElement->find($this->viewDetails);
        if ($viewDetails->isVisible()) {
            $viewDetails->click();
            $labels = $this->_rootElement->getElements($this->optionLabel);
            $values = $this->_rootElement->getElements($this->optionValue);
            $data = [];
            foreach ($labels as $key => $label) {
                if (!$label->isVisible()) {
                    $viewDetails->click();
                }
                $data[] = [
                    'title' => $label->getText(),
                    'value' => str_replace('$', '', $values[$key]->getText()),
                ];
            }
            return $data;
        } else {
            return null;
        }
    }

    /**
     * Fill item product details.
     *
     * @param array $fields
     * @return void
     */
    public function fillProduct(array $fields)
    {
        $mapping = $this->dataMapping($fields);
        $this->_fill($mapping);
    }

    /**
     * Click button 'Add To Cart'
     *
     * @return void
     */
    public function clickAddToCart()
    {
        $this->_rootElement->find($this->addToCart)->click();
    }

    /**
     * Click edit button.
     *
     * @return void
     */
    public function clickEdit()
    {
        $this->_rootElement->find($this->edit)->click();
    }
}
