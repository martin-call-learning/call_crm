<?php

namespace App\Entity;

use App\Repository\FundingTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FundingTypeRepository::class)]
class FundingType extends CrudEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Funder::class, mappedBy: 'fundingType')]
    private Collection $funders;

    public function __construct()
    {
        $this->funders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Funder>
     */
    public function getFunders(): Collection
    {
        return $this->funders;
    }

    public function addFunder(Funder $funder): self
    {
        if (!$this->funders->contains($funder)) {
            $this->funders->add($funder);
            $funder->addFundingType($this);
        }

        return $this;
    }

    public function removeFunder(Funder $funder): self
    {
        if ($this->funders->removeElement($funder)) {
            $funder->removeFundingType($this);
        }

        return $this;
    }
}
