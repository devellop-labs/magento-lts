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

namespace Mage\Adminhtml\Test\Block\Cms\Block\Edit;

use Magento\Mtf\Block\Form;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Client\Element\SimpleElement;
use Magento\Mtf\Fixture\FixtureInterface;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Block adminhtml form.
 */
class BlockForm extends Form
{
    /**
     * Content Editor toggle button id.
     *
     * @var string
     */
    protected $toggleButton = "#toggleblock_content";

    /**
     * Content Editor form.
     *
     * @var string
     */
    protected $contentForm = "#block_content";

    /**
     * Page Content Show/Hide Editor toggle button.
     *
     * @return void
     */
    public function toggleEditor()
    {
        $content = $this->_rootElement->find($this->contentForm, Locator::SELECTOR_CSS);
        $toggleButton = $this->_rootElement->find($this->toggleButton, Locator::SELECTOR_CSS);
        if (!$content->isVisible()) {
            $toggleButton->click();
        }
    }

    /**
     * Fill form.
     *
     * @param FixtureInterface $fixture
     * @param SimpleElement|null $element
     * @return void
     */
    public function fill(FixtureInterface $fixture, SimpleElement $element = null)
    {
        $this->toggleEditor();
        parent::fill($fixture, $element);
    }
}
