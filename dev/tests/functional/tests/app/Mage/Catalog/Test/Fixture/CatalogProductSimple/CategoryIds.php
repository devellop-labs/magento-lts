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

namespace Mage\Catalog\Test\Fixture\CatalogProductSimple;

use Mage\Catalog\Test\Fixture\CatalogCategory;
use Magento\Mtf\Fixture\DataSource;
use Magento\Mtf\Fixture\FixtureFactory;

/**
 * Create and return Category.
 */
class CategoryIds extends DataSource
{
    /**
     * Fixtures of category.
     *
     * @var array
     */
    protected $categories;

    /**
     * Product category.
     *
     * @var
     */
    protected $productCategory;

    /**
     * @constructor
     * @param FixtureFactory $fixtureFactory
     * @param array $params
     * @param array $data
     */
    public function __construct(
        FixtureFactory $fixtureFactory,
        array $params,
        array $data = []
    ) {
        $this->params = $params;

        if (!empty($data['category']) && empty($data['dataset'])) {
            /** @var CatalogCategory $category */
            $category = $data['category'];
            if (!$category->hasData('id')) {
                $category->persist();
            }
            $this->data[] = $category->getName();
            $this->categories[] = $category;
        } elseif (isset($data['dataset'])) {
            $dataset = explode(',', $data['dataset']);
            foreach ($dataset as $preset) {
                $category = $fixtureFactory->createByCode('catalogCategory', ['dataset' => $preset]);
                $category->persist();

                /** @var CatalogCategory $category */
                $this->data[] = $category->getName();
                $this->categories[] = $category;
            }
        }

        if (!empty($this->categories) && count($this->categories) == 1) {
            $this->productCategory = $this->categories[0];
        }
    }

    /**
     * Return category array.
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Get product category.
     *
     * @return mixed
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * Get id of categories.
     *
     * @return array
     */
    public function getIds()
    {
        $ids = [];
        foreach ($this->categories as $category) {
            $ids[] = $category->getId();
        }

        return $ids;
    }
}
