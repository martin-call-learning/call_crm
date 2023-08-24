<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Grade entity represents a score achieved by a student in a test.
 *
 * This class is responsible for storing information about grades, such as the test, student, and the achieved score.
 *
 * @ORM\Entity(repositoryClass=GradeRepository::class)
 */
#[ORM\Entity(repositoryClass: GradeRepository::class)]
class Grade
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Grade.
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
     * @var Test|null The test associated with this grade.
     *
     * @ORM\ManyToOne(inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    #[ORM\ManyToOne(inversedBy: 'grades')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Test $test = null;

    /**
     * @var Student|null The student associated with this grade.
     *
     * @ORM\ManyToOne(inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    #[ORM\ManyToOne(inversedBy: 'grades')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Student $student = null;

    /**
     * @var int|null The score achieved in the test.
     *
     * @ORM\Column(nullable=true)
     */
    #[ORM\Column(nullable: true)]
    private ?int $score = null;

    /**
     * Get the unique identifier for the Grade.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the test associated with this grade.
     *
     * @return Test|null The associated test.
     */
    public function getTest(): ?Test
    {
        return $this->test;
    }

    /**
     * Set the test associated with this grade.
     *
     * @param Test|null $test The test to associate.
     * @return self
     */
    public function setTest(?Test $test): self
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get the student associated with this grade.
     *
     * @return Student|null The associated student.
     */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * Set the student associated with this grade.
     *
     * @param Student|null $student The student to associate.
     * @return self
     */
    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get the score achieved in the test.
     *
     * @return int|null The score.
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * Set the score achieved in the test.
     *
     * @param int|null $score The score to set.
     * @return self
     */
    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }
}
