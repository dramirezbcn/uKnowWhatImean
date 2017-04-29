<?php

namespace Infrastructure\BoardBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Domain\Board\Model\Board;
use Domain\Board\Repository\BoardRepositoryInterface;

/**
 * Class BoardRepository
 * @package Infrastructure\BoardBundle\Repository
 */
class BoardRepository extends EntityRepository implements BoardRepositoryInterface
{
    /**
     * @inheritDoc
     * @throws ORMInvalidArgumentException|OptimisticLockException
     */
    public function store(Board $board): Board
    {
        $this->getEntityManager()->persist($board);
        $this->getEntityManager()->flush();

        return $board;
    }

    /**
     * @inheritDoc
     */
    public function getBoard(int $boardId)
    {
        return $this->find($boardId);
    }
}