<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CustomerPage\Plugin;

use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\OrderListTransfer;
use SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\OrderSearchFormHandlerPluginInterface;

class OrderNameOrderSearchFormHandlerPlugin implements OrderSearchFormHandlerPluginInterface
{
    protected const ALLOWED_TYPES = [
        'all',
        'orderName',
    ];

    protected const ORDER_NAME_FILTER_TYPE = 'orderName';

    /**
     * @inheritDoc
     */
    public function handle(array $orderSearchFormData, OrderListTransfer $orderListTransfer): OrderListTransfer
    {
        if (
            !empty($orderSearchFormData['searchText']) &&
            !empty($orderSearchFormData['searchType']) &&
            in_array($orderSearchFormData['searchType'], self::ALLOWED_TYPES)
        ) {
            $filterFieldTransfer = (new FilterFieldTransfer())
                ->setValue($orderSearchFormData['searchText'])
                ->setType(static::ORDER_NAME_FILTER_TYPE);

            $orderListTransfer->addFilterField($filterFieldTransfer);
        }

        return $orderListTransfer;
    }
}
