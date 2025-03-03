<?php declare(strict_types = 1);

namespace Pyz\Yves\CheckoutPage\Process;

use Pyz\Yves\CheckoutPage\Process\Steps\OrderNameStep;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginInterface;
use SprykerShop\Yves\CheckoutPage\Process\StepFactory as PyzStepFactory;
use Pyz\Yves\CheckoutPage\Plugin\OrderNameStepHandler;
use Pyz\Yves\CheckoutPage\Plugin\Router\CheckoutPageRouteProviderPlugin;

/**
 * @method \SprykerShop\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class StepFactory extends PyzStepFactory
{
    /**
     * @return array<\Spryker\Yves\StepEngine\Dependency\Step\StepInterface>
     */
    public function getSteps(): array
    {
        return [
            $this->createEntryStep(),
            $this->createCustomerStep(),
            $this->createAddressStep(),
            $this->createShipmentStep(),
            $this->createPaymentStep(),
            $this->createOrderNameStep(),
            $this->createSummaryStep(),
            $this->createPlaceOrderStep(),
            $this->createSuccessStep(),
            $this->createErrorStep(),
        ];
    }

    private function createOrderNameStep()
    {
        return new OrderNameStep(
            $this->createOrderNameStepHandler(),
            CheckoutPageRouteProviderPlugin::ROUTE_NAME_CHECKOUT_ORDER_NAME,
            $this->getConfig()->getEscapeRoute()
        );
    }

    private function createOrderNameStepHandler(): StepHandlerPluginInterface
    {
        return new OrderNameStepHandler();
    }
}
