<?php

namespace Tests\Infrastructure\GameBundle\Repository;

use Application\UseCase\User\Request\CreateUserRequest;
use Infrastructure\GameBundle\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameRepositoryTest extends KernelTestCase
{
    /** @var  GameRepository */
    private $gameRepository;

    protected function setUp()
    {
        self::bootKernel();

        $this->gameRepository = static::$kernel->getContainer()->get('game.repository.game');
    }

    public function testRepositoryStore()
    {
        $userCommand = static::$kernel->getContainer()->get('user.use_case.user_command');
        $user1 = $userCommand->create(new CreateUserRequest('userNameTest1'));
        $user2 = $userCommand->create(new CreateUserRequest('userNameTest2'));

        $boardCommand = static::$kernel->getContainer()->get('board.use_case.board_command');
        $board = $boardCommand->create(3);

        $gameFactory = static::$kernel->getContainer()->get('game.factory.game');

        $storedGame = $this->gameRepository->store($gameFactory->create($user1, $user2, $board));

        self::assertEquals($user1, $storedGame->getFirstUser());
        self::assertEquals($user2, $storedGame->getSecondUser());
        self::assertEquals($board, $storedGame->getBoard());
    }

    public function testRepositoryGetGame()
    {
        $userCommand = static::$kernel->getContainer()->get('user.use_case.user_command');
        $user1 = $userCommand->create(new CreateUserRequest('userNameTest1'));
        $user2 = $userCommand->create(new CreateUserRequest('userNameTest2'));

        $boardCommand = static::$kernel->getContainer()->get('board.use_case.board_command');
        $board = $boardCommand->create(3);

        $gameFactory = static::$kernel->getContainer()->get('game.factory.game');

        $storedGame = $this->gameRepository->store($gameFactory->create($user1, $user2, $board));

        $game = $this->gameRepository->getGame($storedGame->getId());

        self::assertEquals($game, $storedGame);
    }
}
