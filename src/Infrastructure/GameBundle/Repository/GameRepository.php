<?php

namespace Infrastructure\GameBundle\Repository;

use Domain\Board\Model\Board;
use Domain\Game\Model\Game;
use Domain\Game\Repository\GameRepositoryInterface;
use Domain\User\Model\User;

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
        $firstUserMock = \Mockery::mock(User::class)
            ->makePartial()
            ->shouldReceive('getName')
            ->andReturn('firstUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();

        $secondUserMock = \Mockery::mock(User::class)
            ->makePartial()
            ->shouldReceive('getName')
            ->andReturn('secondUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(2)
            ->getMock();

        $boardMock = \Mockery::mock(Board::class)
            ->makePartial()
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('setMovement')
            ->andReturn(null)
            ->getMock();

        return \Mockery::mock(Game::class)
            ->makePartial()
            ->shouldReceive('getFirstUser')
            ->andReturn($firstUserMock)
            ->shouldReceive('getSecondUser')
            ->andReturn($secondUserMock)
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('getBoard')
            ->andReturn($boardMock)
            ->getMock();
    }

    /**
     * @inheritDoc
     */
    public function getGame(int $gameId): Game
    {
        $firstUserMock = \Mockery::mock(User::class)
            ->makePartial()
            ->shouldReceive('getName')
            ->andReturn('firstUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();

        $secondUserMock = \Mockery::mock(User::class)
            ->makePartial()
            ->shouldReceive('getName')
            ->andReturn('secondUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(2)
            ->getMock();

        $boardMock = \Mockery::mock(Board::class)
            ->makePartial()
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('setMovement')
            ->andReturn(null)
            ->getMock();

        return \Mockery::mock(Game::class)
            ->makePartial()
            ->shouldReceive('getFirstUser')
            ->andReturn($firstUserMock)
            ->shouldReceive('getSecondUser')
            ->andReturn($secondUserMock)
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('getBoard')
            ->andReturn($boardMock)
            ->getMock();
    }
}