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

    /** @var int */
    private $boardSize;

    /** @var  MovementDto[][] */
    private $boardPositions;

    /** @var  \DateTime */
    private $createdAt;

    /** @var  \DateTime */
    private $updatedAt;

    /**
     * Board constructor.
     * @param int $boardSize
     */
    public function __construct(int $boardSize)
    {
        $this->boardSize = $boardSize;

        $this->initializeBoard();

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
     * @return MovementDto[][]
     */
    public function getBoardPositions(): array
    {
        return $this->boardPositions;
    }

    /**
     * @param MovementDto $movement
     * @return Board
     */
    public function setMovement(MovementDto $movement): Board
    {
        $this->boardPositions[$movement->getPositionX()][$movement->getPositionY()] = $movement;
        $this->updatedAt = new \DateTime();

        return $this;
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

    /**
     * @return int
     */
    public function getBoardSize(): int
    {
        return $this->boardSize;
    }

    /**
     * Initialize to blank MovementDto all the positions
     */
    private function initializeBoard()
    {
        $this->boardPositions = array();
        for ($x = 0; $x < $this->boardSize; $x++) {
            $this->boardPositions[$x] = array();
            for ($y = 0; $y < $this->boardSize; $y++) {
                $this->boardPositions[$x][] =
                    new MovementDto($x, $y, MovementDto::blank, null);
            }
        }
    }
}