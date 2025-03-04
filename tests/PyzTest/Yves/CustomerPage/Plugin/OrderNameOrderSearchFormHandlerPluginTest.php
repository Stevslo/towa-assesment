<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Checkout\Process\Steps;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\OrderListTransfer;
use Pyz\Yves\CustomerPage\Plugin\OrderNameOrderSearchFormHandlerPlugin;
use SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\OrderSearchFormHandlerPluginInterface;

/**
 * @group PyzTest
 * @group Yves
 * @group Checkout
 * @group Process
 * @group Steps
 * @group OrderNameOrderSearchFormHandlerPluginTest
 */
class OrderNameOrderSearchFormHandlerPluginTest extends Unit
{
    /**
     * @return array<mixed>
     */
    public static function provideData()
    {
        return [
            [
                'formData' => [],
                'orderListTransfer' => new OrderListTransfer(),
                'expectedOrderListTransfer' => new OrderListTransfer(),
            ],
            [
                'formData' => ['searchText' => null, 'searchType' => null],
                'orderListTransfer' => new OrderListTransfer(),
                'expectedOrderListTransfer' => new OrderListTransfer(),
            ],
            [
                'formData' => ['searchText' => '', 'searchType' => ''],
                'orderListTransfer' => new OrderListTransfer(),
                'expectedOrderListTransfer' => new OrderListTransfer(),
            ],
            [
                'formData' => ['searchText' => 'test', 'searchType' => null],
                'orderListTransfer' => new OrderListTransfer(),
                'expectedOrderListTransfer' => new OrderListTransfer(),
            ],
            [
                'formData' => ['searchText' => 'test', 'searchType' => 'orderName'],
                'orderListTransfer' => new OrderListTransfer(),
                'expectedOrderListTransfer' => (new OrderListTransfer())->addFilterField(
                    (new FilterFieldTransfer())->setType('orderName')->setValue('test'),
                ),
            ],
            [
                'formData' => ['searchText' => 'test', 'searchType' => 'all'],
                'orderListTransfer' => new OrderListTransfer(),
                'expectedOrderListTransfer' => (new OrderListTransfer())->addFilterField(
                    (new FilterFieldTransfer())->setType('orderName')->setValue('test'),
                ),
            ],
        ];
    }

    /**
     * @dataProvider provideData
     *
     * @param array $formData
     * @param \Generated\Shared\Transfer\OrderListTransfer $orderListTransfer
     * @param \Generated\Shared\Transfer\OrderListTransfer $expectedOrderListTransfer
     *
     * @return void
     */
    public function testHandleWithEmptyData(
        array $formData,
        OrderListTransfer $orderListTransfer,
        OrderListTransfer $expectedOrderListTransfer,
    ): void {
        $plugin = $this->handlerPlugin();
        $result = $plugin->handle($formData, $orderListTransfer);
        $this->assertEquals($expectedOrderListTransfer->getFilterFields(), $result->getFilterFields());
    }

    /**
     * @return \SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\OrderSearchFormHandlerPluginInterface
     */
    protected function handlerPlugin(): OrderSearchFormHandlerPluginInterface
    {
        return new OrderNameOrderSearchFormHandlerPlugin();
    }
}
