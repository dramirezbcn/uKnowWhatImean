<?php

namespace Tests\Application\UseCase\Board;

use Application\UseCase\Board\BoardCommand;
use Domain\Board\Model\Board;
use Infrastructure\BoardBundle\Factory\BoardFactory;
use Infrastructure\BoardBundle\Repository\BoardRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BoardCommandTest extends KernelTestCase
{
    /** @var  BoardCommand */
    private $boardCommand;

    /** @var Board $boardMock */
    private $boardMock;

    /** @var BoardFactory $boardFactoryMock */
    private $boardFactoryMock;

    /** @var BoardRepository $boardRepositoryMock */
    private $boardRepositoryMock;

    protected function setUp()
    {
        self::bootKernel();

        $this->boardMock = \Mockery::mock(Board::class)
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();

        $this->boardRepositoryMock = \Mockery::mock(BoardRepository::class)
            ->shouldReceive('store')
            ->andReturn($this->boardMock)
            ->getMock();

        $this->boardFactoryMock = \Mockery::mock(BoardFactory::class)
            ->shouldReceive('create')
            ->andReturn($this->boardMock)
            ->getMock();

        $this->boardCommand = new BoardCommand(
            $this->boardFactoryMock,
            $this->boardRepositoryMock
        );
    }

    public function testCommandCreate()
    {
        $storedBoard = $this->boardCommand->create();

        self::assertEquals($storedBoard->getId(), 1);
        self::assertEquals($storedBoard->getBoardPositions(), array(array()));
    }
}
