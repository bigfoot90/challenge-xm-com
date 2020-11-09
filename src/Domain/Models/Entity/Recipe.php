<?php

namespace Domain\Models\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Models\ValueObject\Id;

class Recipe
{
    private Id $id;
    private string $name;
    private string $description;
    private ?int $difficulty;
    private ?int $time;
    private ?string $photoUrl;
    private ?string $videoUrl;

    private Collection $steps;

    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;

    public function __construct(string $name, string $description, ?int $difficulty, ?int $time, ?string $photoUrl, ?string $videoUrl)
    {
        $this->id = new Id();
        $this->update($name, $description, $difficulty, $time, $photoUrl, $videoUrl);
        $this->steps = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function update(string $name, string $description, ?int $difficulty, ?int $time, ?string $photoUrl, ?string $videoUrl): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->difficulty = $difficulty;
        $this->time = $time;
        $this->photoUrl = $photoUrl;
        $this->videoUrl = $videoUrl;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    /**
     * @return CookingStep[]|Collection
     */
    public function getSteps(): Collection
    {
        return $this->steps;
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
