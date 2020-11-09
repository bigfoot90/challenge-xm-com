<?php

namespace Domain\Models\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Models\ValueObject\Id;

class CookingStep
{
    private Id $id;

    private Recipe $recipe;

    private int $position;

    private string $procedure;

    /**
     * @var Collection|IngredientQuantity[]
     */
    private Collection $ingredients;

    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;

    /**
     * @param Ingredient[] $ingredients
     */
    public function __construct(Recipe $recipe, string $procedure, array $ingredients = [])
    {
        $this->id = new Id();
        $this->recipe = $recipe;
        $this->ingredients = new ArrayCollection();
        $this->update($procedure, $ingredients);
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @param Ingredient[] $ingredients
     */
    public function update(string $procedure, array $ingredients): void
    {
        $this->procedure = strip_tags($procedure, ['a', 'b', 'blockquote', 'br', 'div', 'em', 'i', 'img', 'p', 's', 'span', 'strong', 'sub', 'sup', 'ol', 'li', 'ul', 'dd', 'dl', 'dt']);
        $this->updatedAt = new \DateTimeImmutable();

        $this->ingredients->clear();
        foreach ($ingredients as $ingredient) {
            $this->ingredients->add($ingredient);
        }
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getProcedure(): string
    {
        return $this->procedure;
    }

    /**
     * @return Collection|IngredientQuantity[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
