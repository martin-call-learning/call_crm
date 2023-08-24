<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Student entity represents a student.
 *
 * This class is responsible for storing information about students, including their contact information,
 * tests they have taken, and grades they have received.
 *
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Student.
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
     * @var Contact|null The contact information associated with the student.
     *
     * @ORM\OneToOne(cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contact $contact = null;

    /**
     * @var Collection|Test[] The collection of tests taken by the student.
     *
     * @ORM\OneToMany(mappedBy="student", targetEntity=Test::class)
     */
    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Test::class)]
    private Collection $tests;

    /**
     * @var Collection|Grade[] The collection of grades received by the student.
     *
     * @ORM\OneToMany(mappedBy="student", targetEntity=Grade::class)
     */
    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Grade::class)]
    private Collection $grades;

    /**
     * Student constructor.
     */
    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->grades = new ArrayCollection();
    }

    /**
     * Get the unique identifier for the Student.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the contact information associated with the student.
     *
     * @return Contact|null The contact information.
     */
    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    /**
     * Set the contact information associated with the student.
     *
     * @param Contact $contact The contact information to set.
     * @return self
     */
    public function setContact(Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get the collection of tests taken by the student.
     *
     * @return Collection|Test[] The collection of tests.
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    /**
     * Add a test to the collection of tests taken by the student.
     *
     * @param Test $test The test to add.
     * @return self
     */
    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests->add($test);
            $test->setStudent($this);
        }

        return $this;
    }

    /**
     * Remove a test from the collection of tests taken by the student.
     *
     * @param Test $test The test to remove.
     * @return self
     */
    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getStudent() === $this) {
                $test->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * Get the collection of grades received by the student.
     *
     * @return Collection|Grade[] The collection of grades.
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    /**
     * Add a grade to the collection of grades received by the student.
     *
     * @param Grade $grade The grade to add.
     * @return self
     */
    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades->add($grade);
            $grade->setStudent($this);
        }

        return $this;
    }

    /**
     * Remove a grade from the collection of grades received by the student.
     *
     * @param Grade $grade The grade to remove.
     * @return self
     */
    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getStudent() === $this) {
                $grade->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * Generate a string representation of the Student.
     *
     * @return string The formatted string.
     */
    public function __toString(): string {
        return $this->getContact();
    }
}
