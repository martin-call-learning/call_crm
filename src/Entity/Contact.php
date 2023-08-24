<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Contact entity representing a contact person.
 */
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{

    use CrudEntity;


    /**
     * The unique identifier of the contact.
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
     * The first name of the contact person.
     *
     * @ORM\Column(length: 255)
     */
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    /**
     * The last name of the contact person.
     *
     * @ORM\Column(length: 255)
     */
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    /**
     * The email address of the contact person.
     *
     * @ORM\Column(length: 255, nullable: true)
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    /**
     * The phone number of the contact person.
     *
     * @ORM\Column(nullable: true)
     */
    #[ORM\Column(nullable: true)]
    private ?int $phoneNumber = null;

    /**
     * The address of the contact person.
     *
     * @ORM\Column(length: 255, nullable: true)
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    /**
     * The associated organization of the contact person.
     *
     * @ORM\ManyToOne
     */
    #[ORM\ManyToOne]
    private ?Organisation $organisation = null;

    /**
     * Get the unique identifier of the contact.
     *
     * @return int|null The contact's ID.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the first name of the contact.
     *
     * @return string|null The contact's first name.
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set the first name of the contact.
     *
     * @param string $firstname The first name to set.
     * @return self The updated contact entity.
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the last name of the contact.
     *
     * @return string|null The contact's last name.
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set the last name of the contact.
     *
     * @param string $lastname The last name to set.
     * @return self The updated contact entity.
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the email address of the contact.
     *
     * @return string|null The contact's email.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the email address of the contact.
     *
     * @param string|null $email The email to set.
     * @return self The updated contact entity.
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the phone number of the contact.
     *
     * @return int|null The contact's phone number.
     */
    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    /**
     * Set the phone number of the contact.
     *
     * @param int|null $phoneNumber The phone number to set.
     * @return self The updated contact entity.
     */
    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the address of the contact.
     *
     * @return string|null The contact's address.
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set the address of the contact.
     *
     * @param string|null $address The address to set.
     * @return self The updated contact entity.
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the associated organization of the contact.
     *
     * @return Organisation|null The organisation associated with the contact.
     */
    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    /**
     * Set the associated organization of the contact.
     *
     * @param Organisation|null $organisation The organisation to set.
     * @return self The updated contact entity.
     */
    public function setOrganisation(?Organisation $organisation): self
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Convert the contact entity to a string representation (full name).
     *
     * @return string The full name of the contact.
     */
    public function __toString(): string {
        return $this->getLastname(). " " . $this->getFirstname();
    }
}
