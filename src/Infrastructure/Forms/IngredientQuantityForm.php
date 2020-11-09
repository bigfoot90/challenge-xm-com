<?php

namespace Infrastructure\Forms;

use Infrastructure\Forms\Choices\IngredientChoice;
use Infrastructure\Forms\Types\QuantityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class IngredientQuantityForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredient', IngredientChoice::class)
            ->add('quantity', QuantityType::class)
        ;
    }

    public function getBlockPrefix()
    {
        return 'ingredient_quantity';
    }
}
