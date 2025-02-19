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

namespace Mage\Sitemap\Test\TestCase;

use Magento\Mtf\TestCase\Injectable;
use Mage\Sitemap\Test\Fixture\Sitemap;
use Mage\Sitemap\Test\Page\Adminhtml\SitemapIndex;
use Mage\Sitemap\Test\Page\Adminhtml\SitemapNew;

/**
 * Steps:
 * 1. Login to the backend.
 * 2. Navigate to Catalog > Google Sitemap.
 * 3. Click "Add Sitemap" button.
 * 4. Fill out all data according to data set.
 * 5. Click "Save" button.
 * 6. Perform all assertions.
 *
 * @group XML_Sitemap_(PS)
 * @ZephyrId MPERF-7060
 */
class CreateSitemapEntityTest extends Injectable
{
    /**
     * Sitemap index page.
     *
     * @var SitemapIndex
     */
    protected $sitemapIndex;

    /**
     * Sitemap new page.
     *
     * @var SitemapNew
     */
    protected $sitemapNew;

    /**
     * Injection pages.
     *
     * @param SitemapIndex $sitemapIndex
     * @param SitemapNew $sitemapNew
     * @return void
     */
    public function __inject(SitemapIndex $sitemapIndex, SitemapNew $sitemapNew)
    {
        $this->sitemapIndex = $sitemapIndex;
        $this->sitemapNew = $sitemapNew;
    }

    /**
     * Create sitemap.
     *
     * @param Sitemap $sitemap
     * @return void
     */
    public function test(Sitemap $sitemap)
    {
        // Steps
        $this->sitemapIndex->open();
        $this->sitemapIndex->getGridPageActions()->addNew();
        $this->sitemapNew->getSitemapForm()->fill($sitemap);
        $this->sitemapNew->getFormPageActions()->save();
    }
}
