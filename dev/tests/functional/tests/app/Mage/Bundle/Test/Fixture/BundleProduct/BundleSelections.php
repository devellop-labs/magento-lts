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
 * @copyright  Copyright (c) 2021 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Mage\Bundle\Test\Fixture\BundleProduct;

use Magento\Mtf\Fixture\DataSource;
use Magento\Mtf\ObjectManager;
use Magento\Mtf\Repository\RepositoryFactory;

/**
 * Bundle selections dataset.
 */
class BundleSelections extends DataSource
{
    /**
     * Repository factory instance.
     *
     * @var RepositoryFactory
     */
    protected $repositoryFactory;

    /**
     * Object manager.
     *
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * Array products' fixtures.
     *
     * @var array
     */
    protected $products;

    /**
     * @constructor
     * @param RepositoryFactory $repositoryFactory
     * @param ObjectManager $objectManager
     * @param array $data
     * @param array $params [optional]
     */
    public function __construct(
        RepositoryFactory $repositoryFactory,
        ObjectManager $objectManager,
        array $data,
        array $params = []
    )
    {
        $this->repositoryFactory = $repositoryFactory;
        $this->params = $params;
        $this->objectManager = $objectManager;
        $this->data = $this->prepareData($data);
    }

    /**
     * Prepare dataset data.
     *
     * @param array $data
     * @return array
     */
    protected function prepareData(array $data)
    {
        $dataset = isset($data['dataset']) && isset($this->params['repository'])
            ? $this->data = $this->repositoryFactory->get($this->params['repository'])->get($data['dataset'])
            : [];
        $this->products = isset($dataset['products']) ? $this->createProducts($dataset['products']) : [];
        return $this->prepareBundleOptions($dataset['bundle_options']);
    }

    /**
     * Prepare bundle options.
     *
     * @param array $data
     * @return array
     */
    protected function prepareBundleOptions(array $data)
    {
        foreach ($data as $optionKey => $bundleOption) {
            foreach ($bundleOption['assigned_products'] as $key => $assignedProduct) {
                $data[$optionKey]['assigned_products'][$key]['sku'] = $this->products[$optionKey][$key]->getSku();
                $data[$optionKey]['assigned_products'][$key]['name'] = $this->products[$optionKey][$key]->getName();
            }
        }

        return $data;
    }

    /**
     * Create products.
     *
     * @param array $products
     * @return array
     */
    protected function createProducts(array $products)
    {
        $resultProduct = [];
        foreach ($products as $key => $product) {
            $resultProduct[$key] = $this->objectManager
                ->create('Mage\Catalog\Test\TestStep\CreateProductsStep', ['products' => implode(',', $product)])
                ->run()['products'];
        }

        return $resultProduct;
    }

    /**
     * Return products' fixtures.
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }
}
