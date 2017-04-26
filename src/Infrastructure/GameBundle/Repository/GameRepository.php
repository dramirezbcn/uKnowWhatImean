<?php

namespace Infrastructure\GameBundle\Repository;

use Domain\Game\Model\Game;
use Domain\Game\Repository\GameRepositoryInterface;

/**
 * Class GameRepository
 * @package Infrastructure\GameBundle\Repository
 */
class GameRepository implements GameRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function store(Game $game): Game
    {
        return \Mockery::mock(Game::class)
            ->shouldReceive('getFirstUser')
            ->andReturn('firstUserNameTest')
            ->shouldReceive('getSecondUser')
            ->andReturn('secondUserNameTest')
            ->getMock();
    }

    /**
     * @inheritDoc
     */
    public function getGame(int $gameId): Game
    {
        return \Mockery::mock(Game::class)
            ->shouldReceive('getFirstUser')
            ->andReturn('firstUserNameTest')
            ->shouldReceive('getSecondUser')
            ->andReturn('secondUserNameTest')
            ->getMock();
    }
}