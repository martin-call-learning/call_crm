<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Role entity represents a user role within the system.
 *
 * This class is responsible for storing information about roles, such as their name and the users associated with them.
 *
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{

    use CrudEntity;

    /**
     * @var int|null The unique identifier for the Role.
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
     * @var string|null The name of the role.
     *
     * @ORM\Column(length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection|User[] The collection of users associated with this role.
     *
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="roles")
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'roles')]
    private Collection $users;

    /**
     * Role constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Get the unique identifier for the Role.
     *
     * @return int|null The identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the role.
     *
     * @return string|null The name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the role.
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
     * Get the collection of users associated with this role.
     *
     * @return Collection|User[] The collection of users.
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * Add a user to the collection of users associated with this role.
     *
     * @param User $user The user to add.
     * @return self
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRole($this);
        }

        return $this;
    }

    /**
     * Remove a user from the collection of users associated with this role.
     *
     * @param User $user The user to remove.
     * @return self
     */
    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeRole($this);
        }

        return $this;
    }

    /**
     * Generate a string representation of the Role.
     *
     * @return string The formatted string.
     */
    public function __toString(): string {
        return $this->name;
    }
}
