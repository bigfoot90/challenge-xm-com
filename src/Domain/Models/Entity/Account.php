<?php

namespace Domain\Models\Entity;

use Domain\Models\ValueObject\Id;

class Account
{
    private Id $id;

    private Chef $chef;
    private string $emailAddress;
    private string $password;

    /**
     * @var string[]
     */
    private array $roles;

    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;

    public function __construct(string $emailAddress, string $password, array $roles = [])
    {
        $this->id = new Id();
        $this->update($emailAddress, $password, $roles);
        $this->createdAt = new \DateTimeImmutable();
    }

    public function update(string $emailAddress, string $password, array $roles = []): void
    {
        $this->emailAddress = $emailAddress;
        $this->password = $password;
        $this->roles = $roles;

        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getChef(): Chef
    {
        return $this->chef;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles ?: ['user'];
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
