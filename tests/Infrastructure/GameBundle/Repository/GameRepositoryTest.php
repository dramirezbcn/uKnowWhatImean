<?php

namespace Tests\Infrastructure\GameBundle\Repository;

use Domain\Board\Model\Board;
use Domain\Game\Model\Game;
use Domain\User\Model\User;
use Infrastructure\GameBundle\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameRepositoryTest extends KernelTestCase
{
    /** @var  GameRepository */
    private $gameRepository;

    /** @var User $firstUserMock */
    private $firstUserMock;

    /** @var User $secondUserMock */
    private $secondUserMock;

    /** @var Game $gameMock */
    private $gameMock;

    /** @var Board $boardMock */
    private $boardMock;

    protected function setUp()
    {
        self::bootKernel();

        $this->gameRepository = static::$kernel->getContainer()->get('game.repository.game');

        $this->firstUserMock = \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn('firstUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();

        $this->secondUserMock = \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn('secondUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(2)
            ->getMock();

        $this->boardMock = \Mockery::mock(Board::class)
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();

        $this->gameMock = \Mockery::mock(Game::class)
            ->shouldReceive('getFirstUser')
            ->andReturn($this->firstUserMock)
            ->shouldReceive('getSecondUser')
            ->andReturn($this->secondUserMock)
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('getBoard')
            ->andReturn($this->boardMock)
            ->getMock();
    }

    public function testRepositoryStore()
    {
        $storedGame = $this->gameRepository->store($this->gameMock);

        self::assertEquals($this->gameMock->getFirstUser()->getName(), $storedGame->getFirstUser()->getName());
        self::assertEquals($this->gameMock->getSecondUser()->getName(), $storedGame->getSecondUser()->getName());
        self::assertEquals($this->gameMock->getBoard()->getId(), $storedGame->getBoard()->getId());
    }

    public function testRepositoryGetGame()
    {
        $game = $this->gameRepository->getGame($this->gameMock->getId());

        self::assertEquals($this->gameMock->getId(), $game->getId());
    }
}
