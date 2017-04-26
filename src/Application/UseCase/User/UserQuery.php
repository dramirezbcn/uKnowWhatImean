<?php

namespace Application\UseCase\User;

use Domain\User\Model\User;
use Domain\User\Repository\UserRepositoryInterface;

/**
 * Class UserQuery
 * @package Application\UseCase\User
 */
class UserQuery
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserCommand constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUser(int $userId): User
    {
        return $this->userRepository->getUser($userId);
    }
}