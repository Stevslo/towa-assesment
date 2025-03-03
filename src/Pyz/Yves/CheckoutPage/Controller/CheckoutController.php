<?php declare(strict_types=1);

namespace Pyz\Yves\CheckoutPage\Controller;

use SprykerShop\Yves\CheckoutPage\Controller\CheckoutController as SprykerCheckoutController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageFactory getFactory()
 * @method \Spryker\Client\Checkout\CheckoutClientInterface getClient()
 */
class CheckoutController extends SprykerCheckoutController
{
    public function orderNameAction(Request $request)
    {
        $quoteValidationResponseTransfer = $this->canProceedCheckout();

        if (!$quoteValidationResponseTransfer->getIsSuccessful()) {
            $this->processErrorMessages($quoteValidationResponseTransfer->getMessages());

            return $this->redirectResponseInternal(static::ROUTE_CART);
        }

        $response = $this->createStepProcess()->process(
            $request,
            $this->getFactory()
                ->createCheckoutFormFactory()
                ->createOrderNameFormCollection(),
        );

        if (!is_array($response)) {
            return $response;
        }

        return $this->view(
            $response,
            $this->getFactory()->getCustomerPageWidgetPlugins(),
            '@CheckoutPage/views/order-name/order-name.twig',
        );
    }
}
