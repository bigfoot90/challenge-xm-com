<?php

namespace Infrastructure\Forms\Choices;

use Domain\Models\Entity\IngredientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientChoice extends AbstractType
{
    private IngredientRepository $repository;

    public function __construct(IngredientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => $this->getChoices(),
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    private function getChoices(): iterable
    {
        $list = $this->repository->list([], ['kind' => 'ASC', 'name' => 'ASC']);

        $items = [];
        foreach ($list as $item) {
            $group = $item->getKind();

            if (!array_key_exists($group, $items)) {
                $items[$group] = [];
            }

            $items[$group][$item->getName()] = (string) $item->getId();
        }

        return $items;
    }
}
