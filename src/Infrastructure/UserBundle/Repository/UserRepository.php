<?php

namespace Infrastructure\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Domain\User\Model\User;
use Domain\User\Repository\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package Infrastructure\UserBundle\Repository
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     * @throws ORMInvalidArgumentException|OptimisticLockException
     */
    public function store(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function getUser(int $userId)
    {
        return $this->find($userId);
    }

    /**
     * @inheritDoc
     * @throws ORMInvalidArgumentException|OptimisticLockException
     */
    public function remove(User $user)
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }
}