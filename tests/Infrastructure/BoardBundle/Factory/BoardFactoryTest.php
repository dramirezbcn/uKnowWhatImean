<?php

namespace Tests\Infrastructure\BoardBundle\Repository;

use Domain\Board\Model\Board;
use Domain\User\Model\User;
use Infrastructure\BoardBundle\Factory\BoardFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class BoardFactoryTest
 * @package Tests\Infrastructure\BoardBundle\Repository
 */
class BoardFactoryTest extends KernelTestCase
{
    /** @var  BoardFactory */
    private $boardFactory;

    /** @var User $firstUserMock */
    private $firstUserMock;

    /** @var User $secondUserMock */
    private $secondUserMock;

    /** @var Board $boardMock */
    private $boardMock;

    protected function setUp()
    {
        self::bootKernel();

        $this->boardMock = \Mockery::mock(Board::class)
            ->shouldReceive('getBoardPositions')
            ->andReturn(array(array()))
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();

        $this->boardFactory = static::$kernel->getContainer()->get('board.factory.board');
    }

    public function testFactory()
    {
        $createdBoard = $this->boardFactory->create();

        self::assertEquals($this->boardMock->getBoardPositions(), $createdBoard->getBoardPositions());
    }
}
