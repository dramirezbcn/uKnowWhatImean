<?php

namespace Tests\Infrastructure\BoardBundle\Repository;

use Domain\Board\Model\Board;
use Infrastructure\BoardBundle\Repository\BoardRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BoardRepositoryTest extends KernelTestCase
{
    /** @var  BoardRepository */
    private $boardRepository;

    /** @var Board $boardMock */
    private $boardMock;

    protected function setUp()
    {
        self::bootKernel();

        $this->boardRepository = static::$kernel->getContainer()->get('board.repository.board');

        $this->boardMock = \Mockery::mock(Board::class)
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();
    }

    public function testRepositoryStore()
    {
        $storedBoard = $this->boardRepository->store($this->boardMock);

        self::assertEquals($this->boardMock->getId(), $storedBoard->getId());
        self::assertEquals($this->boardMock->getBoardPositions(), $storedBoard->getBoardPositions());
    }

    public function testRepositoryGetBoard()
    {
        $board = $this->boardRepository->getBoard($this->boardMock->getId());

        self::assertEquals($this->boardMock->getId(), $board->getId());
    }
}
