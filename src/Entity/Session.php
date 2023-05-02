<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: student::class)]
    private Collection $studentid;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?formationaction $actionid = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startdate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $enddate = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?funder $funderid = null;

    public function __construct()
    {
        $this->studentid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, student>
     */
    public function getStudentid(): Collection
    {
        return $this->studentid;
    }

    public function addStudentid(student $studentid): self
    {
        if (!$this->studentid->contains($studentid)) {
            $this->studentid->add($studentid);
        }

        return $this;
    }

    public function removeStudentid(student $studentid): self
    {
        $this->studentid->removeElement($studentid);

        return $this;
    }

    public function getActionid(): ?formationaction
    {
        return $this->actionid;
    }

    public function setActionid(?formationaction $actionid): self
    {
        $this->actionid = $actionid;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getFunderid(): ?funder
    {
        return $this->funderid;
    }

    public function setFunderid(?funder $funderid): self
    {
        $this->funderid = $funderid;

        return $this;
    }
}
