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

namespace Mage\Adminhtml\Test\Block\System\Store\Delete;

use Magento\Mtf\Block\Form;

/**
 * Form for website deleted.
 */
class Website extends Form
{
    /**
     * Action buttons container.
     *
     * @var string
     */
    protected $buttonContainer = '.content-footer';

    /**
     * 'Delete Website' button css selector.
     *
     * @var string
     */
    protected $delete = '.scalable.delete';

    /**
     * Delete website.
     *
     * @return void
     */
    public function delete()
    {
        $mapping = $this->dataMapping(['create_backup' => 'No']);
        $this->_fill($mapping);
        $this->_rootElement->find($this->delete)->click();
    }

    /**
     * Check whether element is visible
     *
     * @return bool
     */
    public function isVisible()
    {
        return $this->_rootElement->find($this->buttonContainer)->isVisible();
    }
}
