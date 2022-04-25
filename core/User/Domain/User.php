<?php

namespace Core\User\Domain;

use Core\Shared\Domain\Aggregate\AggregateRoot;
use Core\Shared\Domain\ValueObject\CreatedAt;
use Core\Shared\Domain\ValueObject\UpdatedAt;
use Core\Shared\Domain\ValueObject\Uuid;
use Core\User\Domain\ValueObject\UserName;

final class User extends AggregateRoot
{
    public function __construct(
        private Uuid $uuid,
        private UserName $name,
        private CreatedAt $createdAt,
        private ?UpdatedAt $updatedAt = null
    ) {
    }

    public static function create(
        UserName $name
    ): self {
        return new self(
            Uuid::random(),
            $name,
            CreatedAt::now()
        );
    }

    public function update(
        UserName $name
    ): void {
        $this->name = $name;
        $this->updatedAt = UpdatedAt::now();
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function createdAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?UpdatedAt
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid()->value(),
            'name' => $this->name()->value(),
            'created_at' => $this->createdAt()->toDateTime(),
            'updated_at' => $this->updatedAt()?->toDateTime(),
        ];
    }
}
