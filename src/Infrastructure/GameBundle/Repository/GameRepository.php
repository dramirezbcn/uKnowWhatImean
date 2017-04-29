<?php

namespace Infrastructure\GameBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Domain\Game\Model\Game;
use Domain\Game\Repository\GameRepositoryInterface;

/**
 * Class GameRepository
 * @package Infrastructure\GameBundle\Repository
 */
class GameRepository extends EntityRepository implements GameRepositoryInterface
{
    /**
     * @inheritDoc
     * @throws ORMInvalidArgumentException|OptimisticLockException
     */
    public function store(Game $game): Game
    {
        $this->getEntityManager()->persist($game);
        $this->getEntityManager()->flush();

        return $game;
    }

    /**
     * @inheritDoc
     */
    public function getGame(int $gameId)
    {
        return $this->find($gameId);
    }
}