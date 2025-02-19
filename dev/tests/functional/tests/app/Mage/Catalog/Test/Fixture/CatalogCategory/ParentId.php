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

namespace Mage\Catalog\Test\Fixture\CatalogCategory;

use Magento\Mtf\Fixture\FixtureInterface;
use Magento\Mtf\Fixture\FixtureFactory;
use Mage\Catalog\Test\Fixture\CatalogCategory;

/**
 * Prepare parent category.
 */
class ParentId implements FixtureInterface
{
    /**
     * Return category.
     *
     * @var CatalogCategory
     */
    protected $parentCategory = null;

    /**
     * Fixture params.
     *
     * @var array
     */
    protected $params;

    /**
     * @constructor
     * @param FixtureFactory $fixtureFactory
     * @param array $params
     * @param array|int $data
     */
    public function __construct(FixtureFactory $fixtureFactory, array $params, $data = [])
    {
        $this->params = $params;
        if (isset($data['dataset'])) {
            $this->parentCategory = $fixtureFactory->createByCode('catalogCategory', ['dataset' => $data['dataset']]);
            if (!$this->parentCategory->hasData('id')) {
                $this->parentCategory->persist();
            }
            $this->data = $this->parentCategory->getId();
        } elseif (isset($data['data']) && isset($data['parent_category'])) {
            $this->data = $data['data'];
            $this->parentCategory = $data['parent_category'];
        } else {
            $this->data = $data;
        }
    }

    /**
     * Persist attribute options.
     *
     * @return void
     */
    public function persist()
    {
        //
    }

    /**
     * Return prepared data set.
     *
     * @param string|null $key
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getData($key = null)
    {
        return $this->data;
    }

    /**
     * Return data set configuration settings.
     *
     * @return array
     */
    public function getDataConfig()
    {
        return $this->params;
    }

    /**
     * Return entity.
     *
     * @return CatalogCategory
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }
}
