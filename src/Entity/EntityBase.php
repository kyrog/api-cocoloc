<?php

namespace App\Entity;

use App\Entity\EntityInterface\EntityBaseInterface;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class EntityBase
 *
 * PHP version 7.1
 *
 * LICENSE: MIT
 *
 * @package    AppBundle\Mapping
 * @author     Lelle - Daniele Rostellato <lelle.daniele@gmail.com>
 * @license    MIT
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @ORM\HasLifecycleCallbacks
 */
class EntityBase implements EntityBaseInterface
{
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetimetz", nullable=true)
     */
    protected $createdAt;

    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetimetz", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $dateTimeNow = new DateTime('now');

        $this->setUpdatedAt($dateTimeNow);

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function getCreatedAt() :?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt() :?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}