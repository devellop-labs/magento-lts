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

use Mage\Catalog\Test\Page\Adminhtml\CatalogProduct;
use Mage\Catalog\Test\Page\Adminhtml\CatalogProductNew;
use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\Fixture\InjectableFixture;
use Magento\Mtf\TestCase\Injectable;

/**
 * Base class for add related, cross sell and up sell products entity test.
 */
abstract class AbstractAddAppurtenantProductsEntityTest extends Injectable
{
    /**
     * Fixture factory.
     *
     * @var FixtureFactory
     */
    protected $fixtureFactory;

    /**
     * Catalog product index page on backend.
     *
     * @var CatalogProduct
     */
    protected $catalogProductIndex;

    /**
     * Catalog product view page on backend.
     *
     * @var CatalogProductNew
     */
    protected $catalogProductNew;

    /**
     * Prepare data.
     *
     * @param FixtureFactory $fixtureFactory.
     * @return void
     */
    public function __prepare(FixtureFactory $fixtureFactory)
    {
        $this->fixtureFactory = $fixtureFactory;
    }

    /**
     * Inject data.
     *
     * @param CatalogProduct $catalogProductIndex
     * @param CatalogProductNew $catalogProductNew
     * @return void
     */
    public function __inject(CatalogProduct $catalogProductIndex, CatalogProductNew $catalogProductNew)
    {
        $this->catalogProductIndex = $catalogProductIndex;
        $this->catalogProductNew = $catalogProductNew;
    }

    /**
     * Get product by data.
     *
     * @param string $productData
     * @param array $relatedProductsData
     * @return InjectableFixture
     */
    protected function getProductByData($productData, array $relatedProductsData)
    {
        list($fixtureName, $dataset) = explode('::', $productData);
        $relatedProductsPresets = [];
        foreach ($relatedProductsData as $type => $presets) {
            $relatedProductsPresets[$type]['presets'] = $presets;
        }

        return $this->fixtureFactory->createByCode(
            $fixtureName,
            [
                'dataset' => $dataset,
                'data' => $relatedProductsPresets
            ]
        );
    }

    /**
     * Create and save product.
     *
     * @param InjectableFixture $product
     * @return void
     */
    protected function createAndSaveProduct(InjectableFixture $product)
    {
        $this->catalogProductIndex->open();
        $this->catalogProductIndex->getGridPageActionBlock()->addNew();
        $this->catalogProductNew->getProductForm()->fill($product);
        $this->catalogProductNew->getFormPageActions()->save();
    }
}
