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

use Mage\Cms\Test\Fixture\CmsBlock;
use Mage\Cms\Test\Page\Adminhtml\CmsBlockIndex;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 * Assert that created CMS block can be found in grid.
 */
class AssertCmsBlockInGrid extends AbstractConstraint
{
    /**
     * Assert that created CMS block can be found in grid via: title, identifier, status.
     *
     * @param CmsBlock $cmsBlock
     * @param CmsBlockIndex $cmsBlockIndex
     * @return void
     */
    public function processAssert(CmsBlock $cmsBlock, CmsBlockIndex $cmsBlockIndex)
    {
        $cmsBlockIndex->open();
        $data = $cmsBlock->getData();
        $filter = [
            'title' => $data['title'],
            'identifier' => $data['identifier'],
            'is_active' => $data['is_active'],
        ];

        $cmsBlockIndex->getCmsBlockGrid()->search($filter);

        \PHPUnit_Framework_Assert::assertTrue(
            $cmsBlockIndex->getCmsBlockGrid()->isRowVisible($filter, false, false)
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'CMS Block is present in grid.';
    }
}
