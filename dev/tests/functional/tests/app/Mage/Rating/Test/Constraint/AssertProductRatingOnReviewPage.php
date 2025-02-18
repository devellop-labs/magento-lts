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

namespace Mage\Rating\Test\Constraint;

use Mage\Review\Test\Fixture\Review;
use Mage\Review\Test\Page\Adminhtml\CatalogProductReviewEdit;
use Mage\Review\Test\Page\Adminhtml\CatalogProductReview;
use Magento\Mtf\Constraint\AbstractAssertForm;

/**
 * Assert that product rating is displayed on product review(backend) page.
 */
class AssertProductRatingOnReviewPage extends AbstractAssertForm
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert that product rating is displayed on product review(backend) page.
     *
     * @param CatalogProductReview $reviewIndex
     * @param CatalogProductReviewEdit $reviewEdit
     * @param Review $review
     * @return void
     */
    public function processAssert(
        CatalogProductReview $reviewIndex,
        CatalogProductReviewEdit $reviewEdit,
        Review $review
    ) {
        $reviewIndex->open();
        $reviewIndex->getReviewGrid()->searchAndOpen(['title' => $review->getTitle()]);
        $ratingReview = $this->sortDataByPath($review->getRatings(), '::title');
        $ratingForm = $this->sortDataByPath($reviewEdit->getReviewForm()->getData()['ratings'], '::title');
        $error = $this->verifyData($ratingReview, $ratingForm);

        \PHPUnit_Framework_Assert::assertEmpty($error, $error);
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Product rating is displayed on edit review page(backend).';
    }
}
