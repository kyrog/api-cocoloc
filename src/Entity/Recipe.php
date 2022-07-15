<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idRecipe_category;

    /**
     *@ORM\OneToOne(targetEntity=User::class)
     */
    private $idUser;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featured_image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRecipeCategory(): ?int
    {
        return $this->idRecipe_category;
    }

    public function setIdRecipeCategory(int $idRecipe_category): self
    {
        $this->idRecipe_category = $idRecipe_category;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

   

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featured_image;
    }

    public function setFeaturedImage(string $featured_image): self
    {
        $this->featured_image = $featured_image;

        return $this;
    }
}
