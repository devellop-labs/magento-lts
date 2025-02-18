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

namespace Mage\Weee\Test\TestCase;

use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\ObjectManager;
use Magento\Mtf\TestCase\Scenario;

/**
 * Preconditions:
 * 1. Delete all tax rules.
 * 2. Setup configuration.
 * 3. Create customer.
 * 4. Create tax rule.
 * 5. Create custom attribute set with fpt.
 * 6. Create product.
 *
 * Steps:
 * 1. Log in to frontend.
 *
 * @group Tax_(CS)
 * @ZephyrId MPERF-7493
 */
class CreateTaxWithFptTest extends Scenario
{
    /**
     * Prepare data.
     *
     * @param FixtureFactory $fixtureFactory
     * @return array
     */
    public function __prepare(FixtureFactory $fixtureFactory)
    {
        $this->objectManager->create('Mage\Tax\Test\TestStep\DeleteAllTaxRulesStep')->run();
        $this->objectManager->create(
            'Mage\Core\Test\TestStep\SetupConfigurationStep',
            ['configData' => 'default_tax_configuration']
        )->run();
        $customer = $fixtureFactory->createByCode('customer', ['dataset' => 'johndoe_with_addresses']);
        $customer->persist();
        $taxRule = $fixtureFactory->createByCode('taxRule', ['dataset' => 'tax_rule_default']);
        $taxRule->persist();
        $productTemplate = $fixtureFactory->createByCode(
            'catalogAttributeSet',
            ['dataset' => 'custom_attribute_set_with_fpt']
        );
        $productTemplate->persist();

        return [
            'customer' => $customer,
            'data' => ['attribute_set_id' => ['attribute_set' => $productTemplate]]
        ];
    }

    /**
     * Run create tax with Fpt test.
     *
     * @return void
     */
    public function test()
    {
        $this->executeScenario();
    }

    /**
     * Revert configuration to default.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->objectManager->create(
            'Mage\Core\Test\TestStep\SetupConfigurationStep',
            ['configData' => 'default_tax_configuration,shipping_tax_class_taxable_goods_rollback']
        )->run();
    }
}
