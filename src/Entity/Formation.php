<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Formation entity represents an educational program or course.
 *
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{

    use CrudEntity;

    /**
     * The unique identifier of the formation.
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
     * The name of the formation.
     *
     * @ORM\Column(length: 255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * The code or identifier for the formation.
     *
     * @ORM\Column(length: 6)
     */
    #[ORM\Column(length: 6)]
    private ?string $code = null;

    /**
     * The global goal or objective of the formation.
     *
     * @ORM\Column(length: 1024, nullable: true)
     */
    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $globalGoal = null;

    /**
     * The pedagogical goal or objective of the formation.
     *
     * @ORM\Column(length: 1024, nullable: true)
     */
    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $pedaGoal = null;

    /**
     * The content of the formation.
     *
     * @ORM\Column(length: 1024, nullable: true)
     */
    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $content = null;

    /**
     * Highlights or important aspects of the formation.
     *
     * @ORM\Column(length: 1024, nullable: true)
     */
    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $highlights = null;

    /**
     * Expected results or outcomes of the formation.
     *
     * @ORM\Column(length: 1024, nullable: true)
     */
    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $expectedResults = null;

    /**
     * Get the unique identifier of the formation.
     *
     * @return int|null The formation's ID.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the formation.
     *
     * @return string|null The formation's name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the formation.
     *
     * @param string $name The name to set.
     * @return self The updated formation entity.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the code or identifier for the formation.
     *
     * @return string|null The formation's code.
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Set the code or identifier for the formation.
     *
     * @param string $code The code to set.
     * @return self The updated formation entity.
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the global goal or objective of the formation.
     *
     * @return string|null The global goal.
     */
    public function getGlobalGoal(): ?string
    {
        return $this->globalGoal;
    }

    /**
     * Set the global goal or objective of the formation.
     *
     * @param string|null $globalGoal The global goal to set.
     * @return self The updated formation entity.
     */
    public function setGlobalGoal(?string $globalGoal): self
    {
        $this->globalGoal = $globalGoal;

        return $this;
    }

    /**
     * Get the pedagogical goal or objective of the formation.
     *
     * @return string|null The pedagogical goal.
     */
    public function getPedaGoal(): ?string
    {
        return $this->pedaGoal;
    }

    /**
     * Set the pedagogical goal or objective of the formation.
     *
     * @param string|null $pedaGoal The pedagogical goal to set.
     * @return self The updated formation entity.
     */
    public function setPedaGoal(?string $pedaGoal): self
    {
        $this->pedaGoal = $pedaGoal;

        return $this;
    }

    /**
     * Get the content of the formation.
     *
     * @return string|null The content.
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set the content of the formation.
     *
     * @param string|null $content The content to set.
     * @return self The updated formation entity.
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the highlights or important aspects of the formation.
     *
     * @return string|null The highlights.
     */
    public function getHighlights(): ?string
    {
        return $this->highlights;
    }

    /**
     * Set the highlights or important aspects of the formation.
     *
     * @param string|null $highlights The highlights to set.
     * @return self The updated formation entity.
     */
    public function setHighlights(?string $highlights): self
    {
        $this->highlights = $highlights;

        return $this;
    }

    /**
     * Get the expected results or outcomes of the formation.
     *
     * @return string|null The expected results.
     */
    public function getExpectedResults(): ?string
    {
        return $this->expectedResults;
    }

    /**
     * Set the expected results or outcomes of the formation.
     *
     * @param string|null $expectedResults The expected results to set.
     * @return self The updated formation entity.
     */
    public function setExpectedResults(?string $expectedResults): self
    {
        $this->expectedResults = $expectedResults;

        return $this;
    }

    /**
     * Convert the formation entity to a string representation (name).
     *
     * @return string The name of the formation.
     */
    public function __toString(): string {
        return $this->getName();
    }
}
