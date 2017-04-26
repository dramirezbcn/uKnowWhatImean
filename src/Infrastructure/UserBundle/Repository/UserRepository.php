<?php

namespace Infrastructure\UserBundle\Repository;

use Domain\User\Model\User;
use Domain\User\Repository\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package Infrastructure\UserBundle\Repository
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function store(User $user): User
    {
        return \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn('nameTest')
            ->getMock();
    }

    /**
     * @inheritDoc
     */
    public function getUser(int $userId): User
    {
        return \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn('nameTest')
            ->getMock();
    }

    /**
     * @inheritDoc
     */
    public function delete(User $user): bool
    {
        return true;
    }
}