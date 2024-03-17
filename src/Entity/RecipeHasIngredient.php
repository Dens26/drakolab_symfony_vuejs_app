<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\RecipeHasIngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeHasIngredientRepository::class)]
class RecipeHasIngredient
{
    use HasIdTrait;

    #[ORM\Column]
    private ?float $quantity = null;

    #[ORM\Column]
    private ?bool $optional = null;

    #[ORM\ManyToOne(inversedBy: 'RecipeHasIngredients')]
    private ?Ingredient $ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'RecipeHasIngredients')]
    private ?Unit $unit = null;

    #[ORM\ManyToOne(inversedBy: 'RecipeHasIngredients')]
    private ?IngredientGroup $ingredientGroup = null;


    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function isOptional(): ?bool
    {
        return $this->optional;
    }

    public function setOptional(bool $optional): static
    {
        $this->optional = $optional;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getIngredientGroup(): ?IngredientGroup
    {
        return $this->ingredientGroup;
    }

    public function setIngredientGroup(?IngredientGroup $ingredientGroup): static
    {
        $this->ingredientGroup = $ingredientGroup;

        return $this;
    }
}
