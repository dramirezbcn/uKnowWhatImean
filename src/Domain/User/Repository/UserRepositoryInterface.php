<?php

namespace Domain\User\Repository;

use Domain\User\Model\User;

/**
 * Class UserRepositoryInterface
 * @package Domain\User\Repository
 */
interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return User
     */
    public function store(User $user): User;

    /**
     * @param int $userId
     * @return User|null
     */
    public function getUser(int $userId);

    /**
     * @param User $user
     */
    public function remove(User $user);
}