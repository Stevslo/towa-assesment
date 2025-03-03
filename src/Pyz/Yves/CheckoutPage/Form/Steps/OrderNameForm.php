<?php declare(strict_types = 1);

namespace Pyz\Yves\CheckoutPage\Form\Steps;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class OrderNameForm extends AbstractType
{
    protected const FIELD_ORDER_NAME = QuoteTransfer::ORDER_NAME;

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder The form builder
     * @param array<string, mixed> $options The options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addOrderNameField($builder, $options);
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'orderNameForm';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addOrderNameField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FIELD_ORDER_NAME, TextType::class, [
            'label' => 'checkout.step.orderName.label',
            'required' => true,
            'constraints' => [
                new NotBlank(),
                new Regex('/^[a-z0-9]+$/'),
            ]
        ]);

        return $this;
    }
}
