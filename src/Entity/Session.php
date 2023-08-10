<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{

    use CrudEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Student::class)]
    private Collection $students;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FormationAction $formationAction = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $endDate = null;

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

    public function getStartdate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartdate(DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEnddate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEnddate(DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

}
