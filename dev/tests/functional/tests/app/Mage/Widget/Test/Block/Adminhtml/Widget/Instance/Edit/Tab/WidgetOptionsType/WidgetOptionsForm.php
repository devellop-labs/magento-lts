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

namespace Mage\Widget\Test\Block\Adminhtml\Widget\Instance\Edit\Tab\WidgetOptionsType;

use Mage\Adminhtml\Test\Block\Template;
use Magento\Mtf\Block\Form;
use Magento\Mtf\Block\BlockInterface;
use Magento\Mtf\Client\Element\SimpleElement as Element;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Responds for filling widget options form.
 */
class WidgetOptionsForm extends Form
{
    /**
     * Select page button.
     *
     * @var string
     */
    protected $selectPage = '.scalable.btn-chooser';

    /**
     * Select block.
     *
     * @var string
     */
    protected $selectBlock = '';

    /**
     * Grid block locator.
     *
     * @var string
     */
    protected $gridBlock = '';

    /**
     * Path to grid.
     *
     * @var string
     */
    protected $pathToGrid = '';

    /**
     * Selector for template block.
     *
     * @var string
     */
    protected $template = './ancestor::body';

    /**
     * Filling widget options form.
     *
     * @param array $widgetOptionsFields
     * @param Element $element [optional]
     * @return void
     */
    public function fillForm(array $widgetOptionsFields, Element $element = null)
    {
        $element = $element === null ? $this->_rootElement : $element;
        $mapping = $this->dataMapping($widgetOptionsFields);
        $fields = array_diff_key($mapping, ['entities' => '']);
        $this->_fill($fields, $element);
        if (isset($mapping['entities'])) {
            $this->selectEntities($mapping['entities']);
        }
    }

    /**
     * Getting options data form on the widget options form.
     *
     * @param array $fields
     * @param Element $element [optional]
     * @return $this
     */
    public function getDataOptions(array $fields = null, Element $element = null)
    {
        $element = $element === null ? $this->_rootElement : $element;
        $mapping = $this->dataMapping($fields);
        return $this->_getData($mapping, $element);
    }

    /**
     * Select entities on widget options tab.
     *
     * @param array $entities
     * @return void
     */
    protected function selectEntities(array $entities)
    {
        foreach ($entities['value'] as $entity) {
            $this->_rootElement->find($this->selectBlock)->click();
            $this->getTemplateBlock()->waitLoader();
            $grid = $this->getGridBlock();
            $filter = $this->prepareFilter($entity);
            $grid->searchAndSelect($filter);
        }
    }

    /**
     * Get grid block.
     *
     * @return BlockInterface
     */
    protected function getGridBlock()
    {
        return $this->blockFactory->create(
            $this->pathToGrid,
            ['element' => $this->_rootElement->find($this->gridBlock, Locator::SELECTOR_XPATH)]
        );
    }

    /**
     * Prepare filter for grid.
     *
     * @param InjectableFixture $entity
     * @return array
     */
    protected function prepareFilter(InjectableFixture $entity)
    {
        return ['title' => $entity->getTitle()];
    }

    /**
     * Get template block.
     *
     * @return Template
     */
    public function getTemplateBlock()
    {
        return $this->blockFactory->create(
            'Magento\Backend\Test\Block\Template',
            ['element' => $this->_rootElement->find($this->template, Locator::SELECTOR_XPATH)]
        );
    }
}
