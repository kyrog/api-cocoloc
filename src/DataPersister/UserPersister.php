<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPersister implements DataPersisterInterface
{
    protected $em;
    protected $hasheur;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher){
        $this->em = $em;
        $this->hasheur = $hasher;
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }
    public function persist($data)
    {
        $data->setPassword($this->hasheur->hashPassword($data,$data->getPassword()));
        $this->em->persist($data);
        $this->em->flush();
    }
    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}