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

namespace Mage\Admin\Test\Fixture\Role;

use Mage\Adminhtml\Test\Fixture\StoreGroup;
use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\Fixture\FixtureInterface;
use Mage\Admin\Test\Fixture\User;

/**
 * Gws store groups data source.
 * Data keys:
 * - datasets
 */
class GwsStoreGroups implements FixtureInterface
{
    /**
     * Prepared dataset data.
     *
     * @var array
     */
    protected $data;

    /**
     * Data set configuration settings.
     *
     * @var array
     */
    protected $params;

    /**
     * StoreGroup fixtures.
     *
     * @var StoreGroup[]
     */
    protected $storeGroups;

    /**
     * @constructor
     * @param FixtureFactory $fixtureFactory
     * @param array $params
     * @param array $data [optional]
     */
    public function __construct(FixtureFactory $fixtureFactory, array $params, array $data = [])
    {
        $this->params = $params;
        if (isset($data['datasets'])) {
            $datasets = explode(',', $data['datasets']);
            foreach ($datasets as $dataset) {
                /** @var StoreGroup $storeGroup */
                $storeGroup = $fixtureFactory->createByCode('storeGroup', ['dataset' => trim($dataset)]);
                $storeGroup->persist();
                $this->data[] = $storeGroup->getGroupId();
                $this->storeGroups[] = $storeGroup;
            }
        }
    }

    /**
     * Persist source.
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
     * @param string|null $key [optional]
     * @return mixed
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
     * Get store groups.
     *
     * @return StoreGroup[]
     */
    public function getStoreGroups()
    {
        return $this->storeGroups;
    }
}
