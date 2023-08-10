<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{

    use CrudEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 6)]
    private ?string $code = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $globalGoal = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $pedaGoal = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $highlights = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $expectedResults = null;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getGlobalGoal(): ?string
    {
        return $this->globalGoal;
    }

    public function setGlobalGoal(?string $globalGoal): self
    {
        $this->globalGoal = $globalGoal;

        return $this;
    }

    public function getPedaGoal(): ?string
    {
        return $this->pedaGoal;
    }

    public function setPedaGoal(?string $pedaGoal): self
    {
        $this->pedaGoal = $pedaGoal;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getHighlights(): ?string
    {
        return $this->highlights;
    }

    public function setHighlights(?string $highlights): self
    {
        $this->highlights = $highlights;

        return $this;
    }

    public function getExpectedResults(): ?string
    {
        return $this->expectedResults;
    }

    public function setExpectedResults(?string $expectedResults): self
    {
        $this->expectedResults = $expectedResults;

        return $this;
    }

}
