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

namespace Mage\Catalog\Test\TestCase\Product;

use Magento\Mtf\TestCase\Injectable;
use Mage\Catalog\Test\Fixture\CatalogCategory;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProductNew;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProduct;
use Mage\Catalog\Test\Fixture\ConfigurableProduct;
use Mage\Catalog\Test\Fixture\CatalogAttributeSet;

/**
 * Preconditions:
 * 1. Two simple products are created.
 * 2. Configurable attribute with two options is created.
 * 3. Configurable attribute added to Default template.
 *
 * Steps:
 * 1. Login to the backend.
 * 2. Navigate to Catalog > Manage Products.
 * 3. Click "Add Product".
 * 4. Select Configurable Product and Attribute set.
 * 5. Select attribute.
 * 6. Fill in data according to data sets.
 * 7. Save product.
 * 8. Perform all assertions.
 *
 * @group Configurable_Product_(MX)
 * @ZephyrId MPERF-6685
 */
class CreateConfigurableProductEntityTest extends Injectable
{
    /**
     * Product page with a grid.
     *
     * @var CatalogProduct
     */
    protected $productIndex;

    /**
     * Page to create a product.
     *
     * @var CatalogProductNew
     */
    protected $productNew;

    /**
     * Prepare data.
     *
     * @param CatalogCategory $category
     * @return array
     */
    public function __prepare(CatalogCategory $category)
    {
        $category->persist();

        return ['category' => $category];
    }

    /**
     * Injection pages.
     *
     * @param CatalogProduct $productIndex
     * @param CatalogProductNew $productNew
     * @return void
     */
    public function __inject(CatalogProduct $productIndex, CatalogProductNew $productNew)
    {
        $this->productIndex = $productIndex;
        $this->productNew = $productNew;
    }

    /**
     * Test create catalog Configurable product run.
     *
     * @param ConfigurableProduct $product
     * @param CatalogCategory $category
     * @return array
     */
    public function test(ConfigurableProduct $product, CatalogCategory $category)
    {
        // Steps
        $this->productIndex->open();
        $this->productIndex->getGridPageActionBlock()->addNew();
        $this->productNew->getProductForm()->fill($product, null, $category);
        $this->productNew->getFormPageActions()->save();
    }
}
