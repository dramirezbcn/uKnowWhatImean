<?php

namespace Application\UseCase\Game\Dto;

use Domain\User\Model\User;

/**
 * Class Movement
 */
class MovementDto
{
    const
        X = 'X',
        O = 'O';

    /** @var  int */
    private $positionX;

    /** @var  int */
    private $positionY;

    /** @var  string */
    private $type;

    /** @var  User */
    private $user;

    /**
     * Movement constructor.
     * @param int $positionX
     * @param int $positionY
     * @param string $type
     * @param User $user
     */
    public function __construct(int $positionX, int $positionY, string $type, User $user)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->type = $type;
        $this->user = $user;
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}