<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Entity\Traits\HasIdTrait;
use App\Repository\RecipeHasSourceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

// /recipe/1/sources/4
#[ORM\Entity(repositoryClass: RecipeHasSourceRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(),
        new GetCollection(),
        new Delete(),
        new Patch(),
    ],
    normalizationContext: ['groups' => ['read']]
)]
class RecipeHasSource
{
    use HasIdTrait;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups('read')]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'recipeHasSources')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('read')]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'recipeHasSources')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('read')]
    private ?Source $source = null;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }
}