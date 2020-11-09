<?php

namespace Infrastructure\Forms\Choices;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NasdaqChoice extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'American Airlines Group, Inc.' => 'AAL',
                'Atlantic American Corporation' => 'AAME',
                'Applied Optoelectronics, Inc.' => 'AAOI',
                'AAON, Inc.' => 'AAON',
                'Apple Inc.' => 'AAPL',
            ],
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
