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

namespace Mage\Adminhtml\Test\Block\Cms\Page\Edit;

use Mage\Adminhtml\Test\Block\Widget\FormTabs;
use Mage\Cms\Test\Fixture\CmsPage;
use Magento\Mtf\Client\Element\SimpleElement as Element;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\FixtureInterface;

/**
 * Backend Cms Page edit page.
 */
class PageForm extends FormTabs
{
    /**
     * Selector for store view field.
     *
     * @var string
     */
    protected $storeView = '#page_store_id';

    /**
     * Fill form with tabs.
     *
     * @param FixtureInterface $cms
     * @param Element|null $element
     * @return FormTabs
     */
    public function fill(FixtureInterface $cms, Element $element = null)
    {
        $this->fillStoreView($cms);
        return parent::fill($cms, $element);
    }

    /**
     * Fill store view.
     *
     * @param CmsPage $cms
     * @return void
     */
    protected function fillStoreView(CmsPage $cms)
    {
        $this->openTab('page_information');
        $storeViewField = $this->_rootElement->find($this->storeView, Locator::SELECTOR_CSS, 'multiselectgrouplist');
        if($storeViewField->isVisible() && !$cms->hasData('store_id')) {
            $storeViewField->setValue('All Store Views');
        }
    }
}
