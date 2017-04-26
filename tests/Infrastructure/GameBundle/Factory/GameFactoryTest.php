<?php

namespace Tests\Infrastructure\GameBundle\Repository;

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

    /** @var User $firstUserMock */
    private $firstUserMock;

    /** @var User $secondUserMock */
    private $secondUserMock;

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

        $this->gameFactory = static::$kernel->getContainer()->get('game.factory.game');
    }

    public function testFactory()
    {
        $createdGame = $this->gameFactory->create($this->firstUserMock, $this->secondUserMock);

        self::assertEquals($this->firstUserMock, $createdGame->getFirstUser());
        self::assertEquals($this->secondUserMock, $createdGame->getSecondUser());
    }
}
