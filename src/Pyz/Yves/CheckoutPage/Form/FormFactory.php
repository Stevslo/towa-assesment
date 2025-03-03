<?php declare(strict_types = 1);

namespace Pyz\Yves\CheckoutPage\Form;

use Pyz\Yves\CheckoutPage\CheckoutPageDependencyProvider;
use Pyz\Yves\CheckoutPage\Form\Steps\OrderNameForm;
use SprykerShop\Yves\CheckoutPage\Form\FormFactory as SprykerFormFactory;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class FormFactory extends SprykerFormFactory
{
    /**
     * @return \Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface
     */
    public function createOrderNameFormCollection()
    {
        return $this->createFormCollection($this->getOrderNameFormTypes(), $this->getOrderNameFormDataProviderPlugin());
    }


    /**
     * @return array<string>
     */
    public function getOrderNameFormTypes()
    {
        return [
            $this->getOrderNameForm(),
        ];
    }

    /**
     * @return string
     */
    public function getOrderNameForm(): string
    {
        return OrderNameForm::class;
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function getOrderNameFormDataProviderPlugin()
    {
        return $this->getProvidedDependency(CheckoutPageDependencyProvider::PLUGIN_ORDER_NAME_FORM_DATA_PROVIDER);
    }
}
