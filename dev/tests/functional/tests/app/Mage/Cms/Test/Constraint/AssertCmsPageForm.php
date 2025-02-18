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

namespace Mage\Cms\Test\Constraint;

use Mage\Cms\Test\Fixture\CmsPage;
use Mage\Cms\Test\Page\Adminhtml\CmsPageEdit;
use Magento\Mtf\Constraint\AbstractAssertForm;
use Mage\Cms\Test\Page\Adminhtml\CmsPageIndex;
use Mage\Cms\Test\Page\Adminhtml\CmsPageNew;
use Mage\Adminhtml\Test\Block\Cms\Page\Edit\Tab\Content;

/**
 * Assert that displayed CMS page data on edit page equals passed from fixture.
 */
class AssertCmsPageForm extends AbstractAssertForm
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Skipped fields for verify data.
     *
     * @var array
     */
    protected $skippedFields = ['content', 'page_id'];

    /**
     * Assert that displayed CMS page data on edit page equals passed from fixture.
     *
     * @param CmsPage $cms
     * @param CmsPageIndex $cmsPageIndex
     * @param CmsPageNew $cmsPageNew
     * @return void
     */
    public function processAssert(CmsPage $cms, CmsPageIndex $cmsPageIndex, CmsPageNew $cmsPageNew)
    {
        $cmsPageIndex->open();
        $cmsPageIndex->getCmsPageGridBlock()->searchAndOpen(['title' => $cms->getTitle()]);
        $cmsFormData = $cmsPageNew->getPageForm()->getData($cms);
        $errors = $this->verifyData($cms->getData(), $cmsFormData);
        \PHPUnit_Framework_Assert::assertEmpty($errors, $errors);
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'CMS page data on edit page equals data from fixture.';
    }
}
