<?php

namespace Infrastructure\Forms\Types;

use Infrastructure\Forms\Choices\NasdaqChoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class QuantityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'class' => 'touchspin-vertical',
                    'data-min' => 1,
                    'data-max' => 'null',
                    'min' => 1,
                ],
            ])
            ->add('unit', NasdaqChoice::class)
        ;
    }
}
