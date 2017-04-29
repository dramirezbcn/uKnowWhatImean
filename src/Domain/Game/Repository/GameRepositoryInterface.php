<?php

namespace Domain\Game\Repository;

use Domain\Game\Model\Game;

/**
 * Class GameRepositoryInterface
 * @package Domain\Game\Repository
 */
interface GameRepositoryInterface
{
    /**
     * @param Game $game
     * @return Game
     */
    public function store(Game $game): Game;

    /**
     * @param int $gameId
     * @return Game|null
     */
    public function getGame(int $gameId);
}