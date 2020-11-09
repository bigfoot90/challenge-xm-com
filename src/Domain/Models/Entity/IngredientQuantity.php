<?php

namespace Domain\Models\Entity;

use Domain\Models\ValueObject\Id;

class IngredientQuantity
{
    private Id $id;

    private CookingStep $cookingStep;
    private Ingredient $ingredient;

    private int $quantity;
    private string $unit;

    public function __construct(CookingStep $cookingStep, Ingredient $ingredient, int $quantity, string $unit)
    {
        $this->id = new Id();
        $this->cookingStep = $cookingStep;
        $this->ingredient = $ingredient;
        $this->update($quantity, $unit);
    }

    public function update(int $quantity, string $unit): void
    {
        $this->quantity = $quantity;
        $this->unit = $unit;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getCookingStep(): CookingStep
    {
        return $this->cookingStep;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}
