<?php

namespace Tests\Infrastructure\GameBundle\Repository;

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

        $this->gameMock = \Mockery::mock(Game::class)
            ->shouldReceive('getFirstUser')
            ->andReturn($this->firstUserMock)
            ->shouldReceive('getSecondUser')
            ->andReturn($this->secondUserMock)
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();
    }

    public function testRepositoryStore()
    {
        $storedGame = $this->gameRepository->store($this->gameMock);

        self::assertEquals($this->gameMock->getFirstUser(), $storedGame->getFirstUser());
        self::assertEquals($this->gameMock->getSecondUser(), $storedGame->getSecondUser());
    }

    public function testRepositoryGetGame()
    {
        $game = $this->gameRepository->getGame($this->gameMock->getId());

        self::assertEquals($this->gameMock->getId(), $game->getId());
    }
}
