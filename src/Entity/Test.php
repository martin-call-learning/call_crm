<?php

namespace App\Entity;

use App\Repository\TestRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Test entity represents a test associated with a specific skill.
 *
 * This class is responsible for storing information about tests, including their name, associated skill,
 * and the grades received for the test.
 *
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Test.
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
     * @var string|null The name of the test.
     *
     * @ORM\Column(length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Skill|null The skill associated with the test.
     *
     * @ORM\ManyToOne
     * @ORM\JoinColumn(nullable=false)
     */
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Skill $skill = null;

    /**
     * @var Collection|Grade[] The collection of grades received for this test.
     *
     * @ORM\OneToMany(mappedBy="test", targetEntity=Grade::class)
     */
    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Grade::class)]
    private Collection $grades;

    /**
     * Test constructor.
     */
    public function __construct()
    {
        $this->grades = new ArrayCollection();
    }

    /**
     * Get the unique identifier for the Test.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the test.
     *
     * @return string|null The name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the test.
     *
     * @param string $name The name to set.
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the skill associated with the test.
     *
     * @return Skill|null The associated skill.
     */
    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    /**
     * Set the skill associated with the test.
     *
     * @param Skill|null $skill The skill to associate.
     * @return self
     */
    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get the collection of grades received for this test.
     *
     * @return Collection|Grade[] The collection of grades.
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    /**
     * Add a grade to the collection of grades received for this test.
     *
     * @param Grade $grade The grade to add.
     * @return self
     */
    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades->add($grade);
            $grade->setTest($this);
        }

        return $this;
    }

    /**
     * Remove a grade from the collection of grades received for this test.
     *
     * @param Grade $grade The grade to remove.
     * @return self
     */
    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getTest() === $this) {
                $grade->setTest(null);
            }
        }

        return $this;
    }

    /**
     * Generate a string representation of the Test.
     *
     * @return string The formatted string.
     */
    public function __toString(): string {
        return $this->getName() .' - '. $this->getSkill();
    }
}
