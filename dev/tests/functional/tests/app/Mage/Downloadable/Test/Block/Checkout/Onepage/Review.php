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

namespace Mage\Downloadable\Test\Block\Checkout\Onepage;

use Mage\Downloadable\Test\Block\Checkout\Onepage\Review\Items;

/**
 * One page checkout status review block for downloadable product.
 */
class Review extends \Mage\Checkout\Test\Block\Onepage\Review
{
    /**
     * Items block class.
     *
     * @var string
     */
    protected $itemsBlock = 'Mage\Downloadable\Test\Block\Checkout\Onepage\Review\Items';
}
