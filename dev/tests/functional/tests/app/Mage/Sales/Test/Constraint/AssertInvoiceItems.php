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

namespace Mage\Sales\Test\Constraint;

use Mage\Sales\Test\Page\Adminhtml\SalesInvoiceView;
use Mage\Sales\Test\Page\Adminhtml\SalesInvoice;
use Magento\Mtf\ObjectManager;
use Magento\Mtf\System\Event\EventManagerInterface;

/**
 * Assert invoice items on invoice view page.
 */
class AssertInvoiceItems extends AbstractAssertItems
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Entity type.
     *
     * @var string
     */
    protected $entityType = 'invoice';

    /**
     * Special fields for verify.
     *
     * @var array
     */
    protected $specialFields = [
        'item_price',
        'item_subtotal',
        'item_tax',
        'item_discount',
        'item_row_total'
    ];

    /**
     * @constructor
     * @param ObjectManager $objectManager
     * @param EventManagerInterface $eventManager
     * @param SalesInvoice $invoiceIndex
     * @param SalesInvoiceView $orderInvoiceView
     */
    public function __construct(
        ObjectManager $objectManager,
        EventManagerInterface $eventManager,
        SalesInvoice $invoiceIndex,
        SalesInvoiceView $orderInvoiceView
    ) {
        parent::__construct($objectManager, $eventManager);
        $this->salesTypePage = $invoiceIndex;
        $this->salesTypeViewPage = $orderInvoiceView;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'All invoices products are present in invoice page.';
    }
}
