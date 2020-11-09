<?php

namespace Infrastructure\Forms;

use Infrastructure\Forms\Choices\NasdaqChoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class MainForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', NasdaqChoice::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('startDate', DateType::class, [
                'input' => 'string',
                'constraints' => [
                    new NotBlank(),
                    new Date(),
                ],
            ])
            ->add('endDate', DateType::class, [
                'input' => 'string',
                'constraints' => [
                    new NotBlank(),
                    new Date(),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ])
        ;
    }
}
