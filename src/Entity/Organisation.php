<?php

namespace App\Entity;

use App\Repository\OrganisationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Organisation entity represents an organization.
 *
 * This class is responsible for storing information about organizations, such as their name.
 *
 * @ORM\Entity(repositoryClass=OrganisationRepository::class)
 */
#[ORM\Entity(repositoryClass: OrganisationRepository::class)]
class Organisation
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Organisation.
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
     * @var string|null The name of the organization.
     *
     * @ORM\Column(length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * Get the unique identifier for the Organisation.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the organization.
     *
     * @return string|null The name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the organization.
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
     * Generate a string representation of the Organisation.
     *
     * @return string The formatted string.
     */
    public function __toString(): string {
        return $this->getName();
    }
}
