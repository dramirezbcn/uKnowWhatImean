<?php

namespace Infrastructure\BoardBundle\Repository;

use Domain\Board\Model\Board;
use Domain\Board\Repository\BoardRepositoryInterface;

/**
 * Class BoardRepository
 * @package Infrastructure\BoardBundle\Repository
 */
class BoardRepository implements BoardRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function store(Board $board): Board
    {
        return \Mockery::mock(Board::class)
            ->makePartial()
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('setMovement')
            ->andReturn(null)
            ->getMock();
    }

    /**
     * @inheritDoc
     */
    public function getBoard(int $boardId): Board
    {
        return \Mockery::mock(Board::class)
            ->makePartial()
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('setMovement')
            ->andReturn(null)
            ->getMock();
    }
}