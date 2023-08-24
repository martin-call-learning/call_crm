<?php

namespace App\Entity;

use App\Repository\FundingTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The FundingType entity represents a type of funding that can be provided by funders.
 *
 * This class is responsible for storing information about funding types, such as their name and the funders
 * that offer this type of funding.
 *
 * @ORM\Entity(repositoryClass=FundingTypeRepository::class)
 */
#[ORM\Entity(repositoryClass: FundingTypeRepository::class)]
class FundingType
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the FundingType.
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
     * @var string|null The name of the funding type.
     *
     * @ORM\Column(length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection|Funder[] The collection of funders associated with this funding type.
     *
     * @ORM\ManyToMany(targetEntity=Funder::class, mappedBy="fundingType")
     */
    #[ORM\ManyToMany(targetEntity: Funder::class, mappedBy: 'fundingType')]
    private Collection $funders;

    /**
     * FundingType constructor.
     */
    public function __construct()
    {
        $this->funders = new ArrayCollection();
    }

    /**
     * Get the unique identifier for the FundingType.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the funding type.
     *
     * @return string|null The name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the funding type.
     *
     * @param string $name The name to set.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the collection of funders associated with this funding type.
     *
     * @return Collection|Funder[] The collection of funders.
     */
    public function getFunders(): Collection
    {
        return $this->funders;
    }

    /**
     * Add a funder to the collection of funders associated with this funding type.
     *
     * @param Funder $funder The funder to add.
     * @return self
     */
    public function addFunder(Funder $funder): self
    {
        if (!$this->funders->contains($funder)) {
            $this->funders->add($funder);
            $funder->addFundingType($this);
        }

        return $this;
    }

    /**
     * Remove a funder from the collection of funders associated with this funding type.
     *
     * @param Funder $funder The funder to remove.
     * @return self
     */
    public function removeFunder(Funder $funder): self
    {
        if ($this->funders->removeElement($funder)) {
            $funder->removeFundingType($this);
        }

        return $this;
    }

    /**
     * Generate a string representation of the FundingType.
     *
     * @return string The formatted string.
     */
    public function __toString(): string {
        return $this->getName();
    }
}
