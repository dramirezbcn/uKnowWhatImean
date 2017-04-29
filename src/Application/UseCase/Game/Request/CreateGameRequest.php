<?php

namespace Application\UseCase\Game\Request;

/**
 * Class CreateGameRequest
 * @package Application\UseCase\Game\Request
 */
class CreateGameRequest
{
    /** @var  int */
    private $firstUser;

    /** @var  int */
    private $secondUser;

    /** @var  int */
    private $boardSize;

    /**
     * CreateGameRequest constructor.
     * @param int $firstUser
     * @param int $secondUser
     * @param int $boardSize
     */
    public function __construct(int $firstUser, int $secondUser, int $boardSize = 3)
    {
        $this->firstUser = $firstUser;
        $this->secondUser = $secondUser;
        $this->boardSize = $boardSize;
    }

    /**
     * @return int
     */
    public function getFirstUser(): int
    {
        return $this->firstUser;
    }

    /**
     * @return int
     */
    public function getSecondUser(): int
    {
        return $this->secondUser;
    }

    /**
     * @return int
     */
    public function getBoardSize(): int
    {
        return $this->boardSize;
    }
}