<?php

namespace App\Entity;

use App\Repository\FormationActionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationActionRepository::class)]
class FormationAction extends CrudEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formation $formation = null;

    #[ORM\Column]
    private ?\DateInterval $duration = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $expectedStudentCount = null;

    #[ORM\Column]
    private ?bool $remote = false;

    #[ORM\Column]
    private ?bool $presential = false;

    #[ORM\Column(nullable: true)]
    private ?int $levelRequired = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?formation
    {
        return $this->formation;
    }

    public function setFormation(?formation $formation): self
    {
        $this->formation = $formation;

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

    public function getExpectedStudentCount(): ?int
    {
        return $this->expectedStudentCount;
    }

    public function setExpectedStudentCount(?int $expectedStudentCount): self
    {
        $this->expectedStudentCount = $expectedStudentCount;

        return $this;
    }

    public function isRemote(): ?bool
    {
        return $this->remote;
    }

    public function setRemote(bool $remote): self
    {
        $this->remote = $remote;

        return $this;
    }

    public function isPresential(): ?bool
    {
        return $this->presential;
    }

    public function setPresential(bool $presential): self
    {
        $this->presential = $presential;

        return $this;
    }

    public function getLevelRequired(): ?int
    {
        return $this->levelRequired;
    }

    public function setLevelRequired(?int $levelRequired): self
    {
        $this->levelRequired = $levelRequired;

        return $this;
    }
}
