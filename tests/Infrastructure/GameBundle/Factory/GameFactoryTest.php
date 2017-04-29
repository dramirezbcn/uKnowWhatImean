<?php

namespace Tests\Infrastructure\GameBundle\Repository;

use Application\UseCase\User\Request\CreateUserRequest;
use Domain\Board\Model\Board;
use Domain\User\Model\User;
use Infrastructure\GameBundle\Factory\GameFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class GameFactoryTest
 * @package Tests\Infrastructure\GameBundle\Repository
 */
class GameFactoryTest extends KernelTestCase
{
    /** @var  GameFactory */
    private $gameFactory;

    protected function setUp()
    {
        self::bootKernel();

        $this->gameFactory = static::$kernel->getContainer()->get('game.factory.game');
    }

    public function testFactory()
    {
        $userCommand = static::$kernel->getContainer()->get('user.use_case.user_command');
        $user1 = $userCommand->create(new CreateUserRequest('userNameTest1'));
        $user2 = $userCommand->create(new CreateUserRequest('userNameTest2'));

        $boardCommand = static::$kernel->getContainer()->get('board.use_case.board_command');
        $board = $boardCommand->create(3);

        $createdGame = $this->gameFactory->create($user1, $user2, $board);

        self::assertEquals($user1, $createdGame->getFirstUser());
        self::assertEquals($user2, $createdGame->getSecondUser());
        self::assertEquals($board, $createdGame->getBoard());
    }
}
