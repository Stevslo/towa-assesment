<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\Sales\Business\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Pyz\Zed\Sales\Business\Expander\OrderNamePreSaveExpanderPlugin;

/**
 * @group PyzTest
 * @group Zed
 * @group Sales
 * @group Business
 * @group Expander
 * @group OrderNamePreSaveExpanderPluginTest
 */
class OrderNamePreSaveExpanderPluginTest extends Unit
{
    /**
     * @return array<mixed>
     */
    public static function provideExpandData(): array
    {
        return [
            [
                'orderName' => 'testorder124',
            ],
            [
                'orderName' => 'testOrder 1234',
            ],
            [
                'orderName' => null,
            ],
        ];
    }

    /**
     * @dataProvider provideExpandData
     *
     * @param string|null $orderName
     */
    public function testExpand(?string $orderName): void
    {
        $expander = new OrderNamePreSaveExpanderPlugin();

        $quoteTransfer = (new QuoteTransfer())->fromArray([
            QuoteTransfer::ORDER_NAME => $orderName,
        ]);

        $result = $expander->expand(new SpySalesOrderEntityTransfer(), $quoteTransfer);

        $this->assertSame($orderName, $result->getOrderName());
    }
}
