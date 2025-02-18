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

namespace Mage\Sales\Test\Fixture\Order;

use Mage\Customer\Test\Fixture\Customer;
use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\Fixture\FixtureInterface;

/**
 * Prepare CustomerId for order fixture.
 */
class CustomerId implements FixtureInterface
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
     * @constructor
     * @param FixtureFactory $fixtureFactory
     * @param array $params
     * @param array $data [optional]
     */
    public function __construct(FixtureFactory $fixtureFactory, array $params, array $data = [])
    {
        $this->params = $params;
        if (isset($data['customer']) && $data['customer'] instanceof Customer) {
            $this->data = $data['customer'];
            return;
        }
        if (isset($data['dataset'])) {
            $customer = $fixtureFactory->createByCode('customer', ['dataset' => $data['dataset']]);
            if ($customer->hasData('id') === false) {
                $customer->persist();
            }
            $this->data = $customer;
        }
    }

    /**
     * Persist order customer.
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
     * @return Customer
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
     * Get customer fixture.
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->data;
    }
}
