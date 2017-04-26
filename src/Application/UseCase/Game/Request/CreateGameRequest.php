<?php

namespace Application\UseCase\Game\Request;

/**
 * Class CreateGameRequest
 * @package Application\UseCase\Game\Request
 */
class CreateGameRequest
{
    /** @var  string */
    private $firstUser;

    /** @var  string */
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
     * @return string
     */
    public function getFirstUser(): string
    {
        return $this->firstUser;
    }

    /**
     * @return string
     */
    public function getSecondUser(): string
    {
        return $this->secondUser;
    }
}