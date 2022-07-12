<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ApiResource(
 *     itemOperations={"get"={"security"="is_granted('ROLE_USER')"}, "put"={"security"="is_granted('ROLE_USER')"}, "delete"={"security"="is_granted('ROLE_USER')"}, "patch"={"security"="is_granted('ROLE_USER')"}},
 *     collectionOperations={"get"={"security"="is_granted('ROLE_USER')"}, "post"={"security"="is_granted('ROLE_USER')"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *  "title": "partial",
 *  "actions":"exact",
 * })
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Actions::class, mappedBy="categories")
     */
    private $actions;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="categories")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $actualBudget;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $currentBudget;

    /**
     * @ORM\ManyToOne(targetEntity=Roommate::class, inversedBy="categories")
     */
    private $roommate;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Actions>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Actions $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setCategories($this);
        }

        return $this;
    }

    public function removeAction(Actions $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getCategories() === $this) {
                $action->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(user $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
            $userId->setCategories($this);
        }

        return $this;
    }

    public function removeUserId(user $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getCategories() === $this) {
                $userId->setCategories(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getActualBudget(): ?float
    {
        return $this->actualBudget;
    }

    public function setActualBudget(?float $actualBudget): self
    {
        $this->actualBudget = $actualBudget;

        return $this;
    }

    public function getCurrentBudget(): ?float
    {
        return $this->currentBudget;
    }

    public function setCurrentBudget(?float $currentBudget): self
    {
        $this->currentBudget = $currentBudget;

        return $this;
    }

    public function getRoommate(): ?Roommate
    {
        return $this->roommate;
    }

    public function setRoommate(?Roommate $roommate): self
    {
        $this->roommate = $roommate;

        return $this;
    }
}
