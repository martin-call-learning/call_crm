<?php

namespace App\Entity;

use App\Repository\FormationActionRepository;
use DateInterval;
use Doctrine\ORM\Mapping as ORM;

/**
 * The FormationAction entity represents an action related to a specific formation.
 *
 * This class is responsible for storing information about formation actions, such as their duration, price,
 * expected student count, remote and presential flags, and required level.
 *
 * @ORM\Entity(repositoryClass=FormationActionRepository::class)
 */
#[ORM\Entity(repositoryClass: FormationActionRepository::class)]
class FormationAction
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the FormationAction.
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
     * @var Formation|null The formation associated with this action.
     *
     * @ORM\ManyToOne(cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[ORM\ManyToOne(cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formation $formation = null;

    /**
     * @var DateInterval|null The duration of the formation action.
     *
     * @ORM\Column
     */
    #[ORM\Column]
    private ?DateInterval $duration = null;

    /**
     * @var float|null The price of the formation action.
     *
     * @ORM\Column
     */
    #[ORM\Column]
    private ?float $price = null;

    /**
     * @var int|null The expected number of students for the formation action.
     *
     * @ORM\Column(nullable=true)
     */
    #[ORM\Column(nullable: true)]
    private ?int $expectedStudentCount = null;

    /**
     * @var bool|null Indicates if the formation action is conducted remotely.
     *
     * @ORM\Column
     */
    #[ORM\Column]
    private ?bool $remote = false;

    /**
     * @var bool|null Indicates if the formation action is conducted in person.
     *
     * @ORM\Column
     */
    #[ORM\Column]
    private ?bool $presential = false;

    /**
     * @var int|null The required level for the formation action.
     *
     * @ORM\Column(nullable=true)
     */
    #[ORM\Column(nullable: true)]
    private ?int $levelRequired = null;

    /**
     * Get the unique identifier for the FormationAction.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the formation associated with this action.
     *
     * @return Formation|null The associated formation.
     */
    public function getFormation(): ?formation
    {
        return $this->formation;
    }

    /**
     * Set the formation associated with this action.
     *
     * @param Formation|null $formation The formation to associate.
     * @return self
     */
    public function setFormation(?formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get the duration of the formation action.
     *
     * @return DateInterval|null The duration.
     */
    public function getDuration(): ?DateInterval
    {
        return $this->duration;
    }

    /**
     * Set the duration of the formation action.
     *
     * @param DateInterval $duration The duration to set.
     * @return self
     */
    public function setDuration(DateInterval $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the price of the formation action.
     *
     * @return float|null The price.
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * Set the price of the formation action.
     *
     * @param float $price The price to set.
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the expected number of students for the formation action.
     *
     * @return int|null The expected student count.
     */
    public function getExpectedStudentCount(): ?int
    {
        return $this->expectedStudentCount;
    }

    /**
     * Set the expected number of students for the formation action.
     *
     * @param int|null $expectedStudentCount The expected student count to set.
     * @return self
     */
    public function setExpectedStudentCount(?int $expectedStudentCount): self
    {
        $this->expectedStudentCount = $expectedStudentCount;

        return $this;
    }

    /**
     * Check if the formation action is conducted remotely.
     *
     * @return bool|null True if remote, false otherwise.
     */
    public function isRemote(): ?bool
    {
        return $this->remote;
    }

    /**
     * Set whether the formation action is conducted remotely.
     *
     * @param bool $remote Whether the action is remote.
     * @return self
     */
    public function setRemote(bool $remote): self
    {
        $this->remote = $remote;

        return $this;
    }

    /**
     * Check if the formation action is conducted in person.
     *
     * @return bool|null True if presential, false otherwise.
     */
    public function isPresential(): ?bool
    {
        return $this->presential;
    }

    /**
     * Set whether the formation action is conducted in person.
     *
     * @param bool $presential Whether the action is presential.
     * @return self
     */
    public function setPresential(bool $presential): self
    {
        $this->presential = $presential;

        return $this;
    }

    /**
     * Get the required level for the formation action.
     *
     * @return int|null The required level.
     */
    public function getLevelRequired(): ?int
    {
        return $this->levelRequired;
    }

    /**
     * Set the required level for the formation action.
     *
     * @param int|null $levelRequired The required level to set.
     * @return self
     */
    public function setLevelRequired(?int $levelRequired): self
    {
        $this->levelRequired = $levelRequired;

        return $this;
    }

    /**
     * Generate a string representation of the FormationAction.
     *
     * @return string The formatted string.
     */
    public function __toString(): string {
        return $this->getFormation()->__toString() . ' : ' . $this->getPrice()/100 . '€ * '.$this->getExpectedStudentCount(). ', '
            . 'remote : '. $this->isRemote(). ', presential : ' . $this->isPresential(). ', lvl : '.$this->getLevelRequired();
    }
}
