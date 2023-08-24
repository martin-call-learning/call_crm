<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Session entity represents a session of a formation action.
 *
 * This class is responsible for storing information about sessions, such as the students attending, the associated
 * formation action, start and end dates.
 *
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Session.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection|Student[] The collection of students attending this session.
     *
     * @ORM\ManyToMany(targetEntity=Student::class)
     */
    #[ORM\ManyToMany(targetEntity: Student::class)]
    private Collection $students;

    /**
     * @var FormationAction|null The formation action associated with this session.
     *
     * @ORM\ManyToOne
     * @ORM\JoinColumn(nullable=false)
     */
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FormationAction $formationAction = null;

    /**
     * @var DateTimeInterface|null The start date of the session.
     *
     * @ORM\Column(type=Types::DATE_MUTABLE)
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $startDate = null;

    /**
     * @var DateTimeInterface|null The end date of the session.
     *
     * @ORM\Column(type=Types::DATE_MUTABLE)
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $endDate = null;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /**
     * Get the unique identifier for the Session.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the collection of students attending this session.
     *
     * @return Collection|Student[] The collection of students.
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    /**
     * Add a student to the collection of students attending this session.
     *
     * @param Student $student The student to add.
     * @return self
     */
    public function addStudent(student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
        }

        return $this;
    }

    /**
     * Remove a student from the collection of students attending this session.
     *
     * @param Student $student The student to remove.
     * @return self
     */
    public function removeStudent(student $student): self
    {
        $this->students->removeElement($student);

        return $this;
    }

    /**
     * Get the formation action associated with this session.
     *
     * @return FormationAction|null The associated formation action.
     */
    public function getFormationAction(): ?FormationAction
    {
        return $this->formationAction;
    }

    /**
     * Set the formation action associated with this session.
     *
     * @param FormationAction|null $formationAction The formation action to associate.
     * @return self
     */
    public function setFormationAction(?FormationAction $formationAction): self
    {
        $this->formationAction = $formationAction;

        return $this;
    }

    /**
     * Get the start date of the session.
     *
     * @return DateTimeInterface|null The start date.
     */
    public function getStartdate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * Set the start date of the session.
     *
     * @param DateTimeInterface $startDate The start date to set.
     * @return self
     */
    public function setStartdate(DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the end date of the session.
     *
     * @return DateTimeInterface|null The end date.
     */
    public function getEnddate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * Set the end date of the session.
     *
     * @param DateTimeInterface $endDate The end date to set.
     * @return self
     */
    public function setEnddate(DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

}
