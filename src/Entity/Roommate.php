<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoommateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ApiResource(
 *     itemOperations={"get"={"security"="is_granted('ROLE_USER')"}, "put"={"security"="is_granted('ROLE_USER')"}, "delete"={"security"="is_granted('ROLE_USER')"}},
 *     collectionOperations={"get"={"security"="is_granted('ROLE_USER')"}, "post"={"security"="is_granted('ROLE_USER')"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *  "title": "partial",
 *  "id_category":"exact",
 * })
 * @ORM\Entity(repositoryClass=RoommateRepository::class)
 */
class Roommate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Categories::class, mappedBy="roommate")
     */
    private $id_category;

    public function __construct()
    {
        $this->id_category = new ArrayCollection();
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

    /**
     * @return Collection<int, Categories>
     */
    public function getIdCategory(): Collection
    {
        return $this->id_category;
    }

    public function addIdCategory(Categories $idCategory): self
    {
        if (!$this->id_category->contains($idCategory)) {
            $this->id_category[] = $idCategory;
            $idCategory->setRoommate($this);
        }

        return $this;
    }

    public function removeIdCategory(Categories $idCategory): self
    {
        if ($this->id_category->removeElement($idCategory)) {
            // set the owning side to null (unless already changed)
            if ($idCategory->getRoommate() === $this) {
                $idCategory->setRoommate(null);
            }
        }

        return $this;
    }
}
