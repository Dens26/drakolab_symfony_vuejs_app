<?php

namespace App\Entity;

use App\Entity\Traits\HasDatetimeTrait;
use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;
    use HasDatetimeTrait;

    #[ORM\Column]
    private ?bool $vegan = null;

    #[ORM\Column]
    private ?bool $vegatarian = null;

    #[ORM\Column]
    private ?bool $dailyFree = null;

    #[ORM\Column]
    private ?bool $glutenFree = null;

    #[ORM\OneToMany(targetEntity: RecipeHasIngredient::class, mappedBy: 'ingredient')]
    private Collection $RecipeHasIngredients;

    public function __construct()
    {
        $this->RecipeHasIngredients = new ArrayCollection();
    }

    public function isVegan(): ?bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): static
    {
        $this->vegan = $vegan;

        return $this;
    }

    public function isVegatarian(): ?bool
    {
        return $this->vegatarian;
    }

    public function setVegatarian(bool $vegatarian): static
    {
        $this->vegatarian = $vegatarian;

        return $this;
    }

    public function isDailyFree(): ?bool
    {
        return $this->dailyFree;
    }

    public function setDailyFree(bool $dailyFree): static
    {
        $this->dailyFree = $dailyFree;

        return $this;
    }

    public function isGlutenFree(): ?bool
    {
        return $this->glutenFree;
    }

    public function setGlutenFree(bool $glutenFree): static
    {
        $this->glutenFree = $glutenFree;

        return $this;
    }

    /**
     * @return Collection<int, RecipeHasIngredient>
     */
    public function getRecipeHasIngredients(): Collection
    {
        return $this->RecipeHasIngredients;
    }

    public function addRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): static
    {
        if (!$this->RecipeHasIngredients->contains($recipeHasIngredient)) {
            $this->RecipeHasIngredients->add($recipeHasIngredient);
            $recipeHasIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): static
    {
        if ($this->RecipeHasIngredients->removeElement($recipeHasIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeHasIngredient->getIngredient() === $this) {
                $recipeHasIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}
