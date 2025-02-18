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

namespace Mage\Checkout\Test\Block\Cart;

use Mage\Checkout\Test\Block\AbstractItem;

/**
 * Product item block on checkout page.
 */
class CartItem extends AbstractItem
{
    /**
     * MSRP selector.
     *
     * @var string
     */
    protected $msrp = '.cart-msrp-unit';

    /**
     * Selector for "Edit" button.
     *
     * @var string
     */
    protected $edit = '.action.edit';

    /**
     * 'Move to Wishlist' button.
     *
     * @var string
     */
    protected $wishlistButton = '[data-rwd-label="Qty"] .link-wishlist';

    /**
     * Selector for "Remove item" button.
     *
     * @var string
     */
    protected $removeItem = '.product-cart-remove .btn-remove';

    /**
     * Check if MSRP text is visible.
     *
     * @return bool
     */
    public function isMsrpVisible()
    {
        return $this->_rootElement->find($this->msrp)->isVisible();
    }

    /**
     * Check that edit button visible.
     *
     * @return bool
     */
    public function isEditButtonVisible()
    {
        return $this->_rootElement->find($this->edit)->isVisible();
    }

    /**
     * Click on move to wishlist button.
     *
     * @return void
     */
    public function moveToWishlist()
    {
        $this->_rootElement->find($this->wishlistButton)->click();
    }

    /**
     * Remove product item from cart.
     *
     * @return void
     */
    public function removeItem()
    {
        $this->_rootElement->find($this->removeItem)->click();
    }
}
