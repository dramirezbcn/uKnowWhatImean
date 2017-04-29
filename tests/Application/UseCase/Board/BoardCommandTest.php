<?php

namespace Tests\Application\UseCase\Board;

use Application\UseCase\Board\BoardCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BoardCommandTest extends KernelTestCase
{
    /** @var  BoardCommand */
    private $boardCommand;

    protected function setUp()
    {
        self::bootKernel();

        $this->boardCommand = static::$kernel->getContainer()->get('board.use_case.board_command');
    }

    public function testCommandCreate()
    {
        $storedBoard = $this->boardCommand->create(3);

        self::assertInternalType('int', $storedBoard->getId());
        self::assertInternalType('array', $storedBoard->getBoardPositions());
    }
}
