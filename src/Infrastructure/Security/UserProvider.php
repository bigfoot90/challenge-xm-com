<?php

namespace Infrastructure\Security;

use Domain\Models\Entity\AccountRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserLoaderInterface, UserProviderInterface
{
    private AccountRepository $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function loadUserByUsername(string $username)
    {
        $account = $this->repository->get(['emailAddress' => $username]);

        if (!$account) {
            throw new UsernameNotFoundException();
        }

        return new User($account);
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass(string $class)
    {
        return User::class === $class;
    }
}
