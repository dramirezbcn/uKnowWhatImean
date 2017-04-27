<?php

namespace Application\UseCase\Game\Request;

/**
 * Class MovementRequest
 * @package Application\UseCase\Game\Request
 */
class MovementRequest
{
    /** @var  int */
    private $game;

    /** @var  int */
    private $positionX;

    /** @var  int */
    private $positionY;

    /** @var  string */
    private $type;

    /** @var  int */
    private $user;

    /**
     * MovementRequest constructor.
     * @param int $game
     * @param int $positionX
     * @param int $positionY
     * @param string $type
     * @param int $user
     */
    public function __construct(int $game, int $positionX, int $positionY, string $type, int $user)
    {
        $this->game = $game;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->type = $type;
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getGame(): int
    {
        return $this->game;
    }

    /**
     * @return int
     */
    public function getPositionX(): int
    {
        return $this->positionX;
    }

    /**
     * @return int
     */
    public function getPositionY(): int
    {
        return $this->positionY;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }
}