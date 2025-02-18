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

namespace Mage\CatalogRule\Test\TestCase;

use Mage\Catalog\Test\Fixture\CatalogProductSimple;

/**
 * Preconditions:
 *  1. Execute before each variation:
 *   - Delete all active catalog price rules.
 *   - Create catalog price rule from dataset using Curl.
 *
 * Steps:
 *  1. Apply all created rules.
 *  2. Create simple product.
 *  3. Perform all assertions.
 *
 * @group Catalog_Price_Rules_(MX)
 * @ZephyrId MPERF-6801
 */
class ApplySeveralCatalogPriceRuleEntityTest extends AbstractCatalogRuleEntityTest
{
    /**
     * Apply several catalog price rules.
     *
     * @param array $catalogRulesOriginal
     * @return array
     */
    public function test(array $catalogRulesOriginal)
    {
        // Steps:
        $this->catalogRuleIndex->open();
        foreach ($catalogRulesOriginal as $key => $catalogPriceRule) {
            if ($catalogPriceRule === '-') {
                continue;
            }
            $this->catalogRules[$key] = $this->fixtureFactory->createByCode(
                'catalogRule',
                ['dataset' => $catalogPriceRule]
            );
            $this->catalogRules[$key]->persist();

            $filter = [
                'name' => $this->catalogRules[$key]->getName(),
                'rule_id' => $this->catalogRules[$key]->getId(),
            ];
            $this->catalogRuleIndex->getCatalogRuleGrid()->searchAndOpen($filter);
            $this->catalogRuleEdit->getFormPageActions()->saveAndApply();
        }
        // Create product
        $productSimple = $this->fixtureFactory->createByCode(
            'catalogProductSimple',
            ['dataset' => 'simple_for_salesrule_1']
        );
        $productSimple->persist();

        return ['product' => $productSimple];
    }
}
