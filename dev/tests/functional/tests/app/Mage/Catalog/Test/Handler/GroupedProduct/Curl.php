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

namespace Mage\Catalog\Test\Handler\GroupedProduct;

use Mage\Catalog\Test\Handler\CatalogProductSimple\Curl as AbstractCurl;
use Magento\Mtf\Fixture\FixtureInterface;

/**
 * Create new grouped product via curl.
 */
class Curl extends AbstractCurl implements GroupedProductInterface
{
    /**
     * Prepare POST data for creating product request.
     *
     * @param FixtureInterface $fixture
     * @param string|null $prefix [optional]
     * @return array
     */
    protected function prepareData(FixtureInterface $fixture, $prefix = null)
    {
        $data = parent::prepareData($fixture, null);

        $assignedProducts = [];
        if (!empty($data['associated'])) {
            $assignedProducts = $data['associated'];
            unset($data['associated']);
        }

        $data = $prefix ? [$prefix => $data] : $data;
        $links = '';
        $fKey = md5('associated');
        foreach ($assignedProducts as $key => $item) {
            $links .= $item['id']. '=' . $fKey . '&';
        }
        $data['links']['grouped'] = $links;
        return $data;
    }
}
