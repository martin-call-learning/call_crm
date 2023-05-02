<?php

namespace App\Entity;

use App\Repository\FunderRepository;
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
    private ?organisation $orgid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $fundingtype = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrgid(): ?organisation
    {
        return $this->orgid;
    }

    public function setOrgid(organisation $orgid): self
    {
        $this->orgid = $orgid;

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

    public function getFundingtype(): ?int
    {
        return $this->fundingtype;
    }

    public function setFundingtype(?int $fundingtype): self
    {
        $this->fundingtype = $fundingtype;

        return $this;
    }
}
