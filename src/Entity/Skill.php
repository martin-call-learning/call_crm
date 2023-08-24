<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Skill entity represents a skill that can be associated with various entities.
 *
 * This class is responsible for storing information about skills, such as their name.
 *
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Skill.
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
     * @var string|null The name of the skill.
     *
     * @ORM\Column(length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * Get the unique identifier for the Skill.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the skill.
     *
     * @return string|null The name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the skill.
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
     * Generate a string representation of the Skill.
     *
     * @return string The formatted string.
     */
    public function __toString(): string {
        return $this->getName();
    }
}
