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

namespace Mage\Page\Test\Block\Html;

use Magento\Mtf\Block\Block;
use Magento\Mtf\Client\Locator;
use Mage\Adminhtml\Test\Fixture\Store;

/**
 * Footer block.
 */
class Footer extends Block
{
    /**
     * Store Group switch selector.
     *
     * @var string
     */
    protected $storeGroupSwitch = '#select-store';

    /**
     * Link selector.
     *
     * @var string
     */
    protected $linkSelector = '//*[contains(@class, "links")]//a[contains(text(), "%s")]';

    /**
     * Check if store visible in dropdown.
     *
     * @param Store $store
     * @return bool
     */
    public function isStoreGroupVisible(Store $store)
    {
        $availableGroups = explode("\n", $this->_rootElement->find($this->storeGroupSwitch)->getText());
        $storeGroupName = explode('/', $store->getGroupId())[1];

        return in_array($storeGroupName, $availableGroups);
    }

    /**
     * Check if store group switcher is visible.
     *
     * @return bool
     */
    public function isStoreGroupSwitcherVisible()
    {
        return $this->_rootElement->find($this->storeGroupSwitch)->isVisible();
    }

    /**
     * Select store group.
     *
     * @param Store $store
     * @return void
     */
    public function selectStoreGroup(Store $store)
    {
        $storeGroupName = explode("/", $store->getGroupId())[1];
        $this->_rootElement->find($this->storeGroupSwitch, Locator::SELECTOR_CSS, 'select')->setValue($storeGroupName);
    }

    /**
     * Click on link by name.
     *
     * @param string $linkName
     * @return void
     * @throws \Exception
     */
    public function clickLink($linkName)
    {
        $link = $this->_rootElement->find(sprintf($this->linkSelector, $linkName), Locator::SELECTOR_XPATH);
        if (!$link->isVisible()) {
            throw new \Exception(sprintf('"%s" link is not visible', $linkName));
        }
        $link->click();
    }
}
