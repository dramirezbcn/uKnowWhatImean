<?php

namespace Tests\Application\UseCase\Game;

use Application\UseCase\Game\Request\CreateGameRequest;
use Application\UseCase\Game\GameCommand;
use Application\UseCase\Game\GameQuery;
use Application\UseCase\User\UserQuery;
use Domain\Game\Model\Game;
use Domain\User\Model\User;
use Infrastructure\GameBundle\Factory\GameFactory;
use Infrastructure\GameBundle\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameCommandTest extends KernelTestCase
{
    /** @var  GameCommand */
    private $gameCommand;

    /** @var User $firstUserMock */
    private $firstUserMock;

    /** @var User $secondUserMock */
    private $secondUserMock;

    /** @var Game $gameMock */
    private $gameMock;

    /** @var GameFactory $gameFactoryMock */
    private $gameFactoryMock;

    /** @var GameRepository $gameRepositoryMock */
    private $gameRepositoryMock;

    /** @var UserQuery $userQueryMock */
    private $userQueryMock;

    protected function setUp()
    {
        self::bootKernel();

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
            ->getMock();

        $this->gameFactoryMock = \Mockery::mock(GameFactory::class)
            ->shouldReceive('create')
            ->andReturn($this->gameMock)
            ->getMock();

        $this->gameRepositoryMock = \Mockery::mock(GameRepository::class)
            ->shouldReceive('store')
            ->andReturn($this->gameMock)
            ->getMock();

        $this->userQueryMock = \Mockery::mock(UserQuery::class)
            ->shouldReceive('getUser')
            ->withArgs([1])
            ->andReturn($this->firstUserMock)
            ->shouldReceive('getUser')
            ->withArgs([2])
            ->andReturn($this->secondUserMock)
            ->getMock();

        $this->gameCommand = new GameCommand($this->gameFactoryMock, $this->gameRepositoryMock, $this->userQueryMock);
    }

    public function testCommandCreate()
    {
        $createGameRequest = new CreateGameRequest(1, 2);

        $storedGame = $this->gameCommand->create($createGameRequest);

        self::assertEquals($createGameRequest->getFirstUser(), $storedGame->getFirstUser()->getId());
        self::assertEquals($createGameRequest->getSecondUser(), $storedGame->getSecondUser()->getId());
    }
}
