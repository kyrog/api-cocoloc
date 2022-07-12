<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PollAnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PollAnswerRepository::class)
 */
class PollAnswer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pollAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Polls::class, inversedBy="pollAnswers")
     */
    private $poll;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $answer;


    public function __construct()
    {
        $this->answer = new ArrayCollection();
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

    public function getPoll(): ?Polls
    {
        return $this->poll;
    }

    public function setPoll(?Polls $poll): self
    {
        $this->poll = $poll;

        return $this;
    }

    public function isAnswer(): ?bool
    {
        return $this->answer;
    }

    public function setAnswer(?bool $answer): self
    {
        $this->answer = $answer;

        return $this;
    }


    
}
