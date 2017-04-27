<?php

namespace Tests\Application\UseCase\Game;

use Application\UseCase\Game\Request\CreateGameRequest;
use Application\UseCase\Game\GameCommand;
use Application\UseCase\Game\Request\MovementRequest;
use Application\UseCase\User\UserQuery;
use Domain\Board\Model\Board;
use Domain\Game\Model\Game;
use Application\UseCase\Game\Dto\MovementDto;
use Domain\User\Model\User;
use Infrastructure\BoardBundle\Factory\BoardFactory;
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

    /** @var Board $boardMock */
    private $boardMock;

    /** @var BoardFactory $boardFactoryMock */
    private $boardFactoryMock;

    protected function setUp()
    {
        self::bootKernel();

        $this->firstUserMock = \Mockery::mock(User::class)
            ->makePartial()
            ->shouldReceive('getName')
            ->andReturn('firstUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();

        $this->secondUserMock = \Mockery::mock(User::class)
            ->makePartial()
            ->shouldReceive('getName')
            ->andReturn('secondUserNameTest')
            ->shouldReceive('getId')
            ->andReturn(2)
            ->getMock();

        $this->boardMock = \Mockery::mock(Board::class)
            ->makePartial()
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('setMovement')
            ->andReturn(null)
            ->getMock();

        $this->gameMock = \Mockery::mock(Game::class)
            ->makePartial()
            ->shouldReceive('getFirstUser')
            ->andReturn($this->firstUserMock)
            ->shouldReceive('getSecondUser')
            ->andReturn($this->secondUserMock)
            ->shouldReceive('getId')
            ->andReturn(1)
            ->shouldReceive('getBoard')
            ->andReturn($this->boardMock)
            ->getMock();

        $this->gameFactoryMock = \Mockery::mock(GameFactory::class)
            ->makePartial()
            ->shouldReceive('create')
            ->andReturn($this->gameMock)
            ->getMock();

        $this->gameRepositoryMock = \Mockery::mock(GameRepository::class)
            ->makePartial()
            ->shouldReceive('store')
            ->andReturn($this->gameMock)
            ->shouldReceive('getGame')
            ->andReturn($this->gameMock)
            ->getMock();

        $this->userQueryMock = \Mockery::mock(UserQuery::class)
            ->makePartial()
            ->shouldReceive('getUser')
            ->withArgs([1])
            ->andReturn($this->firstUserMock)
            ->shouldReceive('getUser')
            ->withArgs([2])
            ->andReturn($this->secondUserMock)
            ->getMock();

        $this->boardFactoryMock = \Mockery::mock(BoardFactory::class)
            ->makePartial()
            ->shouldReceive('create')
            ->andReturn($this->boardMock)
            ->getMock();

        $this->gameCommand = new GameCommand(
            $this->gameFactoryMock,
            $this->gameRepositoryMock,
            $this->userQueryMock,
            $this->boardFactoryMock
        );
    }

    public function testCommandCreate()
    {
        $createGameRequest = new CreateGameRequest(1, 2);

        $storedGame = $this->gameCommand->create($createGameRequest);

        self::assertEquals($createGameRequest->getFirstUser(), $storedGame->getFirstUser()->getId());
        self::assertEquals($createGameRequest->getSecondUser(), $storedGame->getSecondUser()->getId());
    }

    public function testCommandDoMovement()
    {
        $movementRequest = new MovementRequest(1, 2, 2, MovementDto::X, 1);

        $game = $this->gameCommand->makeMovement($movementRequest);

        self::assertEquals($movementRequest->getGame(), $game->getId());
    }

    public function testCommandCheckWinner()
    {
        $user = $this->gameCommand->checkGameWinner(1);

        self::assertInstanceOf(User::class, $user);
    }
}
