<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     collectionOperations={ "post" = {"path" = "/register"}, "get"={"security"="is_granted('ROLE_USER')"}},
 *     itemOperations={"get"={"security"="is_granted('ROLE_USER')"} ,"put"={"security"="is_granted('ROLE_USER')"},"delete"={"security"="is_granted('ROLE_USER')"}, "patch"={"security"="is_granted('ROLE_USER')"} },
 *     normalizationContext={"groups"={"get"}},
 *     denormalizationContext={"groups"={"post"}}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 *
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"get","post"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("post")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups("post")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"get","post"})
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get","post"})
     */
    private $profile_picture;

    /**
     * @Groups("get")
     * @ORM\OneToMany(targetEntity=Tasks::class, mappedBy="idUser")
     */
    private $tasks;

    /**
     * @Groups("get")
     * @ORM\OneToMany(targetEntity=Actions::class, mappedBy="user")
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="user_id")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=Roommate::class, inversedBy="user")
     */
    private $roommate;
    /**
     * @ORM\OneToMany(targetEntity=PollAnswer::class, mappedBy="user")
     */
    private $pollAnswers;


    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->pollAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(string $profile_picture): self
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    /**
     * @return Collection<int, Tasks>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Tasks $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setIdUser($this);
        }

        return $this;
    }

    public function removeTask(Tasks $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getIdUser() === $this) {
                $task->setIdUser(null);
            }
        }

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
            $action->setUser($this);
        }

        return $this;
    }

    public function removeAction(Actions $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getUser() === $this) {
                $action->setUser(null);
            }
        }

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

    public function getRoommate(): ?Roommate
    {
        return $this->roommate;
    }

    public function setRoommate(?Roommate $roommate): self
    {
        $this->roommate = $roommate;

        return $this;
    }
    /**
     * @return Collection<int, PollAnswer>
     */
    public function getPollAnswers(): Collection
    {
        return $this->pollAnswers;
    }

    public function addPollAnswer(PollAnswer $pollAnswer): self
    {
        if (!$this->pollAnswers->contains($pollAnswer)) {
            $this->pollAnswers[] = $pollAnswer;
            $pollAnswer->setUser($this);
        }

        return $this;
    }

    public function removePollAnswer(PollAnswer $pollAnswer): self
    {
        if ($this->pollAnswers->removeElement($pollAnswer)) {
            // set the owning side to null (unless already changed)
            if ($pollAnswer->getUser() === $this) {
                $pollAnswer->setUser(null);
            }
        }

        return $this;
    }

}