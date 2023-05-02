<?php

namespace App\Entity;

use App\Repository\FormationActionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationActionRepository::class)]
class FormationAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?formation $formationid = null;

    #[ORM\Column]
    private ?\DateInterval $duration = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $studentcount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormationid(): ?formation
    {
        return $this->formationid;
    }

    public function setFormationid(?formation $formationid): self
    {
        $this->formationid = $formationid;

        return $this;
    }

    public function getDuration(): ?\DateInterval
    {
        return $this->duration;
    }

    public function setDuration(\DateInterval $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStudentcount(): ?int
    {
        return $this->studentcount;
    }

    public function setStudentcount(int $studentcount): self
    {
        $this->studentcount = $studentcount;

        return $this;
    }
}
