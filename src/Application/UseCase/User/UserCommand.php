<?php

namespace Application\UseCase\User;

use Application\UseCase\User\Request\CreateUserRequest;
use Domain\User\Factory\UserFactoryInterface;
use Domain\User\Model\User;
use Domain\User\Repository\UserRepositoryInterface;

/**
 * Class UserCommand
 * @package Application\UseCase\User
 */
class UserCommand
{
    /** @var UserFactoryInterface  */
    private $userFactory;

    /** @var UserRepositoryInterface  */
    private $userRepository;

    /** @var UserQuery  */
    private $userQuery;

    /**
     * UserCommand constructor.
     * @param UserFactoryInterface $userFactory
     * @param UserRepositoryInterface $userRepository
     * @param UserQuery $userQuery
     */
    public function __construct(
        UserFactoryInterface $userFactory,
        UserRepositoryInterface $userRepository,
        UserQuery $userQuery
    )
    {
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
        $this->userQuery = $userQuery;
    }

    /**
     * @param CreateUserRequest $createUserRequest
     * @return User
     */
    public function create(CreateUserRequest $createUserRequest): User
    {
        $user = $this->userFactory->create($createUserRequest->getName());
        $this->userRepository->store($user);

        return $user;
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function delete(int $userId): bool
    {
        $user = $this->userQuery->getUser($userId);
        return $this->userRepository->delete($user);
    }
}