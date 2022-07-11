<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @Orm\table(name="Recipe")
 * @ApiResource()
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
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idRecipe_category;

     /**
      *@ORM\OneToOne(targetEntity=User::class)
     */
    private $idUser;
      /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idIngredient;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;
     /**
     * @ORM\Column(type="string", length=2000)
     */
    private $description;
     /**
     * @ORM\Column(type="string")
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
    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
    public function getIdIngredient(): ?int
    {
        return $this->idIngredient;
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

    public function setDFeaturedImage(string $featured_image): self
    {
        $this->featured_image= $featured_image;

        return $this;
    }}