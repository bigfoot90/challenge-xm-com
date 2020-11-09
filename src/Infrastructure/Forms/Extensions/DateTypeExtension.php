<?php

namespace Infrastructure\Forms\Extensions;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTypeExtension extends AbstractTypeExtension
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'widget' => 'single_text',
//            'format' => 'yyyy/MM/dd',
            'max_length' => 10,
            'attr' => [
                'placeholder' => '----/--/--',
            ]
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [DateType::class];
    }
}
