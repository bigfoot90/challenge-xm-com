<?php

namespace Infrastructure\Forms\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditorType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    public function getParent()
    {
        return TextareaType::class;
    }
}
