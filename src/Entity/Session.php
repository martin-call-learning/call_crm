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
    private Collection $students;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FormationAction $formationAction = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
        }

        return $this;
    }

    public function removeStudent(student $student): self
    {
        $this->students->removeElement($student);

        return $this;
    }

    public function getFormationAction(): ?FormationAction
    {
        return $this->formationAction;
    }

    public function setFormationAction(?FormationAction $formationAction): self
    {
        $this->formationAction = $formationAction;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartdate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEnddate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

}
