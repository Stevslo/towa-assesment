<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Checkout\Process\Steps;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Yves\CheckoutPage\Process\Steps\OrderNameStep;

/**
 * @group PyzTest
 * @group Yves
 * @group Checkout
 * @group Process
 * @group Steps
 * @group OrderNameStepTest
 */
class OrderNameStepTest extends Unit
{
    /**
     * @return void
     */
    public function testPostConditionShouldReturnWhenQuoteReadyForSummaryDisplay(): void
    {
        $orderNameStep = $this->createOrderNameStep();

        $quoteTransfer = new QuoteTransfer();
        $quoteTransfer->setOrderName('testorder123');

        $this->assertTrue($orderNameStep->postCondition($quoteTransfer));
    }

    /**
     * @return void
     */
    public function testRequireInputShouldBeTrue(): void
    {
        $orderNameStep = $this->createOrderNameStep();

        $this->assertTrue($orderNameStep->requireInput(new QuoteTransfer()));
    }

    /**
     * @return void
     */
    public function testStepEnabledShouldBeTrue(): void
    {
        $orderNameStep = $this->createOrderNameStep();

        $this->assertTrue($orderNameStep->requireInput((new QuoteTransfer())->setOrderName('testorder123')));
    }

    /**
     * @return void
     */
    public function testStepEnabledShouldBeFalse(): void
    {
        $orderNameStep = $this->createOrderNameStep();

        $this->assertTrue($orderNameStep->requireInput(new QuoteTransfer()));
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Process\Steps\OrderNameStep
     */
    protected function createOrderNameStep(): OrderNameStep
    {
        return new OrderNameStep(
            'shipment',
            'escape_route'
        );
    }
}
