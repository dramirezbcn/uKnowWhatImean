<?php

namespace Application\UseCase\User;

use Domain\User\Exception\UserNotFoundException;
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
     * UserQuery constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $userId
     * @return User|null
     * @throws UserNotFoundException
     */
    public function getUser(int $userId)
    {
        $user = $this->userRepository->getUser($userId);

        if (null === $user) {
            throw new UserNotFoundException($userId);
        }

        return $user;
    }
}