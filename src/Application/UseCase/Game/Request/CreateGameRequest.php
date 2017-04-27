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

    /**
     * CreateGameRequest constructor.
     * @param int $firstUser
     * @param int $secondUser
     */
    public function __construct(int $firstUser, int $secondUser)
    {
        $this->firstUser = $firstUser;
        $this->secondUser = $secondUser;
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
}