<?php

namespace App\Entity;

// Traits
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasDatetimeTrait;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{

    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;
    use HasDateTimeTrait;

    #[ORM\Column]
    private ?bool $draft = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $cooking = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $break = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $preparation = null;

    public function isDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): static
    {
        $this->draft = $draft;

        return $this;
    }

    public function getCooking(): ?int
    {
        return $this->cooking;
    }

    public function setCooking(?int $cooking): static
    {
        $this->cooking = $cooking;

        return $this;
    }

    public function getBreak(): ?int
    {
        return $this->break;
    }

    public function setBreak(?int $break): static
    {
        $this->break = $break;

        return $this;
    }

    public function getPreparation(): ?int
    {
        return $this->preparation;
    }

    public function setPreparation(?int $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }
}
