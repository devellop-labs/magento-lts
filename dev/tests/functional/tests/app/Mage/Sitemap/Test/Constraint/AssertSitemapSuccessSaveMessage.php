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

namespace Mage\Sitemap\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Sitemap\Test\Page\Adminhtml\SitemapIndex;

/**
 * Assert that success message is displayed after sitemap creation.
 */
class AssertSitemapSuccessSaveMessage extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Sitemap success save message.
     */
    const SUCCESS_MESSAGE = 'The sitemap has been saved.';

    /**
     * Assert that success message is displayed after sitemap creation.
     *
     * @param SitemapIndex $sitemapIndex
     * @return void
     */
    public function processAssert(SitemapIndex $sitemapIndex)
    {
        \PHPUnit_Framework_Assert::assertEquals(
            self::SUCCESS_MESSAGE,
            $sitemapIndex->getMessagesBlock()->getSuccessMessages()
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Sitemap success create message is present.';
    }
}
