<?php

namespace Infrastructure\Forms\Extensions;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceTypeExtension extends AbstractTypeExtension
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setNormalizer('placeholder', function ($options, $value) {
            if (!$options['expanded'] && (is_null($value) || $value === '')) {
                return $options['required'] ? 'Choose' : 'Any';
            }
            
            return $value;
        });
    }

    public static function getExtendedTypes(): iterable
    {
        return [ChoiceType::class];
    }
}
