<?php

namespace App\Entity;

use App\Repository\ActionsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ORM\Entity(repositoryClass=ActionsRepository::class)
 * @ApiResource(
 *     itemOperations={"get"={"security"="is_granted('ROLE_USER')"}, "put"={"security"="is_granted('ROLE_USER')"}, "delete"={"security"="is_granted('ROLE_USER')"}, "patch"={"security"="is_granted('ROLE_USER')"}},
 *     collectionOperations={"get"={"security"="is_granted('ROLE_USER')"}, "post"={"security"="is_granted('ROLE_USER')"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={ 
 *  "user": "exact",
 *  "title": "partial",
 *  "amount": "exact",
 *  "categories": "exact"
 * })
 * @ApiFilter(BooleanFilter::class, properties={"is_incoming"})
 */
class Actions extends EntityBase
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_incoming;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="actions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="actions")
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsIncoming(): ?bool
    {
        return $this->is_incoming;
    }

    public function setIsIncoming(bool $is_incoming): self
    {
        $this->is_incoming = $is_incoming;

        return $this;
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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}