<?php

namespace Tests\Application\UseCase\Game;

use Application\UseCase\Game\Request\CreateGameRequest;
use Application\UseCase\Game\GameCommand;
use Application\UseCase\Game\Request\MovementRequest;
use Application\UseCase\Game\Dto\MovementDto;
use Application\UseCase\User\Request\CreateUserRequest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameCommandTest extends KernelTestCase
{
    /** @var  GameCommand */
    private $gameCommand;

    protected function setUp()
    {
        self::bootKernel();

        $this->gameCommand = static::$kernel->getContainer()->get('game.use_case.game_command');
    }

    public function testCommandCreate()
    {
        $userCommand = static::$kernel->getContainer()->get('user.use_case.user_command');
        $user1 = $userCommand->create(new CreateUserRequest('userNameTest1'));
        $user2 = $userCommand->create(new CreateUserRequest('userNameTest2'));

        $createGameRequest = new CreateGameRequest($user1->getId(), $user2->getId());

        $storedGame = $this->gameCommand->create($createGameRequest);

        self::assertEquals($storedGame->getFirstUser()->getName(), $user1->getName());
        self::assertEquals($storedGame->getSecondUser()->getName(), $user2->getName());
        self::assertInternalType('int', $storedGame->getId());
        self::assertInternalType('array',$storedGame->getBoard()->getBoardPositions());
    }

    public function testCommandDoMovement()
    {
        $userCommand = static::$kernel->getContainer()->get('user.use_case.user_command');
        $user1 = $userCommand->create(new CreateUserRequest('userNameTest1'));
        $user2 = $userCommand->create(new CreateUserRequest('userNameTest2'));

        $createGameRequest = new CreateGameRequest($user1->getId(), $user2->getId());

        $storedGame = $this->gameCommand->create($createGameRequest);

        $movementRequest1 = new MovementRequest(
            $storedGame->getId(),
                1,
                1,
                MovementDto::X,
            $user1->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest2 = new MovementRequest(
            $storedGame->getId(),
            2,
            2,
            MovementDto::O,
            $user2->getId()
        );

        $game = $this->gameCommand->makeMovement($movementRequest2);

        self::assertEquals($game->getBoard()
            ->getBoardPositions()[$movementRequest1->getPositionX()][$movementRequest1->getPositionY()]->getUser()->getId(),
            $movementRequest1->getUser()
        );

        self::assertEquals($game->getBoard()
            ->getBoardPositions()[$movementRequest1->getPositionX()][$movementRequest1->getPositionY()]->getType(),
            $movementRequest1->getType()
        );

        self::assertEquals($game->getBoard()
            ->getBoardPositions()[$movementRequest2->getPositionX()][$movementRequest2->getPositionY()]->getUser()->getId(),
            $movementRequest2->getUser()
        );

        self::assertEquals($game->getBoard()
            ->getBoardPositions()[$movementRequest2->getPositionX()][$movementRequest2->getPositionY()]->getType(),
            $movementRequest2->getType()
        );
    }

    public function testCommandCheckWinner()
    {
        $userCommand = static::$kernel->getContainer()->get('user.use_case.user_command');
        $user1 = $userCommand->create(new CreateUserRequest('userNameTest1'));
        $user2 = $userCommand->create(new CreateUserRequest('userNameTest2'));
        $createGameRequest = new CreateGameRequest($user1->getId(), $user2->getId());

        //Check vertical winner
        //=========================
        $game = $this->gameCommand->create($createGameRequest);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            2,
            0,
            MovementDto::X,
            $user1->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            2,
            1,
            MovementDto::X,
            $user1->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            2,
            2,
            MovementDto::X,
            $user1->getId()
        );

        $game = $this->gameCommand->makeMovement($movementRequest1);

        $user = $this->gameCommand->checkGameWinnerOrOver($game->getId());

        self::assertEquals($user, $user1);

        //Check horizontal winner
        //=========================
        $game = $this->gameCommand->create($createGameRequest);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            0,
            0,
            MovementDto::O,
            $user2->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            1,
            0,
            MovementDto::O,
            $user2->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            2,
            0,
            MovementDto::O,
            $user2->getId()
        );

        $game = $this->gameCommand->makeMovement($movementRequest1);

        $user = $this->gameCommand->checkGameWinnerOrOver($game->getId());

        self::assertEquals($user, $user2);

        //Check diagonal winner
        //=========================
        $game = $this->gameCommand->create($createGameRequest);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            0,
            0,
            MovementDto::O,
            $user2->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            1,
            1,
            MovementDto::O,
            $user2->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            2,
            2,
            MovementDto::O,
            $user2->getId()
        );

        $game = $this->gameCommand->makeMovement($movementRequest1);

        $user = $this->gameCommand->checkGameWinnerOrOver($game->getId());

        self::assertEquals($user, $user2);

        //Check anti-diagonal winner
        //=========================
        $game = $this->gameCommand->create($createGameRequest);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            2,
            0,
            MovementDto::O,
            $user2->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            1,
            1,
            MovementDto::O,
            $user2->getId()
        );

        $this->gameCommand->makeMovement($movementRequest1);

        $movementRequest1 = new MovementRequest(
            $game->getId(),
            0,
            2,
            MovementDto::O,
            $user2->getId()
        );

        $game = $this->gameCommand->makeMovement($movementRequest1);

        $user = $this->gameCommand->checkGameWinnerOrOver($game->getId());

        self::assertEquals($user, $user2);
    }
}
