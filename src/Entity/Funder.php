<?php

namespace App\Entity;

use App\Repository\FunderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Funder entity represents an entity that provides funding for organizations.
 *
 * This class is responsible for storing information about funders, such as their name, associated organization,
 * and the types of funding they offer.
 *
 * @ORM\Entity(repositoryClass=FunderRepository::class)
 */
#[ORM\Entity(repositoryClass: FunderRepository::class)]
class Funder
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Funder.
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
     * @var Organisation|null The organization associated with this funder.
     *
     * @ORM\OneToOne(cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Organisation $organisation = null;

    /**
     * @var string|null The name of the funder.
     *
     * @ORM\Column(length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection|FundingType[] The collection of funding types associated with this funder.
     *
     * @ORM\ManyToMany(targetEntity=FundingType::class, inversedBy="funders")
     */
    #[ORM\ManyToMany(targetEntity: FundingType::class, inversedBy: 'funders')]
    private Collection $fundingType;

    /**
     * Funder constructor.
     */
    public function __construct()
    {
        $this->fundingType = new ArrayCollection();
    }

    /**
     * Get the unique identifier for the Funder.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the funder.
     *
     * @return string|null The name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the funder.
     *
     * @param string $name The name to set.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add a funding type to the collection of funding types.
     *
     * @param FundingType $fundingType The funding type to add.
     * @return self
     */
    public function addFundingType(FundingType $fundingType): self
    {
        if (!$this->fundingType->contains($fundingType)) {
            $this->fundingType->add($fundingType);
        }

        return $this;
    }

    /**
     * Remove a funding type from the collection of funding types.
     *
     * @param FundingType $fundingType The funding type to remove.
     * @return self
     */
    public function removeFundingType(FundingType $fundingType): self
    {
        $this->fundingType->removeElement($fundingType);

        return $this;
    }

    /**
     * Get the collection of funding types associated with this funder.
     *
     * @return Collection|FundingType[] The collection of funding types.
     */
    public function getFundingType():Collection {
        return $this->fundingType;
    }

    /**
     * Get the organization associated with this funder.
     *
     * @return Organisation|null The associated organization.
     */
    public function getOrganisation(): ?Organisation {
        return $this->organisation;
    }

    /**
     * Set the organization associated with this funder.
     *
     * @param Organisation|null $organisation The organization to associate.
     */
    public function setOrganisation(?Organisation $organisation): void {
        $this->organisation = $organisation;
    }
}
