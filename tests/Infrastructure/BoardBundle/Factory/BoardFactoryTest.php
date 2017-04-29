<?php

namespace Tests\Infrastructure\BoardBundle\Repository;

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

    protected function setUp()
    {
        self::bootKernel();

        $this->boardFactory = static::$kernel->getContainer()->get('board.factory.board');
    }

    public function testFactory()
    {
        $createdBoard = $this->boardFactory->create(3);

        self::assertCount(3, $createdBoard->getBoardPositions());
    }
}
