<?php

namespace Domain\Board\Model;

use Application\UseCase\Game\Dto\MovementDto;

/**
 * Class Board
 */
class Board
{
    /** @var  int */
    private $id;

    /** @var  MovementDto[][] */
    private $boardPositions;

    /** @var  \DateTime */
    private $createdAt;

    /** @var  \DateTime */
    private $updatedAt;

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->boardPositions = array(array());
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \Application\UseCase\Game\Dto\MovementDto[][]
     */
    public function getBoardPositions(): array
    {
        return $this->boardPositions;
    }

    /**
     * @param MovementDto $movement
     */
    public function setMovement(MovementDto $movement)
    {
        $this->boardPositions[$movement->getPositionX()][$movement->getPositionY()] = $movement;
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}