<?php

namespace Application\UseCase\Game;

use Domain\Game\Exception\GameNotFoundException;
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
     * GameQuery constructor.
     * @param GameRepositoryInterface $gameRepository
     */
    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param int $gameId
     * @return Game
     * @throws GameNotFoundException
     */
    public function getGame(int $gameId): Game
    {
        $game = $this->gameRepository->getGame($gameId);

        if (null === $game) {
            throw new GameNotFoundException($gameId);
        }

        return $game;
    }
}