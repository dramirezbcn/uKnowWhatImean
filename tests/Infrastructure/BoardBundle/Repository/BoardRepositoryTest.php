<?php

namespace Tests\Infrastructure\BoardBundle\Repository;

use Domain\Board\Model\Board;
use Infrastructure\BoardBundle\Repository\BoardRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BoardRepositoryTest extends KernelTestCase
{
    /** @var  BoardRepository */
    private $boardRepository;

    protected function setUp()
    {
        self::bootKernel();

        $this->boardRepository = static::$kernel->getContainer()->get('board.repository.board');
    }

    public function testRepositoryStore()
    {
        $storedBoard = $this->boardRepository->store(new Board(3));

        $this->assertInternalType('int', $storedBoard->getId());
        self::assertCount(3, $storedBoard->getBoardPositions());
    }

    public function testRepositoryGetBoard()
    {
        $storedBoard = $this->boardRepository->store(new Board(3));

        $board = $this->boardRepository->getBoard($storedBoard->getId());

        self::assertEquals($storedBoard->getId(), $board->getId());
    }
}
