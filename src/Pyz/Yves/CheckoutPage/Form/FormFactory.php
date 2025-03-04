<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CheckoutPage\Form;

use Pyz\Yves\CheckoutPage\CheckoutPageDependencyProvider;
use Pyz\Yves\CheckoutPage\Form\Steps\OrderNameForm;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;
use Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface;
use SprykerShop\Yves\CheckoutPage\Form\FormFactory as SprykerFormFactory;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class FormFactory extends SprykerFormFactory
{
    /**
     * @return \Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface
     */
    public function createOrderNameFormCollection(): FormCollectionHandlerInterface
    {
        return $this->createFormCollection($this->getOrderNameFormTypes(), $this->getOrderNameFormDataProviderPlugin());
    }


    /**
     * @return array<string>
     */
    public function getOrderNameFormTypes(): array
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
    public function getOrderNameFormDataProviderPlugin(): StepEngineFormDataProviderInterface
    {
        return $this->getProvidedDependency(CheckoutPageDependencyProvider::PLUGIN_ORDER_NAME_FORM_DATA_PROVIDER);
    }
}
