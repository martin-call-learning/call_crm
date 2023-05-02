<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?contact $contactid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContactid(): ?contact
    {
        return $this->contactid;
    }

    public function setContactid(contact $contactid): self
    {
        $this->contactid = $contactid;

        return $this;
    }
}
