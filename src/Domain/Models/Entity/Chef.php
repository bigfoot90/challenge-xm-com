<?php

namespace Domain\Models\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Models\ValueObject\Id;

class Chef
{
    private Id $id;

    private string $name;
    private Account $account;

    private Collection $preferredRecipes;

    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;

    public function __construct(string $name, Account $account)
    {
        $this->id = new Id();
        $this->update($name, $account);
        $this->preferredRecipes = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function update(string $name, Account $account): void
    {
        $this->name = $name;
        $this->account = $account;

        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAccount(): Account
    {
        return $this->account;
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
