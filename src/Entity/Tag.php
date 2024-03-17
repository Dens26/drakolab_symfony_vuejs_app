<?php

namespace App\Entity;

use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasPriorityTrait;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;
    use HasPriorityTrait;

    #[ORM\Column]
    private ?bool $menu = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'tags')]
    private ?self $tag = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'tag')]
    private Collection $tags;

    #[ORM\ManyToMany(targetEntity: Recipe::class, inversedBy: 'tags')]
    private Collection $recipes;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }

    public function isMenu(): ?bool
    {
        return $this->menu;
    }

    public function setMenu(bool $menu): static
    {
        $this->menu = $menu;

        return $this;
    }

    public function getTag(): ?self
    {
        return $this->tag;
    }

    public function setTag(?self $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(self $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->setTag($this);
        }

        return $this;
    }

    public function removeTag(self $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getTag() === $this) {
                $tag->setTag(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): static
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        $this->recipes->removeElement($recipe);

        return $this;
    }
}
