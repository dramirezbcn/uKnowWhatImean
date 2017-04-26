<?php

namespace Application\UseCase\Game;

use Domain\Game\Model\Game;
use Domain\Game\Repository\GameRepositoryInterface;

/**
 * Class GameQuery
 * @package Application\UseCase\Game
 */
class GameQuery
{
    /** @var GameRepositoryInterface */
    private $gameRepository;

    /**
     * GameCommand constructor.
     * @param GameRepositoryInterface $gameRepository
     */
    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param int $gameId
     * @return Game
     */
    public function getGame(int $gameId): Game
    {
        return $this->gameRepository->getGame($gameId);
    }
}