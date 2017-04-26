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
     * @return User
     */
    public function getUser(int $userId): User;

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool ;
}