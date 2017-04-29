<?php

namespace Application\UseCase\Game\Dto;

use Domain\User\Model\User;

/**
 * Class MovementDto
 */
class MovementDto
{
    const
        X = 'X',
        O = 'O',
        blank = ' ';

    /** @var  int */
    private $positionX;

    /** @var  int */
    private $positionY;

    /** @var  string */
    private $type;

    /** @var  User */
    private $user;

    /**
     * MovementDto constructor.
     * @param int $positionX
     * @param int $positionY
     * @param string $type
     * @param User|null $user
     */
    public function __construct(int $positionX, int $positionY, string $type, User $user = null)
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
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }
}