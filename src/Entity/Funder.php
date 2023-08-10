<?php

namespace App\Entity;

use App\Repository\FunderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FunderRepository::class)]
class Funder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Organisation $organisation = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: FundingType::class, inversedBy: 'funders')]
    private Collection $fundingType;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    public function __construct()
    {
        $this->fundingType = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrgid(): ?Organisation
    {
        return $this->orgid;
    }

    public function setOrgid(Organisation $organisation): self
    {
        $this->orgid = $organisation;

        return $this;
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

    public function addFundingType(FundingType $fundingType): self
    {
        if (!$this->fundingType->contains($fundingType)) {
            $this->fundingType->add($fundingType);
        }

        return $this;
    }

    public function removeFundingType(FundingType $fundingType): self
    {
        $this->fundingType->removeElement($fundingType);

        return $this;
    }

    public function getFundingType():Collection {
        return $this->fundingType;
    }

    /**
     * @return Organisation|null
     */
    public function getOrganisation(): ?Organisation {
        return $this->organisation;
    }

    /**
     * @param Organisation|null $organisation
     */
    public function setOrganisation(?Organisation $organisation): void {
        $this->organisation = $organisation;
    }
}
