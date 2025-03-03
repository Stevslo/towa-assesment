<?php declare(strict_types = 1);

namespace Pyz\Yves\CheckoutPage\Process\Steps;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginInterface;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithBreadcrumbInterface;
use SprykerShop\Yves\CheckoutPage\Process\Steps\AbstractBaseStep;
use Symfony\Component\HttpFoundation\Request;

class OrderNameStep extends AbstractBaseStep implements StepWithBreadcrumbInterface
{
    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginInterface $customerStepHandler
     * @param string $stepRoute
     * @param string|null $escapeRoute
     */
    public function __construct(
        private readonly StepHandlerPluginInterface $orderNameStepHandlerPlugin,
        $stepRoute,
        $escapeRoute
    ) {
        parent::__construct($stepRoute, $escapeRoute);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function requireInput(AbstractTransfer $quoteTransfer)
    {
        return true;
    }

    /**
     * Update QuoteTransfer with order name step handler plugin.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(Request $request, AbstractTransfer $quoteTransfer)
    {
        return $this->orderNameStepHandlerPlugin->addToDataClass($request, $quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function postCondition(AbstractTransfer $quoteTransfer)
    {
        return false;
    }

    /**
     * @return string
     */
    public function getBreadcrumbItemTitle()
    {
        return 'checkout.step.orderName.title';
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBreadcrumbItemEnabled(AbstractTransfer $quoteTransfer)
    {
        return $this->postCondition($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBreadcrumbItemHidden(AbstractTransfer $quoteTransfer)
    {
        return false;
    }
}
