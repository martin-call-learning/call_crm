<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * The CrudEntity trait provides attributes and methods to manage timestamps for created, updated, and deleted records.
 */
trait CrudEntity
{
    /**
     * The timestamp when the entity was created.
     *
     * @ORM\Column(nullable: true)
     */
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $createdAt = null;

    /**
     * The timestamp when the entity was last updated.
     *
     * @ORM\Column(nullable: true)
     */
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    /**
     * The timestamp when the entity was soft-deleted.
     *
     * @ORM\Column(nullable: true)
     */
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $deletedAt = null;

    /**
     * Get the timestamp when the entity was created.
     *
     * @return DateTimeImmutable|null The creation timestamp.
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Set the timestamp when the entity was created.
     *
     * @param DateTimeImmutable $createdAt The creation timestamp.
     * @return self The updated entity.
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get the timestamp when the entity was last updated.
     *
     * @return DateTimeImmutable|null The last update timestamp.
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Set the timestamp when the entity was last updated.
     *
     * @param DateTimeImmutable $updatedAt The last update timestamp.
     * @return self The updated entity.
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get the timestamp when the entity was soft-deleted.
     *
     * @return DateTimeImmutable|null The soft-deletion timestamp.
     */
    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * Set the timestamp when the entity was soft-deleted.
     *
     * @param DateTimeImmutable $deletedAt The soft-deletion timestamp.
     * @return self The updated entity.
     */
    public function setDeletedAt(DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
}
