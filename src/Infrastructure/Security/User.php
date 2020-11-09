<?php

namespace Infrastructure\Security;

use Domain\Models\Entity\Account;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private Account $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getUsername(): string
    {
        return $this->account->getEmailAddress();
    }

    public function getPassword(): string
    {
        return $this->account->getPassword();
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    public function getRoles(): array
    {
        $map = static function (string $role) {
            return 'ROLE_' . strtoupper($role);
        };

        return array_map($map, $this->account->getRoles());
    }
}
